<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Team;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\Setting;
use App\Models\Task;
use App\Models\WebTask;
use App\Models\EmployeeTask;
use MongoDB\BSON\ObjectId;
use App\Models\User;
use App\Models\Group;
use App\Mail\TaskAssignmentMail;

class TeamController extends Controller
{
    /**
     * Convert a stored relative path (e.g. 'projects/xyz.jpg') to a publicly
     * accessible URL under /storage. Leaves absolute URLs unchanged.
     */
    private function toPublicUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }
        $p = (string) $path;
        // Already absolute (http/https) or already points to /storage or /build
        if (preg_match('#^https?://#i', $p) || str_starts_with($p, '/storage/') || str_starts_with($p, '/build/')) {
            return $p;
        }
        return asset('storage/' . ltrim($p, '/'));
    }

    /**
     * Get the correct image URL for a task based on its type and image storage method
     */
    private function getTaskImageUrl($task): ?string
    {
        // For Task and WebTask - use mark_image_path (storage path)
        if (isset($task->mark_image_path) && !empty($task->mark_image_path)) {
            return asset('storage/' . ltrim($task->mark_image_path, '/'));
        }
        
        // For EmployeeTask - use images array
        if (isset($task->images)) {
            $images = $task->images;
            
            // Handle case where images might be stored as JSON string
            if (is_string($images)) {
                try {
                    $images = json_decode($images, true);
                } catch (\Throwable $e) {
                    $images = [];
                }
            }
            
            // Get first image if available
            if (is_array($images) && !empty($images)) {
                $firstImage = trim($images[0]);
                
                // Remove leading slash if present and normalize path separators
                $firstImage = ltrim($firstImage, '/');
                $firstImage = str_replace('\\', '/', $firstImage); // Handle escaped slashes from JSON
                
                // Check if it's a public path (build/img/...) - these are in public directory, not storage
                // These paths should be accessed directly via asset() without storage prefix
                // Normalize and check the path
                $isPublicPath = str_starts_with($firstImage, 'build/img/') 
                    || str_starts_with($firstImage, 'build/')
                    || (strpos($firstImage, 'build') === 0);
                
                if ($isPublicPath) {
                    // Public path - use asset() helper directly (no storage prefix)
                    // asset('build/img/imagw2.jpeg') generates: http://127.0.0.1:8000/build/img/imagw2.jpeg
                    // NOT: http://127.0.0.1:8000/storage/build/img/imagw2.jpeg
                    return asset($firstImage);
                } elseif (str_starts_with($firstImage, 'emptasks/')) {
                    // Storage path - use asset() with storage prefix
                    return asset('storage/' . $firstImage);
                } else {
                    // Default: assume it's a storage path
                    return asset('storage/' . $firstImage);
                }
            }
        }
        
        return null;
    }

    public function index(Request $request)
    {
        $headers = Setting::all();
        $projects = Project::orderBy('title')->get();
        $teams = Team::query()->orderByDesc('created_at')->get()->map(function ($t) {
            try {
                $pid = (string) ($t->project_id ?? '');
                if ($pid !== '') {
                    $project = Project::find($pid);
                    if (!$project) {
                        try {
                            $project = Project::find(new ObjectId($pid));
                        } catch (\Throwable $e) {}
                    }
                    if ($project && isset($project->logo_path)) {
                        $t->project_logo_path = $this->toPublicUrl((string) $project->logo_path);
                    }

                    // Resolve project sections/addresses for card scroller
                    try {
                        $sections = collect();
                        $candidates = [];
                        foreach (['sections','section_names','addresses','address_list','address','locations','location_names','location'] as $field) {
                            if (isset($project->{$field}) && !empty($project->{$field})) {
                                $candidates[] = $project->{$field};
                            }
                        }
                        foreach ($candidates as $candidate) {
                            if (is_string($candidate)) {
                                $sections->push(trim($candidate));
                                continue;
                            }
                            if (is_array($candidate)) {
                                foreach ($candidate as $item) {
                                    if (is_string($item)) {
                                        $sections->push(trim($item));
                                    } elseif (is_array($item)) {
                                        foreach (['name','title','label','address'] as $k) {
                                            if (isset($item[$k]) && is_string($item[$k]) && trim($item[$k]) !== '') {
                                                $sections->push(trim($item[$k]));
                                                break;
                                            }
                                        }
                                    } elseif (is_object($item)) {
                                        $arr = (array) $item;
                                        foreach (['name','title','label','address'] as $k) {
                                            if (isset($arr[$k]) && is_string($arr[$k]) && trim($arr[$k]) !== '') {
                                                $sections->push(trim($arr[$k]));
                                                break;
                                            }
                                        }
                                    }
                                }
                            } elseif (is_object($candidate)) {
                                $arr = (array) $candidate;
                                foreach (['name','title','label','address'] as $k) {
                                    if (isset($arr[$k]) && is_string($arr[$k]) && trim($arr[$k]) !== '') {
                                        $sections->push(trim($arr[$k]));
                                    }
                                }
                            }
                        }
                        $t->project_sections = $sections->filter()->unique()->values()->all();
                    } catch (\Throwable $e) {
                        $t->project_sections = [];
                    }
                }
            } catch (\Throwable $e) {
                // ignore
            }

            // Resolve developer avatars from stored developers (ids or names)
            try {
                $devRaw = $t->task_developers ?? [];
                if (is_string($devRaw)) {
                    $tmp = json_decode($devRaw, true);
                    $devRaw = is_array($tmp) ? $tmp : [];
                }
                $devIds = [];
                $devNames = [];
                foreach ((array) $devRaw as $val) {
                    if (is_array($val)) {
                        foreach ($val as $v) {
                            if (is_string($v)) {
                                if (preg_match('/^[a-f0-9]{24}$/i', $v)) $devIds[] = $v; else $devNames[] = $v;
                            }
                        }
                    } elseif (is_string($val)) {
                        if (preg_match('/^[a-f0-9]{24}$/i', $val)) $devIds[] = $val; else $devNames[] = $val;
                    }
                }
                $users = collect();
                if (!empty($devIds)) {
                    try {
                        $users = User::query()->whereIn('_id', $devIds)->get();
                        if ($users->isEmpty()) {
                            $users = User::query()->whereIn('id', $devIds)->get();
                        }
                    } catch (\Throwable $e) { /* ignore */ }
                }
                if (!empty($devNames)) {
                    try {
                        $byName = User::query()->whereIn('name', $devNames)->get();
                        $users = $users->concat($byName);
                    } catch (\Throwable $e) { /* ignore */ }
                }
                // pick an image-like field
                $avatars = $users->map(function ($u) {
                    foreach (['avatar_path','photo_path','profile_photo_path','image','avatar','photo','profile_image'] as $field) {
                        if (!empty($u->{$field})) return (string) $u->{$field};
                    }
                    return null;
                })->filter()->unique()->values()->all();
                $t->developer_avatar_paths = $avatars;
            } catch (\Throwable $e) {
                $t->developer_avatar_paths = [];
            }

            return $t;
        });
        $selectedProjectId = $request->get('project_id');
        $project = Project::find($selectedProjectId);
        $tickets = [];
        if (!empty($selectedProjectId)) {
            $tickets = Ticket::where('project_id', (string) ($project->_id ?? $project->id))
                ->orderByDesc('created_at')
                ->get();
        } else {
            $tickets = [];
        }
     $teamtotalcount = Team::count();
        return view('Chats.teams', compact('headers','projects','tickets','selectedProjectId','project','teams','teamtotalcount'));
    }

    public function tickets(Request $request)
    {
        $projectId = (string) $request->string('project_id');
        if ($projectId === '') {
            return response()->json([]);
        }

        $tickets = Ticket::query()
            ->where('project_id', $projectId)
            ->orderByDesc('created_at')
            ->limit($request->integer('limit', 50))
            ->get()
            ->map(function ($t) {
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
            })
            ->values();

        return response()->json($tickets);
    }

    public function tasksByTicket(Request $request)
    {
        $ticketId = (string) $request->string('ticket_id');
        if ($ticketId === '') {
            return response()->json([]);
        }

        $allTasks = collect();

        // Helper function to fetch tasks from a model
        $fetchTasks = function($model, $modelName) use ($ticketId) {
            $tasks = collect();
            try {
                $oid = new ObjectId($ticketId);
                $tasks = $model::where('ticket_id', $oid)->orderByDesc('created_at')->get();
            } catch (\Throwable $e) {
                // ignore
            }
            if ($tasks->isEmpty()) {
                $tasks = $model::where('ticket_id', $ticketId)->orderByDesc('created_at')->get();
            }
            
            // Add task type to each task
            return $tasks->map(function($t) use ($modelName) {
                $t->task_type = $modelName;
                return $t;
            });
        };

        // Fetch from Task model
        $regularTasks = $fetchTasks(Task::class, 'task');
        $allTasks = $allTasks->merge($regularTasks);

        // Fetch from WebTask model
        $webTasks = $fetchTasks(WebTask::class, 'webtask');
        $allTasks = $allTasks->merge($webTasks);

        // Fetch from EmployeeTask model
        $employeeTasks = $fetchTasks(EmployeeTask::class, 'employeetask');
        $allTasks = $allTasks->merge($employeeTasks);

        $result = $allTasks->map(function ($t) {
            // Resolve project logo path from Project model based on project_id
            $projectLogo = null;
            if (!empty($t->project_id)) {
                try {
                    $project = null;
                    $projectId = (string)($t->project_id);
                    
                    // Try fetch by ObjectId first
                    try {
                        $project = Project::find(new ObjectId($projectId));
                    } catch (\Throwable $e) {
                        // ignore
                    }
                    
                    // If not found, try string match
                    if (!$project) {
                        $project = Project::find($projectId);
                    }
                    
                    // Get project logo path if available
                    if ($project && !empty($project->logo_path)) {
                        $projectLogo = $this->toPublicUrl((string) $project->logo_path);
                    }
                } catch (\Throwable $e) {
                    // ignore resolution errors
                }
            }

            return [
                'id' => (string) ($t->_id ?? $t->id),
                'ticket_id' => (string) ($t->ticket_id ?? ''),
                'title' => $t->title,
                'description' => $t->description ?? null,
                'status' => $t->status ?? null,
                'priority' => $t->priority ?? null,
                'developer_name' => $t->developer_name ?? null,
                'issues_count' => is_array($t->issues ?? null) ? count($t->issues) : 0,
                'start_date' => optional($t->start_date)?->toDateString(),
                'end_date' => optional($t->end_date)?->toDateString(),
                'mark_image_path' => $this->getTaskImageUrl($t),
                'project_logo_path' => $projectLogo,
                'task_type' => $t->task_type ?? 'task', // Include task type for frontend
                'ticket' => [
                    'title' => optional($t->ticket)->title,
                    'code' => optional($t->ticket)->code,
                ],
            ];
        })->values();

        return response()->json($result);
    }

    // List developers for assignment
    public function developers(Request $request)
    {
        $developers = User::query()
            ->where('type', 'developer')
            ->orderBy('name')
            ->get()
            ->map(function ($u) {
                return [
                    'id' => (string) ($u->_id ?? $u->id), 
                    'name' => $u->name ?? $u->email ?? 'Developer'
                ];
            })
            ->values();
        return response()->json($developers);
    }

    // New, dedicated tickets endpoint for workflow → project → tickets flow
    public function projectTicketsBasic(Request $request)
    {
        $projectId = (string) $request->string('project_id');
        if ($projectId === '') {
            return response()->json([]);
        }

        // Resolve project logo once
        $projectLogoUrl = null;
        try {
            $proj = Project::find($projectId);
            if (!$proj) {
                try { $proj = Project::find(new ObjectId($projectId)); } catch (\Throwable $e) {}
            }
            if ($proj && isset($proj->logo_path)) {
                $projectLogoUrl = $this->toPublicUrl((string) $proj->logo_path);
            }
        } catch (\Throwable $e) {
            // ignore
        }

        // Fetch tickets strictly by project_id without reusing existing method,
        // return minimal fields needed by the workflow UI
        $tickets = Ticket::query()
            ->where('project_id', $projectId)
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($t) {
                return [
                    'id' => (string) ($t->_id ?? $t->id),
                    'title' => $t->title ?? null,
                    'code' => $t->code ?? null,
                    'project_id' => (string) ($t->project_id ?? ''),
                    'project_title' => $t->project_title ?? null,
                    'project_logo' => null, // filled below
                    'status' => $t->status ?? null,
                    'start_date' => optional($t->start_date)?->toDateString(),
                    'end_date' => optional($t->end_date)?->toDateString(),
                ];
            })
            ->values();

        // Attach resolved logo to all items
        if ($tickets->isNotEmpty() && $projectLogoUrl) {
            $tickets = $tickets->map(function ($row) use ($projectLogoUrl) {
                $row['project_logo'] = $projectLogoUrl;
                return $row;
            });
        }

        return response()->json($tickets);
    }

    public function store(Request $request)
    {
        
        
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'project_id' => 'nullable|string|max:255',
            'pm_id' => 'nullable|string|max:255',
            'timeline_color' => 'nullable|string|max:255',
            'banner' => 'nullable|image|max:4096',
            'thumb' => 'nullable|image|max:4096',
            'tickets' => 'nullable|array',
            'tasks' => 'nullable|array',
        ]);
        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('teams', 'public');
        }

        $thumbPath = null;
        if ($request->hasFile('thumb')) {
            $thumbPath = $request->file('thumb')->store('teams', 'public');
        }

        // Normalize tickets coming from form (hidden input "tickets[]")
        $ticketIds = collect($request->input('tickets', []))
            ->filter()
            ->map(function ($t) {
                return (string) $t;
            })
            ->values()
            ->all();

        // Normalize tasks coming from form (hidden inputs "tasks[]")
        $taskIds = collect($request->input('tasks', []))
            ->filter()
            ->map(function ($t) {
                return (string) $t;
            })
            ->values();
        if ($taskIds->isEmpty() && !empty($ticketIds)) {
            try {
                $taskIds = \App\Models\Task::query()
                    ->whereIn('ticket_id', $ticketIds)
                    ->pluck('_id')
                    ->map(function ($id) {
                        return (string) $id;
                    });
            } catch (\Throwable $e) {
                $taskIds = collect();
            }
        }

        try {
            // Priorities as per-task map: [taskId => 'low'|'medium'|'high']
            $priorityValues = collect((array) $request->input('task_priorities', []))
                ->map(function ($v) {
                    if (is_array($v)) return null;
                    $vv = strtolower((string) $v);
                    return in_array($vv, ['low','medium','high'], true) ? $vv : null;
                })
                ->filter()
                ->all();

            // Restructure task_developers: from [taskId => [developerName, ...]] to [userId => [developerName]]
            $devInput = (array) $request->input('task_developers', []);
            $devMap = [];
            
            // Collect all unique developer names/IDs from all tasks
            $allDevelopers = collect($devInput)->flatten()->unique()->filter()->values();
            
            // For each developer (could be name or ID), find the user and create the map
            foreach ($allDevelopers as $developer) {
                $developerStr = trim((string) $developer);
                if (empty($developerStr)) continue;
                
                $user = null;
                
                // Check if it's an ObjectId (user ID)
                if (preg_match('/^[a-f0-9]{24}$/i', $developerStr)) {
                    try { 
                        $user = User::find($developerStr); 
                    } catch (\Throwable $e) {}
                    
                    if (!$user) {
                        try { 
                            $user = User::query()->where('id', $developerStr)->orWhere('_id', $developerStr)->first(); 
                        } catch (\Throwable $e) {}
                    }
                } else {
                    // It's a name, look up by name
                    try {
                        $user = User::where('name', $developerStr)->first();
                    } catch (\Throwable $e) {}
                }
                
                if ($user && $user->name) {
                    $userIdString = (string) ($user->_id ?? $user->id);
                    // Store as {user_id: [developer_name]}
                    $devMap[$userIdString] = [$user->name];
                }
            }

            $team = Team::create([
                'title' => $validated['title'] ?? null,
                'project_id' => $validated['project_id'] ?? null,
                'pm_id' => $validated['pm_id'] ?? null,
                'timeline_color' => $validated['timeline_color'] ?? null,
                'banner_path' => $bannerPath,
                'thumb_path' => $thumbPath,
                'tickets' => $ticketIds,
                'tasks' => $taskIds->values()->all(),
                // store per-task maps with simple values and names
                'task_priorities' => $priorityValues,
                'task_developers' => $devMap,
                'user_id' => Auth::id(),
            ]);

            // Create group from developers assigned to tasks
            // Extract unique developer IDs from task_developers map
            $groupDeveloperIds = [];
            if (!empty($devMap) && is_array($devMap)) {
                // devMap structure: [userId => [developerName]]
                $groupDeveloperIds = array_keys($devMap);
            }
            
            \Log::info('Team created - Extracting developers for group:', [
                'devMap' => $devMap,
                'groupDeveloperIds' => $groupDeveloperIds,
                'count' => count($groupDeveloperIds)
            ]);
            
            if (!empty($groupDeveloperIds) && is_array($groupDeveloperIds)) {
                $group = $this->createGroupForTeam($team, $groupDeveloperIds);
                if ($group) {
                    \Log::info('Group created successfully', ['group_id' => (string)$group->_id, 'team_id' => (string)$team->_id]);
                } else {
                    \Log::warning('Group creation returned null', ['team_id' => (string)$team->_id]);
                }
            } else {
                \Log::info('No developers assigned to tasks, skipping group creation', ['team_id' => (string)$team->_id]);
            }

            // Send email notifications to assigned developers
            $this->sendTaskAssignmentEmails($devMap, $priorityValues, $taskIds->values()->all(), $team->title ?? '');

        } catch (\Throwable $e) {
            return back()->with('error', 'Failed to create team: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('chat-team')->with('success', 'Team created successfully.');
    }

    /**
     * Update group for a team with selected developers
     */
    private function updateGroupForTeam($group, $developerIds, $team)
    {
        try {
            // Filter and validate developer IDs
            $validDeveloperIds = collect($developerIds)
                ->filter()
                ->map(function ($devId) {
                    return (string) trim($devId);
                })
                ->filter(function ($devId) {
                    return !empty($devId) && preg_match('/^[a-f0-9]{24}$/i', $devId);
                })
                ->unique()
                ->values()
                ->all();

            // Verify all developers exist
            $developers = User::whereIn('_id', $validDeveloperIds)
                ->where('type', 'developer')
                ->get();

            if ($developers->isEmpty() && empty($validDeveloperIds)) {
                // No developers, but that's okay - just update name
                $group->name = $team->title ?? $group->name;
                $group->member_ids = [];
                $group->save();
                return $group;
            }

            $actualDeveloperIds = $developers->pluck('_id')->map(function ($id) {
                return (string) $id;
            })->all();

            // Update group
            $group->name = $team->title ?? $group->name;
            $group->member_ids = $actualDeveloperIds;
            $group->save();

            return $group;
        } catch (\Throwable $e) {
            \Log::error('Failed to update group for team: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create a group for a team with selected developers
     */
    private function createGroupForTeam($team, $developerIds)
    {
        try {
            \Log::info('createGroupForTeam called', [
                'team_id' => (string)$team->_id,
                'team_title' => $team->title,
                'developer_ids' => $developerIds,
                'developer_count' => count($developerIds)
            ]);

            // Filter and validate developer IDs
            $validDeveloperIds = collect($developerIds)
                ->filter()
                ->map(function ($devId) {
                    return (string) trim($devId);
                })
                ->filter(function ($devId) {
                    // Validate it's a valid user ID format
                    return !empty($devId) && preg_match('/^[a-f0-9]{24}$/i', $devId);
                })
                ->unique()
                ->values()
                ->all();

            \Log::info('Validated developer IDs', ['valid_ids' => $validDeveloperIds, 'count' => count($validDeveloperIds)]);

            if (empty($validDeveloperIds)) {
                \Log::warning('No valid developer IDs found after validation');
                return null;
            }

            // Verify all developers exist
            $developers = User::whereIn('_id', $validDeveloperIds)
                ->where('type', 'developer')
                ->get();

            \Log::info('Developers found', ['count' => $developers->count(), 'developers' => $developers->pluck('name')->all()]);

            if ($developers->isEmpty()) {
                \Log::warning('No developers found with type=developer', ['searched_ids' => $validDeveloperIds]);
                return null;
            }

            $actualDeveloperIds = $developers->pluck('_id')->map(function ($id) {
                return (string) $id;
            })->all();

            // Create group
            $groupData = [
                'name' => $team->title ?? 'Untitled Group',
                'team_id' => (string) $team->_id,
                'admin_id' => (string) Auth::id(), // Team creator is admin
                'member_ids' => $actualDeveloperIds,
                'created_by' => (string) Auth::id(),
            ];

            \Log::info('Creating group with data', $groupData);

            try {
                $group = new Group();
                $group->name = $groupData['name'];
                $group->team_id = $groupData['team_id'];
                $group->admin_id = $groupData['admin_id'];
                $group->member_ids = $groupData['member_ids'];
                $group->created_by = $groupData['created_by'];
                $group->save();
                
                \Log::info('Group saved successfully', ['group_id' => (string)$group->_id]);
            } catch (\Exception $e) {
                \Log::error('Group::create failed, trying manual save', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }

            \Log::info('Group created successfully', [
                'group_id' => (string)$group->_id,
                'group_name' => $group->name,
                'member_count' => count($actualDeveloperIds)
            ]);

            return $group;
        } catch (\Throwable $e) {
            // Log error but don't fail team creation
            \Log::error('Failed to create group for team', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'team_id' => (string)$team->_id ?? 'unknown'
            ]);
            return null;
        }
    }

    public function destroy($id)
    {
        try {
            $team = Team::find($id);
            if (!$team) {
                try {
                    $team = Team::find(new ObjectId((string) $id));
                } catch (\Throwable $e) {
                    // ignore
                }
            }
            if ($team) {
                $team->delete();
                return back()->with('success', 'Team deleted successfully.');
            }
            return back()->with('error', 'Team not found.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Failed to delete team: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $team = Team::find($id);
            if (!$team) {
                try {
                    $team = Team::find(new ObjectId((string) $id));
                } catch (\Throwable $e) {
                    // ignore
                }
            }
            if (!$team) {
                return back()->with('error', 'Team not found.');
            }

            $validated = $request->validate([
                'title' => 'nullable|string|max:255',
                'project_id' => 'nullable|string|max:255',
                'pm_id' => 'nullable|string|max:255',
                'timeline_color' => 'nullable|string|max:255',
                'banner' => 'nullable|image|max:4096',
                'thumb' => 'nullable|image|max:4096',
                'tickets' => 'nullable|array',
                'tasks' => 'nullable|array',
            ]);

            // Files (optional)
            if ($request->hasFile('banner')) {
                $team->banner_path = $request->file('banner')->store('teams', 'public');
            }
            if ($request->hasFile('thumb')) {
                $team->thumb_path = $request->file('thumb')->store('teams', 'public');
            }

            // Normalize tickets
            $ticketIds = collect($request->input('tickets', []))
                ->filter()
                ->map(function ($t) { return (string) $t; })
                ->values()
                ->all();

            // Normalize tasks (or derive from tickets)
            $taskIds = collect($request->input('tasks', []))
                ->filter()
                ->map(function ($t) { return (string) $t; })
                ->values();
            if ($taskIds->isEmpty() && !empty($ticketIds)) {
                try {
                    $taskIds = \App\Models\Task::query()
                        ->whereIn('ticket_id', $ticketIds)
                        ->pluck('_id')
                        ->map(function ($id) { return (string) $id; });
                } catch (\Throwable $e) {
                    $taskIds = collect();
                }
            }

            // Priorities per-task map
            $priorityValues = collect((array) $request->input('task_priorities', []))
                ->map(function ($v) {
                    if (is_array($v)) return null;
                    $vv = strtolower((string) $v);
                    return in_array($vv, ['low','medium','high'], true) ? $vv : null;
                })
                ->filter()
                ->all();

            // Restructure task_developers: from [taskId => [developerName, ...]] to [userId => [developerName]]
            $devInput = (array) $request->input('task_developers', []);
            $devMap = [];
            
            // Collect all unique developer names/IDs from all tasks
            $allDevelopers = collect($devInput)->flatten()->unique()->filter()->values();
            
            // For each developer (could be name or ID), find the user and create the map
            foreach ($allDevelopers as $developer) {
                $developerStr = trim((string) $developer);
                if (empty($developerStr)) continue;
                
                $user = null;
                
                // Check if it's an ObjectId (user ID)
                if (preg_match('/^[a-f0-9]{24}$/i', $developerStr)) {
                    try { 
                        $user = User::find($developerStr); 
                    } catch (\Throwable $e) {}
                    
                    if (!$user) {
                        try { 
                            $user = User::query()->where('id', $developerStr)->orWhere('_id', $developerStr)->first(); 
                        } catch (\Throwable $e) {}
                    }
                } else {
                    // It's a name, look up by name
                    try {
                        $user = User::where('name', $developerStr)->first();
                    } catch (\Throwable $e) {}
                }
                
                if ($user && $user->name) {
                    $userIdString = (string) ($user->_id ?? $user->id);
                    // Store as {user_id: [developer_name]}
                    $devMap[$userIdString] = [$user->name];
                }
            }

            // Update scalar fields
            $team->title = $validated['title'] ?? $team->title;
            $team->project_id = $validated['project_id'] ?? $team->project_id;
            $team->pm_id = $validated['pm_id'] ?? $team->pm_id;
            $team->timeline_color = $validated['timeline_color'] ?? $team->timeline_color;

            // Store old developers before updating (for comparison)
            $oldDevMap = $team->task_developers ?? [];

            // Update arrays
            $team->tickets = $ticketIds;
            $team->tasks = $taskIds->values()->all();
            $team->task_priorities = $priorityValues;
            $team->task_developers = $devMap;

            $team->save();

            // Update or create group from developers assigned to tasks
            // Extract unique developer IDs from task_developers map
            $groupDeveloperIds = [];
            if (!empty($devMap) && is_array($devMap)) {
                // devMap structure: [userId => [developerName]]
                $groupDeveloperIds = array_keys($devMap);
            }
            
            if (!empty($groupDeveloperIds) && is_array($groupDeveloperIds)) {
                // Check if group exists for this team
                $existingGroup = Group::where('team_id', (string) $team->_id)->first();
                
                if ($existingGroup) {
                    // Update existing group
                    $this->updateGroupForTeam($existingGroup, $groupDeveloperIds, $team);
                } else {
                    // Create new group
                    $this->createGroupForTeam($team, $groupDeveloperIds);
                }
            }

            // Send email notifications to newly assigned developers
            $this->sendTaskAssignmentEmails($devMap, $priorityValues, $taskIds->values()->all(), $team->title ?? '', $oldDevMap);

            return redirect()->route('chat-team')->with('success', 'Team updated successfully.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Failed to update team: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Send email notifications to developers assigned to tasks
     * 
     * @param array $devMap Map of userId => [developerName] (keys are user IDs, not task IDs)
     * @param array $priorityValues Map of taskId => priority
     * @param array $taskIds Array of task IDs
     * @param string $teamTitle Team title
     * @param array $oldDevMap Previous developer assignments (for update, to only notify new assignments)
     */
    private function sendTaskAssignmentEmails(array $devMap, array $priorityValues, array $taskIds, string $teamTitle = '', array $oldDevMap = [])
    {
        try {
            if (empty($devMap) || empty($taskIds)) {
                return; // No developers or tasks to notify
            }

            // Get all user IDs from devMap (keys are user IDs)
            $userIds = array_keys($devMap);
            
            if (empty($userIds)) {
                return; // No developers to notify
            }

            // Fetch all developers by ID to get their emails
            $developers = collect();
            foreach ($userIds as $userId) {
                try {
                    $user = User::find($userId);
                    if (!$user) {
                        try {
                            $user = User::query()->where('id', $userId)->orWhere('_id', $userId)->first();
                        } catch (\Throwable $e) {
                            continue;
                        }
                    }
                    if ($user && $user->type === 'developer' && !empty($user->email)) {
                        $developers->put($userId, $user);
                    }
                } catch (\Throwable $e) {
                    continue;
                }
            }

            if ($developers->isEmpty()) {
                return; // No developers found with emails
            }

            // Get old developer user IDs for comparison (for update scenario)
            $oldUserIds = [];
            if (!empty($oldDevMap)) {
                $oldUserIds = array_keys($oldDevMap);
            }

            // Process each task and send email to assigned developers
            foreach ($taskIds as $taskId) {
                if (empty($taskId)) {
                    continue;
                }

                // Get task details with relationships
                $task = null;
                try {
                    $task = Task::with('ticket')->find($taskId);
                    if (!$task) {
                        try {
                            $task = Task::with('ticket')->find(new ObjectId($taskId));
                        } catch (\Throwable $e) {
                            continue; // Skip if task not found
                        }
                    }
                } catch (\Throwable $e) {
                    continue; // Skip if task not found
                }

                if (!$task) {
                    continue;
                }

                // Get priority for this task
                $priority = $priorityValues[$taskId] ?? '';

                // Send email to each assigned developer
                foreach ($developers as $userId => $developer) {
                    // For update: only send email if developer is newly assigned
                    if (!empty($oldDevMap) && in_array($userId, $oldUserIds)) {
                        continue; // Developer was already assigned, skip
                    }

                    if (empty($developer->email)) {
                        continue; // No email address
                    }

                    // Send email notification
                    try {
                        Mail::to($developer->email)->send(
                            new TaskAssignmentMail($developer, $task, $priority, $teamTitle)
                        );
                    } catch (\Throwable $e) {
                        // Log error but don't fail the entire operation
                        \Log::error('Failed to send task assignment email to ' . $developer->email . ': ' . $e->getMessage());
                    }
                }
            }
        } catch (\Throwable $e) {
            // Log error but don't fail the entire operation
            \Log::error('Failed to send task assignment emails: ' . $e->getMessage());
        }
    }
}


