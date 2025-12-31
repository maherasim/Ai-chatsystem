<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\Task;
use App\Models\WebTask;
use App\Models\EmployeeTask;
use App\Models\Notification;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskAssignmentMail;

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

    /**
     * Get list of developers for task assignment
     */
    public function developers()
    {
        $developers = User::where('type', 'developer')
            ->where('active', true)
            ->orderBy('name')
            ->get()
            ->map(function ($u) {
                return [
                    'id' => (string) ($u->_id ?? $u->id),
                    'name' => $u->name ?? 'Developer',
                    'email' => $u->email ?? '',
                ];
            })
            ->values();
        return response()->json($developers);
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
            'code' => $t->code ?? null,
            'project_id' => $t->project_id,
            'title' => $t->title ?? null,
            'section_name' => $t->section_name ?? null,
            'description' => $t->description ?? null,
            'status' => $t->status ?? null,
            'priority' => $t->priority ?? null,
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
            'assigned_to'  => 'nullable|string', // Developer user ID
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
            'assigned_to'    => $validated['assigned_to'] ?? null,
        ]);

        // Send notification to developer if task is assigned
        if (!empty($validated['assigned_to'])) {
            $this->notifyDeveloperTaskAssigned($task, $validated['assigned_to']);
        }

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
            'status'       => 'nullable|string',
            'start_date'   => 'nullable|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'checkpoints'  => 'nullable|array',
            'checkpoints.*'=> 'nullable|string',
            'mark_image'   => 'nullable|string',
            'issues'       => 'nullable|array',
            'ratings'      => 'nullable|array',
            'assigned_to'  => 'nullable|string',
        ]);

        $task = Task::findOrFail($id);
        
        // Track old status to detect changes
        $oldStatus = $task->status;

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

        // Track old assigned_to to detect changes
        $oldAssignedTo = $task->assigned_to;
        
        // Update scalar fields first
        $task->update($validated);
        
        // Reload task to get updated values
        $task = Task::find($id);
        
        // Check if status changed and notify developer
        $newStatus = $validated['status'] ?? $task->status;
        $statusChanged = ($oldStatus !== $newStatus && !empty($validated['status']));
        
        if ($statusChanged) {
            $this->notifyDeveloperStatusChanged($task, $oldStatus, $newStatus);
        }
        
        // If task is being assigned to a developer (new assignment or changed assignment), send notification
        $newAssignedTo = $validated['assigned_to'] ?? null;
        if (!empty($newAssignedTo) && $newAssignedTo !== $oldAssignedTo) {
            $this->notifyDeveloperTaskAssigned($task, $newAssignedTo);
        }

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

        // Store old status before updating
        $oldStatus = $task->status;
        
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
        
        // Reload task to ensure we have the latest data
        $task = Task::find($validated['task_id']);
        
        // Notify developer about status change
        if ($oldStatus !== 'rejected' && $task) {
            \Log::info("Rejecting task {$validated['task_id']}, old status: {$oldStatus}, assigned_to: " . ($task->assigned_to ?? 'null'));
            $this->notifyDeveloperStatusChanged($task, $oldStatus, 'rejected');
        }

        return response()->json([
            'success' => true,
            'message' => 'Task rejected successfully',
        ]);
    }

    /**
     * Get tasks assigned to the current developer
     */
    public function myTasks(Request $request)
    {
        $user = Auth::user();
        
        // Only developers can access this
        if ($user->type !== 'developer') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only developers can access assigned tasks.',
            ], 403);
        }

        $tasks = Task::where('assigned_to', (string)($user->_id ?? $user->id))
            ->with(['project', 'ticket', 'creator'])
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'tasks' => $tasks,
            'count' => $tasks->count(),
        ]);
    }

    /**
     * Send notification to developer when task is assigned
     */
    private function notifyDeveloperTaskAssigned(Task $task, $developerId)
    {
        try {
            $developer = User::find($developerId);
            if (!$developer || $developer->type !== 'developer') {
                return;
            }

            // Create in-app notification
            Notification::create([
                'user_id' => $developerId,
                'type' => 'task_assigned',
                'title' => 'New Task Assigned',
                'message' => "You have been assigned a new task: {$task->title}",
                'task_id' => (string)($task->_id ?? $task->id),
                'read' => false,
                'created_by' => Auth::id(),
            ]);

            // Send email notification
            if (!empty($developer->email)) {
                try {
                    Mail::to($developer->email)->send(
                        new TaskAssignmentMail($developer, $task, '', '')
                    );
                } catch (\Throwable $e) {
                    \Log::error('Failed to send task assignment email: ' . $e->getMessage());
                }
            }
        } catch (\Throwable $e) {
            \Log::error('Failed to notify developer: ' . $e->getMessage());
        }
    }

    /**
     * Send notification to admin when developer starts task
     */
    private function notifyAdminTaskStarted(Task $task)
    {
        try {
            $currentUserId = (string) Auth::id();
            $taskId = (string) ($task->_id ?? $task->id);
            
            // Find the notification that assigned this task to the current user
            // The admin ID is in the notification's created_by field
            $assignmentNotification = Notification::where('user_id', $currentUserId)
                ->where('type', 'task_assigned')
                ->where('task_id', $taskId)
                ->orderByDesc('created_at')
                ->first();
            
            $adminId = null;
            
            if ($assignmentNotification && $assignmentNotification->created_by) {
                // Get admin ID from the notification that assigned the task
                $adminId = (string) $assignmentNotification->created_by;
            } else {
                // Fallback: find admin user by email
                $admin = User::where('email', 'admin@gmail.com')->first();
                if ($admin) {
                    $adminId = (string) ($admin->_id ?? $admin->id);
                } else {
                    // Final fallback: use task creator
                    if ($task->created_by) {
                        $adminId = (string) $task->created_by;
                    }
                }
            }
            
            if (!$adminId) {
                \Log::warning("Could not find admin to notify for task {$taskId}");
                return;
            }

            $developer = Auth::user();
            $developerName = $developer ? ($developer->name ?? 'Unknown') : 'Unknown';

            // Create in-app notification for admin
            Notification::create([
                'user_id' => $adminId,
                'type' => 'task_started',
                'title' => 'Task Started',
                'message' => "{$developerName} has started working on task: {$task->title}",
                'task_id' => $taskId,
                'read' => false,
                'created_by' => $currentUserId,
            ]);
            
            \Log::info("Notification created for admin {$adminId} - Task {$taskId} started by user {$currentUserId}");
        } catch (\Throwable $e) {
            \Log::error('Failed to notify admin: ' . $e->getMessage());
        }
    }

    /**
     * Send notification to developer when admin changes task status
     */
    private function notifyDeveloperStatusChanged(Task $task, $oldStatus, $newStatus)
    {
        try {
            $taskId = (string) ($task->_id ?? $task->id);
            $developerIds = [];
            
            // First, check if task has direct assigned_to
            if (!empty($task->assigned_to)) {
                $developerIds[] = (string) $task->assigned_to;
            }
            
            // Also check team assignments
            $teams = Team::all();
            foreach ($teams as $team) {
                $teamTasks = is_string($team->tasks) 
                    ? json_decode($team->tasks, true) 
                    : $team->tasks;
                
                if (!is_array($teamTasks)) {
                    continue;
                }
                
                // Check if this task is in the team's tasks
                if (in_array($taskId, $teamTasks)) {
                    $taskDevelopers = is_string($team->task_developers) 
                        ? json_decode($team->task_developers, true) 
                        : $team->task_developers;
                    
                    if (is_array($taskDevelopers)) {
                        // task_developers structure: {userId: [developerName, ...]}
                        foreach ($taskDevelopers as $userId => $developers) {
                            if (!empty($userId)) {
                                $developerIds[] = (string) $userId;
                            }
                        }
                    }
                }
            }
            
            // Remove duplicates
            $developerIds = array_unique($developerIds);
            
            if (empty($developerIds)) {
                \Log::warning("Task {$taskId} has no assigned developers (neither assigned_to nor team assignment), skipping notification for status change from {$oldStatus} to {$newStatus}");
                return;
            }
            
            \Log::info("Found " . count($developerIds) . " developer(s) for task {$taskId}: " . json_encode($developerIds));
            
            // Send notification to all assigned developers
            foreach ($developerIds as $developerId) {
                // Try to find developer with different ID formats
                $developer = User::find($developerId);
                if (!$developer) {
                    $developer = User::where('_id', $developerId)->first();
                }
                if (!$developer) {
                    // Try as ObjectId if it's a valid MongoDB ObjectId string
                    try {
                        $developer = User::where('_id', new \MongoDB\BSON\ObjectId($developerId))->first();
                    } catch (\Exception $e) {
                        // Not a valid ObjectId, continue
                    }
                }
                
                if (!$developer) {
                    \Log::warning("Developer with ID {$developerId} not found for task {$taskId}, skipping notification");
                    continue;
                }
                
                \Log::info("Sending status change notification to developer {$developer->name} (ID: {$developerId}) for task {$taskId}: {$oldStatus} -> {$newStatus}");

                $taskTicketId = $task->ticket_id ?? null;
                $adminId = (string) Auth::id();
                $admin = Auth::user();
                $adminName = $admin ? ($admin->name ?? 'Admin') : 'Admin';
                
                // Get project info if available
                $projectName = 'Unknown Project';
                $projectId = null;
                if ($task->project_id) {
                    $project = Project::find($task->project_id);
                    if ($project) {
                        $projectName = $project->title ?? 'Unknown Project';
                        $projectId = (string) ($project->_id ?? $project->id);
                    }
                }
                
                // Get ticket info if available
                $ticketCode = '';
                if ($taskTicketId) {
                    $ticket = Ticket::find($taskTicketId);
                    if ($ticket) {
                        $ticketCode = $ticket->code ?? '';
                    }
                }
                
                // Determine notification type, title, and message based on status
                $notificationType = 'task_status_updated';
                $notificationTitle = 'Task Status Updated';
                $statusMessage = '';
                $newStatusLower = strtolower($newStatus ?? '');
                
                if (in_array($newStatusLower, ['in_progress', 'progress', 'inprogress', 'started'])) {
                    $notificationType = 'task_started';
                    $notificationTitle = 'Task Started';
                    $statusMessage = "started";
                } elseif (in_array($newStatusLower, ['on_hold', 'hold', 'in_hold'])) {
                    $notificationType = 'task_on_hold';
                    $notificationTitle = 'Task On Hold';
                    $statusMessage = "moved to on hold";
                    if ($task->hold_reason) {
                        $statusMessage .= " - " . $task->hold_reason;
                    }
                } elseif (in_array($newStatusLower, ['checked', 'in_checked'])) {
                    $notificationType = 'task_checked';
                    $notificationTitle = 'Task Checked';
                    $statusMessage = "moved to checked";
                } elseif (in_array($newStatusLower, ['delayed', 'in_delayed'])) {
                    $notificationType = 'task_delayed';
                    $notificationTitle = 'Task Delayed';
                    $statusMessage = "moved to delayed";
                } elseif (in_array($newStatusLower, ['rejected', 'in_rejected'])) {
                    $notificationType = 'task_rejected';
                    $notificationTitle = 'Task Rejected';
                    $statusMessage = "rejected";
                } elseif (in_array($newStatusLower, ['done', 'completed', 'in_done'])) {
                    $notificationType = 'task_completed';
                    $notificationTitle = 'Task Completed';
                    $statusMessage = "completed";
                } else {
                    $statusMessage = "updated status to " . $newStatus;
                }
                
                // Create notification data
                $notificationData = [
                    'task_id' => $taskId,
                    'ticket_id' => $taskTicketId,
                    'ticket_code' => $ticketCode,
                    'project' => $projectName,
                    'project_id' => $projectId,
                    'task_title' => $task->title ?? 'Task',
                    'status' => $newStatus,
                    'old_status' => $oldStatus,
                ];
                
                // Create notification for developer
                $notification = Notification::create([
                    'user_id' => $developerId,
                    'type' => $notificationType,
                    'title' => $notificationTitle,
                    'message' => "{$adminName} {$statusMessage} the task \"{$task->title}\" in project {$projectName}",
                    'data' => $notificationData,
                    'read' => false,
                    'created_by' => $adminId,
                    'task_id' => $taskId,
                ]);
                
                if ($notification) {
                    \Log::info("Notification created successfully for developer {$developerId} - Task {$taskId} status changed from {$oldStatus} to {$newStatus} by admin {$adminId}. Notification ID: " . ($notification->_id ?? $notification->id));
                } else {
                    \Log::error("Failed to create notification - Notification::create() returned null for developer {$developerId}, task {$taskId}");
                }
            }
        } catch (\Throwable $e) {
            \Log::error('Failed to notify developer about status change: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
        }
    }

}


