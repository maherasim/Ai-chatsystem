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
        $inProgressCount = Project::where('status', 'in_progress')->count();
        $inHoldCount = Project::where('status', 'in_hold')->count();
        $delayedCount = Project::where('status', 'delayed')->count();

        return view('Chats.project', compact(
            'headers',
            'projects',
            'totalProjects',
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
            'status' => 'nullable|in:in_progress,in_hold,delayed,completed',
            'priority' => 'nullable|in:low,medium,high',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'reminder_days' => 'nullable|integer|min:0|max:365',
            'progress_percent' => 'nullable|integer|min:0|max:100',
            'logo' => 'nullable|image|max:2048',
            'sections' => 'nullable|array',
            'sections.*.name' => 'nullable|string|max:255',
            'sections.*.description' => 'nullable|string|max:1000',
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

        $project = Project::create([
            'title' => $validated['title'],
            'code' => $validated['code'] ?? null,
            'status' => $validated['status'] ?? 'in_progress',
            'priority' => $validated['priority'] ?? 'low',
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'description' => $validated['description'] ?? null,
            'reminder_days' => $validated['reminder_days'] ?? null,
            'progress_percent' => $validated['progress_percent'] ?? 0,
            'logo_path' => $logoPath,
            'sections' => $sections,
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
            'status' => 'nullable|in:in_progress,in_hold,delayed,completed',
            'priority' => 'nullable|in:low,medium,high',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'reminder_days' => 'nullable|integer|min:0|max:365',
            'progress_percent' => 'nullable|integer|min:0|max:100',
            'logo' => 'nullable|image|max:2048',
            'sections' => 'nullable|array',
            'sections.*.name' => 'nullable|string|max:255',
            'sections.*.description' => 'nullable|string|max:1000',
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

