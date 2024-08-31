<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kunjungan;
use App\Models\Toko;
use Illuminate\Support\Facades\Auth;

class KunjunganController extends Controller
{
    public function appKunjungan(Request $request)
    {
        return view('app.kunjungan.app-kunjungan');
    }

    public function appSimpanKunjungan(Request $request)
    {
        $validated = $request->validate([
            'id_toko' => 'required|numeric',
            'kode_toko' => 'required|string',
            'nama_toko' => 'required|string',
            'pemilik_toko' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',    
        ]);
    
            // Simpan data ke dalam tabel kunjungan atau tabel terkait lainnya
        $kunjungan = new Kunjungan();
        $kunjungan->id_toko = $validated['id_toko'];
        $kunjungan->kode_toko = $validated['kode_toko'];
        $kunjungan->nama_toko = $validated['nama_toko'];
        $kunjungan->pemilik_toko = $validated['pemilik_toko'];
        $kunjungan->kode_sales = Auth::guard('sales')->user()->kode_sales;
        $kunjungan->nama_sales = Auth::guard('sales')->user()->nama_sales;
        $kunjungan->latitude = $validated['latitude'];
        $kunjungan->longitude = $validated['longitude'];
        $kunjungan->save();

        session()->flash('success', 'Data kunjungan berhasil disimpan');
        return redirect('app-daftar-kunjungan');
    }

public function getToko($id_toko)
{
    $toko = Toko::where('id_toko', $id_toko)->first();

    if ($toko) {
        return response()->json([
            'success' => true,
            'toko' => [
                'kode_toko' => $toko->kode_toko,
                'nama_toko' => $toko->nama_toko,
                'pemilik_toko' => $toko->pemilik_toko
            ]
        ]);
    }

    return response()->json(['success' => false, 'message' => 'Toko tidak ditemukan']);
}


    public function saveToko(Request $request)
    {
        $toko = Kunjungan::updateOrCreate(
            ['kode_toko' => $request->input('kode_toko')],
            [
                'nama_toko' => $request->input('nama_toko'),
                'alamat_toko' => $request->input('alamat_toko')
            ]
        );

        return response()->json(['success' => true, 'message' => 'Data Toko berhasil disimpan']);
    }

    public function appDaftarKunjungan()
    {
        $kunjungan = Kunjungan::where('kode_sales', Auth::guard('sales')->user()->kode_sales)->get();
        return view('app.kunjungan.app-daftar-kunjungan', compact('kunjungan'));
    }


}
