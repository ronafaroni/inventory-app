<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Harga;

class StokSales extends Model
{
    use HasFactory;

    // Kolom primary key bukan 'id', tetapi 'id_item'
    protected $primaryKey = 'id_stok_sales';

    protected $fillable = [
        'id_transaksi','kode_sales','nama_sales','stok_sales'
    ];

    public function sales()
    {
        return $this->hasMany(Sales::class, 'kode_sales', 'kode_sales');
    }

    public function faktur()
    {
        return $this->hasMany(Faktur::class, 'kode_item', 'kode_item');
    }

    public function data_faktur()
    {
        return $this->belongsTo(Faktur::class, 'kode_sales', 'kode_sales');
    }

    public function harga()
    {
        return $this->belongsTo(Harga::class, 'kode_item', 'kode_item'); // adjust the foreign key as necessary
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'kode_sales', 'kode_sales');
    }


}
