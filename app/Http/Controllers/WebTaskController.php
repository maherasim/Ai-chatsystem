<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\WebTask;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class WebTaskController extends Controller
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
            'mark_image'   => 'nullable|string',
            'issues'       => 'nullable|array',
            'board_image'  => 'nullable|string',
        ]);

        $path = null; // cropped issue image (unused for thumbnail)
        $dataUrl = $validated['mark_image'] ?? null;
        if ($dataUrl && str_starts_with($dataUrl, 'data:image')) {
            try {
                [$meta, $encoded] = explode(',', $dataUrl, 2);
                $binary = base64_decode($encoded);
                $ext = str_contains($meta, 'png') ? 'png' : 'jpg';
                $filename = 'webtasks/marks/'.uniqid('mark_', true).'.'.$ext;
                Storage::disk('public')->put($filename, $binary);
                $path = $filename;
            } catch (\Throwable $e) {
                $path = null;
            }
        }

        $taskBoardPath = null;
        if (!empty($validated['board_image']) && str_starts_with($validated['board_image'], 'data:image')) {
            try {
                [$meta, $encoded] = explode(',', $validated['board_image'], 2);
                $binary = base64_decode($encoded);
                $ext = str_contains($meta, 'png') ? 'png' : 'jpg';
                $boardPath = 'webtasks/boards/'.uniqid('board_', true).'.'.$ext;
                Storage::disk('public')->put($boardPath, $binary);
                $taskBoardPath = $boardPath; // keep per task; do not mutate ticket
            } catch (\Throwable $e) { $taskBoardPath = null; }
        }

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
                        $fname = 'webtasks/marks/'.uniqid('mark_', true).'.'.$ext;
                        Storage::disk('public')->put($fname, $binary);
                        $issues[$i]['mark_image_path'] = $fname;
                        unset($issues[$i]['mark_image']);
                        if ($firstIssueImagePath === null) $firstIssueImagePath = $fname;
                    }
                } catch (\Throwable $e) {}
            }
        }

        $task = WebTask::create([
            'project_id'     => $validated['project_id'] ?? null,
            'ticket_id'      => $validated['ticket_id'] ?? null,
            'title'          => $validated['title'],
            'description'    => $validated['description'] ?? null,
            'start_date'     => $validated['start_date'] ?? null,
            'end_date'       => $validated['end_date'] ?? null,
            'checkpoints'    => $validated['checkpoints'] ?? [],
            'status'         => 'new_task',
            'shape'          => $validated['shape'] ?? null,
            'color'          => $validated['color'] ?? null,
            'position'       => $validated['position'] ?? null,
            'number'         => $validated['number'] ?? null,
            // prefer full board image for preview; fallback to first issue crop
            'mark_image_path'=> $firstIssueImagePath ?: ($path ?: $taskBoardPath),
            'board_image_path'=> $taskBoardPath,
            'issues'         => $issues,
            'created_by'     => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'task' => [
                'id' => (string)($task->_id ?? $task->id),
                'mark_image_url' => ($taskBoardPath ? Storage::disk('public')->url($taskBoardPath) : ($path ? Storage::disk('public')->url($path) : null)),
            ],
        ]);
    }

    public function destroy($id)
    {
        $task = WebTask::findOrFail($id);
        $task->delete();
        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $task = WebTask::findOrFail($id);
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
        ]);

        $task = WebTask::findOrFail($id);

        if (!empty($validated['mark_image']) && str_starts_with($validated['mark_image'], 'data:image')) {
            try {
                [$meta, $encoded] = explode(',', $validated['mark_image'], 2);
                $binary = base64_decode($encoded);
                $ext = str_contains($meta, 'png') ? 'png' : 'jpg';
                $filename = 'webtasks/marks/'.uniqid('mark_', true).'.'.$ext;
                Storage::disk('public')->put($filename, $binary);
                $validated['mark_image_path'] = $filename;
            } catch (\Throwable $e) {}
        }

        $incomingIssues = $validated['issues'] ?? null;
        unset($validated['mark_image'], $validated['issues']);

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
                        $fname = 'webtasks/marks/'.uniqid('mark_', true).'.'.$ext;
                        Storage::disk('public')->put($fname, $binary);
                        $iss['mark_image_path'] = $fname;
                    } catch (\Throwable $e) {}
                }
                unset($iss['mark_image']);
                $processed[] = $iss;
            }
            $existing = is_array($task->issues) ? $task->issues : [];
            $task->issues = array_merge($existing, $processed);
            $task->save();
        }

        return response()->json(['success' => true]);
    }

    public function reject(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|string',
            'reason' => 'required|string',
            'other_reason' => 'nullable|string',
            'reject_files' => 'nullable|array',
            'reject_files.*' => 'file|max:10240',
        ]);

        $task = WebTask::find($validated['task_id']);
        if (!$task) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        $rejectAttachments = [];
        if ($request->hasFile('reject_files')) {
            foreach ($request->file('reject_files') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('webtasks/rejections', 'public');
                    $rejectAttachments[] = $path;
                }
            }
        }

        $rejectionReason = $validated['reason'];
        if ($validated['reason'] === 'Other' && !empty($validated['other_reason'])) {
            $rejectionReason = $validated['other_reason'];
        }

        $task->status = 'rejected';
        
        $rejectionData = [
            'reason' => $rejectionReason,
            'rejected_at' => now()->toDateTimeString(),
            'rejected_by' => Auth::id(),
            'attachments' => $rejectAttachments,
        ];
        
        $rejections = is_array($task->rejections) ? $task->rejections : [];
        $rejections[] = $rejectionData;
        $task->rejections = $rejections;
        
        $task->save();

        return response()->json([
            'success' => true,
            'message' => 'Task rejected successfully',
        ]);
    }
}


