@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-4">
            <h2 class="text-xl font-bold">Buat Kontrak Baru</h2>
        </div>
        
        <form action="{{ route('kontrak.store') }}" method="POST" class="p-6">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Penyewa</label>
                <select name="penyewa_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500" required>
                    <option value="">-- Pilih Penyewa --</option>
                    @foreach($penyewas as $penyewa)
                        <option value="{{ $penyewa->id }}">{{ $penyewa->nama_lengkap }} ({{ $penyewa->nomor_ktp }})</option>
                    @endforeach
                </select>
                @error('penyewa_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Kamar (Tersedia)</label>
                <select name="kamar_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500" required>
                    <option value="">-- Pilih Kamar --</option>
                    @foreach($kamars as $kamar)
                        <option value="{{ $kamar->id }}">
                            Kamar {{ $kamar->nomor_kamar }} - {{ ucfirst($kamar->tipe) }} (Rp {{ number_format($kamar->harga_bulanan) }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">* Hanya menampilkan kamar yang statusnya 'Tersedia'</p>
                @error('kamar_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Harga Sewa per Bulan (Rp)</label>
                <input type="number" name="harga_bulanan" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Contoh: 500000" required>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('kontrak.index') }}" class="text-gray-500 hover:text-gray-700 font-bold py-2 px-4 rounded mr-2">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan Kontrak
                </button>
            </div>
        </form>
    </div>
</div>
@endsection