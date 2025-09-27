<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Todo;
use Carbon\Carbon;

class TodoController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        
        $users = User::whereIn('type', ['employee', 'developer'])
                 ->where('_id', '!=', $user->_id)->where('completed', '!=', '1')
                 ->get();

        // Today = start_date is today OR no start_date
        $todayTodos = Todo::where('user_id', $user->id)->where('start_date', date('Y-m-d'))->get();

        // Private
        $privateTodos = Todo::where('user_id', $user->id)
            ->where('is_private', "1")->where('completed', '!=', '1')
            ->get();


        // Shared
       // $sharedTodos = Todo::where('user_id', $user->id)->where('is_private', "0")->get();
        
        $sharedTodos = Todo::where('user_id', '!=', $user->id)->where('members', $user->id)->where('completed', '!=', '1')->get();

        return view('todos.index', compact('user', 'users', 'todayTodos', 'privateTodos', 'sharedTodos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'is_private' => 'required|boolean',
            'priority' => 'nullable|string',
            'reminder' => 'nullable|integer',
            'members' => 'nullable|array'
        ]);

        $todo = Todo::create([
            'title'       => $request->title,
            'description' => $request->description,
            'start_date'  => $request->start_date ?? date('Y-m-d'),
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'is_private'  => $request->is_private,
            'project'     => $request->project,
            'priority'    => $request->priority,
            'reminder'    => $request->reminder,
            'user_id'     => Auth::id(),
            'completed'   => 0,
            'is_schduled' => $request->start_date ? 1 : 0,
            'members'     => $request->members ?? []
        ]);

        return redirect()->back()->with('success', 'ToDo created successfully!');
    }


}