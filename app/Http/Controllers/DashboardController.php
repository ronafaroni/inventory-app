<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Stok;
use App\Models\Sales;
use App\Models\Toko;
use App\Models\StokSales;

class DashboardController extends Controller
{
    public function index()
    {
        // Query untuk menggabungkan dan menjumlahkan stok
        $stok_item = Item::with('stok')->sum('stok_item');
        $stok_stok = Stok::with('item')->sum('stok_item');
        $total_sales_stok = StokSales::with('stok_sales')->sum('stok_sales');
        $total_stok = $stok_item + $stok_stok;
        $total_sales = Sales::count();
        $total_toko = Toko::count();
        return view('admin/dashboard', compact('total_stok', 'total_sales', 'total_toko', 'total_sales_stok'));
    }

    public function cek()
    {
        // Query untuk menggabungkan dan menjumlahkan stok
        $total_stok = DB::table('items')
            ->leftJoin('stoks', 'items.kode_item', '=', 'stoks.kode_item')
            ->select('items.kode_item', 'items.nama_item', DB::raw('SUM(stoks.stok_item) as total_stok'))
            ->groupBy('items.kode_item', 'items.nama_item')
            ->get();

        return view('admin.cek', compact('total_stok'));
    }

}
