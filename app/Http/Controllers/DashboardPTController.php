<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalTrainer;
use Illuminate\Support\Facades\Storage;

class DashboardPTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notif = auth()->user()->unreadNotifications;


        $personal_trainer = PersonalTrainer::latest()->get();
        return view('dashboard/layouts/pt/personal_trainer', compact('notif', 'personal_trainer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notif = auth()->user()->unreadNotifications;

        return view('dashboard/layouts/pt/create', compact('notif'));
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
            'nama' => ['required', 'max:255'],
            'kategori' => ['required'],
            'nohp' => ['required'],
            'foto' => ['required', 'image', 'file', 'max:1024']
        ]);

        $ValidateData['foto'] = $request->file('foto')->store('Personal-Trainer');

        $phoneNumber = $request->input('nohp');
        // Menghapus spasi dan karakter non-digit
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // Menambahkan kode negara jika tidak ada
        if (!str_starts_with($phoneNumber, '62') && str_starts_with($phoneNumber, '0')) {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        }
        $ValidateData['nohp'] = $phoneNumber;
        PersonalTrainer::create($ValidateData);

        return redirect('/dashboard/personal_trainer')->with('Sukses', 'Berhasil ditambahkan.');
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
        $notif = auth()->user()->unreadNotifications;


        $personal_trainer = PersonalTrainer::find($id);
        return view('dashboard/layouts/pt/edit', compact('notif', 'personal_trainer'));
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
            'nama' => ['required', 'max:255'],
            'kategori' => ['required'],
            'nohp' => ['required'],
            'foto' => ['image', 'file', 'max:1024']
        ]);
        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $ValidateData['foto'] = $request->file('foto')->store('Personal-Trainer');
        }
        $phoneNumber = $request->input('nohp');
        // Menghapus spasi dan karakter non-digit
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // Menambahkan kode negara jika tidak ada
        if (!str_starts_with($phoneNumber, '62') && str_starts_with($phoneNumber, '0')) {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        }
        $ValidateData['nohp'] = $phoneNumber;
        PersonalTrainer::where('id', $id)->update($ValidateData);
        return redirect('/dashboard/personal_trainer')->with('Sukses', 'Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personal_trainer = PersonalTrainer::find($id);
        if ($personal_trainer->foto) {
            Storage::delete($personal_trainer->foto);
        }
        PersonalTrainer::destroy($id);

        return redirect('/dashboard/personal_trainer')->with('Sukses', 'Berhasil dihapus.');
    }
}
