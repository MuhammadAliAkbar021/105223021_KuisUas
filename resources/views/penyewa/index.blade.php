@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Daftar Penyewa</h1>
    <a href="{{ route('penyewa.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
        + Tambah Penyewa
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            {{-- Header Tabel Warna Ungu --}}
            <tr class="bg-indigo-600 text-white uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Nama Lengkap</th>
                <th class="py-3 px-6 text-left">No. Telepon</th>
                <th class="py-3 px-6 text-left">Pekerjaan</th>
                <th class="py-3 px-6 text-left">Asal</th>
                <th class="py-3 px-6 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse($penyewas as $penyewa)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="py-3 px-6 text-left whitespace-nowrap">
                    <span class="font-medium">{{ $penyewa->nama_lengkap }}</span>
                    <br>
                    <span class="text-xs text-gray-500">KTP: {{ $penyewa->nomor_ktp }}</span>
                </td>
                <td class="py-3 px-6 text-left">
                    {{ $penyewa->nomor_telepon }}
                </td>
                <td class="py-3 px-6 text-left">
                    {{ $penyewa->pekerjaan }}
                </td>
                <td class="py-3 px-6 text-left">
                    {{ Str::limit($penyewa->alamat_asal, 20) }}
                </td>
                <td class="py-3 px-6 text-center">
                    <div class="flex item-center justify-center">
                        <a href="{{ route('penyewa.edit', $penyewa->id) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" title="Edit">
                            ✏️
                        </a>
                        <form action="{{ route('penyewa.destroy', $penyewa->id) }}" method="POST" onsubmit="return confirm('Hapus penyewa ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110" title="Hapus">
                                🗑️
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-6 text-center text-gray-500">
                    Belum ada data penyewa.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection