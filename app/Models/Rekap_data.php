<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekap_data extends Model
{
    protected $table = 'rekap_data';
    protected $primaryKey = 'id'; // Sesuai struktur barumu
    public $incrementing = true;
    public $keyType = 'int';
    public $timestamps = true; // karena kamu pakai created_at & updated_at

    protected $fillable = [
        'tanggal',
        'data_barang_id',
        'stok_awal',
        'pembelian',
        'penjualan',
        'stok_akhir',
        'harga_beli',
        'harga_jual',
        'keuntungan',
        'modal_per_akhir',
        'sub_total',
    ];

    public function dataBarang()
    {
        return $this->belongsTo(Data_barang::class, 'data_barang_id', 'id_barang');
    }
}
