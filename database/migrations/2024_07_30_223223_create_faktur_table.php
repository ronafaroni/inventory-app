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
        Schema::create('faktur', function (Blueprint $table) {
            $table->id('id_faktur')->autoIncrement();
            $table->string('no_faktur_barang')->nullable();
            $table->string('kode_item')->nullable();
            $table->string('nama_item')->nullable();
            $table->string('kode_toko')->nullable();
            $table->string('kode_sales')->nullable();
            $table->string('stok_toko')->nullable();
            $table->string('satuan')->nullable();
            $table->string('harga')->nullable();
            $table->string('diskon')->nullable();
            $table->string('total_harga')->nullable();
            $table->string('no_faktur_bayar')->nullable();
            $table->string('stok_terjual')->nullable();
            $table->string('stok_return')->nullable();
            $table->string('sisa_stok_toko')->nullable();
            $table->string('total_bayar')->nullable();
            $table->string('setor_gudang')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faktur');
    }
};
