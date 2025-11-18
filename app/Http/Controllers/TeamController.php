<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\Setting;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $headers = Setting::all();
        $projects = Project::orderBy('title')->get();
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
        return view('Chats.teams', compact('headers','projects','tickets','selectedProjectId','project'));
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

        Team::create([
            'title' => $validated['title'] ?? null,
            'project_id' => $validated['project_id'] ?? null,
            'pm_id' => $validated['pm_id'] ?? null,
            'timeline_color' => $validated['timeline_color'] ?? null,
            'banner_path' => $bannerPath,
            'thumb_path' => $thumbPath,
            'tickets' => $validated['tickets'] ?? [],
            'tasks' => $validated['tasks'] ?? [],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('chat-team')->with('success', 'Team created successfully.');
    }
}


