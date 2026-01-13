<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Team;
use App\Models\Group;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\Task;
use Carbon\Carbon;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use App\Models\UserAttachment;
use App\Mail\UserWelcomeMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use MongoDB\BSON\ObjectId;

class UsersController extends Controller
{
  public function index()
    {

        //all users other than superadmin
     $users = User::where('email', '!=', 'admin@gmail.com')->get();

        // Get all teams and groups once (optimization)
        try {
            $allTeams = Team::all();
        } catch (\Exception $e) {
            \Log::error('Error fetching teams: ' . $e->getMessage());
            $allTeams = collect([]);
        }
        
        try {
            $allGroups = Group::all();
        } catch (\Exception $e) {
            \Log::error('Error fetching groups: ' . $e->getMessage());
            $allGroups = collect([]);
        }
        
        // Fetch team names for each user
        $users = $users->map(function ($user) use ($allTeams, $allGroups) {
            try {
            $teamNames = [];
            $userId = (string) ($user->_id ?? $user->id);
            $userUserId = $user->user_id ?? null;
            
            // Use pre-fetched teams
            $teams = $allTeams;
            
            foreach ($teams as $team) {
                $taskDevelopers = $team->task_developers ?? [];
                
                // Handle different formats of task_developers
                if (is_string($taskDevelopers)) {
                    $taskDevelopers = json_decode($taskDevelopers, true) ?? [];
                }
                
                if (!is_array($taskDevelopers)) {
                    continue;
                }
                
                // Check if user ID is in task_developers
                // task_developers can be: [userId => [names...]] or flat array of IDs/names
                $found = false;
                
                foreach ($taskDevelopers as $key => $value) {
                    // Check if key matches user ID (for format: {userId: [names...]})
                    $keyStr = (string) $key;
                    if ($keyStr === $userId || $keyStr === $userUserId) {
                        $found = true;
                        break;
                    }
                    
                    if (is_array($value)) {
                        // Format: {userId: [names...]} - check values in the array
                        foreach ($value as $val) {
                            $valStr = (string) $val;
                            if ($valStr === $userId || $valStr === $userUserId || $valStr === $user->name) {
                                $found = true;
                                break 2;
                            }
                        }
                    } else {
                        // Flat array format - check the value directly
                        $valStr = (string) $value;
                        if ($valStr === $userId || $valStr === $userUserId || $valStr === $user->name) {
                            $found = true;
                            break;
                        }
                    }
                }
                
                if ($found) {
                    if (!empty($team->title)) {
                        $teamNames[] = $team->title;
                    }
                    
                    // Count tickets from team
                    $teamTickets = $team->tickets ?? [];
                    if (is_string($teamTickets)) {
                        $teamTickets = json_decode($teamTickets, true) ?? [];
                    }
                    if (is_array($teamTickets)) {
                        if (!isset($user->total_tickets)) {
                            $user->total_tickets = 0;
                        }
                        $user->total_tickets += count($teamTickets);
                    }
                    
                    // Count tasks from team
                    $teamTasks = $team->tasks ?? [];
                    if (is_string($teamTasks)) {
                        $teamTasks = json_decode($teamTasks, true) ?? [];
                    }
                    if (is_array($teamTasks)) {
                        if (!isset($user->total_tasks)) {
                            $user->total_tasks = 0;
                        }
                        $user->total_tasks += count($teamTasks);
                    }
                    
                    // Get project_id from team and fetch project data (logo_path)
                    if (!empty($team->project_id)) {
                        try {
                            $projectId = (string) $team->project_id;
                            $project = Project::find($projectId);
                            if (!$project) {
                                // Try with ObjectId
                                try {
                                    $project = Project::find(new ObjectId($projectId));
                                } catch (\Exception $e) {
                                    // Project not found
                                }
                            }
                            
                            if ($project) {
                                // Fix: Get existing array, modify it, then assign back
                                // This avoids "Indirect modification of overloaded property" error
                                $existingProjects = $user->project_images ?? [];
                                if (!is_array($existingProjects)) {
                                    $existingProjects = [];
                                }
                                
                                // Store project logo_path and title
                                $projectData = [
                                    'logo_path' => $project->logo_path ?? null,
                                    'title' => $project->title ?? null,
                                    'status' => $project->status ?? null,
                                ];
                                
                                // Only add if logo_path exists and not already added
                                if (!empty($projectData['logo_path'])) {
                                    $alreadyExists = false;
                                    foreach ($existingProjects as $existing) {
                                        if (isset($existing['logo_path']) && $existing['logo_path'] === $projectData['logo_path']) {
                                            $alreadyExists = true;
                                            break;
                                        }
                                    }
                                    if (!$alreadyExists) {
                                        $existingProjects[] = $projectData;
                                    }
                                }
                                $user->project_images = $existingProjects;
                            }
                        } catch (\Exception $e) {
                            // Skip if error fetching project
                        }
                    }
                }
            }
            
            // Attach team names to user object
            $user->team_names = array_unique($teamNames);
            $user->team = !empty($teamNames) ? implode(', ', array_unique($teamNames)) : '';
            
            // Ensure project_images is an array
            if (!isset($user->project_images) || !is_array($user->project_images)) {
                $user->project_images = [];
            }
            
            // Ensure ticket and task counts are set
            if (!isset($user->total_tickets)) {
                $user->total_tickets = 0;
            }
            if (!isset($user->total_tasks)) {
                $user->total_tasks = 0;
            }
            
            // Fetch group names for each user (check if user ID is in group's member_ids)
            $groupNames = [];
            // Use pre-fetched groups
            $groups = $allGroups;
            
            foreach ($groups as $group) {
                $memberIds = array_map('strval', $group->member_ids ?? []);
                // Check if user ID is in member_ids or is admin
                if (in_array($userId, $memberIds) || (string)$group->admin_id === $userId) {
                    if (!empty($group->name)) {
                        $groupNames[] = $group->name;
                    }
                }
            }
            
            // Attach group names to user object
            $user->group_names = array_unique($groupNames);
            $user->group = !empty($groupNames) ? implode(', ', array_unique($groupNames)) : '';
            
            return $user;
            } catch (\Exception $e) {
                \Log::error('Error processing user ' . ($user->_id ?? $user->id) . ': ' . $e->getMessage());
                // Set defaults if error occurs
                $user->team_names = [];
                $user->team = '';
                $user->group_names = [];
                $user->group = '';
                return $user;
            }
        });

    $headers = Setting::all();
    $setting = Setting::first();
      
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

        // Dynamic counts for dashboard cards
        $membersCount = $totalUsers; // non-admin users as defined above
        $developersCount = User::where('type', 'developer')->count();
        $employeesCount = User::where('type', 'employee')->count();
        $adminsCount = User::where(function($q){
            $q->where('is_admin', true)->orWhere('type', 'subadmin');
        })->count();

        // Format groups for notification sidebar
        try {
            $groups = $allGroups->map(function($group) use ($allTeams) {
                // Load team separately
                $team = null;
                if ($group->team_id) {
                    try {
                        $team = $allTeams->firstWhere('_id', $group->team_id);
                    } catch (\Exception $e) {
                        // Team not found
                    }
                }
                
                // Handle member_ids - could be array or JSON string
                $memberIds = $group->member_ids ?? [];
                if (is_string($memberIds)) {
                    $decoded = json_decode($memberIds, true);
                    $memberIds = is_array($decoded) ? $decoded : [];
                }
                $memberCount = count($memberIds) + 1; // +1 for admin
                
                return [
                    'id' => (string) $group->_id,
                    'name' => $group->name ?? 'Untitled Group',
                    'team_id' => $group->team_id,
                    'team_photo' => $team && $team->thumb_path 
                        ? asset('storage/' . ltrim($team->thumb_path, '/'))
                        : asset('build/img/profile.svg'),
                    'team_banner' => $team && $team->banner_path 
                        ? asset('storage/' . ltrim($team->banner_path, '/'))
                        : asset('build/img/bgractangle.svg'),
                    'member_count' => $memberCount,
                ];
            })->values();
        } catch (\Exception $e) {
            \Log::error('Error formatting groups in UsersController: ' . $e->getMessage());
            $groups = collect([]);
        }
        
        return view('Chats.users', compact(
            'totalUsers',
            'activeUsers',
            'inactiveUsers',
            'newJoinersToday',
            'users',
            'membersCount',
            'developersCount',
            'employeesCount',
            'adminsCount',
            'headers',
            'setting',
            'groups'
        ));
    }


    public function updoc(Request $request){
        $userid = $request->user;
        $user = User::where("user_id", $userid)->first();

        $file = $request->file('attachment');

        // Store file in /storage/app/public/user_attachments
        $filePath = $file->store('user_attachments', 'public');

        // Create attachment record
        UserAttachment::create([
            'user_id'     => $user->_id ?? $user->id, // use MongoDB _id if exists
            'file_name'   => $file->getClientOriginalName(),
            'file_path'   => $filePath,
            'file_type'   => $file->getClientMimeType(),
            'uploaded_by' => auth()->id(),
            'size'        => $file->getSize(),
        ]);

        return back()->with('error', 'Error: File not uploaded. ');

    }

    public function destroyattachement($id){
        $attachment = UserAttachment::find($id);
        if (!$attachment) {
            return response()->json(['success' => false, 'message' => 'Not found']);
        }

        // Delete file from storage
        \Storage::disk('public')->delete($attachment->file_path);

        // Delete record
        $attachment->delete();

        return response()->json(['success' => true]);
    }

  public function store(Request $request)
{
    //
    // 
    
    $validated = $request->validate([
        'name'      => 'required|string|max:255',
        'title'     => 'nullable|string|max:255',
        'email'     => 'required|email|unique:users,email|same:confirm_email',
        'confirm_email' => 'nullable',
        'passw'     => 'required|min:6|same:rpassw',  // password must match confirm
        'rpassw'    => 'nullable',
        'user_description' => 'nullable|string',
        'gender'    => 'nullable|string',
        'type'      => 'required',
      //  'phone'     => 'nullable|string',
       // 'department'=> 'nullable|string',
        'image'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'banner'    => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4096',
    ]);
    // Step 2: Handle Image Upload
    $imagePath = null;
    $banPath = null;

    // ensure active defaults true, restrict role to non-admin if provided
    $request->merge(['active' => true]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName =  'profile_' . uniqid() . '.' . $file->getClientOriginalName();
        $destinationPath = public_path('upload/users');
        $fullPath = $destinationPath . '/' . $fileName;

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }
        if (!file_exists($fullPath)) {
            $file->move($destinationPath, $fileName);
        }

        $imagePath = 'upload/users/' . $fileName;
    }

    if ($request->hasFile('banner')) {
        $file = $request->file('banner');
        $fileName = 'banner_' . uniqid() . '.' . $file->getClientOriginalName();
        $destinationPath = public_path('upload/users/banner');
        $fullPath = $destinationPath . '/' . $fileName;

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }
        if (!file_exists($fullPath)) {
            $file->move($destinationPath, $fileName);
        }

        $banPath = 'upload/users/banner/' . $fileName;
    }

    $permissions = $request->input('permissions', []);
    foreach ($permissions as $module => &$actions) {
        foreach ($actions as $action => $value) {
            $actions[$action] = true; // turn "on" into true
        }
    }
    
    // Step 3: Generate role-based user_id (sub_1000/dev_1000/emp_1000 ...)
    $type = $validated['type'];
    $userId = $this->generateRoleBasedUserId($type);

    // Step 4: Store in database
    $rawPassword = $validated['passw'] ?? '';
    $user=User::create([
        'name' => $validated['name'],
        'title' => $validated['title'] ?? null,
        'email' => $validated['email'],
        'password' => Hash::make($rawPassword),
        'phone' => $validated['phone'] ?? null,
        'department' => $validated['department'] ?? null,
        'image' => $imagePath,
        'banner' => $banPath,
        'user_description' => $validated['user_description'] ?? null,
        'gender' => $validated['gender'] ?? null,
        'type'   => $type ?? null,
        'user_id' => $userId,
        'active' => true,
        'permissions' => $permissions,
    ]);
    if($user){
      // Step 5: Send role-specific welcome email
      try {
        $this->sendWelcomeEmail($user, $rawPassword);
      } catch (\Throwable $e) {
        // Silently ignore email errors to not block user creation
      }

      return redirect()->back()->with('success', 'User registered successfully!');
    }
    else{
        return redirect()->back()->with('error', 'User registered failed!!'); 
    }

}

    /**
     * Check if email exists (AJAX).
     */
    public function checkEmail(Request $request)
    {
        $email = (string) $request->query('email', '');
        $ignoreId = $request->query('ignore_id');
        $exists = false;
        if ($email !== '') {
            if (!empty($ignoreId)) {
                try {
                    $objectId = new ObjectId($ignoreId);
                    $exists = User::where('email', $email)
                        ->where('_id', '!=', $objectId)
                        ->exists();
                } catch (\Throwable $e) {
                    $exists = User::where('email', $email)
                        ->where('_id', '!=', $ignoreId)
                        ->exists();
                }
            } else {
                $exists = User::where('email', $email)->exists();
            }
        }
        return response()->json(['exists' => $exists]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Custom email validation for MongoDB
        $emailRules = [
            'required',
            'email',
            function ($attribute, $value, $fail) use ($id, $user) {
                // Allow keeping the same email while editing
                if ($user && $user->email === $value) {
                    return;
                }
                try {
                    // Convert string ID to ObjectId for proper MongoDB comparison
                    $objectId = new ObjectId($id);
                    $existingUser = User::where('email', $value)
                        ->where('_id', '!=', $objectId)
                        ->first();
                    if ($existingUser) {
                        $fail('The email has already been taken.');
                    }
                } catch (\Exception $e) {
                    // If ObjectId conversion fails, fall back to string comparison
                    $existingUser = User::where('email', $value)
                        ->where('_id', '!=', $id)
                        ->first();
                    if ($existingUser) {
                        $fail('The email has already been taken.');
                    }
                }
            }
        ];

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'title'     => 'nullable|string|max:255',
            'email'     => $emailRules,
            'user_description' => 'nullable|string',
            'gender'    => 'nullable|string',
            'type'      => 'required',
            'passw'     => 'nullable|min:6|same:rpassw',
            'rpassw'    => 'nullable',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'banner'    => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4096',
        ]);

        // Images
        $imagePath = $user->image;
        $banPath = $user->banner;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'profile_' . uniqid() . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/users');
            if (!\Illuminate\Support\Facades\File::exists($destinationPath)) {
                \Illuminate\Support\Facades\File::makeDirectory($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $fileName);
            $imagePath = 'upload/users/' . $fileName;
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $fileName = 'banner_' . uniqid() . '.' . $file->getClientOriginalName();
            $destinationPath = public_path('upload/users/banner');
            if (!\Illuminate\Support\Facades\File::exists($destinationPath)) {
                \Illuminate\Support\Facades\File::makeDirectory($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $fileName);
            $banPath = 'upload/users/banner/' . $fileName;
        }

        $permissions = $request->input('permissions', []);
        foreach ($permissions as $module => &$actions) {
            foreach ($actions as $action => $value) {
                $actions[$action] = true;
            }
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->title = $validated['title'] ?? $user->title;
        $user->user_description = $validated['user_description'] ?? $user->user_description;
        $user->gender = $validated['gender'] ?? $user->gender;
        $user->type = $validated['type'] ?? $user->type;
        $user->image = $imagePath;
        $user->banner = $banPath;
        if (!empty($validated['passw'])) {
            $user->password = \Illuminate\Support\Facades\Hash::make($validated['passw']);
        }
        if (!empty($permissions)) {
            $user->permissions = $permissions;
        }
        $user->save();

        return redirect()->back()->with('success', 'User updated successfully!');
    }

  /**
   * Generate the next role-based user_id.
   * subadmin => sub_1000+n, developer => dev_1000+n, employee => emp_1000+n
   */
  private function generateRoleBasedUserId($type)
  {
    $map = [
      'subadmin' => 'sub',
      'developer' => 'dev',
      'employee' => 'emp',
    ];
    $prefix = $map[$type] ?? 'emp';

    $existingIds = User::where('type', $type)
      ->whereNotNull('user_id')
      ->pluck('user_id')
      ->toArray();

    $maxNumber = 999; // so first becomes 1000
    foreach ($existingIds as $eid) {
      if (is_string($eid) && strpos($eid, $prefix . '_') === 0) {
        $numPart = substr($eid, strlen($prefix) + 1);
        if (ctype_digit($numPart)) {
          $num = (int) $numPart;
          if ($num > $maxNumber) {
            $maxNumber = $num;
          }
        }
      }
    }

    $next = $maxNumber + 1;
    return $prefix . '_' . $next;
  }

  /**
   * Send role-specific welcome email to the newly created user.
   */
  private function sendWelcomeEmail(User $user, string $rawPassword)
  {
    Mail::to($user->email)->send(new UserWelcomeMail($user, $rawPassword));
  }


public function destroy($id){
     $user=User::find($id);
     if($user){
         $user->delete();
        return redirect()->back()->with('success','User deleted Successfully');
     }
     else{
        return redirect()->back()->with('error','User deleted Successfully');
     }
}

    /**
     * Get projects for a user based on teams where user is in task_developers
     */
    public function getUserProjects($userId)
    {
        try {
            $user = User::where('user_id', $userId)->orWhere('_id', $userId)->first();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }

            $userIdStr = (string) ($user->_id ?? $user->id);
            $userUserId = $user->user_id ?? null;
            
            // Find teams where user is in task_developers
            $teams = Team::all();
            $projectIds = [];
            $totalTickets = 0;
            $totalTasks = 0;
            
            foreach ($teams as $team) {
                $taskDevelopers = $team->task_developers ?? [];
                
                // Handle different formats of task_developers
                if (is_string($taskDevelopers)) {
                    $taskDevelopers = json_decode($taskDevelopers, true) ?? [];
                }
                
                if (!is_array($taskDevelopers)) {
                    continue;
                }
                
                // Check if user ID is in task_developers (format: {"userId": ["name"]})
                $found = false;
                foreach ($taskDevelopers as $key => $value) {
                    $keyStr = (string) $key;
                    if ($keyStr === $userIdStr || $keyStr === $userUserId) {
                        $found = true;
                        break;
                    }
                    
                    if (is_array($value)) {
                        foreach ($value as $val) {
                            $valStr = (string) $val;
                            if ($valStr === $userIdStr || $valStr === $userUserId || $valStr === $user->name) {
                                $found = true;
                                break 2;
                            }
                        }
                    } else {
                        $valStr = (string) $value;
                        if ($valStr === $userIdStr || $valStr === $userUserId || $valStr === $user->name) {
                            $found = true;
                            break;
                        }
                    }
                }
                
                // If user found in team, get project_id and count tickets/tasks
                if ($found) {
                    if (!empty($team->project_id)) {
                        $projectIds[] = (string) $team->project_id;
                    }
                    
                    // Count tickets from team
                    $teamTickets = $team->tickets ?? [];
                    if (is_string($teamTickets)) {
                        $teamTickets = json_decode($teamTickets, true) ?? [];
                    }
                    if (is_array($teamTickets)) {
                        $totalTickets += count($teamTickets);
                    }
                    
                    // Count tasks from team
                    $teamTasks = $team->tasks ?? [];
                    if (is_string($teamTasks)) {
                        $teamTasks = json_decode($teamTasks, true) ?? [];
                    }
                    if (is_array($teamTasks)) {
                        $totalTasks += count($teamTasks);
                    }
                }
            }
            
            $projectIds = array_unique($projectIds);
            
            if (empty($projectIds)) {
                return response()->json([
                    'success' => true, 
                    'projects' => [],
                    'tickets_count' => $totalTickets,
                    'tasks_count' => $totalTasks
                ]);
            }
            
            // Fetch projects - handle both string and ObjectId formats
            $projects = collect();
            foreach ($projectIds as $pid) {
                try {
                    $project = Project::find($pid);
                    if (!$project) {
                        // Try with ObjectId
                        try {
                            $project = Project::find(new ObjectId($pid));
                        } catch (\Exception $e) {
                            // Skip if not found
                            continue;
                        }
                    }
                    if ($project) {
                        $projects->push($project);
                    }
                } catch (\Exception $e) {
                    // Skip if error
                    continue;
                }
            }
            
            // Check if projects were found
            if ($projects->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'projects' => [],
                    'tickets_count' => $totalTickets,
                    'tasks_count' => $totalTasks,
                    'message' => 'No projects found for this user'
                ]);
            }
            
            // Format projects with tickets and tasks
            $formattedProjects = $projects->map(function ($project) use ($userIdStr, $userUserId, $user) {
                // Get tickets for this project
                $tickets = Ticket::where('project_id', (string)($project->_id ?? $project->id))->get();
                
                // Get tasks for this project
                $tasks = Task::where('project_id', (string)($project->_id ?? $project->id))->get();
                
                // Calculate stats
                $totalTickets = $tickets->count();
                $totalTasks = $tasks->count();
                $completedTasks = $tasks->where('status', 'completed')->count();
                $inProgressTickets = $tickets->where('status', 'in_progress')->count();
                
                // Task status breakdown
                $taskStatusBreakdown = [
                    'new' => $tasks->whereIn('status', ['new', 'new_task', 'newtask'])->count(),
                    'in_progress' => $tasks->whereIn('status', ['in_progress', 'progress', 'inprogress'])->count(),
                    'in_hold' => $tasks->whereIn('status', ['in_hold', 'hold', 'inhold', 'on_hold'])->count(),
                    'in_check' => $tasks->whereIn('status', ['in_checked', 'checked', 'inchecked'])->count(),
                    'delayed' => $tasks->whereIn('status', ['delayed', 'in_delayed'])->count(),
                    'rejected' => $tasks->whereIn('status', ['rejected', 'in_rejected'])->count(),
                    'completed' => $tasks->where('status', 'completed')->count(),
                ];
                
                // Get sections
                $sections = $project->sections ?? [];
                $sectionStats = [];
                foreach ($sections as $section) {
                    $sectionName = $section['name'] ?? 'Unknown';
                    $sectionTasks = $tasks->filter(function ($task) use ($sectionName) {
                        return ($task->section_name ?? '') === $sectionName;
                    });
                    $sectionCompleted = $sectionTasks->where('status', 'completed')->count();
                    $sectionTotal = $sectionTasks->count();
                    $sectionProgress = $sectionTotal > 0 ? round(($sectionCompleted / $sectionTotal) * 100) : 0;
                    
                    $sectionStats[] = [
                        'name' => $sectionName,
                        'progress' => $sectionProgress,
                        'total' => $sectionTotal,
                        'completed' => $sectionCompleted,
                    ];
                }
                
                // Get project manager
                $pm = null;
                if (!empty($project->user_id)) {
                    $pm = User::find($project->user_id);
                }
                
                // Get teams for this project with full details
                $teamsForProject = Team::where('project_id', (string)($project->_id ?? $project->id))->get();
                $teamsData = [];
                $allDevelopersMap = []; // Use map to avoid duplicates
                
                foreach ($teamsForProject as $team) {
                    $teamTaskDevelopers = $team->task_developers ?? [];
                    if (is_string($teamTaskDevelopers)) {
                        $teamTaskDevelopers = json_decode($teamTaskDevelopers, true) ?? [];
                    }
                    
                    // Get team developers
                    $teamDevelopers = [];
                    foreach ($teamTaskDevelopers as $devId => $devNames) {
                        $devIdStr = (string) $devId;
                        if (is_array($devNames)) {
                            foreach ($devNames as $devName) {
                                $dev = User::where('name', $devName)->orWhere('_id', $devIdStr)->first();
                                if ($dev) {
                                    $devKey = (string)($dev->_id ?? $dev->id);
                                    if (!isset($allDevelopersMap[$devKey])) {
                                        $allDevelopersMap[$devKey] = [
                                            'id' => $devKey,
                                            'name' => $dev->name,
                                            'avatar' => $dev->image ? asset($dev->image) : asset('build/img/profileuser.svg'),
                                        ];
                                    }
                                    if (!in_array($devKey, array_column($teamDevelopers, 'id'))) {
                                        $teamDevelopers[] = $allDevelopersMap[$devKey];
                                    }
                                }
                            }
                        } else {
                            $dev = User::where('name', $devNames)->orWhere('_id', $devIdStr)->first();
                            if ($dev) {
                                $devKey = (string)($dev->_id ?? $dev->id);
                                if (!isset($allDevelopersMap[$devKey])) {
                                    $allDevelopersMap[$devKey] = [
                                        'id' => $devKey,
                                        'name' => $dev->name,
                                        'avatar' => $dev->image ? asset($dev->image) : asset('build/img/profileuser.svg'),
                                    ];
                                }
                                if (!in_array($devKey, array_column($teamDevelopers, 'id'))) {
                                    $teamDevelopers[] = $allDevelopersMap[$devKey];
                                }
                            }
                        }
                    }
                    
                    // Get team PM
                    $teamPm = null;
                    if (!empty($team->pm_id)) {
                        $teamPm = User::find($team->pm_id);
                    }
                    
                    // Get tasks for this team
                    $teamTaskIds = $team->tasks ?? [];
                    $teamTasks = [];
                    if (is_array($teamTaskIds) && !empty($teamTaskIds)) {
                        $teamTasks = Task::whereIn('_id', $teamTaskIds)->get()->map(function ($task) {
                            $assignedDev = null;
                            if ($task->assigned_to) {
                                $dev = User::find($task->assigned_to);
                                if ($dev) {
                                    $assignedDev = [
                                        'id' => (string)($dev->_id ?? $dev->id),
                                        'name' => $dev->name,
                                        'avatar' => $dev->image ? asset($dev->image) : asset('build/img/profileuser.svg'),
                                    ];
                                }
                            }
                            
                            return [
                                'id' => (string)($task->_id ?? $task->id),
                                'title' => $task->title ?? 'Task',
                                'status' => $task->status ?? 'new',
                                'assigned_developer' => $assignedDev,
                                'start_date' => $task->start_date ? $task->start_date->format('d.m.Y') : null,
                                'end_date' => $task->end_date ? $task->end_date->format('d.m.Y') : null,
                            ];
                        })->toArray();
                    }
                    
                    $teamsData[] = [
                        'id' => (string)($team->_id ?? $team->id),
                        'title' => $team->title ?? 'Team',
                        'banner_url' => $team->banner_path ? asset('storage/' . $team->banner_path) : null,
                        'thumb_url' => $team->thumb_path ? asset('storage/' . $team->thumb_path) : null,
                        'timeline_color' => $team->timeline_color ?? null,
                        'pm' => $teamPm ? [
                            'id' => (string)($teamPm->_id ?? $teamPm->id),
                            'name' => $teamPm->name,
                            'avatar' => $teamPm->image ? asset($teamPm->image) : asset('build/img/profileuser.svg'),
                        ] : null,
                        'developers' => $teamDevelopers,
                        'tasks' => $teamTasks,
                        'total_tasks' => count($teamTasks),
                    ];
                }
                
                // Convert developers map to array (all unique developers)
                $allDevelopers = array_values($allDevelopersMap);
                
                // Calculate days left
                $daysLeft = 0;
                if ($project->end_date) {
                    $endDate = Carbon::parse($project->end_date);
                    $today = Carbon::today();
                    $daysLeft = max(0, $today->diffInDays($endDate, false));
                }
                
                return [
                    'id' => (string)($project->_id ?? $project->id),
                    'title' => $project->title ?? 'Project',
                    'code' => $project->code ?? '',
                    'progress_percent' => $project->progress_percent ?? 0,
                    'status' => $project->status ?? 'new',
                    'priority' => $project->priority ?? 'low',
                    'start_date' => $project->start_date ? $project->start_date->format('d.m.Y') : null,
                    'end_date' => $project->end_date ? $project->end_date->format('d.m.Y') : null,
                    'logo_url' => $project->logo_path ? asset('storage/' . $project->logo_path) : asset('build/img/yekbon.svg'),
                    'total_tickets' => $totalTickets,
                    'in_progress_tickets' => $inProgressTickets,
                    'total_tasks' => $totalTasks,
                    'completed_tasks' => $completedTasks,
                    'days_left' => $daysLeft,
                    'sections' => $sectionStats,
                    'project_manager' => $pm ? [
                        'id' => (string)($pm->_id ?? $pm->id),
                        'name' => $pm->name,
                        'avatar' => $pm->image ? asset($pm->image) : asset('build/img/profileuser.svg'),
                    ] : null,
                    'developers' => $allDevelopers, // All developers, not limited
                    'teams' => $teamsData, // All teams with full details
                    'task_status_breakdown' => $taskStatusBreakdown,
                    'tickets_count' => $totalTickets,
                    'tasks_count' => $totalTasks,
                ];
            });
            
            // Calculate aggregated stats across all projects
            $allTickets = Ticket::whereIn('project_id', $projectIds)->get();
            $allTasks = Task::whereIn('project_id', $projectIds)->get();
            
            // Task status counts
            $newTasksCount = $allTasks->whereIn('status', ['new', 'new_task', 'newtask'])->count();
            $totalTasksCount = $allTasks->count();
            $progressTasksCount = $allTasks->whereIn('status', ['in_progress', 'progress', 'inprogress'])->count();
            $inHoldTasksCount = $allTasks->whereIn('status', ['in_hold', 'hold', 'inhold', 'on_hold'])->count();
            $inCheckTasksCount = $allTasks->whereIn('status', ['in_checked', 'checked', 'inchecked'])->count();
            $delayedTasksCount = $allTasks->whereIn('status', ['delayed', 'in_delayed'])->count();
            $rejectedTasksCount = $allTasks->whereIn('status', ['rejected', 'in_rejected'])->count();
            
            // Project summary (first 2 projects for display)
            $projectSummary = $formattedProjects->take(2)->map(function ($project) {
                return [
                    'id' => $project['id'],
                    'title' => $project['title'],
                    'logo_url' => $project['logo_url'],
                    'tickets_count' => $project['total_tickets'],
                    'tasks_count' => $project['total_tasks'],
                ];
            });
            
            return response()->json([
                'success' => true,
                'projects' => $formattedProjects->values()->all(),
                'summary' => [
                    'total_projects' => $formattedProjects->count(),
                    'project_summary' => $projectSummary->values()->all(),
                    'task_stats' => [
                        'new_tasks' => $newTasksCount,
                        'total_tasks' => $totalTasksCount,
                        'progress_tasks' => $progressTasksCount,
                        'in_hold_tasks' => $inHoldTasksCount,
                        'in_check_tasks' => $inCheckTasksCount,
                        'delayed_tasks' => $delayedTasksCount,
                        'rejected_tasks' => $rejectedTasksCount,
                    ],
                ],
                'tickets_count' => $totalTickets,
                'tasks_count' => $totalTasks,
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to get user projects', [
                'error' => $e->getMessage(),
                'user_id' => $userId,
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to load projects',
            ], 500);
        }
    }
}
