@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <div class="md:col-span-1">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white px-6 py-4">
                <h3 class="text-lg font-bold">Detail Kontrak</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <span class="text-gray-500 text-sm">Nomor Kamar</span>
                    <div class="font-bold text-xl">{{ $kontrak->kamar->nomor_kamar }}</div>
                    <div class="text-sm text-gray-400 capitalize">{{ $kontrak->kamar->tipe }}</div>
                </div>
                <div>
                    <span class="text-gray-500 text-sm">Nama Penyewa</span>
                    <div class="font-bold text-lg">{{ $kontrak->penyewa->nama_lengkap }}</div>
                    <div class="text-sm text-gray-400">{{ $kontrak->penyewa->nomor_telepon }}</div>
                </div>
                <hr>
                <div>
                    <span class="text-gray-500 text-sm">Harga Sewa</span>
                    <div class="font-bold text-green-600">Rp {{ number_format($kontrak->harga_bulanan, 0, ',', '.') }} / bulan</div>
                </div>
                <div>
                    <span class="text-gray-500 text-sm">Status</span> <br>
                    <span class="px-2 py-1 rounded text-xs {{ $kontrak->status == 'aktif' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ ucfirst($kontrak->status) }}
                    </span>
                </div>
                <div class="pt-4">
                    <a href="{{ route('kontrak.index') }}" class="text-blue-500 hover:underline">&larr; Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <div class="md:col-span-2">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-700">Riwayat Pembayaran</h3>
            </div>
            
            @if($kontrak->pembayarans->count() > 0)
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Bulan/Tahun</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tgl Bayar</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kontrak->pembayarans as $pembayaran)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ \Carbon\Carbon::create()->month($pembayaran->bulan)->format('F') }} {{ $pembayaran->tahun }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d/m/Y') }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($pembayaran->status == 'lunas')
                                    <span class="text-green-600 font-bold">Lunas</span>
                                @else
                                    <span class="text-red-600 font-bold">Tertunggak</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-6 text-center text-gray-500">
                    Belum ada riwayat pembayaran untuk kontrak ini.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection