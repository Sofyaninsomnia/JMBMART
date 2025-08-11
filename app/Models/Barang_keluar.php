<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang_keluar extends Model
{
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_barang_keluar';
    public $incrementing = true;
    public $keyType = 'int';

    protected $fillable = [
        'id_barang',
        'tanggal_keluar',
        'jumlah_keluar',
        'keterangan',
        'id_penjualan',
    ];

    public function dataBarang()
    {
        return $this->belongsTo(Data_barang::class, 'id_barang', 'id_barang');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }
}
