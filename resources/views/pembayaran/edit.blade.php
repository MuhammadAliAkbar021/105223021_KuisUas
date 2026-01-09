@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-yellow-500 text-white px-6 py-4">
            <h2 class="text-xl font-bold">Edit Pembayaran</h2>
        </div>
        
        <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="mb-4 bg-gray-100 p-4 rounded text-sm text-gray-600">
                <p><strong>Penyewa:</strong> {{ $pembayaran->kontrakSewa->penyewa->nama_lengkap }}</p>
                <p><strong>Kamar:</strong> {{ $pembayaran->kontrakSewa->kamar->nomor_kamar }}</p>
                <p><strong>Periode:</strong> {{ \Carbon\Carbon::create()->month($pembayaran->bulan)->format('F') }} {{ $pembayaran->tahun }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah Bayar</label>
                <input type="number" name="jumlah_bayar" value="{{ $pembayaran->jumlah_bayar }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="lunas" {{ $pembayaran->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="tertunggak" {{ $pembayaran->status == 'tertunggak' ? 'selected' : '' }}>Tertunggak</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Catatan</label>
                <textarea name="keterangan" class="w-full border border-gray-300 rounded px-3 py-2" rows="3">{{ $pembayaran->keterangan }}</textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('pembayaran.index') }}" class="text-gray-500 hover:text-gray-700 font-bold py-2 px-4 rounded mr-2">Batal</a>
                <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection