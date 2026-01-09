<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';
    
    // Kolom yang boleh diisi
    protected $fillable = [
        'nomor_kamar', 
        'tipe', 
        'harga_bulanan', 
        'fasilitas', 
        'status'
    ];
    
    // Relasi: Satu Kamar bisa punya banyak Kontrak Sewa (history)
    public function kontrakSewas()
    {
        return $this->hasMany(KontrakSewa::class, 'kamar_id');
    }
}