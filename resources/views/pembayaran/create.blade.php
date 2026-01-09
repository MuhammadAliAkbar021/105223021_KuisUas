@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-4">
            <h2 class="text-xl font-bold">Catat Pembayaran</h2>
        </div>
        
        <form action="{{ route('pembayaran.store') }}" method="POST" class="p-6" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Penyewa / Kontrak</label>
                <select name="kontrak_sewa_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500" required>
                    <option value="">-- Pilih Kontrak Aktif --</option>
                    @foreach($kontraks as $kontrak)
                        <option value="{{ $kontrak->id }}">
                            {{ $kontrak->penyewa->nama_lengkap }} - Kamar {{ $kontrak->kamar->nomor_kamar }} (Rp {{ number_format($kontrak->harga_bulanan) }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">* Hanya kontrak berstatus 'Aktif' yang muncul.</p>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Untuk Bulan</label>
                    <select name="bulan" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}" {{ date('n') == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tahun</label>
                    <input type="number" name="tahun" value="{{ date('Y') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah Bayar (Rp)</label>
                    <input type="number" name="jumlah_bayar" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Contoh: 500000" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar" value="{{ date('Y-m-d') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Status Pembayaran</label>
                <select name="status" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="lunas">Lunas</option>
                    <option value="tertunggak">Tertunggak (Belum Lunas)</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Catatan (Opsional)</label>
                <textarea name="keterangan" class="w-full border border-gray-300 rounded px-3 py-2" rows="2" placeholder="Contoh: Transfer via BCA"></textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('pembayaran.index') }}" class="text-gray-500 hover:text-gray-700 font-bold py-2 px-4 rounded mr-2">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection