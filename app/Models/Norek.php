<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Norek extends Model
{
    use HasFactory;

    protected $table = 'norek';

    protected $fillable = [
        'nomor',
        'nama'
    ];
}