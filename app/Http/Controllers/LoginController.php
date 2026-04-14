<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // HALAMAN LOGIN
    public function index()
    {
        return view('admin.login');
    }

    // PROSES LOGIN
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}