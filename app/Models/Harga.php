<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StokSales;

class Harga extends Model
{
    use HasFactory;

    protected $table = 'harga';

    protected $primaryKey = 'id_harga';

    protected $fillable = [
        'id_harga',
        'kode_item',
        'harga',
        'diskon'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'kode_item', 'kode_item');
    }

    public function stok_sales()
    {
        return $this->belongsTo(stokSales::class, 'kode_item', 'kode_item');
    }


}
