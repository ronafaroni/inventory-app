<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model implements AuthenticatableContract
{
    use HasFactory;

    use Authenticatable;

    // Tambahkan atribut lainnya yang diperlukan untuk model ini

    protected $primaryKey = 'id_sales';

    protected $fillable = ['
        id_sales', 'kode_sales', 'nama_sales', 'alamat', 'no_telp', 'username', 'password', 'pencapaian'
    ];

    public function stokSales()
    {
        return $this->hasMany(StokSales::class, 'kode_sales', 'kode_sales');
    }

    public function stok_sales()
    {
        return $this->hasMany(StokSales::class, 'kode_sales', 'kode_sales');
    }
}
