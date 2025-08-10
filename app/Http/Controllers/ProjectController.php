<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
class ProjectController extends Controller
{
    public function index ()
    {
        return view ('Chats.project');
    }
 

public function store(Request $request)
{
    // Validate your inputs
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'priority' => 'required|string|max:255',
        'date_time' => 'required|date',
        'description' => 'nullable|string',
        'sections' => 'nullable|array',
        'project_managers' => 'nullable|array',
        'developers' => 'nullable|array',
        'image' => 'nullable|image|max:2048',
        'upload_files' => 'nullable|file|max:5120',
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('projects/images', 'public');
        $validated['image'] = $imagePath;
    }

    // Handle file upload
    if ($request->hasFile('upload_files')) {
        $filePath = $request->file('upload_files')->store('projects/files', 'public');
        $validated['upload_files'] = $filePath;
    }

    // Create and store in MongoDB
    $project = Project::create([
        'title' => $validated['title'],
        'priority' => $validated['priority'],
        'date_time' => $validated['date_time'],
        'description' => $validated['description'],
        'sections' => $validated['sections'] ?? [],
        'project_managers' => $validated['project_managers'] ?? [],
        'developers' => $validated['developers'] ?? [],
        'image' => $validated['image'] ?? null,
        'upload_files' => $validated['upload_files'] ?? null,
    ]);

   return redirect()->route('chat-project')->with('success', 'Project created successfully');
}

}
