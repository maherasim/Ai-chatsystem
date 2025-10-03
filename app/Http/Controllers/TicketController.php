<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index()
    {
        $headers = \App\Models\Setting::all();
        $tickets = Ticket::with('project')->orderByDesc('created_at')->paginate(12);
        return view('Chats.ticket', compact('headers', 'tickets'));
    }

    public function projects()
    {
        $projects = Project::orderBy('title')->get();

        $data = $projects->map(function ($project) {
            return [
                'id' => (string) ($project->_id ?? $project->id),
                'title' => $project->title,
            ];
        })->values();

        return response()->json($data);
    }

    public function projectSections(string $projectId)
    {
        $project = Project::find($projectId);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $sections = collect($project->sections ?? [])
            ->map(function ($row) {
                return [
                    'name' => isset($row['name']) ? (string) $row['name'] : null,
                    'description' => isset($row['description']) ? (string) $row['description'] : null,
                ];
            })
            ->filter(fn ($row) => $row['name'] !== null && $row['name'] !== '')
            ->values();

        return response()->json($sections);
    }

    public function list(Request $request)
    {
        $query = Ticket::query();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }
        if ($request->filled('project_id')) {
            $query->where('project_id', $request->string('project_id'));
        }

        $tickets = $query->orderByDesc('created_at')
            ->limit($request->integer('limit', 50))
            ->get();

        $data = $tickets->map(function ($t) {
            return [
                'id' => (string) ($t->_id ?? $t->id),
                'code' => $t->code,
                'project_title' => $t->project_title,
                'section_name' => $t->section_name,
                'title' => $t->title,
                'description' => $t->description,
                'status' => $t->status,
                'start_date' => optional($t->start_date)?->toDateString(),
                'end_date' => optional($t->end_date)?->toDateString(),
            ];
        })->values();

        return response()->json($data);
    }

    public function addSection(Request $request, string $projectId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $project = Project::find($projectId);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $sections = collect($project->sections ?? []);

        $exists = $sections->contains(function ($row) use ($validated) {
            return isset($row['name']) && Str::lower(trim($row['name'])) === Str::lower(trim($validated['name']));
        });

        if ($exists) {
            return response()->json(['message' => 'Section with this name already exists'], 422);
        }

        $sections->push([
            'name' => trim($validated['name']),
            'description' => isset($validated['description']) ? trim($validated['description']) : null,
        ]);

        $project->sections = $sections->values()->all();
        $project->save();

        return response()->json(['message' => 'Section added', 'sections' => $project->sections]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|string',
            'section_name' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:in_progress,in_hold,delayed,completed',
            'priority' => 'nullable|in:low,medium,high',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'reminder_hours' => 'nullable|integer|min:0|max:720',
            'assignees' => 'nullable|array',
            'assignees.*' => 'string',
        ]);

        $project = Project::find($validated['project_id']);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        // Generate next ticket code TK-1001, TK-1002, ...
        $base = 1001;
        $prefix = 'TK-';
        $maxNum = 0;
        try {
            // Only read codes starting with TK-
            $existing = Ticket::where('code', 'like', $prefix . '%')->pluck('code')->all();
            foreach ($existing as $c) {
                if (!is_string($c)) continue;
                if (stripos($c, $prefix) !== 0) continue;
                $num = (int) preg_replace('/[^0-9]/', '', substr($c, strlen($prefix)) ?: '0');
                if ($num > $maxNum) $maxNum = $num;
            }
        } catch (\Throwable $e) {
            $maxNum = 0;
        }
        $nextNumber = $maxNum > 0 ? ($maxNum + 1) : $base;
        $codeCandidate = $prefix . (string) $nextNumber;
        $guard = 0;
        while (Ticket::where('code', $codeCandidate)->exists() && $guard < 1000) {
            $nextNumber++;
            $codeCandidate = $prefix . (string) $nextNumber;
            $guard++;
        }

        $ticket = Ticket::create([
            'code' => $codeCandidate,
            'project_id' => (string) ($project->_id ?? $project->id),
            'project_title' => $project->title,
            'section_name' => $validated['section_name'] ?? null,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'] ?? 'in_progress',
            'priority' => $validated['priority'] ?? 'low',
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'reminder_hours' => $validated['reminder_hours'] ?? null,
            'created_by' => optional(Auth::user())?->_id ?? optional(Auth::user())?->id,
            'assignees' => $validated['assignees'] ?? [],
        ]);

        // Flash success for next page load
        session()->flash('success', 'Ticket created successfully.');

        return response()->json([
            'message' => 'Ticket created successfully',
            'ticket' => $ticket,
        ], 201);
    }

    public function show(string $id)
    {
        $ticket = Ticket::with('project')->find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }
        return response()->json([
            'id' => (string) ($ticket->_id ?? $ticket->id),
            'code' => $ticket->code,
            'project_id' => (string) $ticket->project_id,
            'project_title' => $ticket->project_title,
            'section_name' => $ticket->section_name,
            'title' => $ticket->title,
            'description' => $ticket->description,
            'status' => $ticket->status,
            'priority' => $ticket->priority,
            'start_date' => optional($ticket->start_date)?->toDateString(),
            'end_date' => optional($ticket->end_date)?->toDateString(),
            'reminder_hours' => $ticket->reminder_hours,
            'assignees' => $ticket->assignees,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        $validated = $request->validate([
            'project_id' => 'required|string',
            'section_name' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:in_progress,in_hold,delayed,completed',
            'priority' => 'nullable|in:low,medium,high',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'reminder_hours' => 'nullable|integer|min:0|max:720',
            'assignees' => 'nullable|array',
            'assignees.*' => 'string',
        ]);

        $project = Project::find($validated['project_id']);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $ticket->project_id = (string) ($project->_id ?? $project->id);
        $ticket->project_title = $project->title;
        $ticket->section_name = $validated['section_name'] ?? null;
        $ticket->title = $validated['title'];
        $ticket->description = $validated['description'] ?? null;
        $ticket->status = $validated['status'] ?? $ticket->status;
        $ticket->priority = $validated['priority'] ?? $ticket->priority;
        $ticket->start_date = $validated['start_date'] ?? null;
        $ticket->end_date = $validated['end_date'] ?? null;
        $ticket->reminder_hours = $validated['reminder_hours'] ?? null;
        $ticket->assignees = $validated['assignees'] ?? $ticket->assignees;
        $ticket->save();

        return response()->json(['message' => 'Ticket updated successfully']);
    }
}


