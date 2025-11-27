<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeTask;
use App\Models\Ticket;

class EmployeeTaskController extends Controller
{
    public function tickets(Request $request)
    {
        $projectId = $request->input('project_id');
        $query = Ticket::query();
        if (!empty($projectId)) {
            $query->where('project_id', $projectId);
        }
        $tickets = $query->orderByDesc('created_at')->limit(100)->get();
        $data = $tickets->map(function ($t) {
            return [
                'id' => (string) ($t->_id ?? $t->id),
                'code' => $t->code,
                'project_id' => $t->project_id,
                'title' => $t->title,
                'section_name' => $t->section_name,
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
       // dd($request->all());
        $validated = $request->validate([
            'project_id'      => 'required|string',
            'ticket_id'       => 'required|string',
            'title'           => 'required|string|max:255',
            'priority'        => 'nullable|in:low,medium,high',
            'description'     => 'nullable|string',
            'start_date'      => 'nullable|date',
            'end_date'        => 'nullable|date|after_or_equal:start_date',
            'day'             => 'nullable|string',
            'duration'        => 'nullable|string',
            'reminder_hours'  => 'nullable|integer|min:0|max:720',
            'images'          => 'nullable',
            'selected_image'  => 'nullable|string',
        ]);

        // Persist up to 4 images (base64 data URLs)
        $imagePaths = [];
        // Handle base64 or UploadedFile(s)
        $images = $request->input('images', []);
        if (is_array($images)) {
            foreach ($images as $img) {
                if (is_string($img) && str_starts_with($img, 'data:image')) {
                    try {
                        [$meta, $encoded] = explode(',', $img, 2);
                        $binary = base64_decode($encoded);
                        $ext = str_contains($meta, 'png') ? 'png' : 'jpg';
                        $fname = 'emptasks/images/'.uniqid('emp_', true).'.'.$ext;
                        Storage::disk('public')->put($fname, $binary);
                        $imagePaths[] = $fname;
                    } catch (\Throwable $e) {}
                }
            }
        }
        // Also accept files
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file) continue;
                try {
                    $path = $file->store('emptasks/images', 'public');
                    if ($path) $imagePaths[] = $path;
                } catch (\Throwable $e) {}
            }
        }
        // Or accept a predefined static image selection from public/build/img
        $selected = $request->input('selected_image');
        if (is_string($selected)) {
            $allowed = [
                'build/img/image1.jpeg',
                'build/img/imagw2.jpeg',
                'build/img/image3.jpeg',
                'build/img/image4.jpeg',
            ];
            if (in_array($selected, $allowed, true)) {
                $imagePaths[] = $selected;
            }
        }

        $task = EmployeeTask::create([
            'project_id'     => $validated['project_id'],
            'ticket_id'      => $validated['ticket_id'],
            'title'          => $validated['title'],
            'status'         => 'new_task',
            'priority'       => $validated['priority'] ?? null,
            'description'    => $validated['description'] ?? null,
            'start_date'     => $validated['start_date'] ?? null,
            'end_date'       => $validated['end_date'] ?? null,
            'day'            => $validated['day'] ?? null,
            'duration'       => $validated['duration'] ?? null,
            'reminder_hours' => $validated['reminder_hours'] ?? null,
            'images'         => $imagePaths,
            'created_by'     => Auth::id(),
        ]);

return redirect()->back()->with('success', 'Employee Task created successfully');    }

    public function destroy($id)
    {
        $task = EmployeeTask::findOrFail($id);
        $task->delete();
        return response()->json(['success' => true]);
    }
}


