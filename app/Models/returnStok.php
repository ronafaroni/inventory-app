<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnStok extends Model
{
    use HasFactory;

    protected $table = 'return_stok_sales';

    protected $primaryKey = 'id_return_stok_sales';

    protected $fillable = [
        'id_transaksi','kode_sales','nama_sales','return_stok','status'
    ];


}
