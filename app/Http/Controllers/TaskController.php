<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Ticket;

class TaskController extends Controller
{
    public function index()
    {
        $headers = \App\Models\Setting::all();
        $projects = Project::orderBy('title')->get();
       // dd($projects);
        return view('Chats.task', compact('headers', 'projects'));
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

}


