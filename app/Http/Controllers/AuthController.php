<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function index()
    {
        if (!Auth::check()) return view('login');
        else return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $pwd = $request->password;

        if (Auth::attempt(['username' => $username, 'password' => $pwd])) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('alert', 'Terjadi kesalahan dalam login. Cek kembali Username dan Password Anda');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->back();
    }
}
