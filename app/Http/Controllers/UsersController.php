<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersController extends Controller
{
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
// dd($validated );
    // Step 2: Handle Image Upload
    $imagePath = null;

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
        'password' => Hash::make($validated['passw']),
        'phone' => $validated['phone'],
        'department' => $validated['department'],
        'image' => $imagePath,
        'active'=>true,
        'permissions' => json_encode($permissions), // make sure 'permissions' is fillable in User model
    ]);
      dd($request->all());
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
