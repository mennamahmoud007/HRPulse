<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // عرض صفحة إنشاء حساب
    public function showRegister()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    // تنفيذ إنشاء الحساب
    public function register(Request $request)
    {
        $validation = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'role_id'          => 'required|exists:roles,id',
        ]);

        User::create([
            'name'     => $validation['name'],
            'email'    => $validation['email'],
            'password' => Hash::make($validation['password']),
            'role_id'  => $validation['role_id'],
        ]);
         $role = Role::find($validation['role_id']);

            if ($role->name === 'employee') {
                Employee::create([
                    'user_id' => $user->id,
                    'status' => 'active',
                ]);
            }

        return redirect()
            ->route('login')
            ->with('success', 'Registration successful. Please login.');
    }

    // عرض صفحة تسجيل الدخول
    public function showLogin()
    {
        return view('auth.login');
    }

    // تنفيذ عملية تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            return match ($user->role->name) {
                'employee' => redirect()->route('employee.dashboard'),
                'hr'       => redirect()->route('hr.dashboard'),
                'manager'  => redirect()->route('manager.dashboard'),
                'admin'    => redirect()->route('admin.dashboard'),
                default    => abort(403),
            };
        }

        return back()
            ->withErrors([
                'email' => 'The email or password is incorrect.',
            ])
            ->onlyInput('email');
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}