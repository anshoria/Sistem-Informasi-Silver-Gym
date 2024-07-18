<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;

class Forgot_Password_Controller extends Controller
{
    public function index()
    {
        return view('login/forgot-password');
    }
    public function forgot_password(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email:dns']
        ]);


        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    // reset password
    public function reset_password($token)
    {
        return view('login/reset-password', compact('token'));
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        $user = User::where('email', $request->email)->first();
        if ($user->is_admin) {
            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login-admin')->with('status', __($status))
                : back()->with(['gagal' => [__($status)]]);
        } else {
            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->with(['gagal' => [__($status)]]);
        }

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->with(['gagal' => [__($status)]]);
    }
}
