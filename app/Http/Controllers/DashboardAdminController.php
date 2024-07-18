<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notif = auth()->user()->unreadNotifications;


        $user = User::where('is_admin', true)->latest()->get();
        return view('dashboard/layouts/admin/admin', compact('notif', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notif = auth()->user()->unreadNotifications;


        return view('dashboard/layouts/admin/create', compact('notif'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ValidateData = $request->validate([
            'nama' => ['required', 'max:255', 'unique:users', 'regex:/^[^\s]+$/', 'regex:/[0-9]+/'],
            'nohp' => ['required'],
            'password' => ['required', 'min:8']
        ], [
            'nama.regex' => 'Username harus memiliki angka dan tidak menggunakan spasi.',
            'nama.unique' => 'Usernama sudah dimiliki.'
        ]);

        $ValidateData['is_admin'] = true;

        $ValidateData['password'] = Hash::make($ValidateData['password']);

        User::create($ValidateData);

        return redirect('/dashboard/admin')->with('Sukses', 'Berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        // Cek apakah user yang dihapus adalah admin
        if ($user->is_admin) {
            // Cek jumlah admin yang tersisa
            $adminCount = User::where('is_admin', true)->count();

            // Jika hanya satu admin tersisa, tampilkan pesan kesalahan
            if ($adminCount <= 1) {
                return back()->with('error', 'Tidak dapat menghapus admin terakhir.');
            }
        }
        User::destroy($id);
        return redirect('/dashboard/admin')->with('Sukses', 'Berhasil dihapus.');
    }
}
