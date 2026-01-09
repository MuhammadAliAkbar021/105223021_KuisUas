@extends('layouts.app')

@section('content')

{{-- BAGIAN JUDUL & TOMBOL (Cuma satu sekarang) --}}
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Riwayat Pembayaran</h1>
    <div class="flex gap-2">
        {{-- Tombol Print --}}
        <button onclick="window.print()" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow flex items-center gap-2">
              Cetak Laporan
        </button>
        
        {{-- Tombol Tambah --}}
        <a href="{{ route('pembayaran.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
            + Bayar Baru
        </a>
    </div>
</div>

{{-- Style Khusus Print --}}
<style>
    @media print {
        button, a, nav, .aksi-btn { display: none !important; }
        body { background: white; }
    }
</style>

{{-- TABEL DATA --}}
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            {{-- Header Tabel Jadi Ungu (Indigo) --}}
            <thead>
                <tr class="bg-indigo-600 text-white uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Penyewa & Kamar</th>
                    <th class="py-3 px-6 text-left">Untuk Periode</th>
                    <th class="py-3 px-6 text-left">Tgl Bayar</th>
                    <th class="py-3 px-6 text-right">Jumlah</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @forelse($pembayarans as $p)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6 text-left">
                        <div class="font-bold text-gray-800">{{ $p->kontrakSewa->penyewa->nama_lengkap }}</div>
                        <div class="text-xs text-gray-500">Kamar: {{ $p->kontrakSewa->kamar->nomor_kamar }}</div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{ \Carbon\Carbon::create()->month($p->bulan)->format('F') }} {{ $p->tahun }}
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{ \Carbon\Carbon::parse($p->tanggal_bayar)->format('d/m/Y') }}
                    </td>
                    <td class="py-3 px-6 text-right font-medium text-gray-800">
                        Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                    </td>
                    <td class="py-3 px-6 text-center">
                        @if($p->status == 'lunas')
                            <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs font-bold">Lunas</span>
                        @else
                            <span class="bg-red-200 text-red-700 py-1 px-3 rounded-full text-xs font-bold">Tertunggak</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <a href="{{ route('pembayaran.edit', $p->id) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" title="Edit">
                                ✏️ </a>
                            <form action="{{ route('pembayaran.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data pembayaran ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110" title="Hapus">
                                    🗑️ </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-6 text-center text-gray-500">
                        Belum ada data pembayaran.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection