<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Toko extends Model
{
    use HasFactory;

    protected $table = 'toko';

    protected $primaryKey = 'id_toko';

    protected $fillable = [
        'kode_toko',
        'nama_toko',
        'pemilik_toko',
        'alamat',
        'no_telp',
        'telepon',
        'link_gmap',
        'nama_sales'
    ];

    public function faktur()
    {
        return $this->hasMany(Faktur::class, 'kode_toko', 'kode_toko');
    }

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'kode_sales', 'kode_sales', 'nama_sales');
    }
}
