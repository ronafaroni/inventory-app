<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
