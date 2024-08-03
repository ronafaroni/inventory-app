<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Toko;

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
    ];

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'kode_toko', 'kode_toko');
    }
}
