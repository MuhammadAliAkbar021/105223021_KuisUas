@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dashboard Overview</h1>
            <p class="text-gray-500 mt-1">Laporan ringkas manajemen kost hari ini.</p>
        </div>
        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
            {{ now()->format('d M Y') }}
        </span>
    </div>

    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl shadow-lg p-6 mb-8 text-white relative overflow-hidden">
    <div class="relative z-10">
        <h2 class="text-2xl font-bold mb-2"> Halo, Pemilik Kost!</h2>
        <p class="opacity-90">Hari ini tanggal {{ now()->isoFormat('D MMMM Y') }}. Cek status pembayaran terbaru yuk.</p>
    </div>
    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
    <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
</div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        {{-- Card 1: Total Kamar --}}
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500 transition hover:shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div>
                    <div class="text-sm text-gray-500 font-medium">Total Kamar</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $totalKamar }} Unit</div>
                </div>
            </div>
            <div class="mt-2 text-xs text-gray-400">
                {{ $kamarTerisi }} Terisi | {{ $kamarTersedia }} Kosong
            </div>
        </div>

        {{-- Card 2: Kamar Tersedia (Fokus untuk jualan) --}}
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 transition hover:shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <div>
                    <div class="text-sm text-gray-500 font-medium">Kamar Tersedia</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $kamarTersedia }} Unit</div>
                </div>
            </div>
            <div class="mt-2 text-xs text-green-600 font-semibold">
                Siap disewakan segera
            </div>
        </div>

        {{-- Card 3: Pendapatan Bulan Ini --}}
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500 transition hover:shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <div class="text-sm text-gray-500 font-medium">Pendapatan (Bln Ini)</div>
                    <div class="text-2xl font-bold text-gray-900">
                        Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}
                    </div>
                </div>
            </div>
            <div class="mt-2 text-xs text-gray-400">
                Dari pembayaran status 'lunas'
            </div>
        </div>

        {{-- Card 4: Tunggakan --}}
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500 transition hover:shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-500 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <div class="text-sm text-gray-500 font-medium">Belum Lunas</div>
                    <div class="text-2xl font-bold text-red-600">{{ $pembayaranTertunggak }} Transaksi</div>
                </div>
            </div>
            <div class="mt-2 text-xs text-red-500 font-semibold">
                Perlu ditindaklanjuti
            </div>
        </div>
    </div>

    {{-- Menggunakan variabel $kontrakAktif yang dikirim dari controller --}}
    @if(isset($kontrakAktif) && count($kontrakAktif) > 0)
    <div class="bg-white shadow-md rounded-lg overflow-hidden mt-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-gray-700 font-bold text-lg">Kontrak Aktif Terbaru</h3>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penyewa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kamar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berakhir Pada</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($kontrakAktif as $k)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $k->penyewa->nama_lengkap }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $k->kamar->nomor_kamar }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($k->tanggal_selesai)->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Aktif
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-3 bg-gray-50 text-right">
            <a href="{{ route('kontrak.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">Lihat Semua Kontrak &rarr;</a>
        </div>
    </div>
    @endif

</div>
@endsection