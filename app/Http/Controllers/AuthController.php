<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function showregister(){
        return view('auth.register');
    }

    public function register(Request $request){

    $validation=$request->validate([
        'name'=>'required|string|max:255',
        'email'=>'required|email|unique:users,email',
        'password'=>'required|min:8',
        'confirm_password'=>'same:password|required'

    ]);

    $employeeRole=Role::where('name','employee')->first();

    User::create([
    'name'=>$validation['name'],
    'password'=>Hash::make( $validation['password']),
    'email'=>$validation['email'],
    'role_id'=>$employeeRole->id,
    ]);

   return redirect()->route('login')->with('success', 'Registration successful. Please login.');

    }


    public function showLogin(){
        return view('auth.login');
    }


    public function login(Request $request){

   $credentials=$request->validate([
    'email'=>'required|email',
    'password'=>'required'
   ]);

  if(Auth::attempt($credentials)){
    $request->session()->regenerate();
    return redirect()->route('dashboard');

  }
  return back()->withErrors(['email'=>'The email or password is incorrect.'])->onlyInput('email');


    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');

    }
}
