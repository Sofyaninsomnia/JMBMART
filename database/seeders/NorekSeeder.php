<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Norek;

class NorekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Norek::create([
            'nomor' => '123457890',
            'nama' => 'John Doe',
        ]);
    }
}