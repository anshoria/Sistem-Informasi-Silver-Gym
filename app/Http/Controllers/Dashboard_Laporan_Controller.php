<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class Dashboard_Laporan_Controller extends Controller
{
    public function index_transaksi(Request $request)
    {
        $notif = auth()->user()->unreadNotifications;


        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $transaksi = Transaksi::with('User')->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->latest()->get();
        $total_harga = $transaksi->sum('harga');

        $formatted_total_harga = number_format($total_harga, 0, ',', '.');


        return view('dashboard/layouts/laporan/laporan_transaksi', compact('notif', 'transaksi', 'tanggal_awal', 'tanggal_akhir', 'formatted_total_harga'));
    }

    public function laporan_transaksi(Request $request)
    {
        $notif = auth()->user()->unreadNotifications;


        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;


        $tanggal_awal = $tanggal_awal . ' 00:00:00';
        $tanggal_akhir = $tanggal_akhir . ' 23:59:59';

        $transaksi = Transaksi::with('User')->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->latest()->get();
        $total_harga = $transaksi->sum('harga');

        $formatted_total_harga = number_format($total_harga, 0, ',', '.');

        session(['tanggal_awal' => $tanggal_awal]);
        session(['tanggal_akhir' => $tanggal_akhir]);

        return view('dashboard/layouts/laporan/laporan_transaksi', compact('notif', 'transaksi', 'tanggal_awal', 'tanggal_akhir', 'formatted_total_harga'));
    }

    public function index_member(Request $request)
    {
        $notif = auth()->user()->unreadNotifications;


        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $user = User::with('Kategori')->where('is_admin', false)->where('is_member', true)->whereBetween('tanggal_bergabung', [$tanggal_awal, $tanggal_akhir])->latest()->get();
        $total_user = $user->count();
        return view('dashboard/layouts/laporan/laporan_member', compact('notif', 'user', 'tanggal_awal', 'tanggal_akhir', 'total_user'));
    }

    public function laporan_member(Request $request)
    {
        $notif = auth()->user()->unreadNotifications;

        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $tanggal_awal = $tanggal_awal . ' 00:00:00';
        $tanggal_akhir = $tanggal_akhir . ' 23:59:59';

        $user = User::with('Kategori')->where('is_admin', false)->where('is_member', true)->whereBetween('tanggal_bergabung', [$tanggal_awal, $tanggal_akhir])->latest()->get();
        $total_user = $user->count();

        session(['tanggal_awal' => $tanggal_awal]);
        session(['tanggal_akhir' => $tanggal_akhir]);
        return view('dashboard/layouts/laporan/laporan_member', compact('notif', 'user', 'tanggal_awal', 'tanggal_akhir', 'total_user'));
    }


    public function cetak_laporan_transaksi()
    {

        $tanggal_awal = session('tanggal_awal');
        $tanggal_akhir = session('tanggal_akhir');

        $transaksi = Transaksi::with('User')->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->latest()->get();

        $total_harga = $transaksi->sum('harga');

        $formatted_total_harga = number_format($total_harga, 0, ',', '.');

        return view('dashboard/layouts/laporan/cetak-transaksi', compact('transaksi', 'tanggal_awal', 'tanggal_akhir', 'formatted_total_harga'));
    }


    public function cetak_laporan_member()
    {
        $tanggal_awal = session('tanggal_awal');
        $tanggal_akhir = session('tanggal_akhir');

        $user = User::with('Kategori')->where('is_admin', false)->where('is_member', true)->whereBetween('tanggal_bergabung', [$tanggal_awal, $tanggal_akhir])->latest()->get();

        $total_user = $user->count();

        return view('dashboard/layouts/laporan/cetak-member', compact('user', 'tanggal_awal', 'tanggal_akhir', 'total_user'));
    }
}
