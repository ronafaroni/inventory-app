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
        Schema::create('sales', function (Blueprint $table) {
            $table->id('id_sales')->autoIncrement();
            $table->string('kode_sales');
            $table->string('nama_sales');
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('foto');
            $table->string('username');
            $table->string('password');
            $table->string('pencapaian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
