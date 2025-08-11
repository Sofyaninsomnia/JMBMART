<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class DataSupplier extends Model
{
    use HasFactory;
    protected $table = 'data_supplier';
    protected $primaryKey = 'id_supplier';
    public $incrementing = true;
    public $keyType = 'int';

    protected $fillable = [
        'nama_supplier',
        'alamat',
        'no_telp_supplier'
    ];

    public function data_barang(){
        return $this->hasOne(Data_barang::class);
    }
}
