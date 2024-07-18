<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function index()
    {
        return view('login/admin');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();
        request() > session()->flash('Logout', 'Anda telah Logout.');
        return redirect('/admin');
    }


    public function store(Request $request)
    {
        $Credentials = $request->validate([
            'nama' => ['required'],
            'password' => ['required']
        ]);

        if ($ValidateData['is_admin'] = true) {
            // login with true remember me
            if (Auth::attempt($Credentials, true)) {
                $request->session()->regenerate();
                $request->session()->flash('Sukses', 'Login berhasil.');
                return redirect()->intended('/dashboard');
            }
        }

        return back()->with('Gagal', 'Login Gagal!');
    }
}
