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
        Schema::create('data_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('package');
            $table->bigInteger('harga_beli');
            $table->bigInteger('harga_jual');
            $table->integer('id_kategori');
            $table->integer('stok')->nullable();
            $table->integer('id_supplier');
            $table->timestamps();

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_supplier')->references('id_supplier')->on('data_supplier')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_barang');
    }
};
