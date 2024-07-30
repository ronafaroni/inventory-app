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
        Schema::create('stok_sales', function (Blueprint $table) {
            $table->id('id_stok_sales')->autoIncrement();
            $table->string('id_transaksi');
            $table->string('kode_sales');
            $table->string('nama_sales');
            $table->string('kode_item');
            $table->string('nama_item');
            $table->string('stok_sales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_sales');
    }
};
