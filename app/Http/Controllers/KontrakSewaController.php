<?php

namespace App\Http\Controllers;

use App\Models\KontrakSewa;
use App\Models\Kamar;
use App\Models\Penyewa;
use Illuminate\Http\Request;

class KontrakSewaController extends Controller
{
    public function index()
    {
        $kontraks = KontrakSewa::with(['penyewa', 'kamar'])->latest()->get();
        return view('kontrak.index', compact('kontraks'));
    }

    public function create()
    {
        $penyewas = Penyewa::all();
        // Hanya tampilkan kamar yang tersedia
        $kamars = Kamar::where('status', 'tersedia')->get();
        return view('kontrak.create', compact('penyewas', 'kamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penyewa_id' => 'required|exists:penyewa,id',
            'kamar_id' => 'required|exists:kamar,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'harga_bulanan' => 'required|numeric|min:0',
        ]);

        // 1. Buat Kontrak
        KontrakSewa::create([
            'penyewa_id' => $request->penyewa_id,
            'kamar_id' => $request->kamar_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'harga_bulanan' => $request->harga_bulanan,
            'status' => 'aktif'
        ]);

        // 2. Update Status Kamar jadi Terisi
        Kamar::where('id', $request->kamar_id)->update(['status' => 'terisi']);

        return redirect()->route('kontrak.index')->with('success', 'Kontrak berhasil dibuat');
    }

    public function show($id)
    {
        $kontrak = KontrakSewa::with(['penyewa', 'kamar', 'pembayarans'])->findOrFail($id);
        return view('kontrak.show', compact('kontrak'));
    }

    public function edit($id)
    {
        $kontrak = KontrakSewa::findOrFail($id);
        return view('kontrak.edit', compact('kontrak'));
    }

    public function update(Request $request, $id)
    {
        $kontrak = KontrakSewa::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:aktif,selesai',
        ]);

        // Jika status diubah jadi selesai, kamar jadi tersedia lagi
        if ($kontrak->status == 'aktif' && $request->status == 'selesai') {
            Kamar::where('id', $kontrak->kamar_id)->update(['status' => 'tersedia']);
        }

        $kontrak->update(['status' => $request->status]);

        return redirect()->route('kontrak.index')->with('success', 'Status kontrak diperbarui');
    }

    public function destroy($id)
    {
        $kontrak = KontrakSewa::findOrFail($id);
        
        // Kembalikan status kamar jadi tersedia jika kontrak dihapus
        if ($kontrak->status == 'aktif') {
            Kamar::where('id', $kontrak->kamar_id)->update(['status' => 'tersedia']);
        }
        
        $kontrak->delete();
        return redirect()->route('kontrak.index')->with('success', 'Kontrak dihapus');
    }
}