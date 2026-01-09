@extends('layouts.app')

@section('title', 'Tambah Kamar')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Tambah Kamar Baru</h1>
        <p class="text-gray-500 mt-1">Isi formulir di bawah ini untuk menambahkan unit kamar baru.</p>
    </div>

    <form action="{{ route('kamar.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-6 border border-gray-200">
        @csrf
        
        {{-- Input Nomor Kamar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Kamar <span class="text-red-500">*</span></label>
            <input type="text" name="nomor_kamar" value="{{ old('nomor_kamar') }}" 
                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('nomor_kamar') border-red-500 @enderror" 
                   placeholder="Contoh: A-101">
            @error('nomor_kamar')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Select Tipe Kamar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar <span class="text-red-500">*</span></label>
            <select name="tipe" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('tipe') border-red-500 @enderror">
                <option value="">-- Pilih Tipe --</option>
                <option value="standard" {{ old('tipe') == 'standard' ? 'selected' : '' }}>Standard</option>
                <option value="deluxe" {{ old('tipe') == 'deluxe' ? 'selected' : '' }}>Deluxe</option>
                <option value="vip" {{ old('tipe') == 'vip' ? 'selected' : '' }}>VIP</option>
            </select>
            @error('tipe')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input Harga Bulanan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Harga Bulanan (Rp) <span class="text-red-500">*</span></label>
            <div class="relative rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <span class="text-gray-500 sm:text-sm">Rp</span>
                </div>
                <input type="number" name="harga_bulanan" value="{{ old('harga_bulanan') }}" 
                       class="w-full rounded-md border-gray-300 pl-10 focus:border-blue-500 focus:ring-blue-500 p-2 border @error('harga_bulanan') border-red-500 @enderror" 
                       placeholder="0">
            </div>
            @error('harga_bulanan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Textarea Fasilitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Fasilitas <span class="text-red-500">*</span></label>
            <textarea name="fasilitas" rows="3" 
                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('fasilitas') border-red-500 @enderror" 
                      placeholder="Contoh: AC, WiFi, Kamar Mandi Dalam...">{{ old('fasilitas') }}</textarea>
            @error('fasilitas')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Select Status --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status Awal <span class="text-red-500">*</span></label>
            <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border @error('status') border-red-500 @enderror">
                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="terisi" {{ old('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
            </select>
            @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
            <a href="{{ route('kamar.index') }}" class="bg-white border border-gray-300 text-gray-700 font-semibold py-2 px-4 rounded hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition">
                Simpan Kamar
            </button>
        </div>
    </form>
</div>
@endsection