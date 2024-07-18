<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Gallery;
use App\Models\User;
use App\Models\Kategori;
use App\Models\PersonalTrainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function index()
    {
        $gambar = Gallery::latest()->get();
        $Trainers = PersonalTrainer::all();
        $Kategori = Kategori::all();
        return view('layouts/home', compact(
            'gambar',
            'Trainers',
            'Kategori'
        ));
    }
    public function member()
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

        // grafik
        $presensiUser = Auth::user()->id;

        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now();
        $endDateMonth = Carbon::now()->endOfMonth();

        // $weeklyAttendance = Presensi::where('user_id', $presensiUser)->whereBetween('created_at', [$startDate, $endDate])
        //     ->selectRaw('WEEK(created_at) as week, COUNT(id) as attendance_count')->groupBy('week')->get();
        $weeklyAttendance = Presensi::where('user_id', $presensiUser)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('FLOOR((DAYOFMONTH(created_at) - 1) / 7) + 1 as week, COUNT(id) as attendance_count')
            ->groupBy('week')
            ->get();
        // $topPresensi = Presensi::selectRaw('user_id, COUNT(*) as presence_count')
        //     ->with('User')
        //     ->whereBetween('created_at', [$startDate, $endDateMonth])
        //     ->groupBy('user_id')
        //     ->orderByDesc('presence_count')
        //     ->take(3)
        //     ->get();

        $Trainers = PersonalTrainer::all();
        $Kategori = Kategori::all();
        return view('layouts/home-member', compact(
            'Trainers',
            'Kategori',
            'weeklyAttendance'
        ));
    }

    public function storePresensi(Request $request)
    {

        $loggedInUserId = Auth::id();
        $user = Auth::user();

        $tanggalBerakhir = Auth::user()->tanggal_berakhir;

        if ($tanggalBerakhir != null) {
            $tanggalBerakhirFormat = Carbon::parse($tanggalBerakhir);
            $tanggalBerakhirFormat->endOfDay();

            if ($tanggalBerakhirFormat->isPast()) {
                return redirect('/Halaman-member')->with('error', 'Langganan member berakhir');
            }
        }

        Presensi::create([
            'user_id' => $loggedInUserId,
            'no_member' => $user->no_member
        ]);

        return redirect('/Halaman-member')->with('Sukses', 'Presensi Berhasil.');
    }

    public function tips()
    {
        return view('layouts/tips');
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
