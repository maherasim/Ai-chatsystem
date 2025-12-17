<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\Task;
use App\Models\WebTask;
use App\Models\EmployeeTask;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $headers = \App\Models\Setting::all();
        // Always load all projects for the select dropdown
        $projects = Project::orderBy('title')->get();
        $projectsdone = Project::orderBy('title')->get();
        $tasks = Task::orderByDesc('created_at')->limit(50)->get();
        $webtasks = WebTask::orderByDesc('created_at')->limit(50)->get();
        $employeeTasks = EmployeeTask::orderByDesc('created_at')->limit(50)->get();
        $emptasks = EmployeeTask::orderByDesc('created_at')->limit(50)->get();
        // Fallback: some records might not have created_at populated in Mongo; sort by _id instead
        if ($employeeTasks->isEmpty()) {
            $employeeTasks = EmployeeTask::orderByDesc('_id')->limit(50)->get();
        }
        $projectIds = $tasks->pluck('project_id')->merge($webtasks->pluck('project_id'))->merge($employeeTasks->pluck('project_id'))
            ->filter()->map(fn($v) => (string)$v)->unique()->values();
        $ticketIds  = $tasks->pluck('ticket_id')->merge($webtasks->pluck('ticket_id'))->merge($employeeTasks->pluck('ticket_id'))
            ->filter()->map(fn($v) => (string)$v)->unique()->values();

        $projectSubset = $projectIds->isNotEmpty()
            ? $projects->whereIn('_id', $projectIds)->values()
            : collect();
        $tickets  = $ticketIds->isNotEmpty()
            ? Ticket::whereIn('_id', $ticketIds)->get()
            : collect();
        $projectMap = ($projectSubset->isNotEmpty() ? $projectSubset : $projects)->keyBy(fn($p) => (string)($p->_id ?? $p->id));
        $ticketMap  = $tickets->keyBy(fn($t) => (string)($t->_id ?? $t->id));

        $tasks = $tasks->map(function($t) use ($projectMap, $ticketMap){
            $t->project = $projectMap->get((string)($t->project_id ?? ''));
            $t->ticket  = $ticketMap->get((string)($t->ticket_id ?? ''));
            return $t;
        });
        $webtasks = $webtasks->map(function($t) use ($projectMap, $ticketMap){
            $t->project = $projectMap->get((string)($t->project_id ?? ''));
            $t->ticket  = $ticketMap->get((string)($t->ticket_id ?? ''));
            return $t;
        });
        $employeeTasks = $employeeTasks->map(function($t) use ($projectMap, $ticketMap){
            $t->project = $projectMap->get((string)($t->project_id ?? ''));
            $t->ticket  = $ticketMap->get((string)($t->ticket_id ?? ''));
            return $t;
        });
        // Return with both camelCase and snakeCase variants for robustness in blade
        return view('Chats.task', [
            'headers'         => $headers,
            'projects'        => $projects,
            'tasks'           => $tasks,
            'emptasks'        => $emptasks,
            'webtasks'        => $webtasks,
            'webTasks'        => $webtasks,
            'employeeTasks'   => $employeeTasks,
            'employeetasks'   => $employeeTasks,
            'employee_tasks'  => $employeeTasks,
            'projectsdone'    => $projectsdone,
        ]);
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

    public function tickets(Request $request)
{
    $projectId = $request->input('project_id'); // ✅ plain string

    $query = Ticket::query();

    if (!empty($projectId)) {
        $query->where('project_id', $projectId);
    }

    $tickets = $query->orderByDesc('created_at')->limit(100)->get();

    // ✅ Transform data for clean frontend response
    $data = $tickets->map(function ($t) {
        return [
            'id' => (string) ($t->_id ?? $t->id),
            'code' => $t->code,
            'project_id' => $t->project_id,
            'title' => $t->title,
            'section_name' => $t->section_name,
            'title' => $t->title,
            'description' => $t->description,
            'status' => $t->status,
            'priority' => $t->priority,
            'start_date' => optional($t->start_date)->toDateString(),
            'end_date' => optional($t->end_date)->toDateString(),
        ];
    })->values();

    return response()->json([
        'success' => true,
        'count' => $data->count(),
        'tickets' => $data
    ]);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id'   => 'nullable|string',
            'ticket_id'    => 'nullable|string',
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'start_date'   => 'nullable|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'checkpoints'  => 'nullable|array',
            'checkpoints.*'=> 'nullable|string',
            'shape'        => 'nullable|string',
            'color'        => 'nullable|string',
            'position'     => 'nullable|array',
            'position.left'=> 'nullable|numeric',
            'position.top' => 'nullable|numeric',
            'number'       => 'nullable|integer',
            'mark_image'   => 'nullable|string', // base64 data URL
            'issues'       => 'nullable|array',
            'board_image'  => 'nullable|string', // optional base64 board
        ]);

        $path = null;
        $dataUrl = $validated['mark_image'] ?? null;
        if ($dataUrl && str_starts_with($dataUrl, 'data:image')) {
            try {
                [$meta, $encoded] = explode(',', $dataUrl, 2);
                $binary = base64_decode($encoded);
                $ext = str_contains($meta, 'png') ? 'png' : 'jpg';
                $filename = 'tasks/marks/'.uniqid('mark_', true).'.'.$ext;
                Storage::disk('public')->put($filename, $binary);
                $path = $filename;
            } catch (\Throwable $e) {
                $path = null;
            }
        }

        // Persist board image if provided and attach to ticket
        if (!empty($validated['board_image']) && str_starts_with($validated['board_image'], 'data:image')) {
            try {
                [$meta, $encoded] = explode(',', $validated['board_image'], 2);
                $binary = base64_decode($encoded);
                $ext = str_contains($meta, 'png') ? 'png' : 'jpg';
                $boardPath = 'tasks/boards/'.uniqid('board_', true).'.'.$ext;
                Storage::disk('public')->put($boardPath, $binary);
                if (!empty($validated['ticket_id'])) {
                    $ticket = Ticket::find($validated['ticket_id']);
                    if ($ticket) {
                        $ticket->board_image_path = $boardPath;
                        $ticket->save();
                    }
                }
            } catch (\Throwable $e) {}
        }

        // Persist issue images if provided and set first as preview path
        $issues = $validated['issues'] ?? [];
        $firstIssueImagePath = null;
        if (is_array($issues)) {
            foreach ($issues as $i => $iss) {
                try {
                    $imgData = $iss['mark_image'] ?? null;
                    if (is_string($imgData) && str_starts_with($imgData, 'data:image')) {
                        [$meta, $encoded] = explode(',', $imgData, 2);
                        $binary = base64_decode($encoded);
                        $ext = str_contains($meta, 'png') ? 'png' : 'jpg';
                        $fname = 'tasks/marks/'.uniqid('mark_', true).'.'.$ext;
                        Storage::disk('public')->put($fname, $binary);
                        $issues[$i]['mark_image_path'] = $fname;
                        unset($issues[$i]['mark_image']);
                        if ($firstIssueImagePath === null) $firstIssueImagePath = $fname;
                    }
                } catch (\Throwable $e) {}
            }
        }

        $task = Task::create([
            'project_id'     => $validated['project_id'] ?? null,
            'ticket_id'      => $validated['ticket_id'] ?? null,
            'title'          => $validated['title'],
            'description'    => $validated['description'] ?? null,
            'status'         => 'new_task',
            'start_date'     => $validated['start_date'] ?? null,
            'end_date'       => $validated['end_date'] ?? null,
            'checkpoints'    => $validated['checkpoints'] ?? [],
            'shape'          => $validated['shape'] ?? null,
            'color'          => $validated['color'] ?? null,
            'position'       => $validated['position'] ?? null,
            'number'         => $validated['number'] ?? null,
            'mark_image_path'=> $firstIssueImagePath ?: $path,
            'issues'         => $issues,
            'created_by'     => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'task' => [
                'id' => (string)($task->_id ?? $task->id),
                'mark_image_url' => $path ? Storage::disk('public')->url($path) : null,
            ],
        ]);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json(['success' => true, 'task' => $task]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'        => 'sometimes|required|string|max:255',
            'description'  => 'nullable|string',
            'start_date'   => 'nullable|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'checkpoints'  => 'nullable|array',
            'checkpoints.*'=> 'nullable|string',
            'mark_image'   => 'nullable|string',
            'issues'       => 'nullable|array',
        ]);

        $task = Task::findOrFail($id);

        // Optional new image
        if (!empty($validated['mark_image']) && str_starts_with($validated['mark_image'], 'data:image')) {
            try {
                [$meta, $encoded] = explode(',', $validated['mark_image'], 2);
                $binary = base64_decode($encoded);
                $ext = str_contains($meta, 'png') ? 'png' : 'jpg';
                $filename = 'tasks/marks/'.uniqid('mark_', true).'.'.$ext;
                Storage::disk('public')->put($filename, $binary);
                $validated['mark_image_path'] = $filename;
            } catch (\Throwable $e) {}
        }

        // Append new issues if provided (convert base64 to stored paths)
        $incomingIssues = $validated['issues'] ?? null;
        unset($validated['mark_image'], $validated['issues']);

        // Update scalar fields first
        $task->update($validated);

        if (is_array($incomingIssues) && count($incomingIssues)) {
            $processed = [];
            foreach ($incomingIssues as $iss) {
                if (!is_array($iss)) continue;
                $imgData = $iss['mark_image'] ?? null;
                if (is_string($imgData) && str_starts_with($imgData, 'data:image')) {
                    try {
                        [$meta, $encoded] = explode(',', $imgData, 2);
                        $binary = base64_decode($encoded);
                        $ext = str_contains($meta, 'png') ? 'png' : 'jpg';
                        $fname = 'tasks/marks/'.uniqid('mark_', true).'.'.$ext;
                        \Storage::disk('public')->put($fname, $binary);
                        $iss['mark_image_path'] = $fname;
                    } catch (\Throwable $e) {}
                }
                unset($iss['mark_image']);
                $processed[] = $iss;
            }
            // Merge with existing issues
            $existing = is_array($task->issues) ? $task->issues : [];
            $merged = array_merge($existing, $processed);
            $task->issues = $merged;
            $task->save();
        }

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['success' => true]);
    }

    // Optional: upload the base board image used for markers (kept by ticket)
    public function uploadBoard(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|string',
            'image'     => 'required|image|max:4096'
        ]);
        $path = $request->file('image')->store('tasks/boards', 'public');
        // store path on ticket (or a dedicated collection) for retrieval
        $ticket = Ticket::find($request->ticket_id);
        if ($ticket) {
            $ticket->board_image_path = $path;
            $ticket->save();
        }
        return response()->json([
            'success' => true,
            'url' => Storage::disk('public')->url($path),
        ]);
    }

    // Fetch tasks (and board) for a ticket to re-render markers
    public function byTicket(Request $request)
    {
        $ticketId = (string)$request->query('ticket_id');
        $tasks = Task::where('ticket_id', $ticketId)->orderBy('number')->get();
        $ticket = Ticket::find($ticketId);

        // Normalize: expand embedded issues into individual marker items for UI
        $items = [];
        foreach ($tasks as $t) {
            if (is_array($t->issues) && !empty($t->issues)) {
                foreach ($t->issues as $idx => $issue) {
                    $items[] = [
                        'title' => $issue['title'] ?? ($t->title ?? 'Issue'),
                        'description' => $issue['description'] ?? null,
                        'start_date' => $issue['start_date'] ?? null,
                        'end_date' => $issue['end_date'] ?? null,
                        'checkpoints' => $issue['checkpoints'] ?? [],
                        'shape' => $issue['shape'] ?? null,
                        'color' => $issue['color'] ?? '#28c76f',
                        'position' => $issue['position'] ?? null,
                        'number' => $issue['number'] ?? ($idx + 1),
                        'mark_image' => $issue['mark_image'] ?? null,
                    ];
                }
            } else {
                $items[] = [
                    'title' => $t->title,
                    'description' => $t->description,
                    'start_date' => optional($t->start_date)->toDateString(),
                    'end_date' => optional($t->end_date)->toDateString(),
                    'checkpoints' => $t->checkpoints ?? [],
                    'shape' => $t->shape ?? null,
                    'color' => $t->color ?? '#28c76f',
                    'position' => $t->position ?? null,
                    'number' => $t->number ?? null,
                ];
            }
        }

        return response()->json([
            'success' => true,
            'board_image_url' => ($ticket && $ticket->board_image_path) ? Storage::disk('public')->url($ticket->board_image_path) : null,
            'tasks' => $items,
        ]);
    }

    public function reject(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|string',
            'reason' => 'required|string',
            'other_reason' => 'nullable|string',
            'reject_files' => 'nullable|array',
            'reject_files.*' => 'file|max:10240', // 10MB max per file
        ]);

        $task = Task::find($validated['task_id']);
        if (!$task) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        // Handle file uploads
        $rejectAttachments = [];
        if ($request->hasFile('reject_files')) {
            foreach ($request->file('reject_files') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('tasks/rejections', 'public');
                    $rejectAttachments[] = $path;
                }
            }
        }

        // Build rejection reason
        $rejectionReason = $validated['reason'];
        if ($validated['reason'] === 'Other' && !empty($validated['other_reason'])) {
            $rejectionReason = $validated['other_reason'];
        }

        // Update task status to rejected
        $task->status = 'rejected';
        
        // Store rejection data
        $rejectionData = [
            'reason' => $rejectionReason,
            'rejected_at' => now()->toDateTimeString(),
            'rejected_by' => Auth::id(),
            'attachments' => $rejectAttachments,
        ];
        
        // Store rejection history (you might want to add a rejections array field)
        $rejections = is_array($task->rejections) ? $task->rejections : [];
        $rejections[] = $rejectionData;
        $task->rejections = $rejections;
        
        $task->save();

        return response()->json([
            'success' => true,
            'message' => 'Task rejected successfully',
        ]);
    }

}


