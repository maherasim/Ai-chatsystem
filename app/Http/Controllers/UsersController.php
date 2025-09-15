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
    
    $validated = $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|unique:users,email|same:confirm_email',
        'confirm_email' => 'required',
        'passw'     => 'required|min:6|same:rpassw',  // password must match confirm
        'rpassw'    => 'required',
        'gender'    => 'nullable|string',
        'type'      => 'required',
      //  'phone'     => 'nullable|string',
       // 'department'=> 'nullable|string',
        'image'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
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
       
    // Step 4: Store in database
    $user=User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['passw'] ?? ''),
        'phone' => $validated['phone'] ?? null,
        'department' => $validated['department'] ?? null,
        'image' => $imagePath,
        'banner' => $banPath,
        'gender' => $validated['gender'] ?? null,
        'type'   => $validated['type'] ?? null,
        'active' => true,
        'permissions' => $permissions,
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
