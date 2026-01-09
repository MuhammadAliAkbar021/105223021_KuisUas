<?php

namespace Database\Seeders;

// Import Model yang sudah kamu buat
use App\Models\User;
use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\KontrakSewa;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. BUAT DATA KAMAR (20 Kamar)
        $kamars = [];
        $tipeKamar = ['standard', 'deluxe', 'vip'];
        
        for ($i = 1; $i <= 20; $i++) {
            $nomor = $i < 10 ? '0'.$i : $i;
            $tipe = $tipeKamar[rand(0, 2)];
            $harga = match($tipe) {
                'standard' => 500000,
                'deluxe' => 850000,
                'vip' => 1500000,
            };

            $kamars[] = Kamar::create([
                'nomor_kamar' => 'K-' . $nomor,
                'tipe' => $tipe,
                'harga_bulanan' => $harga,
                'fasilitas' => 'Kasur, Lemari, WiFi, ' . ($tipe == 'vip' ? 'AC, TV' : 'Kipas Angin'),
                'status' => 'tersedia' // Default tersedia
            ]);
        }

        // 2. BUAT DATA PENYEWA (5 Orang)
        $penyewas = [];
        $names = ['Budi Santoso', 'Siti Aminah', 'Rudi Hermawan', 'Dewi Lestari', 'Andi Pratama'];
        
        foreach ($names as $index => $name) {
            $penyewas[] = Penyewa::create([
                'nama_lengkap' => $name,
                'nomor_telepon' => '08123456789' . $index,
                'nomor_ktp' => '31710000000' . $index,
                'alamat_asal' => 'Jl. Merdeka No. ' . ($index + 1),
                'pekerjaan' => $index % 2 == 0 ? 'Mahasiswa' : 'Karyawan',
            ]);
        }

        // 3. BUAT KONTRAK SEWA (3 Kontrak Aktif)
        $kontraks = [];
        for ($i = 0; $i < 3; $i++) {
            $kamar = $kamars[$i];
            $penyewa = $penyewas[$i];

            $kontrak = KontrakSewa::create([
                'penyewa_id' => $penyewa->id,
                'kamar_id' => $kamar->id,
                'tanggal_mulai' => '2026-01-01',
                'tanggal_selesai' => '2026-12-31',
                'harga_bulanan' => $kamar->harga_bulanan,
                'status' => 'aktif'
            ]);

            $kamar->update(['status' => 'terisi']);
            
            $kontraks[] = $kontrak;
        }

        // 4. BUAT PEMBAYARAN
        if (isset($kontraks[0])) {
            Pembayaran::create([
                'kontrak_sewa_id' => $kontraks[0]->id,
                'bulan' => 1,
                'tahun' => 2026,
                'jumlah_bayar' => $kontraks[0]->harga_bulanan,
                'tanggal_bayar' => '2026-01-05',
                'status' => 'lunas',
                'keterangan' => 'Pembayaran awal tahun'
            ]);
            
            Pembayaran::create([
                'kontrak_sewa_id' => $kontraks[0]->id,
                'bulan' => 2,
                'tahun' => 2026,
                'jumlah_bayar' => $kontraks[0]->harga_bulanan,
                'tanggal_bayar' => '2026-02-05',
                'status' => 'lunas',
                'keterangan' => 'Lancar'
            ]);
        }
        
        // Buat pembayaran tertunggak untuk kontrak kedua
        if (isset($kontraks[1])) {
             Pembayaran::create([
                'kontrak_sewa_id' => $kontraks[1]->id,
                'bulan' => 1,
                'tahun' => 2026,
                'jumlah_bayar' => 0,
                'tanggal_bayar' => '2026-01-10', 
                'status' => 'tertunggak',
                'keterangan' => 'Janji bayar minggu depan'
            ]);
        }
    }
}