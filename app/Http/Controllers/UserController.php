<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sales;
use App\Models\Toko;

class UserController extends Controller
{
    public function users()
    {
        return view('user.app');
    }

    public function toko_sales()
    {
        $kode = Auth::guard('sales')->user()->kode_sales;
        $toko = Toko::where('kode_sales', $kode)->get();
        return view('user.toko-sales', compact('toko'));
    }

    public function kunjungan()
    {
        return view('user.kunjungan');
    }

    public function profile()
    {
        return view('user.profile');
    }

}
