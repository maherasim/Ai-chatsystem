<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserWelcomeMail;
use Illuminate\Support\Facades\File;
use MongoDB\BSON\ObjectId;

class UsersController extends Controller
{
  public function index()
    {

        //all users other than superadmin
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
    //
    // 
    
    $validated = $request->validate([
        'name'      => 'required|string|max:255',
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
            $query = User::where('email', $email);
            if (!empty($ignoreId)) {
                $query->where('_id', '!=', $ignoreId);
            }
            $exists = $query->exists();
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
            function ($attribute, $value, $fail) use ($id) {
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
        return redirect()->back()->with('success','User deleted Successfull');
     }
     else{
        return redirect()->back()->with('error','User deleted Successfull');
     }
}

}
