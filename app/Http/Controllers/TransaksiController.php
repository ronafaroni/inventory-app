<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Harga;
use App\Models\Item;
use App\Models\Faktur;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function harga()
    {
        $harga = Harga::with('item')->get();
        return view('transaksi.harga', compact('harga'));
    }

    public function tambah_harga()
    {
        $items = Item::all();
        return view('transaksi.tambah-harga', compact('items'));
    }

    public function edit_harga($id_harga)
    {
        $harga = Harga::with('item')->find($id_harga);
        return view('transaksi.edit-harga', compact('harga'));
    }

    public function simpan_harga(Request $request){

        $validated = $request->validate([
            'kode_item' => 'required',
            'harga' => 'required',
            'diskon' => 'required',
        ]);

        $harga = new Harga();
        $harga->kode_item = $request->kode_item;
        $harga->harga = $request->harga;
        $harga->diskon = $request->diskon;
        $harga->harga_diskon = $request->harga_diskon;
        $harga->save();

        session()->flash('success', 'Data harga berhasil ditambahkan.');
        return redirect()->route('harga');
    }

    public function update_harga(Request $request, $id_harga){

        $request->validate([
            'kode_item' => 'required',
            'harga' => 'required',
            'diskon' => 'required',
        ]);

        $harga = Harga::findOrFail($id_harga);
        $harga->kode_item = $request->kode_item;
        $harga->harga = $request->harga;
        $harga->diskon = $request->diskon;
        $harga->harga_diskon = $request->harga_diskon;
        $harga->update();

        session()->flash('update', 'Data harga berhasil perbaharui.');
        return redirect()->route('harga');
    }

    public function delete_harga($id_harga){

        $harga = Harga::findOrFail($id_harga);
        $harga->delete();
        
        session()->flash('delete', 'Data harga berhasil di hapus.');
        return redirect()->route('harga');
    }

    public function faktur_terima_barang()
    {
        $faktur_barang = Faktur::with(['item', 'sales', 'toko'])
            ->select(
                'no_faktur_barang',
                'no_faktur_bayar',
                DB::raw('MAX(kode_toko) as kode_toko'),
                DB::raw('MAX(kode_sales) as kode_sales'),
                DB::raw('SUM(stok_toko) as total_stok_toko'),
                DB::raw('SUM(total_harga) as total_harga'),
                DB::raw('MAX(created_at) as created_at')
            )
            ->groupBy('no_faktur_barang', 'no_faktur_bayar')
            ->get();

        return view('transaksi.faktur-terima-barang', compact('faktur_barang'));
    }
 
    public function detail_faktur_barang($no_faktur_barang)
    {
        $faktur_barang = Faktur::with('item','sales','toko')->where('no_faktur_barang', $no_faktur_barang)->first();
            
        $detail_faktur_barang = Faktur::with('item','sales','toko')->where('no_faktur_barang', $no_faktur_barang)->get();
        return view('transaksi.detail-faktur-barang', compact('faktur_barang', 'detail_faktur_barang'));
    }

    public function faktur_pembayaran()
    {
        $faktur_bayar = Faktur::with(['item', 'sales', 'toko'])
            ->select(
                'no_faktur_bayar',
                DB::raw('MAX(kode_toko) as kode_toko'),
                DB::raw('MAX(kode_sales) as kode_sales'),
                DB::raw('SUM(stok_toko) as total_stok_toko'),
                DB::raw('SUM(stok_terjual) as total_stok_terjual'),
                DB::raw('SUM(total_bayar) as total_bayar'),
                DB::raw('SUM(stok_return) as stok_return'),
                DB::raw('SUM(sisa_stok_toko) as sisa_stok_toko'),
                DB::raw('SUM(setor_gudang) as setor_gudang'),
                DB::raw('MAX(created_at) as created_at')
            )
            ->whereNotNull('no_faktur_bayar')
            ->groupBy('no_faktur_bayar')
            ->get();

        return view('transaksi.faktur-pembayaran', compact('faktur_bayar'));
    }
 
    public function detail_faktur_bayar($no_faktur_bayar)
    {
        $faktur_bayar = Faktur::with('item','sales','toko')->where('no_faktur_bayar', $no_faktur_bayar)->first();
            
        $detail_faktur_bayar = Faktur::with('item','sales','toko')->where('no_faktur_bayar', $no_faktur_bayar)->get();
        return view('transaksi.detail-faktur-bayar', compact('faktur_bayar', 'detail_faktur_bayar'));
    }

    public function update_faktur_bayar(Request $request, $id_faktur)
    {
        $faktur = Faktur::findOrFail($id_faktur);
        $faktur->setor_gudang = $request->setor_gudang;
        $faktur->update();

        $request->session()->flash('update', 'Data faktur bayar berhasil di update.');
        return view('transaksi.faktur-pembayaran');
    }

}
