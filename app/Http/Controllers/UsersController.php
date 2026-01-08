<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Setting;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\Task;
use App\Models\Todo;
use Carbon\Carbon;

class UsersController extends Controller
{

    public function home(){
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
                return User::find($memberId);
            })->filter();
            
            // Get project manager
            $projectManager = $project->created_by ? User::find($project->created_by) : null;
            
            // Calculate days left
            $daysLeft = $project->end_date ? Carbon::parse($project->end_date)->diffInDays(Carbon::now(), false) : null;
            
            return [
                'id' => $project->_id,
                'title' => $project->title,
                'logo' => $project->logo_path ? asset('storage/' . $project->logo_path) : asset('build/img/yekbon.svg'),
                'progress' => $progress,
                'priority' => $project->priority ?? 'low',
                'status' => $project->status ?? 'active',
                'start_date' => $project->start_date ? Carbon::parse($project->start_date)->format('d.m.Y') : null,
                'end_date' => $project->end_date ? Carbon::parse($project->end_date)->format('d.m.Y') : null,
                'tickets_count' => $tickets->count(),
                'tasks_count' => $totalTasks,
                'days_left' => $daysLeft,
                'sections' => $sections,
                'team_members' => $teamMembers,
                'project_manager' => $projectManager,
                'tickets' => $tickets->take(2)->map(function($ticket) {
                    return [
                        'id' => $ticket->_id,
                        'code' => $ticket->code,
                        'title' => $ticket->title,
                        'tasks_count' => Task::where('ticket_id', (string)$ticket->_id)->count()
                    ];
                })
            ];
        });
        
        // Fetch todos overview
        $todos = Todo::where('is_removed', '!=', true)
            ->where(function($q) use ($userId) {
                $q->where('user_id', $userId)
                  ->orWhere('members', $userId)
                  ->orWhere('is_private', false);
            })
            ->with('user')
            ->get();
        
        $todosCount = $todos->count();
        $userTodos = $todos; // For profile modal
        
        // Fetch assigned tickets (tickets assigned to current user)
        $assignedTickets = Ticket::where(function($q) use ($userId) {
                $q->where('assignees', $userId)
                  ->orWhere('assignees', 'like', '%' . $userId . '%')
                  ->orWhere('created_by', $userId);
            })
            ->get()
            ->map(function($ticket) {
                $project = Project::find($ticket->project_id);
                $tasks = Task::where('ticket_id', (string)$ticket->_id)->get();
                $totalTasks = $tasks->count();
                $completedTasks = $tasks->where('status', 'done')->count();
                $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
                
                // Get assignees
                $assignees = collect($ticket->assignees ?? [])->map(function($assigneeId) {
                    return User::find($assigneeId);
                })->filter();
                
                return [
                    'id' => $ticket->_id,
                    'code' => $ticket->code,
                    'title' => $ticket->title,
                    'section' => $ticket->section_name ?? 'N/A',
                    'priority' => $ticket->priority ?? 'low',
                    'status' => $ticket->status ?? 'open',
                    'start_date' => $ticket->start_date ? Carbon::parse($ticket->start_date)->format('d.m.Y') : null,
                    'end_date' => $ticket->end_date ? Carbon::parse($ticket->end_date)->format('d.m.Y') : null,
                    'project' => $project,
                    'tasks_count' => $totalTasks,
                    'progress' => $progress,
                    'assignees' => $assignees
                ];
            });
        
        // Helper function to format tasks
        $formatTask = function($task) {
            $project = $task->project;
            $ticket = $task->ticket;
            
            // Get task image URL
            $markImageUrl = null;
            if ($task->mark_image_path) {
                $markImagePath = $task->mark_image_path;
                // Ensure proper path handling
                if (strpos($markImagePath, 'storage/') === 0) {
                    $markImageUrl = asset($markImagePath);
                } elseif (strpos($markImagePath, 'tasks/') === 0) {
                    $markImageUrl = asset('storage/' . $markImagePath);
                } else {
                    $markImageUrl = asset('storage/' . $markImagePath);
                }
            }
            
            return [
                'id' => $task->_id,
                'title' => $task->title,
                'section' => $task->section ?? 'N/A',
                'priority' => $task->priority ?? 'low',
                'status' => $task->status,
                'start_date' => $task->start_date ? Carbon::parse($task->start_date)->format('d.m.Y') : null,
                'end_date' => $task->end_date ? Carbon::parse($task->end_date)->format('d.m.Y') : null,
                'project' => $project,
                'ticket' => $ticket,
                'ticket_code' => $ticket ? $ticket->code : 'N/A',
                'project_logo' => $project && $project->logo_path ? asset('storage/' . $project->logo_path) : asset('build/img/yekbon.svg'),
                'hold_reason' => $task->hold_reason ?? null,
                'mark_image_url' => $markImageUrl,
            ];
        };
        
        // Fetch tasks by status (handle multiple possible status values)
        $newTasks = Task::where(function($q) {
                $q->where('status', 'new_task')
                  ->orWhere('status', 'new');
            })
            ->where(function($q) use ($userId) {
                $q->where('assigned_to', $userId)
                  ->orWhere('created_by', $userId);
            })
            ->with(['project', 'ticket'])
            ->get()
            ->map($formatTask);
        
        $inProgressTasks = Task::where(function($q) {
                $q->where('status', 'in_progress')
                  ->orWhere('status', 'progress');
            })
            ->where(function($q) use ($userId) {
                $q->where('assigned_to', $userId)
                  ->orWhere('created_by', $userId);
            })
            ->with(['project', 'ticket'])
            ->get()
            ->map($formatTask);
        
        $inHoldTasks = Task::where(function($q) {
                $q->where('status', 'in_hold')
                  ->orWhere('status', 'on_hold')
                  ->orWhere('status', 'hold');
            })
            ->where(function($q) use ($userId) {
                $q->where('assigned_to', $userId)
                  ->orWhere('created_by', $userId);
            })
            ->with(['project', 'ticket'])
            ->get()
            ->map($formatTask);
        
        $inCheckTasks = Task::where(function($q) {
                $q->where('status', 'in_check')
                  ->orWhere('status', 'checked')
                  ->orWhere('status', 'in_checked');
            })
            ->where(function($q) use ($userId) {
                $q->where('assigned_to', $userId)
                  ->orWhere('created_by', $userId);
            })
            ->with(['project', 'ticket'])
            ->get()
            ->map($formatTask);
        
        $rejectedTasks = Task::where(function($q) {
                $q->where('status', 'rejected')
                  ->orWhere('status', 'in_rejected');
            })
            ->where(function($q) use ($userId) {
                $q->where('assigned_to', $userId)
                  ->orWhere('created_by', $userId);
            })
            ->with(['project', 'ticket'])
            ->get()
            ->map($formatTask);
        
        // Fetch reminders (todos with reminder set)
        $reminders = Todo::where('is_removed', '!=', true)
            ->whereNotNull('reminder')
            ->where(function($q) use ($userId) {
                $q->where('user_id', $userId)
                  ->orWhere('members', $userId)
                  ->orWhere('is_private', false);
            })
            ->with('user')
            ->get()
            ->map(function($todo) {
                return [
                    'id' => $todo->_id,
                    'title' => $todo->title,
                    'description' => $todo->description ?? '',
                    'priority' => $todo->priority ?? 'low',
                    'reminder' => $todo->reminder,
                    'start_date' => $todo->start_date ? Carbon::parse($todo->start_date)->format('d.m.Y') : null,
                    'end_date' => $todo->end_date ? Carbon::parse($todo->end_date)->format('d.m.Y') : null,
                    'user' => $todo->user
                ];
            });
        
        // Calculate total statistics
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
        
        return view('index', compact(
            'user', 
            'setting', 
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
            'taskStats'
        ));
    }

  public function index()
    {
     $users = User::where('email', '!=', 'admin@gmail.com')->get();

        $totalUsers = User::where('is_admin', '!=', true)
            ->where(function ($q) {
                $q->where('email', '!=', 'admin@gmail.com')->orWhereNull('role');
            })
            ->count();

        $activeUsers = User::where('is_admin', '!=', true)
            ->where(function ($q) {
                $q->where('email', '!=', 'admin@gmail.com')->orWhereNull('role');
            })
            ->where('active', true)
            ->count();

        $inactiveUsers = User::where('is_admin', '!=', true)
            ->where(function ($q) {
                $q->where('email', '!=', 'admin@gmail.com')->orWhereNull('role');
            })
            ->where('active', false)
            ->count();

        $newJoinersToday = User::where('is_admin', '!=', true)
            ->where(function ($q) {
                $q->where('email', '!=', 'admin@gmail.com')->orWhereNull('role');
            })
            ->whereDate('created_at', Carbon::today())
            ->where('active', true)
            ->count();

        return view('Chats.users', compact('totalUsers', 'activeUsers', 'inactiveUsers', 'newJoinersToday', 'users'));
    }

  public function store(Request $request)
{
    //  Step 1: Validation
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required',
        'remail' => 'nullable',
        'passw' => 'nullable',
        'rpassw' => 'nullable',
        'cpassw' => 'nullable',
        'phone' => 'nullable',
        'department' => 'nullable|string',
        'image' => 'nullable',
         ]);
    // Step 2: Handle Image Upload
    $imagePath = null;

    // ensure active defaults true, restrict role to non-admin if provided
    $request->merge(['active' => true]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path('upload/users');
        $fullPath = $destinationPath . '/' . $fileName;

        if (!file_exists($fullPath)) {
            $file->move($destinationPath, $fileName);
        }
        $imagePath = 'upload/users/' . $fileName;
    }
    // Step 3: Extract Permissions
    $permissions = $request->input('permissions', []); // default is empty array if nothing checked
    // It will look like: ['clients' => ['read' => 'on', 'write' => 'on'], 'projects' => ['read' => 'on'], ...]

    // Optional: Convert "on" to true
    foreach ($permissions as $module => &$actions) {
        foreach ($actions as $action => $value) {
            $actions[$action] = true;
        }
    }  
    // Step 4: Store in database
    $user=User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['passw'] ?? ''),
        'phone' => $validated['phone'] ?? null,
        'department' => $validated['department'] ?? null,
        'image' => $imagePath,
        'active' => true,
        'permissions' => json_encode($permissions),
    ]);
    if($user){
      
    return redirect()->back()->with('success', 'User registered successfully!');
    }
    else{
        return redirect()->back()->with('error', 'User registered failed!!'); 
    }
}
public function destroy($id){
     $user=User::find($id);
     if($user){
         $user->delete();
        return redirect()->back()->with('success','User deleted Successfull');
     }
     else{
        return redirect()->back()->with('error','User deleted Successfull');
     }
}

}
