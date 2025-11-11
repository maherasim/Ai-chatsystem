<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Setting;
use App\Models\Todo;
use App\Models\Meetings;
use App\Models\MeetingMembers;
use Illuminate\Support\Facades\Storage;
use MongoDB\BSON\ObjectId;
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

                 $todayMeetings = Meetings::where('completed', 0)
    ->where('start_date',  date('Y-m-d'))
    ->get();

/*
$todayMeetings = Meetings::where(function ($q) use ($user) {
        // Meetings created by this user
      //  $q->where('user_id', $user->id)
          // OR meetings where this user is in members
          //->orWhereHas('members', function ($m) use ($user) {
           //   $m->where('user_id', $user->id);
          //});
    })
    ->where('completed', 0)
    ->where('start_date',  date('Y-m-d'))
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
*/
//$upcomingMeetings = Meetings::where('user_id', $user->id)
  //  ->where('completed',  0)
  //  ->where('start_date', '>', date('Y-m-d'))
   // ->where(function($q) {
   //     $q->where('is_removed', 0)
   //       ->orWhereNull('is_removed');
  //  })
  //  ->get();

    $upcomingMeetings = Meetings::where('completed', 0)
    ->where('start_date', '>', date('Y-m-d'))
  //  ->where(function ($q) {
  //      $q->where('is_removed', 0)
  //        ->orWhereNull('is_removed');
  //  })
    ->get();


/*
    $userId = new ObjectId($user->id);

// First, find all meeting IDs where the user is a member
$memberMeetingIds = MeetingMembers::where('user_id', $userId)
    ->pluck('meeting_id')
    ->toArray();

// Now fetch meetings either created by or joined by the user
$upcomingMeetings = Meetings::where(function($q) use ($userId, $memberMeetingIds) {
        $q->where('user_id', $userId)
          ->orWhereIn('_id', $memberMeetingIds);
    })
    ->where('completed', 0)
    ->where('start_date', '>', date('Y-m-d'))
    ->where(function($q) {
        $q->where('is_removed', 0)
          ->orWhereNull('is_removed');
    })
    ->get();
*/
         //   foreach ($upcomingMeetings as $m) {
    //echo $m->_id . ' => ' . MeetingMembers::where('meeting_id', $m->_id)->count() . "<br>";
//}
//die("");

            $ctime = strtotime(date("Y-m-d H:i:s"));
        
        return view('Chats.meetings', compact('user', 'users', 'todayMeetings', 'upcomingMeetings',  'setting', 'ctime'));
    }

    public function delmeetings(){
        Meetings::query()->delete(); //
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
            'sections'    => 'nullable|string',
            'members' => 'nullable|array',
            'attachments.*' => 'file|mimes:pdf,mp4,png,jpg,jpeg|max:80240'
        ]);

        $startTime = $request->start_time;
        
        $endTime = $request->end_time;
        $total_time = 0;
        $startDate = $request->start_date ?? date('Y-m-d');

        if ($request->start_date === null) {
            // If today, calculate based on todaytime input
            $hoursToAdd =  (int) $request->todaytime; // e.g. 2,3,6
            $startTime = now()->addHours($hoursToAdd)->format('H:i'); // now()->format('H:i');

            
            $newhours = $hoursToAdd * 2;
            $endTime = now()->addHours($newhours)->format('H:i');
           
            $total_time = $request->todaytime;
            $startDate = date('Y-m-d');
        }

        //echo date("H:i");
        //die("");

        $todoid = $request->meeting_id;

        $todo = Meetings::updateOrCreate(
    ['_id' => $todoid], // condition to match
    [
        'title'       => $request->title,
        'start_date'  => $startDate,
        'start_time'  => $startTime,
        'end_date'    => $startDate,
        'end_time'    => $endTime,
        'is_private'  => $request->is_private,
        'project'     => $request->project,
        'team'        => $request->team,
        'priority'    => $request->priority ?? "low",
        'reminder'    => $request->reminder,
        'description' => $request->sections, 
        'user_id'     => Auth::id(),
        'total_time'  => $total_time,
        'completed'   => 0,
        'is_schduled' => $request->start_date ? 1 : 0,
       // 'members'     => $request->members ?? [],
        'link_type'   => $request->link_type,
        'meet_link'   => $request->meetinglink
    ]
);


    if ($request->filled('members')) {
        // Remove existing entries if updating existing meeting
        //MeetingMembers::where('meeting_id', new ObjectId($todo->_id))->delete();
        MeetingMembers::where('meeting_id', $todo->_id)->delete();

        foreach ($request->members as $memberId) {
            MeetingMembers::create([
                'meeting_id' => $todo->_id,
                'user_id'    => $memberId,
                'decision'   => 0, // pending by default
            ]);
        }
            
    }





        return redirect()->back()->with('success', 'Meeting created successfully!');
    }

    public function acceptMeeting($id)
{
    $userId = new ObjectId(Auth::id());
    $meetingId = new ObjectId($id);

    $member = MeetingMembers::where('meeting_id', $id)
        ->where('user_id', Auth::id())
        ->first();

    if ($member) {
        $member->update(['decision' => 1]);
        return response()->json(['success' => true, 'message' => 'Meeting accepted.']);
    }

    return response()->json(['success' => false, 'message' => 'Not authorized or not part of meeting.'], 403);
}

public function getmeeting( $id){
    $meeting = Meetings::with(['members.user'])
        ->where('id', $id)
        ->first();

    return response()->json([
        'success' => true,
        'meeting' => $meeting,
        
    ]);
}


public function postpone(Request $request){
        
        $user = Auth::user();
        $remid = $request->postponeid;

        $meeting = Meetings::where('id', $remid)->first();
       
        if($meeting){

            $meeting->is_removed = -2;
            
            $meeting->save();

            return redirect()->back()->with('success', 'Meeting Postponed successfully.');
        }
        return redirect()->back()->with('error', 'Meeting not belonged to user');
        
    }

public function remove(Request $request){
        
        $user = Auth::user();
        $remid = $request->remid;

        $reason = $request->reason;
        $isremove = $request->isremove;

        $meeting = Meetings::where('id', $remid)->first();

       
        if($meeting){
            
            $meeting->is_removed = -1;
            
            $meeting->reason = $reason;
            
            $meeting->save();

            return redirect()->back()->with('success', 'Meeting removed successfully.');
        }


        return redirect()->back()->with('error', 'Meeting not belonged to user');
        
    }

public function rejectMeeting($id)
{
   
    $member = MeetingMembers::where('meeting_id', $id)
        ->where('user_id', Auth::id())
        ->first();

    if ($member) {
        $member->update(['decision' => -1]);
        return response()->json(['success' => true, 'message' => 'Meeting rejected.']);
    }

    return response()->json(['success' => false, 'message' => 'Not authorized or not part of meeting.'], 403);
}

    public function destroy($id)
    {
        $todo = Meetings::findOrFail($id);
        $todo->delete();

        return redirect()->back()->with('success', 'Meeting deleted successfully.');
    }

}