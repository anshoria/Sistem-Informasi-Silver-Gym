<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        $countExpired = 0;

        foreach ($users as $user) {
            $tanggalBerakhir = $user->tanggal_berakhir;

            if ($tanggalBerakhir !== null && Carbon::now()->isSameDay($tanggalBerakhir)) {
                $countExpired++;
            }
        }

        // Simpan pesan dalam session alert
        if ($countExpired > 0) {
            session()->flash('alert', 'Ada ' . $countExpired . ' member berakhir langganan hari ini.');
        }

        $notif = auth()->user()->unreadNotifications;

        $user = User::where('is_admin', false)->where('is_member', true)->with('Kategori')->latest()->get();
        return view('dashboard/layouts/member/member', compact('notif', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notif = auth()->user()->unreadNotifications;

        $kategori = Kategori::where('nama', '!=', 'Non Member')->get();
        return view('dashboard/layouts/member/create', compact('notif', 'kategori'));
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
            'tanggal_bergabung' => ['required', 'date'],
            'no_member' => ['required', 'unique:users'],
            'nama' => ['required', 'max:255', 'regex:/^[^0-9]+$/'],
            'nohp' => ['required'],
            'alamat' => ['required'],
            'kategori_id' => ['required'],
            'password' => ['nullable', 'min:8']
        ], [
            'nama.regex' => 'Nama tidak boleh mengandung angka.'
        ]);

        // Mendapatkan informasi kategori terkait
        $kategori = Kategori::find($request->kategori_id);
        if (!$kategori) {
            return redirect('/dashboard/member')->with('error', 'Kategori tidak ditemukan.');
        }

        if ($kategori->masaaktif == 'Pervisit') {
            $tanggalBerakhir = null;
        } else {
            $tanggalBerakhir = $this->calculateTanggalBerakhir($ValidateData['tanggal_bergabung'], $kategori->masaaktif);
        }

        if ($request->filled('password')) {
            $ValidateData['password'] = Hash::make($ValidateData['password']);
        }

        $ValidateData['is_member'] = true;
        $ValidateData['tanggal_berakhir'] = $tanggalBerakhir;

        User::create($ValidateData);

        return redirect('/dashboard/member')->with('Sukses', 'Berhasil ditambahkan.');
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


        $user =  User::find($id);
        $kategori = Kategori::where('nama', '!=', 'Non Member')->get();
        return view('dashboard/layouts/member/edit', compact('notif', 'user', 'kategori'));
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
            'tanggal_bergabung' => ['required', 'date'],
            'no_member' => ['required', Rule::unique('users')->ignore($id)],
            'nama' => ['required', 'max:255', 'regex:/^[^0-9]+$/'],
            'nohp' => ['required'],
            'alamat' => ['required'],
            'kategori_id' => ['required'],
            'password' => ['nullable', 'min:8']
        ], [
            'nama.regex' => 'Nama tidak boleh mengandung angka.',
        ]);

        $kategori = Kategori::find($request->kategori_id);

        if (!$kategori) {
            return redirect('/dashboard/member')->with('error', 'Kategori tidak ditemukan.');
        }

        if ($kategori->masaaktif == 'Pervisit') {
            $tanggalBerakhir = null;
        } else {
            $tanggalBerakhir = $this->calculateTanggalBerakhir($ValidateData['tanggal_bergabung'], $kategori->masaaktif);
        }


        if ($request->filled('password')) {
            $ValidateData['password'] = Hash::make($ValidateData['password']);
        }

        $ValidateData['tanggal_berakhir'] = $tanggalBerakhir;

        User::where('id', $id)->update($ValidateData);
        return redirect('/dashboard/member')->with('Sukses', 'Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('/dashboard/member')->with('Sukses', 'Berhasil dihapus.');
    }



    private function calculateTanggalBerakhir($tanggalBergabung, $masaAktifString)
    {
        preg_match('/(\d+)\s+bulan/', $masaAktifString, $matches);

        $jumlahBulan = $matches[1] ?? 0;

        return Carbon::parse($tanggalBergabung)->addMonths($jumlahBulan);
    }
}
