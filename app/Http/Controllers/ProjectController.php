<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $headers = \App\Models\Setting::all();
        $projects = Project::orderByDesc('created_at')->paginate(12);

        $totalProjects = Project::count();
        $newProjectCount = Project::where('status', 'new')->count();
        $inProgressCount = Project::where('status', 'in_progress')->count();
        $inHoldCount = Project::where('status', 'in_hold')->count();
        $delayedCount = Project::where('status', 'delayed')->count();

        return view('Chats.project', compact(
            'headers',
            'projects',
            'totalProjects',
            'newProjectCount',
            'inProgressCount',
            'inHoldCount',
            'delayedCount'
        ));
    }

    public function store(Request $request)
    {
       // dd($request->all());
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'status' => 'nullable|in:new,in_progress,in_hold,delayed,completed',
            'priority' => 'nullable|in:low,medium,high',
            'start_date' => 'nullable|date|after_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'reminder_days' => 'nullable|integer|min:0|max:365',
            'progress_percent' => 'nullable|integer|min:0|max:100',
            'logo' => 'nullable|image|max:2048',
            'sections' => 'nullable|array',
            'sections.*.name' => 'nullable|string|max:255',
            'sections.*.description' => 'nullable|string|max:1000',
            'attachments' => 'nullable',
            'attachments.*' => 'file|mimes:pdf|max:10240',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('projects', 'public');
        }

        // Normalize sections (remove empty rows)
        $sections = collect($request->input('sections', []))
            ->map(function ($row) {
                return [
                    'name' => isset($row['name']) ? trim($row['name']) : null,
                    'description' => isset($row['description']) ? trim($row['description']) : null,
                ];
            })
            ->filter(function ($row) {
                return ($row['name'] !== null && $row['name'] !== '') || ($row['description'] !== null && $row['description'] !== '');
            })
            ->values()
            ->all();

        // Save attachments
        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ((array) $request->file('attachments') as $file) {
                if (!$file) continue;
                $path = $file->store('project_attachments', 'public');
                $attachments[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'url'  => asset('storage/' . $path),
                    'size_kb' => round($file->getSize() / 1024),
                ];
            }
        }

        // Generate a unique code like XY-1000 where XY are first & last letters of title
        $generatedCode = $validated['code'] ?? null;
        if ($generatedCode === null || trim($generatedCode) === '') {
            $title = (string) ($validated['title'] ?? 'Project');
            // Extract first and last alphabetic letters; fallback to first/last char if no letters
            $firstLetter = null;
            if (preg_match('/[A-Za-z]/', $title, $m, 0, 0)) {
                // find first alpha
                preg_match('/[A-Za-z]/', $title, $m);
                $firstLetter = $m[0];
            }
            $lastLetter = null;
            if (preg_match('/[A-Za-z](?!.*[A-Za-z])/', $title, $m)) {
                $lastLetter = $m[0];
            }
            if ($firstLetter === null) {
                $firstLetter = mb_substr($title, 0, 1) ?: 'P';
            }
            if ($lastLetter === null) {
                $lastLetter = mb_substr($title, -1) ?: 'R';
            }
            $prefix = strtoupper($firstLetter . $lastLetter);

            // Determine next incremental number per prefix, starting at 1001
            $base = 1001;
            // Match any separator after prefix (space or dash), digits are extracted below
            $existingCodes = Project::where('code', 'like', $prefix . '%')->pluck('code')->all();
            $maxNum = null;
            foreach ($existingCodes as $codeVal) {
                if (!is_string($codeVal)) continue;
                if (stripos($codeVal, $prefix . '-') !== 0) continue;
                $numPart = preg_replace('/[^0-9]/', '', substr($codeVal, strlen($prefix) + 1) ?: '');
                if ($numPart !== '' && ctype_digit($numPart)) {
                    $n = (int) $numPart;
                    if ($maxNum === null || $n > $maxNum) $maxNum = $n;
                }
            }
            $nextNumber = ($maxNum === null) ? $base : ($maxNum + 1);
            // Use dash separator as requested: e.g., "LM-1001"
            $candidate = $prefix . '-' . (string) $nextNumber;
            // Ensure uniqueness guard
            $guard = 0;
            while (Project::where('code', $candidate)->exists() && $guard < 1000) {
                $nextNumber++;
                $candidate = $prefix . '-' . (string) $nextNumber;
                $guard++;
            }
            $generatedCode = $candidate;
        }

        $project = Project::create([
            'title' => $validated['title'],
            'code' => $generatedCode,
            'status' => $validated['status'] ?? 'new',
            'priority' => $validated['priority'] ?? 'low',
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'description' => $validated['description'] ?? null,
            'reminder_days' => $validated['reminder_days'] ?? null,
            'progress_percent' => $validated['progress_percent'] ?? 0,
            'logo_path' => $logoPath,
            'sections' => $sections,
            'attachments' => $attachments,
        ]);

        return redirect()->route('chat-project')->with('success', 'Project created successfully.');
    }

    public function update(Request $request, string $id)
    {
       // dd($request->all());
        $project = Project::find($id);
        if (!$project) {
            return redirect()->route('chat-project')->with('error', 'Project not found.');
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'status' => 'nullable|in:new,in_progress,in_hold,delayed,completed',
            'priority' => 'nullable|in:low,medium,high',
            'start_date' => 'nullable|date|after_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'reminder_days' => 'nullable|integer|min:0|max:365',
            'progress_percent' => 'nullable|integer|min:0|max:100',
            'logo' => 'nullable|image|max:2048',
            'sections' => 'nullable|array',
            'sections.*.name' => 'nullable|string|max:255',
            'sections.*.description' => 'nullable|string|max:1000',
            'attachments' => 'nullable',
            'attachments.*' => 'file|mimes:pdf|max:10240',
            'delete_attachments' => 'nullable|array',
            'delete_attachments.*' => 'integer',
        ]);

        if ($request->hasFile('logo')) {
            try {
                if (!empty($project->logo_path)) {
                    Storage::disk('public')->delete($project->logo_path);
                }
            } catch (\Throwable $e) {
                // ignore
            }
            $project->logo_path = $request->file('logo')->store('projects', 'public');
        }

        // Normalize sections
        $sections = collect($request->input('sections', []))
            ->map(function ($row) {
                return [
                    'name' => isset($row['name']) ? trim($row['name']) : null,
                    'description' => isset($row['description']) ? trim($row['description']) : null,
                ];
            })
            ->filter(function ($row) {
                return ($row['name'] !== null && $row['name'] !== '') || ($row['description'] !== null && $row['description'] !== '');
            })
            ->values()
            ->all();

        $project->title = $validated['title'] ?? $project->title;
        $project->status = $validated['status'] ?? $project->status;
        $project->priority = $validated['priority'] ?? $project->priority;
        $project->start_date = $validated['start_date'] ?? $project->start_date;
        $project->end_date = $validated['end_date'] ?? $project->end_date;
        $project->description = $validated['description'] ?? $project->description;
        $project->reminder_days = $validated['reminder_days'] ?? $project->reminder_days;
        $project->progress_percent = $validated['progress_percent'] ?? $project->progress_percent;
        if ($request->has('sections')) {
            $project->sections = $sections;
        }

        // Handle attachment deletions by index
        $current = collect($project->attachments ?? []);
        $toDeleteIdx = collect($request->input('delete_attachments', []))->map(function($v){ return (int) $v; })->all();
        if (!empty($toDeleteIdx)) {
            $keep = [];
            foreach ($current as $idx => $att) {
                if (in_array($idx, $toDeleteIdx, true)) {
                    try { if (!empty($att['path'])) Storage::disk('public')->delete($att['path']); } catch (\Throwable $e) {}
                    continue;
                }
                $keep[] = $att;
            }
            $current = collect($keep);
        }

        // Handle new attachments
        if ($request->hasFile('attachments')) {
            foreach ((array) $request->file('attachments') as $file) {
                if (!$file) continue;
                $path = $file->store('project_attachments', 'public');
                $current->push([
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'url'  => asset('storage/' . $path),
                    'size_kb' => round($file->getSize() / 1024),
                ]);
            }
        }

        $project->attachments = $current->values()->all();

        $project->save();

        return redirect()->route('chat-project')->with('success', 'Project updated successfully.');
    }
    public function destroy(string $id)
    {
        
        $project = Project::find($id);
        if (!$project) {
            return redirect()->route('chat-project')->with('error', 'Project not found.');
        }
//dd($project);
        $ticketCount = Ticket::where('project_id', (string) ($project->_id ?? $project->id))->count();
        if ($ticketCount > 0) {
            return redirect()->route('chat-project')->with('error', "Cannot delete project '{$project->title}' because it has {$ticketCount} ticket(s).");
        }
       // dd($hasTickets);

        // delete stored logo if present
        if (!empty($project->logo_path)) {
            try {
                Storage::disk('public')->delete($project->logo_path);
            } catch (\Throwable $e) {
                // ignore storage deletion errors
            }
        }

       $projectdata= $project->delete();
 
        return redirect()->route('chat-project')->with('success', 'Project deleted successfully.');
    }
}

