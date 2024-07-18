<?php

namespace App\Http\Controllers;


use App\Models\PersonalTrainer;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public function index()
    {
        $notif = auth()->user()->unreadNotifications;

        $admin = User::where('is_admin', true)->count();
        $personal_trainer = PersonalTrainer::count();
        $user = User::where('is_member', true)->count();

        // total transaksi perbulan
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $transaksi = Transaksi::whereBetween('created_at', [$startDate, $endDate])->sum('harga');
        $formatted_total_harga = number_format($transaksi, 0, ',', '.');

        // grafik Transaksi
        $transaksiPerminggu = Transaksi::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('WEEK(created_at) as week, SUM(harga) as transaksi')->groupBy('week')->get();

        // grafik Langganan Member
        $memberPerminggu = User::where('is_member', true)->whereBetween('tanggal_bergabung', [$startDate, $endDate])
            ->selectRaw('WEEK(tanggal_bergabung) as week, COUNT(id) as member')->groupBy('week')->get();

        // member aktif
        $currentDate = Carbon::now();
        $memberaktif = User::where('is_member', true)->whereDate('tanggal_berakhir', '>=', $currentDate)->count();

        // unconfirmed member
        $unconfirm_member = User::where('is_member', false)->where('is_admin', false)->count();

        return view('dashboard/layouts/dashboard', compact(
            'notif',
            'admin',
            'personal_trainer',
            'user',
            'formatted_total_harga',
            'transaksiPerminggu',
            'memberPerminggu',
            'memberaktif',
            'unconfirm_member'
        ));
    }


    public function notif()
    {
        $user = auth()->user();

        // Ambil notifikasi yang belum dibaca
        $notif = $user->unreadNotifications;

        // Periksa apakah ada notifikasi sebelum memanggil markAsRead
        if ($notif->isNotEmpty()) {
            // Tandai notifikasi sebagai sudah dibaca
            $user->unreadNotifications->markAsRead();
        }

        $unconfirmedUsers = User::where('is_member', false)->where('is_admin', false)->latest()->get();

        return view('dashboard/layouts/notification', compact('notif', 'unconfirmedUsers'));
    }


    public function confirm(Request $request, $id)
    {
        $request->validate([
            'no_member' => ['required', 'unique:users'],
            'tanggal_bergabung' => ['required', 'date']
        ]);

        $user = User::find($id);

        if (!$user) {
            return redirect('/dashboard/member')->with('error', 'Pengguna tidak ditemukan');
        }


        $kategori = $user->kategori;
        $masaAktifString = $kategori->masaaktif;

        if ($kategori->masaaktif == 'Pervisit') {
            $tanggalBerakhir = null;
        } else {
            $tanggalBerakhir = $this->calculateTanggalBerakhir($request->tanggal_bergabung, $masaAktifString);
        }


        $user->where('id', $id)->update([
            'is_member' => true,
            'no_member' => $request->no_member,
            'tanggal_bergabung' => $request->tanggal_bergabung,
            'tanggal_berakhir' => $tanggalBerakhir
        ]);


        return redirect('/dashboard/notif-member')->with('Sukses', 'Berhasil ditambahkan.');
    }

    public function reject($id)
    {

        $user = User::find($id);


        if (!$user) {
            return redirect('/dashboard/member')->with('error', 'Pengguna tidak ditemukan.');
        }

        $user->delete();

        return redirect('/dashboard/notif-member')->with('Sukses', 'Berhasil dihapus.');
    }


    private function calculateTanggalBerakhir($tanggalBergabung, $masaAktifString)
    {
        // Cari jumlah bulan dalam string dan kembalikan nilainya
        preg_match('/(\d+)\s+bulan/', $masaAktifString, $matches);

        // Jika tidak ada kecocokan, default ke 0 bulan
        $jumlahBulan = $matches[1] ?? 0;

        // Tanggal berakhir dihitung dengan menambahkan jumlah bulan ke tanggal bergabung
        return Carbon::parse($tanggalBergabung)->addMonths($jumlahBulan);
    }


    public function update_password(Request $request)
    {

        $request->validate([
            'password_lama' => ['required', 'min:8'],
            'password' => ['required', 'min:8', 'confirmed']
        ], [
            'password.confirmed' => 'Konfirmasi Password salah.'
        ]);
        $user = auth()->user();
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password salah!']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect('/dashboard/profil')->with('Sukses', 'Password berhasil diubah.');
    }
}
