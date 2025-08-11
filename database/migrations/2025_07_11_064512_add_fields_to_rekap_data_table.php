<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rekap_data', function (Blueprint $table) {
            $table->integer('stok_awal')->nullable();
            $table->integer('pembelian')->nullable();
            $table->integer('penjualan')->nullable();
            $table->integer('stok_akhir')->nullable();
            $table->bigInteger('harga_beli')->nullable();
            $table->bigInteger('harga_jual')->nullable();
            $table->bigInteger('keuntungan')->nullable();
            $table->bigInteger('modal_per_akhir')->nullable();
            $table->bigInteger('sub_total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekap_data', function (Blueprint $table) {
            //
        });
    }
};
