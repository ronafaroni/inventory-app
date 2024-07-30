<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
