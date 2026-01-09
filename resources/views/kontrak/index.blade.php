@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Kontrak Sewa</h1>
    <a href="{{ route('kontrak.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
        + Buat Kontrak Baru
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            {{-- Header Tabel Warna Ungu (Indigo) --}}
            <tr class="bg-indigo-600 text-white uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Penyewa</th>
                <th class="py-3 px-6 text-left">Kamar</th>
                <th class="py-3 px-6 text-center">Durasi Sewa</th>
                <th class="py-3 px-6 text-right">Harga/Bulan</th>
                <th class="py-3 px-6 text-center">Status</th>
                <th class="py-3 px-6 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($kontraks as $kontrak)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="py-3 px-6 text-left whitespace-nowrap">
                    <div class="flex items-center">
                        <span class="font-medium">{{ $kontrak->penyewa->nama_lengkap }}</span>
                    </div>
                </td>
                <td class="py-3 px-6 text-left">
                    <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-xs font-semibold">
                        {{ $kontrak->kamar->nomor_kamar }}
                    </span>
                </td>
                <td class="py-3 px-6 text-center">
                    {{ \Carbon\Carbon::parse($kontrak->tanggal_mulai)->format('d M Y') }} 
                    <span class="text-gray-400 mx-1">s/d</span> 
                    {{ \Carbon\Carbon::parse($kontrak->tanggal_selesai)->format('d M Y') }}
                </td>
                <td class="py-3 px-6 text-right font-bold text-gray-700">
                    Rp {{ number_format($kontrak->harga_bulanan, 0, ',', '.') }}
                </td>
                <td class="py-3 px-6 text-center">
                    @if($kontrak->status == 'aktif')
                        <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs">Aktif</span>
                    @else
                        <span class="bg-gray-200 text-gray-600 py-1 px-3 rounded-full text-xs">Selesai</span>
                    @endif
                </td>
                <td class="py-3 px-6 text-center">
                    <div class="flex item-center justify-center">
                        <a href="{{ route('kontrak.show', $kontrak->id) }}" class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110" title="Lihat Detail">
                            👁️
                        </a>
                        <a href="{{ route('kontrak.edit', $kontrak->id) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" title="Edit">
                            ✏️
                        </a>
                        <form action="{{ route('kontrak.destroy', $kontrak->id) }}" method="POST" onsubmit="return confirm('Hapus kontrak? PERHATIAN: Status kamar akan kembali menjadi Tersedia.')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110" title="Hapus">
                                🗑️
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection