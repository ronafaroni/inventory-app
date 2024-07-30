<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Kolom primary key bukan 'id', tetapi 'id_item'
    protected $primaryKey = 'id_item';

    protected $fillable = [
        'id_item','nama_item','stok_item','gambar_produk'
    ];

    public function stoks()
    {
        return $this->hasMany(Stok::class, 'kode_item', 'kode_item');
    }

    public function stok_sales()
    {
        return $this->hasMany(StokSales::class, 'kode_item', 'kode_item');
    }



}


