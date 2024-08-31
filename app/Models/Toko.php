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

    public function sales1()
    {
        return $this->hasMany(Sales::class, 'kode_toko');
    }

    public function faktur1()
    {
        return $this->hasManyThrough(Faktur::class, Sales::class, 'kode_toko', 'kode_toko');
    }


    public function sales()
    {
        return $this->belongsTo(Sales::class, 'kode_sales', 'kode_sales', 'nama_sales');
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'kode_sales');
    }

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class, 'kode_toko', 'kode_toko');
    }
    


}
