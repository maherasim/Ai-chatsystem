<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\Task;
use App\Models\WebTask;
use App\Models\EmployeeTask;
use App\Models\Teams;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index()
    {
        $authId = Auth::id(); // Get authenticated user ID
        $authIdString = (string) $authId; // Convert to string for comparison
        
        // DEBUG: Log authenticated user info
        Log::info('=== TASK FILTERING DEBUG START ===');
        Log::info('Authenticated User ID (raw): ' . $authId);
        Log::info('Authenticated User ID (string): ' . $authIdString);
        Log::info('Authenticated User Name: ' . (Auth::user()->name ?? 'N/A'));

        $headers = \App\Models\Setting::all();
        $projects = Project::orderBy('title')->get();
        $projectsdone = Project::orderBy('title')->get();

        // Fetch all teams to check task_developers - only get tasks where user is assigned
        $teams = Teams::all();
        $userTaskIds = [];
        
        // DEBUG: Log teams count
        Log::info('Total Teams Found: ' . $teams->count());

        foreach ($teams as $team) {
            $teamId = (string) ($team->_id ?? $team->id ?? 'unknown');
            Log::info("--- Processing Team: {$teamId} (Title: " . ($team->title ?? 'N/A') . ") ---");
            
            // Check task_developers - KEY is user ID, VALUE is developer names
            // Handle both JSON string and array formats
            $taskDevelopers = is_string($team->task_developers) 
                ? json_decode($team->task_developers, true) 
                : $team->task_developers;
            
            // DEBUG: Log raw task_developers data
            Log::info('Team task_developers (raw): ' . json_encode($team->task_developers));
            Log::info('Team task_developers (decoded): ' . json_encode($taskDevelopers));
            Log::info('Is task_developers array? ' . (is_array($taskDevelopers) ? 'Yes' : 'No'));
            
            // Check if authenticated user ID exists as a KEY in task_developers
            if (is_array($taskDevelopers) && $authIdString && isset($taskDevelopers[$authIdString])) {
                Log::info("  ✓ User ID {$authIdString} found in task_developers");
                Log::info("  Developer names: " . json_encode($taskDevelopers[$authIdString]));
                
                // Get tasks array - this contains the actual task IDs
                $teamTasks = is_string($team->tasks) 
                    ? json_decode($team->tasks, true) 
                    : $team->tasks;
                
                Log::info('Team tasks (raw): ' . json_encode($team->tasks));
                Log::info('Team tasks (decoded): ' . json_encode($teamTasks));
                
                if (is_array($teamTasks)) {
                    foreach ($teamTasks as $taskId) {
                        if (!empty($taskId)) {
                            $userTaskIds[] = $taskId;
                            Log::info("  ✓ Added Task ID: {$taskId}");
                        }
                    }
                } else {
                    Log::info("  Team tasks is not an array or is empty");
                }
            } else {
                if (!is_array($taskDevelopers)) {
                    Log::info("  Skipping: task_developers is not an array");
                } elseif (!$authIdString) {
                    Log::info("  Skipping: authIdString is empty");
                } else {
                    Log::info("  User ID {$authIdString} NOT found in task_developers keys");
                    Log::info("  Available keys: " . json_encode(array_keys($taskDevelopers)));
                }
            }
        }

        $userTaskIds = array_unique(array_filter($userTaskIds)); // Remove duplicates and empty values
        
        // DEBUG: Log final task IDs
        Log::info('=== FINAL RESULTS ===');
        Log::info('Total Task IDs Found from Teams: ' . count($userTaskIds));
        Log::info('Task IDs from Teams: ' . json_encode($userTaskIds));

        // Also fetch tasks directly assigned to the user via assigned_to field
        $directlyAssignedTasks = Task::where('assigned_to', $authIdString)
            ->orderByDesc('created_at')
            ->limit(200)
            ->get();
            
        $directlyAssignedWebTasks = WebTask::where('assigned_to', $authIdString)
            ->orderByDesc('created_at')
            ->limit(200)
            ->get();
            
        $directlyAssignedEmployeeTasks = EmployeeTask::where('assigned_to', $authIdString)
            ->orderByDesc('created_at')
            ->limit(200)
            ->get();
        
        // Get IDs from directly assigned tasks
        $directTaskIds = $directlyAssignedTasks->pluck('_id')->map(fn($id) => (string)$id)->toArray();
        $directWebTaskIds = $directlyAssignedWebTasks->pluck('_id')->map(fn($id) => (string)$id)->toArray();
        $directEmployeeTaskIds = $directlyAssignedEmployeeTasks->pluck('_id')->map(fn($id) => (string)$id)->toArray();
        
        // Merge all task IDs (from teams and direct assignments)
        $allTaskIds = array_unique(array_merge($userTaskIds, $directTaskIds));
        $allWebTaskIds = array_unique(array_merge($userTaskIds, $directWebTaskIds));
        $allEmployeeTaskIds = array_unique(array_merge($userTaskIds, $directEmployeeTaskIds));
        
        Log::info('Directly assigned Task IDs: ' . count($directTaskIds));
        Log::info('Total combined Task IDs: ' . count($allTaskIds));

        // Fetch tasks assigned to authenticated user (from teams OR direct assignment)
        $tasks = !empty($allTaskIds) 
            ? Task::whereIn('_id', $allTaskIds)->orderByDesc('created_at')->limit(200)->get()
            : collect();
            
        $webtasks = !empty($allWebTaskIds)
            ? WebTask::whereIn('_id', $allWebTaskIds)->orderByDesc('created_at')->limit(200)->get()
            : collect();
            
        $employeeTasks = !empty($allEmployeeTaskIds)
            ? EmployeeTask::whereIn('_id', $allEmployeeTaskIds)->orderByDesc('created_at')->limit(200)->get()
            : collect();
            
        $emptasks = $employeeTasks;
        
        // DEBUG: Log fetched tasks count
        Log::info('Tasks fetched from Task model: ' . $tasks->count());
        Log::info('Tasks fetched from WebTask model: ' . $webtasks->count());
        Log::info('Tasks fetched from EmployeeTask model: ' . $employeeTasks->count());
        Log::info('=== TASK FILTERING DEBUG END ===');

        // Collect unique project and ticket IDs
        $projectIds = $tasks->pluck('project_id')
            ->merge($webtasks->pluck('project_id'))
            ->merge($employeeTasks->pluck('project_id'))
            ->filter()
            ->map(fn($v) => (string)$v)
            ->unique()
            ->values();

        $ticketIds = $tasks->pluck('ticket_id')
            ->merge($webtasks->pluck('ticket_id'))
            ->merge($employeeTasks->pluck('ticket_id'))
            ->filter()
            ->map(fn($v) => (string)$v)
            ->unique()
            ->values();

        $projectSubset = $projectIds->isNotEmpty()
            ? $projects->whereIn('_id', $projectIds)->values()
            : collect();

        $tickets = $ticketIds->isNotEmpty()
            ? Ticket::whereIn('_id', $ticketIds)->get()
            : collect();

        $projectMap = ($projectSubset->isNotEmpty() ? $projectSubset : $projects)
            ->keyBy(fn($p) => (string)($p->_id ?? $p->id));
        $ticketMap = $tickets->keyBy(fn($t) => (string)($t->_id ?? $t->id));

        // Map projects and tickets to tasks
        $tasks = $tasks->map(function ($t) use ($projectMap, $ticketMap) {
            $t->project = $projectMap->get((string)($t->project_id ?? ''));
            $t->ticket = $ticketMap->get((string)($t->ticket_id ?? ''));
            return $t;
        });

        $webtasks = $webtasks->map(function ($t) use ($projectMap, $ticketMap) {
            $t->project = $projectMap->get((string)($t->project_id ?? ''));
            $t->ticket = $ticketMap->get((string)($t->ticket_id ?? ''));
            return $t;
        });

        $employeeTasks = $employeeTasks->map(function ($t) use ($projectMap, $ticketMap) {
            $t->project = $projectMap->get((string)($t->project_id ?? ''));
            $t->ticket = $ticketMap->get((string)($t->ticket_id ?? ''));
            return $t;
        });

        // Merge all tasks for stats
        $allTasks = collect($tasks)->merge($webtasks)->merge($employeeTasks);

        // Helper to normalize status strings
        $norm = fn($s) => strtolower(str_replace([' ', '-'], '_', $s ?? ''));

        $stats = [
            'total'       => $allTasks->count(),
            'new'         => $allTasks->filter(fn($t) => in_array($norm($t->status), ['new', 'new_task']))->count(),
            'in_progress' => $allTasks->filter(fn($t) => in_array($norm($t->status), ['in_progress', 'progress']))->count(),
            'on_hold'     => $allTasks->filter(fn($t) => in_array($norm($t->status), ['on_hold', 'hold', 'in_hold']))->count(),
            'checked'     => $allTasks->filter(fn($t) => in_array($norm($t->status), ['checked', 'in_checked']))->count(),
            'delayed'     => $allTasks->filter(fn($t) => in_array($norm($t->status), ['delayed', 'in_delayed']))->count(),
            'rejected'    => $allTasks->filter(fn($t) => in_array($norm($t->status), ['rejected', 'in_rejected']))->count(),
            'done'        => $allTasks->filter(fn($t) => in_array($norm($t->status), ['done', 'completed', 'in_done']))->count(),
        ];

        // Fetch notifications for the current user related to tasks
        $userId = (string) $authId;
        
        // Debug: Log user ID being searched
        Log::info('=== NOTIFICATION FETCH DEBUG ===');
        Log::info('Searching for notifications with user_id: ' . $userId);
        Log::info('User ID type: ' . gettype($userId));
        
        // Try multiple query formats to handle different user_id storage formats
        $notifications = Notification::where(function($query) use ($userId, $authId) {
                $query->where('user_id', $userId)
                      ->orWhere('user_id', (string)$authId);
            })
            ->where('type', 'ticket_assigned')
            ->orderByDesc('created_at')
            ->limit(20)
            ->get();
        
        // Debug: Log notification results
        Log::info('Total notifications found: ' . $notifications->count());
        foreach ($notifications as $index => $notif) {
            Log::info("Notification #{$index}: ID={$notif->_id}, user_id={$notif->user_id}, type={$notif->type}, title={$notif->title}");
        }
        Log::info('=== NOTIFICATION FETCH DEBUG END ===');

        return view('Chats.task', [
            'headers'       => $headers,
            'projects'      => $projects,
            'tasks'         => $tasks,
            'emptasks'      => $emptasks,
            'webtasks'      => $webtasks,
            'webTasks'      => $webtasks,
            'employeeTasks' => $employeeTasks,
            'employeetasks' => $employeeTasks,
            'projectsdone'  => $projectsdone,
            'stats'         => $stats,
            'notifications' => $notifications,
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
            'checkpoints.*' => 'nullable|string',
            'shape'        => 'nullable|string',
            'color'        => 'nullable|string',
            'position'     => 'nullable|array',
            'position.left' => 'nullable|numeric',
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
                $filename = 'tasks/marks/' . uniqid('mark_', true) . '.' . $ext;
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
                $boardPath = 'tasks/boards/' . uniqid('board_', true) . '.' . $ext;
                Storage::disk('public')->put($boardPath, $binary);
                if (!empty($validated['ticket_id'])) {
                    $ticket = Ticket::find($validated['ticket_id']);
                    if ($ticket) {
                        $ticket->board_image_path = $boardPath;
                        $ticket->save();
                    }
                }
            } catch (\Throwable $e) {
            }
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
                        $fname = 'tasks/marks/' . uniqid('mark_', true) . '.' . $ext;
                        Storage::disk('public')->put($fname, $binary);
                        $issues[$i]['mark_image_path'] = $fname;
                        unset($issues[$i]['mark_image']);
                        if ($firstIssueImagePath === null) $firstIssueImagePath = $fname;
                    }
                } catch (\Throwable $e) {
                }
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
            'mark_image_path' => $firstIssueImagePath ?: $path,
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
        // Handle both JSON and FormData requests
        $contentType = $request->header('Content-Type', '');
        $isJson = str_contains($contentType, 'application/json') || $request->isJson();
        
        if ($isJson) {
            $validated = $request->validate([
                'title'        => 'sometimes|required|string|max:255',
                'description'  => 'nullable|string',
                'start_date'   => 'nullable|date',
                'end_date'     => 'nullable|date|after_or_equal:start_date',
                'checkpoints'  => 'nullable|array',
                'checkpoints.*' => 'nullable|string',
                'mark_image'   => 'nullable|string',
                'issues'       => 'nullable|array',
                'status'       => 'sometimes|nullable|string',
                'hold_reason'  => 'nullable|string|max:255',
                'video_link'   => 'nullable|string|max:500',
                'attachments'  => 'nullable|array',
                'attachments.*' => 'nullable|string', // file paths
            ]);
        } else {
            // FormData request
            $validated = $request->validate([
                'title'        => 'sometimes|required|string|max:255',
                'description'  => 'nullable|string',
                'start_date'   => 'nullable|date',
                'end_date'     => 'nullable|date|after_or_equal:start_date',
                'checkpoints'  => 'nullable|array',
                'checkpoints.*' => 'nullable|string',
                'mark_image'   => 'nullable|string',
                'issues'       => 'nullable|array',
                'status'       => 'sometimes|nullable|string',
                'hold_reason'  => 'nullable|string|max:255',
                'video_link'   => 'nullable|string|max:500',
                'attachment_files.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,mp4|max:10240', // 10MB max
            ]);
        }

        \Illuminate\Support\Facades\Log::info("Task Update Hit. ID: " . $id);

        // Try direct finding or explicit ID query for Mongo
        $task = Task::find($id);
        if (!$task) {
            $task = Task::where('_id', $id)->first();
        }

        if (!$task) {
            // Fallback: Check WebTask
            $task = WebTask::find($id) ?? WebTask::where('_id', $id)->first();
        }
        if (!$task) {
            // Fallback: Check EmployeeTask
            $task = EmployeeTask::find($id) ?? EmployeeTask::where('_id', $id)->first();
        }

        if (!$task) {
            // Final Fallback: Iterating to match string ID across all types
            $allTasks = collect(Task::all())
                ->merge(WebTask::all())
                ->merge(EmployeeTask::all());

            foreach ($allTasks as $t) {
                if ((string)$t->_id === $id || (string)$t->id === $id) {
                    $task = $t;
                    break;
                }
            }
        }

        if (!$task) {
            \Illuminate\Support\Facades\Log::error("Task not found (in any collection) for ID: " . $id);
            return response()->json(['success' => false, 'message' => 'Task not found in any collection.'], 404);
        }

        // Force Status Update
        if (!empty($validated['status'])) {
            $task->status = $validated['status'];
            \Illuminate\Support\Facades\Log::info("Task status updated to: " . $validated['status']);
        }
        
        // Update hold reason if provided
        if (isset($validated['hold_reason'])) {
            $task->hold_reason = $validated['hold_reason'];
            \Illuminate\Support\Facades\Log::info("Task hold reason updated to: " . $validated['hold_reason']);
        }
        
        // Update video link if provided
        if (isset($validated['video_link'])) {
            $task->video_link = $validated['video_link'];
            \Illuminate\Support\Facades\Log::info("Task video link updated");
        }
        
        // Handle file uploads if provided (FormData)
        $attachmentPaths = [];
        if (!$isJson && $request->hasFile('attachment_files')) {
            $files = $request->file('attachment_files');
            if (is_array($files)) {
                foreach ($files as $file) {
                    if ($file && $file->isValid()) {
                        try {
                            $path = $file->store('tasks/attachments', 'public');
                            $attachmentPaths[] = $path;
                        } catch (\Throwable $e) {
                            \Illuminate\Support\Facades\Log::error("Failed to upload attachment: " . $e->getMessage());
                        }
                    }
                }
            } elseif ($files) {
                // Single file
                try {
                    $path = $files->store('tasks/attachments', 'public');
                    $attachmentPaths[] = $path;
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error("Failed to upload attachment: " . $e->getMessage());
                }
            }
        }
        
        // Update attachments - merge with existing or set new
        if (!empty($attachmentPaths)) {
            $existingAttachments = is_array($task->attachments) ? $task->attachments : [];
            $task->attachments = array_merge($existingAttachments, $attachmentPaths);
            \Illuminate\Support\Facades\Log::info("Task attachments updated: " . count($attachmentPaths) . " new files");
        } elseif (isset($validated['attachments']) && is_array($validated['attachments'])) {
            // If attachments are provided as paths (from JSON)
            $task->attachments = $validated['attachments'];
            \Illuminate\Support\Facades\Log::info("Task attachments updated: " . count($validated['attachments']) . " files");
        }
        
        // Save the task
        $task->save();

        // Optional new image
        if (!empty($validated['mark_image']) && str_starts_with($validated['mark_image'], 'data:image')) {
            try {
                [$meta, $encoded] = explode(',', $validated['mark_image'], 2);
                $binary = base64_decode($encoded);
                $ext = str_contains($meta, 'png') ? 'png' : 'jpg';
                $filename = 'tasks/marks/' . uniqid('mark_', true) . '.' . $ext;
                Storage::disk('public')->put($filename, $binary);
                $validated['mark_image_path'] = $filename;
            } catch (\Throwable $e) {
            }
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
                        $fname = 'tasks/marks/' . uniqid('mark_', true) . '.' . $ext;
                        \Storage::disk('public')->put($fname, $binary);
                        $iss['mark_image_path'] = $fname;
                    } catch (\Throwable $e) {
                    }
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
}

