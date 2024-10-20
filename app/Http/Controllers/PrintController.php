<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printFaktur()
    {
        // Contoh data yang akan dicetak
        $data = [
            'tanggal' => now()->format('d-m-Y H:i:s'),
            'items' => [
                ['nama' => 'Produk A', 'jumlah' => 2, 'harga' => '5000'],
                ['nama' => 'Produk B', 'jumlah' => 1, 'harga' => '10000'],
            ],
            'total' => '20000',
        ];

        return view('print', $data);
    }
}
