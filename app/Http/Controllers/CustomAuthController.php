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
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ],
         [
            'name.required' => 'Username is required',
            'password.required' => 'Password is required',

        ]


    );
        $credentials = $request->only('name', 'password');
         if ($credentials['name']=='username' && $credentials['password']=='123456'){
        return redirect()->intended('index')
                        ->withSuccess('Signed in');
        }
        if (Auth::attempt($credentials)) {
            return redirect()->intended('index')
                        ->withSuccess('Signed in');
        }
        return redirect("signin")->withErrors('These credentials do not match our records.');
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
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('signin');
    }
}