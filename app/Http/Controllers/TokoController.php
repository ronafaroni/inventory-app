<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Toko;
use DNS1D;
use DNS2D;

class TokoController extends Controller 
{
    public function daftar_toko()
    {
        $toko = Toko::all();
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
        return view('toko.tambah-toko', compact('data_sales'));
    }

    public function simpan_toko(Request $request)
    {
        $request->validate([
            'kode_toko' => 'required',
            'nama_toko' => 'required',
            'pemilik_toko' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'link_gmap' => 'required',
            'kode_sales' => 'required',
            'gambar_toko' => 'required',
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

    public function update_toko(Request $request, $id_toko)
    {
        $request->validate([
            'kode_toko' => 'required',
            'nama_toko' => 'required',
            'pemilik_toko' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'link_gmap' => 'required',
            'kode_sales' => 'required',
            'gambar_toko' => 'required',
        ],
        [
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
        $toko = Toko::find($id_toko);
        $toko->kode_toko = $request->input('kode_toko');
        $toko->nama_toko = $request->input('nama_toko');
        $toko->pemilik_toko = $request->input('pemilik_toko');
        $toko->no_telp = $request->input('no_telp');
        $toko->alamat = $request->input('alamat');
        $toko->link_gmap = $request->input('link_gmap');
        $toko->kode_sales = $request->input('kode_sales');
        $toko->gambar_toko = $tujuan_upload . $nama_file;
        $toko->barcode = $barcode;
        $toko->update();

        session()->flash('update', 'Data toko berhasil diupdate.');

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

    public function download_barcode($kode_toko)
    {
        // Generate barcode
        $barcode = DNS2D::getBarcodePNG($kode_toko, 'QRCODE');

        // Set the content type and download headers
        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="barcode.png"',
        ];

        // Convert the barcode to image data
        $imageData = base64_decode($barcode);

        return response($imageData, 200, $headers);
    }

}
