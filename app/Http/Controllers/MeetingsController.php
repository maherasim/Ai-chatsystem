<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Setting;
use App\Models\Todo;
use App\Models\Meetings;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MeetingsController extends Controller
{


public function index()
    {

       
        $user = Auth::user();

        $setting = Setting::first();

        $users = User::whereIn('type', ['employee', 'developer'])
                 ->where('_id', '!=', $user->_id)->where('completed', '!=', '1')
                 ->get();


        $todayMeetings = Meetings::where('start_date', date('Y-m-d'))
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

            $upcomingMeetings = Meetings::where('user_id', $user->id)
    ->where('completed',  0)
     ->where('start_date', '>', date('Y-m-d'))
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

            $ctime = strtotime(date("Y-m-d H:i:s"));
        
        return view('Chats.meetings', compact('user', 'users', 'todayMeetings', 'upcomingMeetings',  'setting', 'ctime'));
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
            'sections'    => 'nullable|string',
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

        $todo = Meetings::updateOrCreate(
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
        'description' => $request->sections, 
        'user_id'     => Auth::id(),
        'total_time'  => $total_time,
        'completed'   => 0,
        'is_schduled' => $request->start_date ? 1 : 0,
        'members'     => $request->members ?? []
    ]
);




        return redirect()->back()->with('success', 'Meeting created successfully!');
    }

    public function destroy($id)
    {
        $todo = Meetings::findOrFail($id);
        $todo->delete();

        return redirect()->back()->with('success', 'Meeting deleted successfully.');
    }

}