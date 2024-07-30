<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Stok;
use App\Models\StokSales;

class ItemController extends Controller
{
    public function tambah_item()
    {
        $items = Item::all();
        return view('item/tambah-item', compact('items'));
    }

    public function daftar_item()
    {
        $items = Item::all();
        return view('item/daftar-item', compact('items'));
    }

    public function edit_item($id_item){
        $item = Item::findOrFail($id_item);
        return view('item/edit-item', compact('item'));
    }

    //delete item
    public function delete_item (Request $request, $id_item){
        $item = Item::findOrFail($id_item);
        $item->delete();

        // Flash message ke sesi
        session()->flash('delete', 'Data berhasil dihapus!');

        return redirect()->route('daftar-item');
    }

    //delete stok
    public function delete_stok (Request $request, $id_stok){
        $stok = Stok::findOrFail($id_stok);
        $stok->delete();

        // Flash message ke sesi
        session()->flash('delete', 'Data berhasil dihapus!');

        return redirect()->route('riwayat-stok');
    }

    public function stok_barang()
    {
        // Query untuk menggabungkan dan menjumlahkan stok
        $items = DB::table('items')
            ->leftJoin('stoks', 'items.kode_item', '=', 'stoks.kode_item')
            ->leftJoin('stok_sales', 'items.kode_item', '=', 'stok_sales.kode_item') // Memperbaiki join di sini
            ->select(
                'items.kode_item',
                'items.nama_item',
                DB::raw('IFNULL(SUM(stoks.stok_item), 0) as total_stok'),
                DB::raw('IFNULL(SUM(items.stok_item), 0) as total_stok_items'),
                DB::raw('IFNULL(SUM(stok_sales.stok_sales), 0) as total_stok_sales') // Memperbaiki nama kolom di sini
            )
            ->groupBy('items.kode_item', 'items.nama_item')
            ->get();
    
        return view('item/stok-barang', compact('items'));
    }
    

    public function tambah_stok()
    {
        $items = Item::all();
        return view('item/tambah-stok', compact('items'));
    }

    public function riwayat_stok()
    {
        $stoks = Stok::with('item')->get();
        return view('item/riwayat-stok', compact('stoks'));
    }   

    // Simpan Item
    public function simpan_item(Request $request){

        // Validasi form input item
        $validated = $request->validate([
            'kode_item' => 'required',
            'nama_item' => 'required',
            'stok_item' => 'required',
            'upload_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'image' => 'Kolom :attribute harus berupa gambar.',
            'mimes' => 'Kolom :attribute harus memiliki format file :values.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max kb.'
        ]);

        // Proses upload file
        $file = $request->file('upload_gambar'); 
        $nama_file = $request->input('nama_item') . '.' . $file->getClientOriginalExtension();
        // Tujuan file diupload kemana
        $tujuan_upload = '/uploads/item/';
        // Tempat file diupload
        $file->move(public_path($tujuan_upload), $nama_file);

        // Simpan ke database
        $item = new Item;
        $item->kode_item = $request->input('kode_item');
        $item->nama_item = $request->input('nama_item');
        $item->stok_item = $request->input('stok_item'); // Pastikan kolom ini sesuai dengan inputan form
        $item->gambar_produk = $tujuan_upload . $nama_file;
        $item->save();

        // Untuk menampilkan data item
        $items = Item::all();

        // Flash message ke sesi
        session()->flash('success', 'Data berhasil disimpan!');

        // Redirect
        return redirect()->route('daftar-item', compact('items'));
    }

    //Update Item  
    public function update_item(Request $request, $id_item){

        // Validasi form input item
        $validated = $request->validate([
            'kode_item' => 'required',
            'nama_item' => 'required',
            'stok_item' => 'required',
            'upload_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'image' => 'Kolom :attribute harus berupa gambar.',
            'mimes' => 'Kolom :attribute harus memiliki format file :values.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max kb.'
        ]);

        // Proses upload file
        $file = $request->file('upload_gambar');
        $nama_file = $request->input('nama_item') . '.' . $file->getClientOriginalExtension();
        // Tujuan file diupload kemana
        $tujuan_upload = '/uploads/item/';
        // Tempat file diupload
        $file->move(public_path($tujuan_upload), $nama_file);

        // Simpan ke database
        $item = Item::findOrFail($id_item);
        $item->kode_item = $request->input('kode_item');
        $item->nama_item = $request->input('nama_item');
        $item->stok_item = $request->input('stok_item'); // Pastikan kolom ini sesuai dengan inputan form
        $item->gambar_produk = $tujuan_upload . $nama_file;
        $item->update();

        // Untuk menampilkan data item
        $items = Item::all();

             // Flash message ke sesi
             session()->flash('update', 'Data berhasil diperbarui!');

        // Redirect
        return view('item/daftar-item', compact('items'));
    }

    // Simpan Tambahan Stok
    public function simpan_stok(Request $request){

        // Mendekode data JSON yang dikirim dari form
        $data = json_decode($request->input('data'), true);

        // Melakukan loop pada setiap item dan menyimpannya ke dalam database
        foreach ($data as $item) {
            // Simpan ke database
            $stok = new Stok;
            $stok->id_transaksi = 'SB'.rand(10000, 99999);
            $stok->kode_item    = $item['kodeItem'];
            $stok->stok_item    = $item['stokItem'];
            $stok->save();
        }

        // Flash message ke sesi
        session()->flash('success', 'Stok Barang berhasil di tambahkan.');

        // Redirect
        return redirect()->route('tambah-stok');

    }

}
