<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Setting;
use App\Models\Todo;
use App\Models\TodoAttachment;
use App\Models\Task;
use App\Models\Project;
use App\Models\Teams;
use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;
use App\Mail\CustomMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class TodoController extends Controller
{

    public function checkexpired(){

        $now = Carbon::now();

        $todos = Todo::where(function($query) use ($now) {
    // expired todos
    $query->where('end_date', '<', $now->format('Y-m-d'))
          ->orWhere(function($q) use ($now) {
              $q->where('end_date', $now->format('Y-m-d'))
                ->where('end_time', '<=', $now->format('H:i'));
          });
})
->where(function($query) {
    // either sentmail != "1" or field not exists
    $query->where('sentmail', '!=', "1")
          ->orWhereNull('sentmail');
})->take(2)->get();

        
        foreach($todos as $todo){
           
            foreach ($todo->members as $mem) {

            $tuser = User::where('_id', $mem)->first();
            $fuser = User::where('_id', $todo->user_id)->first();

                if($tuser){

                    $tomail = $tuser->email;
                   // echo $tomail;
                        $details = [
                            'subject' => 'ToDo Expired',
                            'from'    =>  $fuser->name,
                            'name'      =>  $tuser->name,
                            'view'    => 'emails.todoexpire',
                            'todo'    => $todo
                        ];

                        Mail::to($tomail)->send(new CustomMail($details));
                    }
                }
            $todo->sentmail = 1;
            $todo->save();
          //  echo $todo->_id;
        }
        
        return true;

    }


    public function remove(Request $request){
        $user = Auth::user();
        $remid = $request->remid;

        $reason = $request->reason;
        $isremove = $request->isremove;

        $todo = Todo::where('id', $remid)->first();
        if($todo){
            if($request->iscomplete != "-1"){
                $todo->is_removed = 1;
            }
            
            if ($reason) {
                $todo->reason = $reason;
            }
            if($request->iscomplete == "-1" && $todo->user_id == $user->_id){
                $todo->completed = "-2";
            }else{
                $todo->completed = $request->iscomplete;
            }
            
            $todo->save();

            return redirect()->back()->with('success', 'Todo removed successfully.');
        }

        

        //$todo = Todo::where('id', $remid)
              //  ->where('user_id', $user->id)
       //         ->first();
       // if($isremove == 1){
       //     $todo->delete();
       // }else if($todo){
         //   $todo->is_removed = 1;
         //       if ($reason) {
        //            $todo->reason = $reason;
        //        }
       //     $todo->save();

        //    return redirect()->back()->with('success', 'Todo removed successfully.');
       // }

        return redirect()->back()->with('error', 'Todo not belonged to user');
        
    }

    public function complete(Request $request)
    {
        $id = $request->todo_id;

        $todo = Todo::findOrFail($id);

        $ratings = $request->input('ratings');
        $todo->ratings = $ratings;
        $todo->completed = $request->setcomplete;
        $todo->all_tasks_done  = $request->has('all_tasks_done')  ? 1 : 0;
        $todo->all_tasks_check = $request->has('all_tasks_check') ? 1 : 0;
        $todo->files_upload    = $request->has('files_upload')    ? 1 : 0;
        $todo->save();

        return redirect()->back()->with('success', 'Todo mark as done successfully.');
    }

    public function index()
    {

       
        $user = Auth::user();

        $setting = Setting::first();

        $users = User::whereIn('type', ['employee', 'developer'])
                 ->where('_id', '!=', $user->_id)->where('completed', '!=', '1')
                 ->get();


        $todayTodos = Todo::where('end_date', date('Y-m-d'))
    ->where(function ($q) use ($user) {
        $q
        // ✅ Case 1: completed = 2 → only include if this user is owner
        ->where(function ($sub) use ($user) {
            $sub->whereIn('completed', ["-1", "2"])
                ->where('user_id', $user->_id);
        })
        // ✅ Case 2: completed ≠ 1 and completed ≠ 2 → include if user is owner or member
        ->orWhere(function ($sub) use ($user) {
            $sub->whereNotIn('completed', ["1", "2", "-1", "-2"])
                ->where(function ($inner) use ($user) {
                    $inner->where('user_id', $user->_id)
                          ->orWhere('members', $user->_id);
                });
        });
    })
    ->where(function ($q) {
        $q->where('is_removed', 0)
          ->orWhereNull('is_removed');
    })
    ->get()
    ->map(function ($todo) {
        $members = User::whereIn('_id', $todo->members ?? [])->get(['_id','name','profile_image']);
        $todo->members_data = $members->map(function ($u) {
            return [
                'id'    => $u->_id,
                'name'  => $u->name,
                'image' => $u->profile_image
                    ? asset("storage/" . $u->profile_image)
                    : asset("build/img/default.png"),
            ];
        });
        return $todo;
    });


       
/*
      $todayTodos = Todo::where('end_date', date('Y-m-d'))
        ->where('completed', "!=", 2)
        ->where(function ($q) use ($user) {
            $q->where('user_id', $user->_id)
            ->orWhere('members', $user->_id); // ✅ works in MongoDB
        })
        ->where(function ($q) {
            $q->where('is_removed', 0)
            ->orWhereNull('is_removed');
        })
        ->get()
    ->map(function ($todo) {
        $members = User::whereIn('_id', $todo->members ?? [])->get(['_id','name','profile_image']);

        $todo->members_data = $members->map(function ($u) {
            return [
                'id'    => $u->_id,
                'name'  => $u->name,
                'image' => $u->profile_image
                    ? asset("storage/" . $u->profile_image)
                    : asset("build/img/default.png"),
            ];
        });
        return $todo;
    });

*/
            $privateTodos = Todo::where('user_id', $user->id)
    ->where('completed',  0)
     ->where('end_date', '>', date('Y-m-d'))
    ->where(function($q) {
        $q->where('is_removed', 0)
          ->orWhereNull('is_removed');
    })
            ->get()
            ->map(function ($todo) {
                $members = User::whereIn('_id', $todo->members ?? [])->get(['_id','name','profile_image']);

                $todo->members_data = $members->map(function ($u) {
                    return [
                        'id'    => $u->_id,
                        'name'  => $u->name,
                        'image' => $u->profile_image
                            ? asset("storage/" . $u->profile_image)
                            : asset("build/img/default.png"),
                    ];
                });

                return $todo;
            });





        // Shared
       // $sharedTodos = Todo::where('user_id', $user->id)->where('is_private', "0")->get();
        
        $sharedTodos = Todo::where('user_id', '!=', $user->id)
        ->where('members', $user->id)->where('completed', 0)
        ->where('end_date', '>', date('Y-m-d'))
        ->where(function($q) {
        $q->where('completed',  0)
          ->orWhereNull('is_removed');
    })->get()->map(function ($todo) {
                $members = User::whereIn('_id', $todo->members ?? [])->get(['_id','name','profile_image']);

                $todo->members_data = $members->map(function ($u) {
                    return [
                        'id'    => $u->_id,
                        'name'  => $u->name,
                        'image' => $u->profile_image
                            ? asset("storage/" . $u->profile_image)
                            : asset("build/img/default.png"),
                    ];
                });

                return $todo;
            });

            $ctime = strtotime(date("Y-m-d H:i:s"));
        
        // Fetch data for profile modal
        $userId = $user->_id ?? $user->id;
        
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
        
        // Calculate task statistics
        $totalTasks = Task::where(function($q) use ($userId) {
            $q->where('assigned_to', $userId)
              ->orWhere('created_by', $userId);
        })->count();
        
        $newTasksCount = Task::where(function($q) {
            $q->where('status', 'new')
              ->orWhere('status', 'new_task');
        })->where(function($q) use ($userId) {
            $q->where('assigned_to', $userId)
              ->orWhere('created_by', $userId);
        })->count();
        
        $inProgressTasksCount = Task::where(function($q) {
            $q->where('status', 'in_progress')
              ->orWhere('status', 'progress');
        })->where(function($q) use ($userId) {
            $q->where('assigned_to', $userId)
              ->orWhere('created_by', $userId);
        })->count();
        
        $inHoldTasksCount = Task::where(function($q) {
            $q->where('status', 'on_hold')
              ->orWhere('status', 'hold')
              ->orWhere('status', 'in_hold');
        })->where(function($q) use ($userId) {
            $q->where('assigned_to', $userId)
              ->orWhere('created_by', $userId);
        })->count();
        
        $inCheckTasksCount = Task::where(function($q) {
            $q->where('status', 'checked')
              ->orWhere('status', 'check')
              ->orWhere('status', 'checking')
              ->orWhere('status', 'in_checking')
              ->orWhere('status', 'in_checked');
        })->where(function($q) use ($userId) {
            $q->where('assigned_to', $userId)
              ->orWhere('created_by', $userId);
        })->count();
        
        $rejectedTasksCount = Task::where(function($q) {
            $q->where('status', 'rejected')
              ->orWhere('status', 'in_rejected');
        })->where(function($q) use ($userId) {
            $q->where('assigned_to', $userId)
              ->orWhere('created_by', $userId);
        })->count();
        
        $taskStats = [
            'new' => $newTasksCount,
            'total' => $totalTasks,
            'progress' => $inProgressTasksCount,
            'in_hold' => $inHoldTasksCount,
            'in_check' => $inCheckTasksCount,
            'delayed' => Task::where(function($q) use ($userId) {
                $q->where('assigned_to', $userId)
                  ->orWhere('created_by', $userId);
            })->where('end_date', '<', Carbon::now())->where('status', '!=', 'done')->count(),
            'rejected' => $rejectedTasksCount
        ];
        
        // Optional variables for profile modal (set to empty collections if not needed)
        $userTodos = collect();
        $assignedTickets = collect();
        // Projects for Add Todo dropdown (from Project model)
        $projects = Project::orderBy('title', 'asc')->get(['_id', 'title']);
        // Teams for Add Todo dropdown; map each team to list of user IDs and full member data from task_developers
        $teams = Teams::orderBy('title', 'asc')->get(['_id', 'title', 'project_id', 'task_developers']);
        $teamMemberIds = [];
        $teamMembersData = [];
        foreach ($teams as $t) {
            $teamKey = (string) ($t->_id ?? $t->id);
            $devs = is_string($t->task_developers ?? '') ? json_decode($t->task_developers, true) : ($t->task_developers ?? []);
            $ids = is_array($devs) ? array_values(array_map('strval', array_keys($devs))) : [];
            $teamMemberIds[$teamKey] = $ids;
            // Load only users that appear in task_developers (dynamic: 2 ids => 2 users, etc.)
            $usersInTeam = empty($ids) ? collect() : User::whereIn('_id', $ids)->get(['_id', 'name', 'profile_image']);
            $teamMembersData[$teamKey] = $usersInTeam->map(function ($u) {
                return [
                    'id'   => (string) ($u->_id ?? $u->id),
                    'name' => $u->name ?? '',
                    'profile_image' => $u->profile_image ? asset('storage/' . $u->profile_image) : asset('build/img/profileuser.svg'),
                ];
            })->values()->toArray();
        }
        
        return view('Todos.index', compact('user', 'users', 'todayTodos', 'privateTodos', 'sharedTodos', 'setting', 'ctime', 'reminders', 'taskStats', 'userTodos', 'projects', 'teams', 'teamMemberIds', 'teamMembersData', 'assignedTickets', 'newTasks', 'inProgressTasks', 'inHoldTasks', 'inCheckTasks', 'rejectedTasks'));
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect()->back()->with('success', 'Todo deleted successfully.');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date'  => 'nullable|date',
        'start_time'  => 'nullable',
        'end_time'    => 'nullable',
       // 'is_private'  => 'required|boolean',
        'priority'    => 'nullable|string',
        'reminder'    => 'nullable|integer',
        'members'     => 'nullable|array'
    ]);

    $todo = Todo::findOrFail($id);

    $todo->update([
        'title'       => $request->title,
        'description' => $request->description ?? $todo->description,
        'start_date'  => $request->start_date ?? $todo->start_date ?? date('Y-m-d'),
        'start_time'  => $request->start_time ?? $todo->start_time,
        'end_time'    => $request->end_time ?? $todo->end_time,
        'is_private'  => $request->is_private,
        'project'     => $request->project ?? $todo->project,
        'priority'    => $request->priority ?? $todo->priority,
        'reminder'    => $request->reminder ?? $todo->reminder,
        'completed'   => $todo->completed ?? 0,
        'is_schduled' => $request->start_date ? 1 : ($todo->is_schduled ?? 0),
        'members'     => $request->members ?? $todo->members ?? []
    ]);

    return redirect()->back()->with('success', 'ToDo updated successfully!');
}

    public function deltodo(){
        Todo::query()->delete(); //
        die("done");
    }

    public function download($id)
{
    $attachment = TodoAttachment::findOrFail($id); // adjust model name if needed
    $path = storage_path('app/public/' . $attachment->file_path);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->download($path, $attachment->file_name);
}


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
           // 'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'is_private' => 'required|boolean',
            'priority' => 'nullable|string',
            'reminder' => 'nullable|integer',
            'sections'    => 'nullable|array',
            'sections.*'  => 'nullable|string',
            'members' => 'nullable|array',
            'attachments.*' => 'file|mimes:pdf,mp4,png,jpg,jpeg|max:80240'
        ]);

        $startTime = $request->start_time;
        $endDate = $request->end_date ?? date('Y-m-d');
        $endTime = $request->end_time;
        $total_time = 0;
        $startDate = $request->start_date ?? date('Y-m-d');

        if ($request->start_date === null) {
            // If today, calculate based on todaytime input
            $hoursToAdd =  (int) $request->todaytime; // e.g. 2,3,6
            $startTime = now()->format('H:i');
            $endTime = now()->addHours($hoursToAdd)->format('H:i');
            $endDate = now()->addHours($hoursToAdd)->format('Y-m-d');
            $total_time = $request->todaytime;
            $startDate = date('Y-m-d');
        }

        //echo date("H:i");
        //die("");

        $todoid = $request->todo_id;

        $todo = Todo::updateOrCreate(
    ['_id' => $todoid], // condition to match
    [
        'title'       => $request->title,
        'start_date'  => $startDate,
        'start_time'  => $startTime,
        'end_date'    => $endDate,
        'end_time'    => $endTime,
        'is_private'  => $request->is_private,
        'project'     => $request->project,
        'priority'    => $request->priority ?? "low",
        'reminder'    => $request->reminder,
        'description' => $request->sections ?? [], 
        'user_id'     => Auth::id(),
        'total_time'  => $total_time,
        'completed'   => 0,
        'is_schduled' => $request->start_date ? 1 : 0,
        'members'     => $request->members ?? []
    ]
);

if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $file) {
            $path = $file->store('uploads/todos', 'public');

            TodoAttachment::create([
                'todo_id' => $todo->_id,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'size'        => Storage::disk('public')->size($path),
                'file_type' => $file->getMimeType(),
                'uploaded_by' => Auth::id()
            ]);
        }
    }

    //send email here

        if (!empty($request->members)) {
            foreach ($request->members as $mem) {
                    $tuser = User::where('_id', $mem)->first();
                    if($tuser){

                        $tomail = $tuser->email;

                        $details = [
                            'subject' => 'New Todo Assigned',
                            'from'    =>  Auth::user()->name,
                            'name'      =>  $tuser->name,
                            'view'    => 'emails.todo',
                            'todo'    => $todo
                        ];

                        Mail::to($tomail)->send(new CustomMail($details));
                    }
                }
        }
        


/*
        $todo = Todo::create([
            'title'       => $request->title,
           // 'description' => $request->description,
            'start_date'  => $request->start_date ?? date('Y-m-d'),
            'start_time'  => $startTime,
            'end_time'    => $endTime,
            'is_private'  => $request->is_private,
            'project'     => $request->project,
            'priority'    => $request->priority,
            'reminder'    => $request->reminder,
            'description' => $request->sections ?? [], 
            'user_id'     => Auth::id(),
            'total_time'  => $total_time,
            'completed'   => 0,
            'is_schduled' => $request->start_date ? 1 : 0,
            'members'     => $request->members ?? []
        ]);
*/
        return redirect()->back()->with('success', 'ToDo created successfully!');
    }


}