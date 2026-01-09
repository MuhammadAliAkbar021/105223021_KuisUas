<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    public function index()
    {
        $penyewas = Penyewa::latest()->get();
        return view('penyewa.index', compact('penyewas'));
    }

    public function create()
    {
        return view('penyewa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:15',
            'nomor_ktp' => 'required|string|unique:penyewa,nomor_ktp|max:20',
            'alamat_asal' => 'required|string',
            'pekerjaan' => 'required|string|max:50',
        ]);

        Penyewa::create($validated);
        return redirect()->route('penyewa.index')->with('success', 'Penyewa berhasil ditambahkan');
    }

    public function show($id)
    {
        $penyewa = Penyewa::with('kontrakSewas.kamar')->findOrFail($id);
        return view('penyewa.show', compact('penyewa'));
    }

    public function edit($id)
    {
        $penyewa = Penyewa::findOrFail($id);
        return view('penyewa.edit', compact('penyewa'));
    }

    public function update(Request $request, $id)
    {
        $penyewa = Penyewa::findOrFail($id);
        
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:15',
            'nomor_ktp' => 'required|string|max:20|unique:penyewa,nomor_ktp,' . $penyewa->id,
            'alamat_asal' => 'required|string',
            'pekerjaan' => 'required|string|max:50',
        ]);

        $penyewa->update($validated);
        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil diupdate');
    }

    public function destroy($id)
    {
        $penyewa = Penyewa::findOrFail($id);
        $hasActiveContract = $penyewa->kontrakSewas()->where('status', 'aktif')->exists();
        
        if ($hasActiveContract) {
            return back()->with('error', 'Tidak bisa dihapus karena masih ada kontrak aktif.');
        }

        $penyewa->delete();
        return redirect()->route('penyewa.index')->with('success', 'Penyewa berhasil dihapus');
    }
}