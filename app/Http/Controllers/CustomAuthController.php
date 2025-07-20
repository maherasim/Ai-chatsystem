<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CustomAuthController extends Controller
{

    public function index()
    {
        
        return view('signin');
    }  
      


public function customLogin(Request $request)
{
    // ✅ Validate input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ], [
        'email.required' => 'Email is required',
        'email.email' => 'Please enter a valid email address',
        'password.required' => 'Password is required',
    ]);

    // ✅ Attempt to log in with credentials
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // ✅ Authentication passed
        $request->session()->regenerate(); // Prevent session fixation
        return redirect()->intended('index')->with('success', 'Signed in');
    }

    // ❌ Authentication failed
    return redirect()->back()
        ->withInput($request->only('email'))
        ->withErrors(['email' => 'These credentials do not match our records.']);
}

    public function registration()
    {
        return view('signup');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required|string|min:5',
            'last_name' => 'required|string|min:5',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required', 'max:10','regex:/^[0-9]{10}$/',
            'user_name' => 'required',
            'password' => 'required|min:6',
        ],
        [
            'name.required' => 'Firstname is required',
            'last_name.required' => 'Lastname is required',
            'email' =>'Email is required',
            'phone_number.required' => 'Phonenumber is required',
            'user_name' => ' Username is required',
            'password.required' => 'Password is required',
        ]

    );
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("index")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'last_name' => $data['last_name'],
        'email' => $data['email'],
        'phone_number' => $data['phone_number'],
        'user_name' => $data['user_name'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('index');
        }
  
        return redirect("signin")->withSuccess('You are not allowed to access');
    }
    

    public function signOut(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/signin');
}


}