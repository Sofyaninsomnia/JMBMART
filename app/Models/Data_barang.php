<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data_barang extends Model
{
    protected $table = 'data_barang';
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'package',
        'harga_beli',
        'harga_jual',
        'id_kategori',
        'stok',
        'id_supplier'
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function data_supplier(){
        return $this->belongsTo(DataSupplier::class, 'id_supplier', 'id_supplier');
    }

    public function barangMasuk()
    {
        return $this->hasMany(Barang_masuk::class, 'id_barang_masuk', 'id_barang_masuk');
    }

    public function barangKeluar()
    {
        return $this->hasMany(Barang_keluar::class, 'id_barang_keluar', 'id_barang_keluar');
    }
}
