<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login/login');
    }


    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();
        request() > session()->flash('Logout', 'Anda telah Logout.');
        return redirect('/');
    }


    public function store(Request $request)
    {
        $Credentials = $request->validate([
            'no_member' => ['required'],
            'password' => ['required']
        ]);


        // login with true remember me
        if (Auth::attempt($Credentials, true)) {
            if (auth()->user()->is_member) {
                $request->session()->regenerate();
                $request->session()->flash('Sukses', 'Login berhasil.');
                return redirect()->intended('/Halaman-member');
            }
        }


        return back()->with('Gagal', 'Login Gagal!');
    }
}
