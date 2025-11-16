<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Setting;
use App\Models\Todo;
use App\Models\TodoAttachment;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TodoController extends Controller
{


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
            $todo->completed = $request->iscomplete;
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


                 $prevTodos = Todo::where('end_date', '>', date('Y-m-d'))
    ->where(function ($q) use ($user) {
        // Exclude todos owned by or involving this user
        $q->where('user_id', '!=', $user->_id)
          ->where(function ($sub) use ($user) {
              $sub->whereNull('members')
                  ->orWhere(function ($inner) use ($user) {
                      // members does NOT contain this user
                      $inner->where('members', 'not like', '%' . $user->_id . '%');
                  });
          });
    })
    ->where(function ($q) {
        $q->where('is_removed', 0)
          ->orWhereNull('is_removed');
    })
    ->get()
    ->map(function ($todo) {
        $members = User::whereIn('_id', $todo->members ?? [])->get(['_id','name','image']);
        $todo->members_data = $members->map(function ($u) {
            return [
                'id'    => $u->_id,
                'name'  => $u->name,
                'image' => $u->image
                    ? asset($u->image)
                    : asset("build/img/profile.svg"),
            ];
        });
        return $todo;
    });


       


        $todayTodos = Todo::where('end_date', date('Y-m-d'))
   
    ->where(function ($q) {
        $q->where('is_removed', 0)
          ->orWhereNull('is_removed');
    })
    ->get()
    ->map(function ($todo) {
        $members = User::whereIn('_id', $todo->members ?? [])->get(['_id','name','image']);
        $todo->members_data = $members->map(function ($u) {
            return [
                'id'    => $u->_id,
                'name'  => $u->name,
                'image' => $u->image
                    ? asset($u->image)
                    : asset("build/img/profile.svg"),
            ];
        });
        return $todo;
    });

 
    $privateTodos = Todo::where('user_id', $user->id)->where('completed',  0)->where('end_date', '>', date('Y-m-d'))
    ->where(function($q) {
        $q->where('is_removed', 0)
          ->orWhereNull('is_removed');
    })
            ->get()
            ->map(function ($todo) {
        $members = User::whereIn('_id', $todo->members ?? [])->get(['_id','name','image']);

                $todo->members_data = $members->map(function ($u) {
                    return [
                        'id'    => $u->_id,
                        'name'  => $u->name,
                'image' => $u->image
                    ? asset($u->image)
                    : asset("build/img/profile.svg"),
                    ];
                });

                return $todo;
            });

        $sharedTodos = Todo::where('user_id', '!=', $user->id)
        ->where('members', $user->id)->where('completed', 0)
        ->where('end_date', '>', date('Y-m-d'))
        ->where(function($q) {
        $q->where('completed',  0)
          ->orWhereNull('is_removed');
    })->get()->map(function ($todo) {
        $members = User::whereIn('_id', $todo->members ?? [])->get(['_id','name','image']);

                $todo->members_data = $members->map(function ($u) {
                    return [
                        'id'    => $u->_id,
                        'name'  => $u->name,
                'image' => $u->image
                    ? asset($u->image)
                    : asset("build/img/profile.svg"),
                    ];
                });

                return $todo;
            });

            $ctime = strtotime(date("Y-m-d H:i:s"));

            $headers = Setting::all();
        
        return view('Todos.index', compact('user', 'users', 'prevTodos', 'todayTodos', 'privateTodos', 'sharedTodos', 'setting', 'ctime', 'headers'));
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