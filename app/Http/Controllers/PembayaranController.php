<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\KontrakSewa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('kontrakSewa.penyewa')->latest()->get();
        return view('pembayaran.index', compact('pembayarans'));
    }

    public function create()
    {
        // Hanya kontrak aktif yang bisa bayar
        $kontraks = KontrakSewa::where('status', 'aktif')->with('penyewa', 'kamar')->get();
        return view('pembayaran.create', compact('kontraks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kontrak_sewa_id' => 'required|exists:kontrak_sewa,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'status' => 'required|in:lunas,tertunggak',
        ]);

        Pembayaran::create($request->all());
        
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran dicatat');
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('pembayaran.edit', compact('pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($request->only(['status', 'keterangan', 'jumlah_bayar']));
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran diupdate');
    }

    public function destroy($id)
    {
        Pembayaran::destroy($id);
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran dihapus');
    }
}