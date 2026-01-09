<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\KontrakSewa;
use App\Models\Pembayaran;
use App\Models\Penyewa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total Kamar
        $totalKamar = Kamar::count();

        // 2. Kamar Tersedia & Terisi
        $kamarTersedia = Kamar::where('status', 'tersedia')->count();
        $kamarTerisi = Kamar::where('status', 'terisi')->count();

        // 3. Pendapatan Bulan Ini (Hanya yang status lunas)
        $currentMonth = now()->month;
        $currentYear = now()->year;
        
        $pendapatanBulanIni = Pembayaran::whereMonth('tanggal_bayar', $currentMonth)
            ->whereYear('tanggal_bayar', $currentYear)
            ->where('status', 'lunas')
            ->sum('jumlah_bayar');

        // 4. Pembayaran Tertunggak (Semua waktu)
        $pembayaranTertunggak = Pembayaran::where('status', 'tertunggak')->count();

        // 5. List Kontrak Aktif (Opsional untuk ditampilkan di dashboard)
        $kontrakAktif = KontrakSewa::with(['penyewa', 'kamar'])
            ->where('status', 'aktif')
            ->latest()
            ->take(5)
            ->get();

       return view('dashboard.index', compact( 
        'totalKamar',
        'kamarTersedia',
        'kamarTerisi',
        'pendapatanBulanIni',
        'pembayaranTertunggak',
        'kontrakAktif'
));
    }
}