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
            Team::create([
                'title' => $validated['title'] ?? null,
                'project_id' => $validated['project_id'] ?? null,
                'pm_id' => $validated['pm_id'] ?? null,
                'timeline_color' => $validated['timeline_color'] ?? null,
                'banner_path' => $bannerPath,
                'thumb_path' => $thumbPath,
                'tickets' => $ticketIds,
                'tasks' => $taskIds->values()->all(),
                'user_id' => Auth::id(),
            ]);
        } catch (\Throwable $e) {
            return back()->with('error', 'Failed to create team: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('chat-team')->with('success', 'Team created successfully.');
    }
}


