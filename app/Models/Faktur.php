<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Toko;
use App\Models\Sales;
use App\Models\Item;

class Faktur extends Model
{
    use HasFactory;

    protected $table = 'faktur';

    protected $primaryKey = 'id_faktur';

    protected $fillable = [ 
        'no_faktur_barang',
        'kode_item',
        'nama_item',
        'kode_toko',
        'kode_sales',
        'stok_toko',
        'harga',
        'diskon',
        'total_harga',
        'setor_gudang'
    ];
    
    // public function toko()
    // {
    //     return $this->belongsTo(Toko::class, 'kode_toko', 'kode_sales');
    // }

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'kode_toko', 'kode_toko');
    }

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'kode_sales', 'kode_sales');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'kode_item', 'kode_item');
    }

    public function tokos()
    {
        return $this->hasMany(Toko::class, 'kode_toko', 'kode_toko');
    }

    public function saless()
    {
        return $this->hasMany(Sales::class, 'kode_sales', 'kode_sales');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'kode_item', 'kode_item');
    }

    public function sales1()
    {
        return $this->belongsTo(Sales::class, 'kode_toko');
    }

    public function faktur()
    {
        return $this->hasMany(Faktur::class, 'kode_item', 'kode_item');
    }

    // Assuming you have a relation back to StokSales
    public function stokSales()
    {
        return $this->belongsTo(StokSales::class, 'kode_item', 'kode_item', 'kode_sales');
    }

    public function data_stok_sales()
    {
        return $this->hasMany(StokSales::class, 'kode_sales', 'kode_sales');
    }

}
