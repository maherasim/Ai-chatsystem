<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $headers = \App\Models\Setting::all();
        $projects = Project::orderByDesc('created_at')->paginate(12);

        $totalProjects = Project::count();
        $inProgressCount = Project::where('status', 'in_progress')->count();
        $inHoldCount = Project::where('status', 'in_hold')->count();
        $delayedCount = Project::where('status', 'delayed')->count();

        return view('Chats.project', compact(
            'headers',
            'projects',
            'totalProjects',
            'inProgressCount',
            'inHoldCount',
            'delayedCount'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'nullable|string|max:255',
            'status' => 'nullable|in:in_progress,in_hold,delayed,completed',
            'priority' => 'nullable|in:low,medium,high',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'reminder_days' => 'nullable|integer|min:0|max:365',
            'progress_percent' => 'nullable|integer|min:0|max:100',
            'logo' => 'nullable|image|max:2048',
            'sections' => 'nullable|array',
            'sections.*.name' => 'nullable|string|max:255',
            'sections.*.description' => 'nullable|string|max:1000',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('projects', 'public');
        }

        // Normalize sections (remove empty rows)
        $sections = collect($request->input('sections', []))
            ->map(function ($row) {
                return [
                    'name' => isset($row['name']) ? trim($row['name']) : null,
                    'description' => isset($row['description']) ? trim($row['description']) : null,
                ];
            })
            ->filter(function ($row) {
                return ($row['name'] !== null && $row['name'] !== '') || ($row['description'] !== null && $row['description'] !== '');
            })
            ->values()
            ->all();

        $project = Project::create([
            'title' => $validated['title'],
            'code' => $validated['code'] ?? null,
            'status' => $validated['status'] ?? 'in_progress',
            'priority' => $validated['priority'] ?? 'low',
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'description' => $validated['description'] ?? null,
            'reminder_days' => $validated['reminder_days'] ?? null,
            'progress_percent' => $validated['progress_percent'] ?? 0,
            'logo_path' => $logoPath,
            'sections' => $sections,
        ]);

        return redirect()->route('chat-project')->with('success', 'Project created successfully.');
    }
}

