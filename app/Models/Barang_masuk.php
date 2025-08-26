<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang_masuk extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_barang_masuk';
    public $incrementing = true;
    public $keyType = 'int';

    protected $fillable = [
        'id_barang',
        'tanggal_masuk',
        'jumlah_masuk',
        'keterangan'
    ];

    public function dataBarang()
    {
        return $this->belongsTo(Data_barang::class, 'id_barang', 'id_barang');
    }
}
