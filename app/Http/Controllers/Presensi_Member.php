<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Presensi_Member extends Controller
{
    public function minggu_ini()
    {
        $user = Auth::user();

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $presensi = Presensi::where('user_id', $user->id)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();

        return view('layouts/presensi-minggu', compact('presensi'));
    }

    public function bulan_ini()
    {
        $user = Auth::user();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $presensi = Presensi::where('user_id', $user->id)->whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();

        return view('layouts/presensi-bulan', compact('presensi'));
    }

    public function tahun_ini()
    {
        $user = Auth::user();

        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        $presensi = Presensi::where('user_id', $user->id)->whereBetween('created_at', [$startOfYear, $endOfYear])->get();

        return view('layouts/presensi-tahun', compact('presensi'));
    }

    public function semua()
    {
        $user = Auth::user();

        $presensi = Presensi::where('user_id', $user->id)->get();

        return view('layouts/presensi-semua', compact('presensi'));
    }
}
