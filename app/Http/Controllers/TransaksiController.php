<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Harga;
use App\Models\Item;

class TransaksiController extends Controller
{
    public function harga()
    {
        $harga = Harga::all();
        return view('transaksi.harga', compact('harga'));
    }

    public function tambah_harga()
    {
        $items = Item::all();
        return view('transaksi.tambah-harga', compact('items'));
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

        $request->session()->flash('success', 'Data harga berhasil ditambahkan.');
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
        return view('transaksi.faktur-terima-barang');
    }

    public function faktur_pembayaran()
    {
        return view('transaksi.faktur-pembayaran');
    }
}
