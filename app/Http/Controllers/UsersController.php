<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UsersController extends Controller
{
  public function index()
    {
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
    //  Step 1: Validation
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required',
        'remail' => 'nullable',
        'passw' => 'nullable',
        'rpassw' => 'nullable',
        'cpassw' => 'nullable',
        'phone' => 'nullable',
        'department' => 'nullable|string',
                 'image' => 'nullable',
         ]);
    // Step 2: Handle Image Upload
    $imagePath = null;

    // ensure active defaults true, restrict role to non-admin if provided
    $request->merge(['active' => true]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path('upload/users');
        $fullPath = $destinationPath . '/' . $fileName;

        if (!file_exists($fullPath)) {
            $file->move($destinationPath, $fileName);
        }

        $imagePath = 'upload/users/' . $fileName;
    }

    // Step 3: Extract Permissions
    $permissions = $request->input('permissions', []); // default is empty array if nothing checked
    // It will look like: ['clients' => ['read' => 'on', 'write' => 'on'], 'projects' => ['read' => 'on'], ...]

    // Optional: Convert "on" to true
    foreach ($permissions as $module => &$actions) {
        foreach ($actions as $action => $value) {
            $actions[$action] = true;
        }
    }
       
    // Step 4: Store in database
    $user=User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['passw'] ?? ''),
        'phone' => $validated['phone'] ?? null,
        'department' => $validated['department'] ?? null,
        'image' => $imagePath,
        'active' => true,
        'permissions' => json_encode($permissions),
    ]);
    if($user){
      
    return redirect()->back()->with('success', 'User registered successfully!');
    }
    else{
        return redirect()->back()->with('error', 'User registered failed!!'); 
    }

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
