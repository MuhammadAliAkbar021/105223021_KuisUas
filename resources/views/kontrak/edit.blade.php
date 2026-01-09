@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-yellow-500 text-white px-6 py-4">
            <h2 class="text-xl font-bold">Edit Status Kontrak</h2>
        </div>
        
        <form action="{{ route('kontrak.update', $kontrak->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="mb-4 bg-gray-100 p-4 rounded text-sm text-gray-600">
                <p><strong>Penyewa:</strong> {{ $kontrak->penyewa->nama_lengkap }}</p>
                <p><strong>Kamar:</strong> {{ $kontrak->kamar->nomor_kamar }}</p>
                <p><strong>Periode:</strong> {{ $kontrak->tanggal_mulai->format('d/m/Y') }} - {{ $kontrak->tanggal_selesai->format('d/m/Y') }}</p>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Status Kontrak</label>
                <select name="status" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500">
                    <option value="aktif" {{ $kontrak->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="selesai" {{ $kontrak->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <p class="text-xs text-red-500 mt-2">* Jika diubah ke "Selesai", status kamar akan otomatis menjadi "Tersedia".</p>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('kontrak.index') }}" class="text-gray-500 hover:text-gray-700 font-bold py-2 px-4 rounded mr-2">Batal</a>
                <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Update Status
                </button>
            </div>
        </form>
    </div>
</div>
@endsection