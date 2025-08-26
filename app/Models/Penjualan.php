<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';

    protected $fillable = [
        'kode_penjualan', 
        'nama_pelanggan',
        'tanggal',
        'total'
    ];

    public function barangKeluar()
    {
        return $this->hasMany(Barang_keluar::class, 'id_penjualan');
    }
}
