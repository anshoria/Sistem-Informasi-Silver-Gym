<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;


class DashboardTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notif = auth()->user()->unreadNotifications;


        $transaksi = Transaksi::with('User')->latest()->get();

        return view('dashboard/layouts/transaksi/transaksi', compact('notif', 'transaksi'));
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
        $transaksi = Transaksi::all();
        return view('dashboard/layouts/transaksi/create', compact('notif', 'user', 'transaksi'));
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
            'nama_transaksi' => ['required'],
            'kategori' => ['required'],
            'harga' => ['required']
        ]);

        $ValidateData['harga'] = str_replace('.', '', $request->harga);


        if ($request->filled('no_member')) {
            $user = User::where('no_member', $request->no_member)->first();
            if ($user) {
                $ValidateData['no_member'] = $user->no_member;
                $ValidateData['user_id'] = $user->id;
                Transaksi::create($ValidateData);

                return redirect('/dashboard/transaksi')->with('Sukses', 'Berhasil ditambahkan.');
            } else {
                return redirect('/dashboard/transaksi/create')->with('error', 'Nomor member tidak valid.');
            }
        }

        Transaksi::create($ValidateData);


        return redirect('/dashboard/transaksi')->with('Sukses', 'Berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notif = auth()->user()->unreadNotifications;


        $user = User::all();
        $transaksi = Transaksi::find($id);
        return view('dashboard/layouts/transaksi/edit', compact('notif', 'user', 'transaksi'));
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
        $ValidateData = $request->validate([
            'nama_transaksi' => ['required'],
            'kategori' => ['required'],
            'harga' => ['required']
        ]);

        $ValidateData['harga'] = str_replace('.', '', $request->harga);

        if ($request->filled('no_member')) {
            $user = User::where('no_member', $request->no_member)->first();
            if ($user) {
                $ValidateData['no_member'] = $user->no_member;
                $ValidateData['user_id'] = $user->id;
                Transaksi::where('id', $id)->update($ValidateData);

                return redirect('/dashboard/transaksi')->with('Sukses', 'Berhasil diubah.');
            } else {
                return back()->with('error', 'Nomor member tidak valid.');
            }
        }

        if ($request->kategori == 'Member') {
            $request->validate([
                'no_member' => ['required']
            ]);
        } elseif ($request->kategori == 'Non Member') {
            $ValidateData['no_member'] = null;
            $ValidateData['user_id'] = null;
        }

        Transaksi::where('id', $id)->update($ValidateData);


        return redirect('/dashboard/transaksi')->with('Sukses', 'Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::destroy($id);

        return redirect('/dashboard/transaksi')->with('Sukses', 'Berhasil dihapus.');
    }
}
