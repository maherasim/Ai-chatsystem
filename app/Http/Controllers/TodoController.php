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
            ->where('start_date', date('Y-m-d'))
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
            ->where('is_private', "1")
    ->where('completed', '!=', '1')
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
        
        $sharedTodos = Todo::where('user_id', '!=', $user->id)->where('members', $user->id)->where('completed', '!=', '1')->get();

        return view('Todos.index', compact('user', 'users', 'todayTodos', 'privateTodos', 'sharedTodos', 'setting'));
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

        $todo = Todo::create([
            'title'       => $request->title,
           // 'description' => $request->description,
            'start_date'  => $request->start_date ?? date('Y-m-d'),
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'is_private'  => $request->is_private,
            'project'     => $request->project,
            'priority'    => $request->priority,
            'reminder'    => $request->reminder,
            'description' => $request->sections ?? [], 
            'user_id'     => Auth::id(),
            'completed'   => 0,
            'is_schduled' => $request->start_date ? 1 : 0,
            'members'     => $request->members ?? []
        ]);

        return redirect()->back()->with('success', 'ToDo created successfully!');
    }


}