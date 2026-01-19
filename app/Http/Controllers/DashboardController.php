<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\Task;
use App\Models\Todo;
use App\Models\Meetings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Middleware already handles authentication, so user is guaranteed to exist
        $header = Setting::all();
        $setting = Setting::first();
        $user = Auth::user();
        
        $userId = (string) Auth::id();
        
        // Fetch all projects with their statistics
        $projects = Project::all()->map(function($project) use ($userId) {
            $tickets = Ticket::where('project_id', (string)$project->_id)->get();
            $allTasks = Task::where('project_id', (string)$project->_id)->get();
            
            // Calculate project progress
            $totalTasks = $allTasks->count();
            $completedTasks = $allTasks->where('status', 'done')->count();
            $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
            
            // Get section progress
            $sections = collect($project->sections ?? [])->map(function($section) use ($allTasks) {
                $sectionName = $section['name'] ?? null;
                if (!$sectionName) return null;
                
                $sectionTasks = $allTasks->filter(function($task) use ($sectionName) {
                    return isset($task->section) && $task->section === $sectionName;
                });
                $sectionTotal = $sectionTasks->count();
                $sectionCompleted = $sectionTasks->where('status', 'done')->count();
                $sectionProgress = $sectionTotal > 0 ? round(($sectionCompleted / $sectionTotal) * 100) : 0;
                
                return [
                    'name' => $sectionName,
                    'progress' => $sectionProgress
                ];
            })->filter();
            
            // Get team members
            $teamMembers = collect($project->team_members ?? [])->map(function($memberId) {
                $member = User::find($memberId);
                return $member ? [
                    'id' => (string)$member->_id,
                    'name' => $member->name ?? 'Unknown',
                    'email' => $member->email ?? ''
                ] : null;
            })->filter();
            
            // Get project manager
            $projectManager = $project->created_by ? User::find($project->created_by) : null;
            
            // Calculate days left
            $daysLeft = $project->end_date ? Carbon::parse($project->end_date)->diffInDays(Carbon::now(), false) : null;
            
            return [
                'id' => (string)$project->_id,
                '_id' => (string)$project->_id,
                'title' => $project->title ?? 'Untitled Project',
                'description' => $project->description ?? '',
                'logo' => $project->logo_path ? asset('storage/' . $project->logo_path) : asset('build/img/yekbon.svg'),
                'progress' => $progress,
                'priority' => $project->priority ?? 'low',
                'status' => $project->status ?? 'active',
                'start_date' => $project->start_date ? Carbon::parse($project->start_date)->format('d.m.Y') : null,
                'end_date' => $project->end_date ? Carbon::parse($project->end_date)->format('d.m.Y') : null,
                'days_left' => $daysLeft,
                'total_tasks' => $totalTasks,
                'tasks_count' => $totalTasks,
                'completed_tasks' => $completedTasks,
                'tickets_count' => $tickets->count(),
                'sections' => $sections,
                'team_members' => $teamMembers,
                'project_manager' => $projectManager,
                'tickets' => $tickets->take(2)->map(function($ticket) {
                    return [
                        'id' => (string)$ticket->_id,
                        'code' => $ticket->code ?? '',
                        'title' => $ticket->title ?? '',
                        'tasks_count' => Task::where('ticket_id', (string)$ticket->_id)->count()
                    ];
                })
            ];
        });
        
        // Get user todos
        $userTodos = Todo::where('user_id', $userId)->get();
        $todosCount = $userTodos->count();
        
        // Get todos with reminders
        $reminders = Todo::where('user_id', $userId)
            ->whereNotNull('reminder_date')
            ->where('reminder_date', '>=', Carbon::now())
            ->orderBy('reminder_date', 'asc')
            ->get()
            ->map(function($todo) {
                return [
                    '_id' => (string)$todo->_id,
                    'title' => $todo->title ?? 'Untitled Todo',
                    'description' => $todo->description ?? '',
                    'reminder_date' => $todo->reminder_date ?? null,
                    'status' => $todo->status ?? 'pending'
                ];
            });
        
        // Get assigned tickets
        $assignedTickets = Ticket::where('assigned_to', $userId)->get();
        
        // Get tasks for the user
        $newTasks = Task::where(function($q) use ($userId) {
            $q->where('assigned_to', $userId)
              ->orWhere('created_by', $userId);
        })->where('status', 'new')->get();
        
        $inProgressTasks = Task::where(function($q) use ($userId) {
            $q->where('assigned_to', $userId)
              ->orWhere('created_by', $userId);
        })->where('status', 'in_progress')->get();
        
        $inHoldTasks = Task::where(function($q) use ($userId) {
            $q->where('assigned_to', $userId)
              ->orWhere('created_by', $userId);
        })->where('status', 'in_hold')->get();
        
        $inCheckTasks = Task::where(function($q) use ($userId) {
            $q->where('assigned_to', $userId)
              ->orWhere('created_by', $userId);
        })->where('status', 'in_check')->get();
        
        $rejectedTasks = Task::where(function($q) use ($userId) {
            $q->where('assigned_to', $userId)
              ->orWhere('created_by', $userId);
        })->where('status', 'rejected')->get();
        
        $totalTasks = Task::where(function($q) use ($userId) {
            $q->where('assigned_to', $userId)
              ->orWhere('created_by', $userId);
        })->count();
        
        $taskStats = [
            'new' => $newTasks->count(),
            'total' => $totalTasks,
            'progress' => $inProgressTasks->count(),
            'in_hold' => $inHoldTasks->count(),
            'in_check' => $inCheckTasks->count(),
            'delayed' => Task::where(function($q) use ($userId) {
                $q->where('assigned_to', $userId)
                  ->orWhere('created_by', $userId);
            })->where('end_date', '<', Carbon::now())->where('status', '!=', 'done')->count(),
            'rejected' => $rejectedTasks->count()
        ];
        
        // Calculate global statistics for dashboard cards
        $totalTickets = Ticket::count();
        $totalTasks_global = Task::count();
        $totalMeetings = Meetings::where('is_removed', '!=', true)->count();
        $totalMembers = User::count();
        $todosCount_global = Todo::count();
        
        return view('index', compact(
            'header',
            'setting',
            'user', 
            'projects', 
            'todosCount',
            'userTodos',
            'assignedTickets',
            'newTasks',
            'inProgressTasks',
            'inHoldTasks',
            'inCheckTasks',
            'rejectedTasks',
            'reminders',
            'taskStats',
            'totalTickets',
            'totalTasks_global',
            'totalMembers',
            'totalMeetings',
            'todosCount_global'
        ));
    }
}

