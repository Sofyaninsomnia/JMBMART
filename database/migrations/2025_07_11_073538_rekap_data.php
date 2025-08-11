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
        Schema::create('rekap_datas', function (Blueprint $table) {
            $table->id(); // Pastikan ada kolom id sebagai primary key
            $table->date('tanggal')->nullable();
            $table->integer('data_barang_id')->nullable(); // Pastikan ini sesuai
            $table->integer('stok_awal')->nullable();
            $table->integer('pembelian')->nullable();
            $table->integer('penjualan')->nullable();
            $table->integer('stok_akhir')->nullable();
            $table->bigInteger('harga_beli')->nullable();
            $table->bigInteger('harga_jual')->nullable();
            $table->bigInteger('keuntungan')->nullable();
            $table->bigInteger('modal_per_akhir')->nullable();
            $table->bigInteger('sub_total')->nullable();
            $table->timestamps(); // Untuk created_at dan updated_at
            $table->foreign('data_barang_id')->references('id_barang')->on('data_barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
