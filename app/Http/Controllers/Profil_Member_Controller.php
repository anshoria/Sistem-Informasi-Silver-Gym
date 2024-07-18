<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class Profil_Member_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $tanggalBerakhir = Auth::user()->tanggal_berakhir;

        if ($tanggalBerakhir != null) {
            $tanggalBerakhirFormat = Carbon::parse($tanggalBerakhir);
            $tanggalBerakhirFormat->endOfDay();
            // Hitung hari yang tersisa
            $hariTersisa = $this->hitungHariTersisa($tanggalBerakhir);
            if ($tanggalBerakhirFormat->isPast()) {
                session()->flash('info_hari', 'Langganan member berakhir, perpanjang langganan!');
            } else {
                // Tampilkan pesan alert dinamis mulai dari H-3
                if ($hariTersisa === 2) {
                    session()->flash('info_hari', 'Langganan member anda berakhir 3 hari lagi!');
                } elseif ($hariTersisa === 1) {
                    session()->flash('info_hari', 'Langganan member anda berakhir 2 hari lagi!');
                } elseif ($hariTersisa === 0) {
                    session()->flash('info_hari', 'Langganan member anda berakhir besok!');
                }
            }
        }

        return view('layouts.profil');
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
        return view('layouts/edit-profil');
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
            'email' => ['nullable', 'email:dns', Rule::unique('users')->ignore($id)],
            'nohp' => ['required'],
            'alamat' => ['required'],
            'gambar' => ['image', 'file', 'max:1024']
        ]);
        if ($request->file('gambar')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $ValidateData['gambar'] = $request->file('gambar')->store('Profil-Member');
        }

        User::where('id', $id)->update($ValidateData);
        return redirect('/profil')->with('Sukses', 'Berhasil diubah.');
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

    private function hitungHariTersisa($tanggalBerakhir)
    {
        $tanggalBerakhir = Carbon::parse($tanggalBerakhir);
        $sekarang = Carbon::now();
        $sekarangFormatDMY = $sekarang->format('d-m-Y');

        // Hitung selisih hari antara tanggal berakhir dan hari ini
        return $tanggalBerakhir->diffInDays($sekarangFormatDMY);
    }
}
