<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    // Kolom primary key bukan 'id', tetapi 'id_item'
    protected $primaryKey = 'id_stok';
    protected $fillable = [
        'id_transaksi', 'kode_item', 'stok_item'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'kode_item', 'kode_item');
    }

}
