<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MemberBaru;

class RegisterController extends Controller
{
    public function index()
    {
        return view('login/register', [
            'Kategori' => Kategori::where('nama', '!=', 'Non Member')->get()
        ]);
    }
    public function store(Request $request)
    {
        $ValidateData = $request->validate([
            'nama' => ['required', 'max:255', 'regex:/^[^0-9]+$/'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'nohp' => ['required'],
            'alamat' => ['required'],
            'password' => ['required', 'min:8', 'max:255'],
            'kategori_id' => ['required']
        ], [
            'nama.regex' => 'Nama tidak boleh mengandung angka.',
            'kategori_id.required' => 'The kategori field is required.'
        ]);

        $ValidateData['password'] = Hash::make($ValidateData['password']);

        $user = User::create($ValidateData);

        $admins = User::where('is_admin', true)->get();
        Notification::send($admins, new MemberBaru($user));

        return redirect('/#pricelist')->with('Sukses', 'Pendaftaran berhasil, lakukan pembayaran.');
    }
}
