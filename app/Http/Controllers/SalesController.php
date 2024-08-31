<?php

namespace App\Http\Controllers;

use App\Models\ReturnStokSales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sales;
use App\Models\Item;
use App\Models\StokSales;
use App\Models\ReturnStok;
use App\Models\Faktur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class SalesController extends Controller
{
    public function tambah_sales()
    {
        return view('sales.tambah-sales');
    }
    public function daftar_sales()
    {
        $sales_data = Sales::with('faktur','kunjungan')->get();
        return view('sales.daftar-sales', compact('sales_data'));
    }

    public function detail_sales($kode_sales)
    {
        $sales = Sales::with('stokSales', 'faktur', 'toko')->where('kode_sales',$kode_sales)->get();
        
        $detail = StokSales::with(['faktur' => function($query) use ($kode_sales) {
            $query->where('kode_sales', $kode_sales);
        }])
        ->where('kode_sales', $kode_sales)
        ->select('kode_item', 'nama_item', DB::raw('SUM(stok_sales) as total_stok_sales'))
        ->groupBy('kode_item', 'nama_item')
        ->get();

        return view('sales/detail-sales', compact('sales', 'detail'));
    }

    public function stok_sales()
    {
        $sales = Sales::with('stokSales', 'faktur', 'toko')->get();

        return view('sales.stok-sales', compact('sales'));
    }

    public function stok_masuk($id_sales)
    {
        $data_item = Item::all();
        $data_sales = Sales::findOrFail($id_sales);
        return view('sales/tambah-stok-masuk', compact('data_sales','data_item'));
    }
    public function return_stok_sales($id_sales)
    {
        // Mengambil data sales berdasarkan id_sales
        $data_sales = Sales::findOrFail($id_sales);

        // Mengambil dan mengelompokkan data item berdasarkan kode_sales dari data_sales
        $data_item = StokSales::where('kode_sales', $data_sales->kode_sales)
        ->select('kode_item', DB::raw('MAX(nama_item) as nama_item'))
        ->groupBy('kode_item')
        ->get();

        return view('sales.return-stok-sales', compact('data_sales', 'data_item'));
    }
    public function tambah_stok_sales()
    {
        $data_sales = Sales::all();
        $data_item = Item::all();
        return view('sales/tambah-stok-sales', compact('data_sales','data_item'));
    }

    public function riwayat_sales()
    {
        $riwayat_sales = StokSales::all();
        return view('sales/riwayat-sales', compact('riwayat_sales'));
    }

    public function return_stok()
    {
        //ini untuk menampilkan form return
        // $data_sales = Sales::all();
        // $data_item = Item::all();
        // return view('sales.return-stok', compact('data_sales','data_item'));

        $riwayat_return_stok = ReturnStok::all();
        return view('sales.riwayat-return-stok-sales', compact('riwayat_return_stok'));
    }

    public function tambah_return_stok(){
        $data_sales = Sales::all();
        $data_item = Item::all();
        return view('sales/tambah-return-stok', compact('data_sales','data_item'));
    }

    // Simpan Item
    public function kirim_sales(Request $request){
    
        $sales = Sales::all();
        $validated = $request->validate([
            'kode_sales' => 'required|unique:sales,kode_sales',
            'nama_sales' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'username' => 'required',
            'password' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ],
        [
            'unique' => 'Kolom :attribute sudah ada.',
            'required' => 'Kolom :attribute wajib diisi.',
            'image' => 'Kolom :attribute harus berupa gambar.',
            'mimes' => 'Kolom :attribute harus memiliki format file :values.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max kb.'
        ]);

        // Proses upload file
        $file = $request->file('foto');
        $nama_file = $request->input('nama_sales') . '.' . $file->getClientOriginalExtension();
        // Tujuan file diupload kemana
        $tujuan_upload = '/uploads/sales/';
        // Tempat file diupload
        $file->move(public_path($tujuan_upload), $nama_file);

        // Simpan ke database
        $sales = new Sales;
        $sales->kode_sales = $request->input('kode_sales');
        $sales->nama_sales = $request->input('nama_sales');
        $sales->alamat = $request->input('alamat');
        $sales->no_telp = $request->input('no_telp');
        $sales->username = $request->input('username');
        $sales->password = Hash::make($request->input('password')); // Simpan password yang telah di-hash
        $sales->foto = $tujuan_upload . $nama_file;
        $sales->pencapaian = 1;
        $sales->save();
    
        // Redirect ke halaman daftar item
        session()->flash('success', 'Sales baru ditambahkan');

        return redirect()->route('daftar-sales');

    }

public function update_sales(Request $request, $id_sales)
{
    // Cari sales berdasarkan ID
    $sales = Sales::findOrFail($id_sales);

    // Validasi input
    $validated = $request->validate([
        'kode_sales' => [
            'required',
            Rule::unique('sales', 'kode_sales')->ignore($sales->kode_sales, 'kode_sales'),
        ],
        'nama_sales' => 'required',
        'alamat' => 'required',
        'no_telp' => 'required',
        'username' => 'required',
        'password' => 'nullable', // Password hanya perlu validasi jika ada input
        'foto' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5000' // Foto opsional
    ], [
        'unique' => 'Kolom :attribute sudah ada.',
        'required' => 'Kolom :attribute wajib diisi.',
        'nullable' => 'Kolom :attribute tidak wajib diisi.',
        'image' => 'Kolom :attribute harus berupa gambar.',
        'mimes' => 'Kolom :attribute harus memiliki format file :values.',
        'max' => 'Kolom :attribute tidak boleh lebih dari :max kb.',
        'min' => 'Kolom :attribute harus memiliki minimal :min karakter.'
    ]);

    // Proses upload file jika ada gambar baru
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $nama_file = $request->input('nama_sales') . '.' . $file->getClientOriginalExtension();
        $tujuan_upload = '/uploads/sales/';
        $file->move(public_path($tujuan_upload), $nama_file);
        $sales->foto = $tujuan_upload . $nama_file;
    }

    // Update data lainnya
    $sales->kode_sales = $request->input('kode_sales');
    $sales->nama_sales = $request->input('nama_sales');
    $sales->alamat = $request->input('alamat');
    $sales->no_telp = $request->input('no_telp');
    $sales->username = $request->input('username');

    // Update password jika ada input
    if ($request->filled('password')) {
        $sales->password = Hash::make($request->input('password'));
    }

    $sales->pencapaian = 1;
    $sales->update();

    // Flash message ke sesi
    session()->flash('update', 'Data sales diperbarui');

    // Redirect ke halaman daftar item
    return redirect()->route('daftar-sales');
}

    //delete sales
    public function delete_sales (Request $request, $id_sales){
        $sales_hapus = Sales::findOrFail($id_sales);
        $sales_hapus->delete();

        // Flash message ke sesi
        session()->flash('delete', 'Data berhasil dihapus!');

        return redirect()->route('daftar-sales');
    }

    public function edit_sales($id_sales){
        $sales = Sales::findOrFail($id_sales);
        return view('sales/edit-sales', compact('sales'));
    }
    
    // Simpan Tambahan Stok
    public function simpan_stok_sales(Request $request)
    {
        // Mendekode data JSON yang dikirim dari form
        $data = json_decode($request->data, true);

        // Periksa apakah data berhasil didekode dan merupakan array
        if (is_array($data) && !empty($data)) {
            // Melakukan loop pada setiap item dan menyimpannya ke dalam database
            foreach ($data as $sales) {
                // Simpan ke database
                $stok_sales = new StokSales();
                $stok_sales->id_transaksi = 'SS' . rand(10000, 99999);
                $stok_sales->kode_sales = $sales['kodeSales'];
                $stok_sales->nama_sales = $sales['namaSales'];
                $stok_sales->kode_item = $sales['kodeItem'];
                $stok_sales->nama_item = $sales['namaItem'];
                $stok_sales->stok_sales = $sales['tambahStok'];
                $stok_sales->save();
            }

            // Flash message ke sesi
            session()->flash('success', 'Stok Sales berhasil ditambahkan.');
        } else {
            // Flash message ke sesi untuk error
            session()->flash('error', 'Data tidak valid atau kosong.');
        }

        // Redirect
        return redirect()->route('stok-sales');
    }

    public function riwayat_stok_sales($kode_sales) {
        // Query untuk mendapatkan riwayat stok berdasarkan kode_sales dan mengelompokkan berdasarkan kode_item
        $riwayat_stok = DB::table('stok_sales')
            ->select('kode_item','nama_item', 'nama_sales', DB::raw('SUM(stok_sales) as total_stok_sales'))
            ->where('kode_sales', $kode_sales)
            ->groupBy('kode_item', 'nama_item', 'nama_sales')
            ->get();

        // Mengirimkan data riwayat stok ke view
        $data_sales = Sales::where('kode_sales', $kode_sales)->first();
    
        return view('sales/riwayat-stok-sales', compact('riwayat_stok', 'data_sales'));
    }
    
    public function delete_stok_sales(Request $request, $id_stok_sales)
    {   
        $stok_sales = StokSales::findOrFail($id_stok_sales);
        $stok_sales->delete();

         // Flash message ke sesi
         session()->flash('delete', 'Data stok salesberhasil dihapus!');

         return redirect()->route('riwayat-sales');
    }
 
    public function simpan_return_stok_sales(Request $request){

        // Mendekode data JSON yang dikirim dari form
        $data = json_decode($request->input('data'), true);

        // Melakukan loop pada setiap item dan menyimpannya ke dalam database
        foreach ($data as $sales) {
            // Simpan ke database
            $return_stok = new ReturnStok();
            $return_stok->id_transaksi = 'RS'.rand(10000, 99999);
            $return_stok->kode_sales   = $sales['kodeSales'];
            $return_stok->nama_sales   = $sales['namaSales'];
            $return_stok->kode_item    = $sales['kodeItem'];
            $return_stok->nama_item    = $sales['namaItem'];
            $return_stok->return_stok  = $sales['returnStok'];
            $return_stok->status       = $sales['status'];
            $return_stok->save();
        }

        // Flash message ke sesi
        session()->flash('success', 'Return Stok Sales berhasil di tambahkan.');

        // Redirect
        return redirect()->route('return-stok');
    }

    public function delete_return_stok($id_return_stok) {
        $return_stok = ReturnStokSales::findOrFail($id_return_stok);
        $return_stok->delete();

         // Flash message ke sesi
         session()->flash('delete', 'Data return stok sales berhasil dihapus!');

         return redirect()->route('return-stok');

    }

    public function update_pencapaian_sales(Request $request)
    {
        $sales = Sales::findOrFail($request->id_sales);
        $sales->pencapaian = $request->pencapaian;
        $sales->update();

        session()->flash('success', 'Pencapaian Sales berhasil diupdate.');
        return redirect()->route('stok-sales');
    }

    public function target_sales(Request $request)
    {
        $sales = Sales::all();
        return view('sales.target-sales', compact('sales'));
    }

}   
