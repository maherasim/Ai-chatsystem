<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\Setting;
use App\Models\Task;
use MongoDB\BSON\ObjectId;
use App\Models\User;

class TeamController extends Controller
{
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
                        $t->project_logo_path = $project->logo_path;
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
      //  dd($tickets);
        return view('Chats.teams', compact('headers','projects','tickets','selectedProjectId','project','teams'));
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

        // Try both ObjectId and string matching for safety
        $tasks = collect();
        try {
            $oid = new ObjectId($ticketId);
            $tasks = Task::where('ticket_id', $oid)->orderByDesc('created_at')->get();
        } catch (\Throwable $e) {
            // ignore
        }
        if ($tasks->isEmpty()) {
            $tasks = Task::where('ticket_id', $ticketId)->orderByDesc('created_at')->get();
        }

        $result = $tasks->map(function ($t) {
            // Resolve project logo path (if any)
            $projectLogo = null;
            try {
                $project = null;
                // Try fetch by ObjectId first
                try {
                    $project = \App\Models\Project::find(new ObjectId((string)($t->project_id)));
                } catch (\Throwable $e) {
                    // ignore
                }
                if (!$project) {
                    $project = \App\Models\Project::find((string)($t->project_id));
                }
                if ($project && isset($project->logo_path)) {
                    $projectLogo = $project->logo_path;
                }
            } catch (\Throwable $e) {
                // ignore resolution errors
            }

            return [
                'id' => (string) ($t->_id ?? $t->id),
                'ticket_id' => (string) ($t->ticket_id ?? ''),
                'title' => $t->title,
                'description' => $t->description,
                'status' => $t->status,
                'priority' => $t->priority ?? null,
                'developer_name' => $t->developer_name ?? null,
                'issues_count' => is_array($t->issues) ? count($t->issues) : 0,
                'start_date' => optional($t->start_date)?->toDateString(),
                'end_date' => optional($t->end_date)?->toDateString(),
                'mark_image_path' => $t->mark_image_path ?? null,
                'project_logo_path' => $projectLogo,
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
            ->get(['id','name'])
            ->map(function ($u) {
                return ['id' => (string) ($u->_id ?? $u->id), 'name' => $u->name ?? 'Developer'];
            })
            ->values();
        return response()->json($developers);
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
            // Flatten priorities to simple list of values like ['low','medium']
            $priorityInput = (array) $request->input('task_priorities', []);
            $priorityValues = collect($priorityInput)
                ->values()
                ->map(function ($v) { return is_array($v) ? null : $v; })
                ->filter()
                ->map(function ($v) { return strtolower((string) $v); })
                ->filter(function ($v) { return in_array($v, ['low','medium','high'], true); })
                ->unique()
                ->values()
                ->all();

            // Flatten developers to list of developer NAMES (not keyed, no ids)
            $devInput = (array) $request->input('task_developers', []);
            $devIds = collect($devInput)
                ->values()
                ->flatten()
                ->filter()
                ->map(function ($v) { return (string) $v; })
                ->unique()
                ->values();
            $devNames = collect();
            if ($devIds->isNotEmpty()) {
                try {
                    $devNames = User::query()
                        ->whereIn('_id', $devIds->all())
                        ->pluck('name');
                    if ($devNames->isEmpty()) {
                        $devNames = User::query()->whereIn('id', $devIds->all())->pluck('name');
                    }
                } catch (\Throwable $e) {
                    $devNames = collect();
                }
            }
            $devNames = $devNames->filter()->unique()->values()->all();

            Team::create([
                'title' => $validated['title'] ?? null,
                'project_id' => $validated['project_id'] ?? null,
                'pm_id' => $validated['pm_id'] ?? null,
                'timeline_color' => $validated['timeline_color'] ?? null,
                'banner_path' => $bannerPath,
                'thumb_path' => $thumbPath,
                'tickets' => $ticketIds,
                'tasks' => $taskIds->values()->all(),
                // store compact arrays: priorities as values only, developers as names only
                'task_priorities' => $priorityValues,
                'task_developers' => $devNames,
                'user_id' => Auth::id(),
            ]);
        } catch (\Throwable $e) {
            return back()->with('error', 'Failed to create team: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('chat-team')->with('success', 'Team created successfully.');
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
}


