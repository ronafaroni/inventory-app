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
        Schema::create('toko', function (Blueprint $table) {
            $table->id('id_toko')->autoIncrement();
            $table->string('kode_toko');
            $table->string('nama_toko');
            $table->string('pemilik_toko');
            $table->string('no_telp');
            $table->string('alamat');
            $table->string('link_gmap');
            $table->string('kode_sales');
            $table->string('gambar_toko');
            $table->string('barcode')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toko');
    }
};
