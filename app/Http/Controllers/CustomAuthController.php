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
    $credentials = $request->only('_id', 'email', 'password');

    
    if (!Auth::attempt($credentials)) {
        return response()->json(['success' => false, 'message' => 'Invalid credentials']);
    }

    $user = Auth::user();

    //Check if user already completed profile & accepted policy
    if ($user->policy_accepted && $user->phone && $user->image && $user->card_image) {
        return response()->json(['success' => true, 'redirect' => route('home')]);
    }


    
    return response()->json([
        'success' => false,
        'require_info' => true,
        'user' => $user
    ]);
}

public function completeprofile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'phone' => 'required',
        'image' => 'required|image',
        'cardImgInput' => 'required|image',
    ]);

    if ($request->hasFile('image')) {
        $user->profile_image = $request->file('image')->store('profiles', 'public');
    }

    if ($request->hasFile('cardImgInput')) {
        $user->card_image = $request->file('cardImgInput')->store('cards', 'public');
    }

    $user->phone = $request->phone;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->country = $request->country;
    $user->policy_accepted = true;
    $user->agreement_accepted = true;
    $user->save();

    return redirect("home")->withSuccess('You have signed-in');

    //return response()->json(['success' => true, 'redirect' => route('home')]);
}


public function customLogin_old(Request $request)
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
        return redirect()->intended('home')->with('success', 'Signed in');
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
    return redirect('/');
}


}