<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontrakSewa extends Model
{
    protected $table = 'kontrak_sewa';
    
    protected $fillable = [
        'penyewa_id', 
        'kamar_id', 
        'tanggal_mulai', 
        'tanggal_selesai', 
        'harga_bulanan', 
        'status'
    ];
    
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];
    
    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class, 'penyewa_id');
    }
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'kontrak_sewa_id');
    }
}