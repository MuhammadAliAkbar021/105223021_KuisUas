@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow-md mt-6">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Edit Data Penyewa</h2>
    
    <form action="{{ route('penyewa.update', $penyewa->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="{{ $penyewa->nama_lengkap }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nomor KTP (NIK)</label>
            <input type="text" name="nomor_ktp" value="{{ $penyewa->nomor_ktp }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" value="{{ $penyewa->nomor_telepon }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Pekerjaan</label>
            <input type="text" name="pekerjaan" value="{{ $penyewa->pekerjaan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Asal</label>
            <textarea name="alamat_asal" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:border-blue-500" rows="3" required>{{ $penyewa->alamat_asal }}</textarea>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('penyewa.index') }}" class="text-gray-500 hover:text-gray-800 font-bold">Batal</a>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Update Data
            </button>
        </div>
    </form>
</div>
@endsection