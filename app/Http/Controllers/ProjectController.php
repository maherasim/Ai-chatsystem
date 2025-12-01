<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
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
    
            // Sections
            'sections' => 'nullable|array',
            'sections.*.name' => 'nullable|string|max:255',
            'sections.*.description' => 'nullable|string|max:1000',
            'sections.*.phase_title' => 'nullable|string|max:255',
    
            // Phases
            'phases' => 'nullable|array',
            'phases.*.title' => 'nullable|string|max:255',
            'phases.*.description' => 'nullable|string|max:1000',
            'phases.*.start_date' => 'nullable|date',
            'phases.*.end_date' => 'nullable|date|after_or_equal:phases.*.start_date',
            'phases.*.reminder_days' => 'nullable|integer|min:0|max:365',
    
            'attachments' => 'nullable',
            'attachments.*' => 'file|mimes:pdf|max:10240',
        ]);
    
        // Upload logo
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('projects', 'public');
        }
    
        /*
        |--------------------------------------------------------------------------
        | FIXED SECTIONS PARSING
        |--------------------------------------------------------------------------
        | Converts keys like "0_0", "0_1", "2_3" → 0, 1, 2...
        | Ensures proper storage even with dynamic UI nested keys
        */
        $rawSections = $request->input('sections', []);
    
        $sections = collect($rawSections)
            ->values()     // RESET KEYS → fixes "0_0", "0_1"
            ->map(function ($row) {
                return [
                    'name' => isset($row['name']) ? trim($row['name']) : null,
                    'description' => isset($row['description']) ? trim($row['description']) : null,
                    'phase_title' => isset($row['phase_title']) ? trim($row['phase_title']) : null,
                ];
            })
            ->filter(function ($row) {
                return ($row['name'] && $row['name'] !== '') ||
                       ($row['description'] && $row['description'] !== '') ||
                       ($row['phase_title'] && $row['phase_title'] !== '');
            })
            ->values()
            ->all();
   // dd($sections);
        /*
        |--------------------------------------------------------------------------
        | Attachments
        |--------------------------------------------------------------------------
        */
        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
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
    
        /*
        |--------------------------------------------------------------------------
        | Auto-generate project code
        |--------------------------------------------------------------------------
        */
        $generatedCode = $validated['code'] ?? null;
    
        if ($generatedCode === null || trim($generatedCode) === '') {
    
            $title = (string) ($validated['title'] ?? 'Project');
    
            preg_match('/[A-Za-z]/', $title, $m);
            $firstLetter = $m[0] ?? mb_substr($title, 0, 1);
    
            preg_match('/[A-Za-z](?!.*[A-Za-z])/', $title, $m);
            $lastLetter = $m[0] ?? mb_substr($title, -1);
    
            $prefix = strtoupper($firstLetter . $lastLetter);
    
            $base = 1001;
    
            $existingCodes = Project::where('code', 'like', $prefix . '%')->pluck('code')->all();
            $maxNum = null;
    
            foreach ($existingCodes as $codeVal) {
                if (!is_string($codeVal)) continue;
                if (stripos($codeVal, $prefix . '-') !== 0) continue;
    
                $numPart = preg_replace('/[^0-9]/', '', substr($codeVal, strlen($prefix) + 1));
    
                if ($numPart !== '' && ctype_digit($numPart)) {
                    $n = (int) $numPart;
                    if ($maxNum === null || $n > $maxNum) $maxNum = $n;
                }
            }
    
            $nextNumber = $maxNum === null ? $base : $maxNum + 1;
            $candidate = $prefix . '-' . $nextNumber;
    
            $guard = 0;
            while (Project::where('code', $candidate)->exists() && $guard < 1000) {
                $nextNumber++;
                $candidate = $prefix . '-' . $nextNumber;
                $guard++;
            }
    
            $generatedCode = $candidate;
        }
    
        /*
        |--------------------------------------------------------------------------
        | Save data into DB
        |--------------------------------------------------------------------------
        */
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
    
            // FIXED sections storing
            'sections' => $sections,
    
            // Phases
            'phases' => collect($request->input('phases', []))
                ->map(function ($row) {
                    return [
                        'title' => $row['title'] ?? null,
                        'description' => $row['description'] ?? null,
                        'start_date' => !empty($row['start_date']) ? (string) $row['start_date'] : null,
                        'end_date' => !empty($row['end_date']) ? (string) $row['end_date'] : null,
                        'reminder_days' => isset($row['reminder_days']) ? (int)$row['reminder_days'] : null,
                    ];
                })
                ->filter(function ($row) {
                    return $row['title'] ||
                           $row['description'] ||
                           $row['start_date'] ||
                           $row['end_date'];
                })
                ->values()
                ->all(),
    
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
            'sections.*.phase_title' => 'nullable|string|max:255',
            // phases
            'phases' => 'nullable|array',
            'phases.*.title' => 'nullable|string|max:255',
            'phases.*.description' => 'nullable|string|max:1000',
            'phases.*.start_date' => 'nullable|date',
            'phases.*.end_date' => 'nullable|date|after_or_equal:phases.*.start_date',
            'phases.*.reminder_days' => 'nullable|integer|min:0|max:365',
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
                    'phase_title' => isset($row['phase_title']) ? trim($row['phase_title']) : null,
                ];
            })
            ->filter(function ($row) {
                return ($row['name'] !== null && $row['name'] !== '') ||
                       ($row['description'] !== null && $row['description'] !== '') ||
                       ($row['phase_title'] !== null && $row['phase_title'] !== '');
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

        // Update phases
        if ($request->has('phases')) {
            $project->phases = collect($request->input('phases', []))->map(function ($row) {
                return [
                    'title' => isset($row['title']) ? trim($row['title']) : null,
                    'description' => isset($row['description']) ? trim($row['description']) : null,
                    'start_date' => isset($row['start_date']) && $row['start_date'] !== '' ? (string) $row['start_date'] : null,
                    'end_date' => isset($row['end_date']) && $row['end_date'] !== '' ? (string) $row['end_date'] : null,
                    'reminder_days' => isset($row['reminder_days']) && $row['reminder_days'] !== '' ? (int) $row['reminder_days'] : null,
                ];
            })->filter(function ($row) {
                return ($row['title'] !== null && $row['title'] !== '') ||
                       ($row['description'] !== null && $row['description'] !== '') ||
                       $row['start_date'] !== null || $row['end_date'] !== null;
            })->values()->all();
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

    /**
     * Lightweight JSON detail for a single project (used by edit modal prefill).
     */
    public function showApi(string $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Not found'], 404);
        }

        // Normalize dates to Y-m-d strings for inputs
        $start = $project->start_date ? (string) (\Carbon\Carbon::parse($project->start_date)->format('Y-m-d')) : null;
        $end   = $project->end_date ? (string) (\Carbon\Carbon::parse($project->end_date)->format('Y-m-d')) : null;

        // Some older records might have JSON stored as strings. Decode defensively.
        $phases = $project->phases;
        if (is_string($phases)) {
            $decoded = json_decode($phases, true);
            $phases = is_array($decoded) ? $decoded : [];
        } elseif (!is_array($phases)) {
            $phases = [];
        }

        $sections = $project->sections;
        if (is_string($sections)) {
            $decoded = json_decode($sections, true);
            $sections = is_array($decoded) ? $decoded : [];
        } elseif (!is_array($sections)) {
            $sections = [];
        }

        $attachments = $project->attachments;
        if (is_string($attachments)) {
            $decoded = json_decode($attachments, true);
            $attachments = is_array($decoded) ? $decoded : [];
        } elseif (!is_array($attachments)) {
            $attachments = [];
        }

        // Teams for this project
        $makeUrl = function ($path) {
            if (!$path) return null;
            $p = ltrim((string) $path, '/');
            if (Str::startsWith($p, ['http://', 'https://'])) {
                return $p;
            }
            if (Str::startsWith($p, ['upload/', 'storage/'])) {
                return asset($p);
            }
            // default: assume stored via storage/app/public
            return asset('storage/' . $p);
        };
        $teams = Team::where('project_id', (string) ($project->_id ?? $project->id))->get();
        $teamsPayload = [];
        foreach ($teams as $team) {
            $taskDevelopers = [];
            $raw = $team->task_developers;
            if (is_string($raw)) {
                $decoded = json_decode($raw, true);
                $raw = is_array($decoded) ? $decoded : [];
            } elseif (!is_array($raw)) {
                $raw = [];
            }
            // Flatten unique developer names from values
            $names = [];
            foreach ($raw as $arr) {
                if (is_array($arr)) {
                    foreach ($arr as $nm) {
                        $t = trim((string) $nm);
                        if ($t !== '' && !in_array($t, $names, true)) $names[] = $t;
                    }
                }
            }
            // Fetch users by name
            $users = empty($names) ? collect() : User::whereIn('name', $names)->get();
            $devs = [];
            foreach ($users as $u) {
                $img = $u->image ?? null;
                $url = $makeUrl($img);
                $devs[] = [
                    'id' => (string) ($u->_id ?? $u->id),
                    'name' => $u->name,
                    'avatar_url' => $url,
                ];
            }
            $teamsPayload[] = [
                'id' => (string) ($team->_id ?? $team->id),
                'title' => $team->title ?? 'Team',
                'developers' => $devs,
                'banner_url' => $makeUrl($team->banner_path),
                'thumb_url' => $makeUrl($team->thumb_path),
            ];
        }

        // Tickets for this project
        $ticketsQuery = Ticket::where('project_id', (string) ($project->_id ?? $project->id))->orderByDesc('created_at');
        $ticketsTotal = (int) $ticketsQuery->count();
        $ticketsList = $ticketsQuery->limit(20)->get();
        $ticketsPayload = [];
        foreach ($ticketsList as $t) {
            $start = $t->start_date ? Carbon::parse($t->start_date) : null;
            $end = $t->end_date ? Carbon::parse($t->end_date) : null;
            $today = Carbon::today();
            $daysLeft = null;
            if ($end) {
                $daysLeft = $today->diffInDays($end, false);
            }
            // compute timeline progress percent based on dates
            $progress = 0;
            if ($start && $end && $end->greaterThanOrEqualTo($start)) {
                $total = max(1, $start->diffInSeconds($end));
                $elapsed = max(0, min($total, $start->diffInSeconds(min($today, $end))));
                $progress = (int) round(($elapsed / $total) * 100);
            }
            $ticketsPayload[] = [
                'id' => (string) ($t->_id ?? $t->id),
                'code' => $t->code,
                'title' => $t->title,
                'status' => $t->status,
                'priority' => $t->priority,
                'section_name' => $t->section_name,
                'start_date' => $t->start_date ? Carbon::parse($t->start_date)->format('Y-m-d') : null,
                'end_date' => $t->end_date ? Carbon::parse($t->end_date)->format('Y-m-d') : null,
                'days_left' => $daysLeft,
                'progress_percent' => $progress,
            ];
        }

        return response()->json([
            'id' => (string) ($project->_id ?? $project->id),
            'code' => $project->code,
            'title' => $project->title,
            'priority' => $project->priority,
            'start_date' => $start,
            'end_date' => $end,
            'description' => $project->description,
            'reminder_days' => $project->reminder_days,
            'progress_percent' => $project->progress_percent,
            'status' => $project->status,
            'logo_url' => $project->logo_path ? asset('storage/' . $project->logo_path) : null,
            'phases' => $phases,
            'sections' => $sections,
            'attachments' => $attachments,
            'teams' => $teamsPayload,
            'tickets' => $ticketsPayload,
            'tickets_total' => $ticketsTotal,
        ]);
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

