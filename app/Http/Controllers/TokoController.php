<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Toko; 
use App\Models\Faktur;
use DNS1D;
use DNS2D;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TokoController extends Controller 
{
    public function daftar_toko()
    {
        $toko = Toko::with('faktur', 'sales', 'kunjungan')->get();
        // Generate barcode for each store
        // Generate barcode for each store
        foreach ($toko as $data) {
            $data->barcode = DNS1D::getBarcodeHTML($data->kode_toko, 'C39');
        }

        return view('toko.daftar-toko', compact('toko'));
    }

    public function tambah_toko()
    {
        $data_sales = Sales::all();
        $toko = Toko::all();
        return view('toko.tambah-toko', compact('data_sales', 'toko'));
    } 

    public function simpan_toko(Request $request)
    {
        $request->validate([
            'kode_toko' => 'required|unique:toko,kode_toko',
            'nama_toko' => 'required',
            'pemilik_toko' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'link_gmap' => 'required',
            'kode_sales' => 'required',
            'gambar_toko' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'mimes' => 'File harus berformat :values.',
            'max' => 'Ukuran file maksimal :max KB.',
            'kode_toko.unique' => 'Kode Toko sudah ada.',
            'kode_toko.required' => 'Kode Toko harus diisi.',
            'nama_toko.required' => 'Nama harus diisi.',
            'pemilik_toko.required' => 'Pemilik Toko harus diisi.',
            'no_telp.required' => 'Nomor Telepon harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'link_gmap.required' => 'Link Google Maps harus diisi.',
            'kode_sales.required' => 'Kode Sales harus diisi.',
            'gambar_toko.required' => 'Gambar Toko harus diisi.',
        ]);

        //Membuat barcode
        $barcode = 'BC'.time();  // Generate unique barcode

        // Proses upload file
        $file = $request->file('gambar_toko');
        $nama_file = $request->input('nama_toko') . '.' . $file->getClientOriginalExtension();
        // Tujuan file diupload kemana
        $tujuan_upload = '/uploads/toko/';
        // Tempat file diupload
        $file->move(public_path($tujuan_upload), $nama_file);

        // Simpan ke database
        $toko = new Toko;
        $toko->kode_toko = $request->input('kode_toko');
        $toko->nama_toko = $request->input('nama_toko');
        $toko->pemilik_toko = $request->input('pemilik_toko');
        $toko->no_telp = $request->input('no_telp');
        $toko->alamat = $request->input('alamat');
        $toko->link_gmap = $request->input('link_gmap');
        $toko->kode_sales = $request->input('kode_sales');
        $toko->gambar_toko = $tujuan_upload . $nama_file;
        $toko->barcode = $barcode;
        $toko->save();

        session()->flash('success', 'Data toko berhasil ditambahkan.');

        $toko = Toko::all();
        foreach ($toko as $data) {
            $data->barcode = DNS1D::getBarcodeHTML($data->kode_toko, 'C39');
        }

        return redirect()->route('daftar-toko', compact('toko'));
    }

    public function edit_toko($id)
    {
        $toko = Toko::find($id);
        $data_sales = Sales::all();
        return view('toko.edit-toko', compact('toko', 'data_sales'));
    }

    public function update_capaian(Request $request, $id_toko)
    {
        $toko = Toko::find($id_toko);
        $toko->pencapaian = $request->pencapaian;
        $toko->update();

        session()->flash('update', 'Pencapaian toko berhasil dibuat.');
        return redirect()->route('daftar-toko');
    }

    public function detail_toko($kode_toko)
    {
        $data_toko = Toko::where('kode_toko', $kode_toko)->first();
        $data_terjual = Faktur::where('kode_toko', $kode_toko)->get();
        $detail = DB::table('faktur')
        ->join('sales', 'faktur.kode_sales', '=', 'sales.kode_sales')
        ->where('faktur.kode_toko', $kode_toko)
        ->select('faktur.kode_item', 'faktur.nama_item', DB::raw('SUM(faktur.stok_toko) as total_stok'),DB::raw('SUM(faktur.stok_terjual) as total_stok_terjual'),DB::raw('SUM(faktur.stok_return) as total_stok_return') ,'sales.kode_sales', 'sales.nama_sales', )
        ->groupBy('faktur.kode_item', 'faktur.nama_item', 'sales.kode_sales', 'sales.nama_sales')
        ->get();

        return view('toko.detail-toko', compact('data_toko', 'data_terjual', 'detail'));
    }

    public function update_toko(Request $request, $id_toko)
{
    // Cari toko berdasarkan ID
    $toko = Toko::findOrFail($id_toko);

    // Validasi input
    $validated = $request->validate([
        'kode_toko' => [
            'required',
            Rule::unique('toko', 'kode_toko')->ignore($toko->kode_toko, 'kode_toko'),
        ],
        'nama_toko' => 'required',
        'pemilik_toko' => 'required',
        'no_telp' => 'required',
        'alamat' => 'required',
        'link_gmap' => 'required',
        'kode_sales' => 'required',
        'gambar_toko' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Hanya divalidasi jika ada file
    ],
    [
        'mimes' => 'File harus berformat :values.',
        'max' => 'Ukuran file maksimal :max KB.',
        'kode_toko.unique' => 'Kode Toko sudah ada.',
        'kode_toko.required' => 'Kode Toko harus diisi.',
        'nama_toko.required' => 'Nama harus diisi.',
        'pemilik_toko.required' => 'Pemilik Toko harus diisi.',
        'no_telp.required' => 'Nomor Telepon harus diisi.',
        'alamat.required' => 'Alamat harus diisi.',
        'link_gmap.required' => 'Link Google Maps harus diisi.',
        'kode_sales.required' => 'Kode Sales harus diisi.',
        'gambar_toko.sometimes' => 'Gambar Toko harus berupa gambar.',
    ]);

    // Membuat barcode
    $barcode = 'BC' . time();  // Generate unique barcode

    // Proses upload file jika ada gambar baru
    if ($request->hasFile('gambar_toko')) {
        $file = $request->file('gambar_toko');
        $nama_file = $request->input('nama_toko') . '.' . $file->getClientOriginalExtension();
        $tujuan_upload = '/uploads/toko/';
        $file->move(public_path($tujuan_upload), $nama_file);
        $toko->gambar_toko = $tujuan_upload . $nama_file; // Update gambar
    }

    // Update data toko lainnya
    $toko->kode_toko = $request->input('kode_toko');
    $toko->nama_toko = $request->input('nama_toko');
    $toko->pemilik_toko = $request->input('pemilik_toko');
    $toko->no_telp = $request->input('no_telp');
    $toko->alamat = $request->input('alamat');
    $toko->link_gmap = $request->input('link_gmap');
    $toko->kode_sales = $request->input('kode_sales');
    $toko->barcode = $barcode;
    $toko->update(); // Simpan perubahan ke database

    // Flash message ke sesi
    session()->flash('update', 'Data toko berhasil diupdate.');

    // Ambil semua data toko untuk tampilan
    $toko = Toko::all();
    foreach ($toko as $data) {
        $data->barcode = DNS1D::getBarcodeHTML($data->kode_toko, 'C39');
    }

    return redirect()->route('daftar-toko', compact('toko'));
}


    public function delete_toko($id_toko)
    {
        $toko = Toko::find($id_toko);
        $toko->delete();
        session()->flash('delete', 'Data toko berhasil dihapus.');
        return redirect()->route('daftar-toko');
    }

    public function download_barcode($id_toko)
    {
        // Generate barcode
        $barcode = DNS2D::getBarcodePNG($id_toko, 'QRCODE'); 

        // Set the content type and download headers
        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="Barcode-' . $id_toko . '.png"',
        ];

        // Convert the barcode to image data
        $imageData = base64_decode($barcode);

        return response($imageData, 200, $headers);
    }

}