<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sales;
use App\Models\Toko;
use App\Models\Item;
use App\Models\harga;
use App\Models\Faktur;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DNS1D;

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
        $stok_toko = DB::table('faktur')
            ->leftJoin('toko', 'faktur.kode_toko', '=', 'toko.kode_toko')
            ->select(
                'toko.kode_toko',
                'toko.nama_toko',
                'toko.pemilik_toko',
                'toko.alamat',
                'faktur.kode_sales',
                DB::raw('IFNULL(SUM(faktur.stok_toko), 0) as total_stok_toko'),
                DB::raw('IFNULL(SUM(faktur.stok_terjual), 0) as total_terjual'),
            )
            ->groupBy('toko.kode_toko', 'toko.nama_toko', 'toko.pemilik_toko', 'toko.alamat', 'faktur.kode_sales')
            ->where('faktur.kode_sales', $kode)
            ->get();

        return view('user.toko-sales', compact('toko', 'stok_toko'));
    }

    public function tambah_toko_sales()
    {
        $kode = Auth::guard('sales')->user()->kode_sales;
        return view('user.tambah-toko-sales', compact('kode'));
    }

    public function simpan_toko_sales(Request $request)
    {
        $request->validate([
            'kode_toko' => 'required',
            'nama_toko' => 'required',
            'pemilik_toko' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'link_gmap' => 'required',
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
        $toko = new Toko;
        $toko->kode_toko = $request->input('kode_toko');
        $toko->nama_toko = $request->input('nama_toko');
        $toko->pemilik_toko = $request->input('pemilik_toko');
        $toko->no_telp = $request->input('no_telp');
        $toko->alamat = $request->input('alamat');
        $toko->link_gmap = $request->input('link_gmap');
        $toko->kode_sales = Auth::guard('sales')->user()->kode_sales;
        $toko->gambar_toko = $tujuan_upload . $nama_file;
        $toko->barcode = $barcode;
        $toko->save();

        session()->flash('success', 'Data toko berhasil ditambahkan.');

        $toko_sales = Toko::all();
        foreach ($toko_sales as $data) {
            $data->barcode = DNS1D::getBarcodeHTML($data->kode_toko, 'C39');
        }

        return redirect()->route('toko-sales', compact('toko_sales'));
    }

    public function stok_masuk_sales($id_toko)
    {
        $kode = Auth::guard('sales')->user()->kode_sales;
        $sales = Sales::where('kode_sales', $kode)->first();
        $toko = Toko::where('id_toko', $id_toko)->first();
        $item = Item::all();
        return view('user.stok-masuk-sales', compact('sales', 'item', 'toko'));
    }

    public function getItemDetails($kode_item)
    {
        // Ambil data harga dan diskon berdasarkan kode item dari database
        $hargaDiskon = Harga::where('kode_item', $kode_item)->first(['harga', 'diskon']);

        if ($hargaDiskon) {
            return response()->json([
                'harga' => $hargaDiskon->harga,
                'diskon' => $hargaDiskon->diskon,
            ]);
        } else {
            return response()->json([
                'harga' => 0,
                'diskon' => 0,
            ]);
        }
    }


    public function simpan_faktur_barang(Request $request) {
        // Mendekode data JSON yang dikirim dari form
        $data = json_decode($request->input('data'), true);
    
        // Tambahkan logging untuk memeriksa data yang diterima
        Log::info('Data received:', ['data' => $data]);

        // Buat kode faktur unik sekali untuk seluruh batch
        $kodeFakturBarang = 'STB'.'.'.uniqid();
    
        if (is_array($data)) {
            foreach ($data as $item) {
                if (is_array($item) &&
                    isset($item['kodeItem']) && is_string($item['kodeItem']) &&
                    isset($item['namaItem']) && is_string($item['namaItem']) &&
                    isset($item['kodeToko']) && is_string($item['kodeToko']) &&
                    isset($item['stok']) && is_numeric($item['stok']) &&
                    isset($item['harga']) && is_numeric($item['harga']) &&
                    isset($item['diskon']) && is_numeric($item['diskon']) &&
                    isset($item['totalHarga']) && is_numeric($item['totalHarga'])
                ) {
                    $stok = new Faktur;
                    $stok->no_faktur_barang = Str::upper($kodeFakturBarang);
                    $stok->kode_item = $item['kodeItem'];
                    $stok->nama_item = $item['namaItem'];
                    $stok->kode_toko = $item['kodeToko'];
                    $stok->kode_sales = Auth::guard('sales')->user()->kode_sales;
                    $stok->stok_toko = $item['stok'];
                    $stok->harga = $item['harga'];
                    $stok->diskon = $item['diskon'];
                    $stok->total_harga = $item['totalHarga'];
                    $stok->save();
                } else {
                    Log::error('Invalid data item:', ['item' => $item]);
                    session()->flash('error', 'Data yang diberikan tidak lengkap atau tidak valid.');
                    return redirect()->route('tambah-stok');
                }
            }
            session()->flash('success', 'Stok Barang berhasil di tambahkan.');
        } else {
            Log::error('Invalid data format received:', ['data' => $data]);
            session()->flash('error', 'Data yang diberikan tidak valid.');
        }
    
        return redirect()->route('toko-sales');
    }

    public function faktur_barang($kode_toko)
    {
        $sales = Auth::guard('sales')->user()->kode_sales;
        
        $barang = Toko::where('kode_toko', $kode_toko)->first();

        $faktur = Faktur::where('kode_sales', $sales)
            ->where('kode_toko', $kode_toko)
            ->select(
                'created_at','updated_at',
                'no_faktur_barang', 
                DB::raw('SUM(stok_toko) as total_stok_toko'), 
                DB::raw('SUM(total_harga) as total_harga'),
                DB::raw('SUM(sisa_stok_toko) as total_sisa_stok_toko'))

            ->groupBy('no_faktur_barang', 'created_at', 'updated_at')
            ->get();

        return view('user.faktur-barang', compact('faktur', 'barang'));
    }

    public function faktur_bayar($no_faktur_barang)
    {
        $sales = Auth::guard('sales')->user()->kode_sales;

        $faktur = Faktur::where('kode_sales', $sales)
            ->where('no_faktur_barang', $no_faktur_barang)
            ->get();
        
        $no_faktur = Faktur::where('kode_sales', $sales)
            ->where('no_faktur_barang', $no_faktur_barang)
            ->first();

        $faktur_pembayaran = Faktur::where('kode_sales', $sales)
            ->where('no_faktur_barang', $no_faktur_barang)
            ->select(
                'no_faktur_barang', 
                DB::raw('SUM(stok_toko) as total_stok_toko'), 
                DB::raw('SUM(total_harga) as total_harga'),
                DB::raw('SUM(sisa_stok_toko) as total_sisa_stok_toko'))
            ->groupBy('no_faktur_barang')
            ->get();

        return view('user.faktur-bayar', compact('faktur', 'no_faktur', 'faktur_pembayaran'));
    }

    public function detail_faktur($no_faktur_barang)
    {
        $sales = Auth::guard('sales')->user()->kode_sales;

        $faktur = Faktur::where('kode_sales', $sales)
            ->where('no_faktur_barang', $no_faktur_barang)
            ->get();
        
        $no_faktur = Faktur::where('kode_sales', $sales)
            ->where('no_faktur_barang', $no_faktur_barang)
            ->first();

        $faktur_bayar = Faktur::where('kode_sales', $sales)
            ->where('no_faktur_barang', $no_faktur_barang)
            ->select(
                'created_at','updated_at',
                'no_faktur_barang', 
                DB::raw('SUM(stok_toko) as total_stok_toko'), 
                DB::raw('SUM(total_harga) as total_harga'),
                DB::raw('SUM(sisa_stok_toko) as total_sisa_stok_toko'))
            ->groupBy('no_faktur_barang', 'created_at', 'updated_at')
            ->get();

        return view('user.detail-faktur-bayar', compact('faktur', 'no_faktur', 'faktur_bayar'));
    }

    public function saveTerjual(Request $request, $id_faktur)
    {
        $faktur = Faktur::find($request->id_faktur);
        $faktur->no_faktur_bayar = 'FP-'.$request->no_faktur_terjual;
        $faktur->stok_terjual = $request->jumlah_terjual;
        //untuk menentukan harga berdasarkan diskon
        $faktur->total_bayar = $request->jumlah_terjual * $request->harga * ((100 - $request->diskon) / 100);
        $faktur->sisa_stok_toko = $faktur->stok_toko - $request->jumlah_terjual;
        $faktur->update();
    }

    public function saveReturn(Request $request, $id_faktur)
    {
        $faktur = Faktur::find($request->id_faktur);
        $faktur->no_faktur_bayar = 'FP-'.$request->no_faktur_return;
        $faktur->stok_return = $request->jumlah_return;
        $faktur->sisa_stok_toko = $request->sisa_stok - $faktur->stok_return;
        $faktur->update();
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
