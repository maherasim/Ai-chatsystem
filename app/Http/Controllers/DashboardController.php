<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\Todo;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->take(50)->get();
        $tickets = Ticket::latest()->take(50)->get();
        $headers = Setting::all();
        $setting = Setting::first();

        $todayTodos = Todo::where('end_date', date('Y-m-d'))
   
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


        $user = Auth::user();
        $teams = User::where('type', 'developer')->orWhere('type', 'employee')->get();

        $stats = (object) [
            'todo'     => Todo::count(),
            'members'  => User::where('type', 'developer')->orWhere('type', 'employee')->count(),
            'ticket'   => Ticket::count(),
            'project'  => Project::count(),
        ];

        return view('index', compact('user', 'stats', 'headers','setting', 'projects', 'teams', 'tickets', 'todayTodos'));
    }

    
}

