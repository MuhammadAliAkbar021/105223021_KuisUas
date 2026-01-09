<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kamar::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('tipe') && $request->tipe != '') {
            $query->where('tipe', $request->tipe);
        }

        // Ambil data
        $kamars = $query->latest()->get();

        return view('kamar.index', compact('kamars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'nomor_kamar' => 'required|unique:kamar,nomor_kamar|max:10',
            'tipe' => 'required|in:standard,deluxe,vip',
            'harga_bulanan' => 'required|numeric|min:0',
            'fasilitas' => 'required|string',
            'status' => 'required|in:tersedia,terisi',
        ]);

    
        Kamar::create($validated);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('kamar.show', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('kamar.edit', compact('kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kamar = Kamar::findOrFail($id);

        $validated = $request->validate([
            // unique:table,column,except_id
            'nomor_kamar' => 'required|max:10|unique:kamar,nomor_kamar,' . $kamar->id,
            'tipe' => 'required|in:standard,deluxe,vip',
            'harga_bulanan' => 'required|numeric|min:0',
            'fasilitas' => 'required|string',
            'status' => 'required|in:tersedia,terisi',
        ]);

        $kamar->update($validated);

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kamar = Kamar::findOrFail($id);

        // Cek relasi: Jangan hapus jika pernah disewa (ada di tabel kontrak)
        if ($kamar->kontrakSewas()->count() > 0) {
            return redirect()->back()->with('error', 'Kamar tidak bisa dihapus karena memiliki riwayat sewa.');
        }

        $kamar->delete();

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus');
    }
}