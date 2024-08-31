<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan';

    protected $primaryKey = 'id_kunjungan';

    protected $fillable = [
        'id_kunjungan', 'id_toko', 'kode_toko', 'nama_toko', 'pemilik_toko', 'kode_sales', 'nama_sales', 'latitude', 'longitude'
    ];

    public function toko()
    {
        return $this->hasMany(Toko::class, 'kode_sales', 'kode_sales');
    }

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'kode_sales', 'kode_sales');
    }

    
}
