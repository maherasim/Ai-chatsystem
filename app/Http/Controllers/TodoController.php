<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Setting;
use App\Models\Todo;
use Carbon\Carbon;

class TodoController extends Controller
{


    public function remove(Request $request){
        $user = Auth::user();
        $remid = $request->remid;

        $reason = $request->reason;

        $todo = Todo::where('id', $remid)
                ->where('user_id', $user->id)
                ->first();

        if($todo){
            $todo->is_removed = 1;
                if ($reason) {
                    $todo->reason = $reason;
                }
            $todo->save();

            return redirect()->back()->with('success', 'Todo removed successfully.');
        }

        return redirect()->back()->with('error', 'Todo not belonged to user');
        
    }

    public function complete($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->completed = 1;
        $todo->save();

        return response()->json(['success' => true]);
    }

    public function index()
    {
        $user = Auth::user();

        $setting = Setting::first();

        
        $users = User::whereIn('type', ['employee', 'developer'])
                 ->where('_id', '!=', $user->_id)->where('completed', '!=', '1')
                 ->get();

        // Today = start_date is today OR no start_date
      //  $todayTodos = Todo::where('user_id', $user->id)->where('start_date', date('Y-m-d'))->get();

        // Private
      //  $privateTodos = Todo::where('user_id', $user->id)
       //     ->where('is_private', "1")->where('completed', '!=', '1')
       //     ->get();

        $todayTodos = Todo::where('user_id', $user->id)
            ->where('end_date', date('Y-m-d'))
            ->where('completed',  0)
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
        
        $sharedTodos = Todo::where('user_id', '!=', $user->id)->where('members', $user->id)->where('completed', 0)
        
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
            
            
        return view('Todos.index', compact('user', 'users', 'todayTodos', 'privateTodos', 'sharedTodos', 'setting', 'ctime'));
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
            'members' => 'nullable|array'
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