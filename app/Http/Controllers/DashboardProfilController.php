<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class DashboardProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notif = auth()->user()->unreadNotifications;


        return view('dashboard/layouts/profil/profil', compact('notif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return view('dashboard/layouts/profil/edit', compact('notif'));
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
            'nama' => ['required', 'max:255', 'regex:/^[^\s]+$/', 'regex:/[0-9]+/', Rule::unique('users')->ignore($id)->where(function ($query) {
                return $query->where('is_admin', true);
            })],
            'nohp' => ['required'],
            'email' => ['nullable', 'email:dns', Rule::unique('users')->ignore($id)],
            'gambar' => ['image', 'file', 'max:1024']
        ], [
            'nama.regex' => 'Username harus memiliki angka dan tidak menggunakan spasi.',
            'nama.unique' => 'Usernama sudah dimiliki.'
        ]);
        if ($request->file('gambar')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $ValidateData['gambar'] = $request->file('gambar')->store('Profil-Admin');
        }

        User::where('id', $id)->update($ValidateData);
        return redirect('/dashboard/profil')->with('Sukses', 'Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
