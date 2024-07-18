<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\User;

class DashboardPresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notif = auth()->user()->unreadNotifications;

        $presensi = Presensi::with('User')->latest()->get();

        return view('dashboard/layouts/presensi/presensi', compact('notif', 'presensi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notif = auth()->user()->unreadNotifications;


        $user = User::where('is_admin', false)->where('is_member', true)->latest()->get();

        return view('dashboard/layouts/presensi/create', compact('notif', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_member' => ['required']
        ]);
        // Cari pengguna berdasarkan nomor member
        $user = User::where('no_member', $request->no_member)->first();
        if ($user) {
            Presensi::create([
                'user_id' => $user->id,
                'no_member' => $request->no_member,
            ]);

            return redirect('/dashboard/presensi')->with('Sukses', 'Berhasil ditambahkan.');
        } else {
            return redirect('/dashboard/presensi/create')->with('error', 'Nomor member tidak valid.');
        }
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
        Presensi::destroy($id);

        return redirect('/dashboard/presensi')->with('Sukses', 'Berhasil dihapus.');
    }
}
