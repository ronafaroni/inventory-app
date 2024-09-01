<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\Faktur;
use App\Models\Sales;
use App\Models\Item;
use App\Models\Harga;
use App\Models\StokSales;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DNS1D;
use PDF;

class AppController extends Controller
{
    public function index()
    {
        $tittle = ['title' => 'Dashboard'];
        return view('app.index', $tittle);
    }

    public function app_toko_sales()
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
                DB::raw('IFNULL(SUM(faktur.stok_return), 0) as total_return')
            )
            ->groupBy('toko.kode_toko', 'toko.nama_toko', 'toko.pemilik_toko', 'toko.alamat', 'faktur.kode_sales')
            ->where('faktur.kode_sales', $kode)
            ->get();

        return view('app.toko.app-toko-sales', compact('toko', 'stok_toko'));
    }

    public function app_faktur_barang($kode_toko)
    {
        $sales = Auth::guard('sales')->user()->kode_sales;
        
        $barang = Toko::with('faktur')
        ->where('kode_toko', $kode_toko)
        ->first();

        $faktur = Faktur::where('kode_sales', $sales)
            ->where('kode_toko', $kode_toko)
            ->select(
                'no_faktur_barang', 
                DB::raw('SUM(stok_toko) as total_stok_toko'), 
                DB::raw('SUM(total_harga) as total_harga'),
                DB::raw('SUM(sisa_stok_toko) as total_sisa_stok_toko'),
                DB::raw('SUM(stok_terjual) as total_stok_terjual'),
                DB::raw('SUM(total_bayar) as total_bayar'),
                DB::raw('SUM(stok_return) as total_return'))

            ->groupBy('no_faktur_barang')
            ->get();

        return view('app.faktur.app-faktur-barang', compact('faktur', 'barang'));
    }

    public function app_faktur_bayar($no_faktur_barang)
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
            DB::raw('SUM(sisa_stok_toko) as total_sisa_stok_toko'),
            DB::raw('SUM(stok_terjual) as total_stok_terjual'),
            DB::raw('SUM(total_bayar) as total_bayar'),
            DB::raw('SUM(stok_return) as total_return'))
        ->groupBy('no_faktur_barang')
        ->get();

        $faktur_bayar = Faktur::where('kode_sales', $sales)
            ->where('no_faktur_barang', $no_faktur_barang)
            ->select(
                'no_faktur_barang', 'no_faktur_bayar',
                DB::raw('SUM(stok_toko) as total_stok_toko'), 
                DB::raw('SUM(total_harga) as total_harga'),
                DB::raw('SUM(sisa_stok_toko) as total_sisa_stok_toko'),
                DB::raw('SUM(stok_terjual) as total_stok_terjual'),
                DB::raw('SUM(total_bayar) as total_bayar'),
                DB::raw('SUM(stok_return) as total_return'),
                DB::raw('SUM(setor_gudang) as total_setor_gudang'))
            ->groupBy('no_faktur_barang', 'no_faktur_bayar')
            ->get();

        return view('app.faktur.app-faktur-bayar', compact('faktur', 'no_faktur', 'faktur_pembayaran', 'faktur_bayar'));
    }

    public function app_tambah_toko()
    {
        return view('app.toko.app-tambah-toko');
    }

    public function app_simpan_toko(Request $request)
    {
        $request->validate([
            'kode_toko' => 'required|unique:toko,kode_toko',
            'nama_toko' => 'required',
            'pemilik_toko' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'link_gmap' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'kode_toko.unique' => 'Kode Toko sudah ada.',
            'kode_toko.required' => 'Kode Toko harus diisi.',
            'nama_toko.required' => 'Nama harus diisi.',
            'pemilik_toko.required' => 'Pemilik Toko harus diisi.',
            'no_telp.required' => 'Nomor Telepon harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'link_gmap.required' => 'Link Google Maps harus diisi.',
            'kode_sales.required' => 'Kode Sales harus diisi.',
            'gambar.required' => 'Gambar Toko harus diisi.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'File harus berupa jpeg, png, jpg.',
            'gambar.max' => 'File tidak boleh lebih dari 2 MB.',
        ]);

        //Membuat barcode
        $barcode = 'BC'.time();  // Generate unique barcode

        // Proses upload file
        $file = $request->file('gambar');
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

        return redirect()->route('app-toko-sales', compact('toko_sales'));
    }

    public function app_tambah_stok($id_toko)
    {
        $kode = Auth::guard('sales')->user()->kode_sales;
        $sales = Sales::where('kode_sales', $kode)->first();
        $toko = Toko::where('id_toko', $id_toko)->first();
        $item = Item::all();
        return view('app.stok.app-tambah-stok', compact('sales', 'item', 'toko'));
    }

    public function app_simpan_faktur_barang(Request $request) {
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
    
        return redirect()->route('app-toko-sales');
    }

    public function app_detail_faktur_bayar($no_faktur_barang)
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

        return view('app.faktur.app-detail-faktur-bayar', compact('faktur', 'no_faktur', 'faktur_bayar'));
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

    public function appSaveTerjual(Request $request, $id_faktur)
    {
        $faktur = Faktur::find($request->id_faktur);
        $faktur->no_faktur_bayar = 'FP-'.$request->no_faktur_terjual;
        $faktur->stok_terjual = $request->jumlah_terjual;
        //untuk menentukan harga berdasarkan diskon
        $faktur->total_bayar = $request->jumlah_terjual * $request->harga * ((100 - $request->diskon) / 100);
        $faktur->sisa_stok_toko = $faktur->stok_toko - $request->jumlah_terjual;
        $faktur->update();

        return response()->json(['success' => true]);
    }

    public function appSaveReturn(Request $request, $id_faktur)
    {
        $faktur = Faktur::find($request->id_faktur);
        $faktur->no_faktur_bayar = 'FP-'.$request->no_faktur_return;
        $faktur->stok_return = $request->jumlah_return;
        $faktur->sisa_stok_toko = $request->sisa_stok - $faktur->stok_return;
        $faktur->update();

        return response()->json(['success' => true]);
    }

    public function appProfile()
    {
        $sales = Auth::guard('sales')->user()->kode_sales; 
        $data = Sales::with('toko', 'faktur')->where('kode_sales', $sales)->first();
        $stok = StokSales::where('kode_sales', $sales)
            ->select(DB::raw('SUM(stok_sales) as total_stok_sales'))
            ->first();

        $stok_terjual = Faktur::where('kode_sales', $sales)
            ->select(DB::raw('SUM(stok_terjual) as total_stok_terjual'))
            ->first();

        
        //Mengambil data stok sales dan menghitung total stok serta penjualan terjual berdasarkan kode_sales
        $stok_sales = StokSales::leftJoin('faktur', 'stok_sales.kode_item', '=', 'faktur.kode_item')
        ->where('stok_sales.kode_sales', '=', $sales) // Filter stok_sales berdasarkan kode_sales
        ->where(function ($query) use ($sales) {
            $query->where('faktur.kode_sales', '=', $sales)
                ->orWhereNull('faktur.kode_sales');
        })
        ->select('stok_sales.kode_item', 'stok_sales.nama_item',
            DB::raw('SUM(DISTINCT stok_sales.stok_sales) as total_stok_sales'),
            DB::raw('SUM(faktur.stok_terjual) as total_stok_terjual'))
        ->groupBy('stok_sales.kode_item', 'stok_sales.nama_item')
        ->get();

    
        return view('app.profile.app-profile', compact('data', 'stok_sales', 'stok', 'stok_terjual'));
    }    

    public function cetak_faktur_barang($no_faktur_barang)
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
                DB::raw('SUM(sisa_stok_toko) as total_sisa_stok_toko'),
                DB::raw('SUM(stok_terjual) as total_stok_terjual'),
                DB::raw('SUM(total_bayar) as total_bayar'),
                DB::raw('SUM(stok_return) as total_return'))
            ->groupBy('no_faktur_barang')
            ->get();

        // // Siapkan data yang akan dikirimkan ke view
        // $data = [
        //     'no_faktur_barang' => $no_faktur->no_faktur_barang,
        //     'nama_sales' => $invoice->sales->nama_sales,
        //     'alamat' => now()->format('d/m/Y'),
        //     'pemilik_toko' => $invoice->invoice_number,
        //     'jumlah_stok' => $invoice->customer_name,
        //     'jumlah_penjualan' => $invoice->items, // Asumsikan `items` adalah relasi dengan detail faktur
        //     'jumlah_prnjualan_press' => $invoice->total,
        //     'jumlah_return' => $invoice->sisa_stok_toko,
        // ];

        // Load view dan konversi menjadi PDF
        $pdf = PDF::loadView('app.faktur.cetak-faktur-barang', compact('faktur', 'no_faktur', 'faktur_pembayaran'));

        // Kirim PDF sebagai respon ke browser
        return $pdf->download('invoice' . $no_faktur_barang . '.pdf');
    }

    public function cetak_faktur_pembayaran($no_faktur_barang)
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
                DB::raw('SUM(sisa_stok_toko) as total_sisa_stok_toko'),
                DB::raw('SUM(stok_terjual) as total_stok_terjual'),
                DB::raw('SUM(total_bayar) as total_bayar'),
                DB::raw('SUM(stok_return) as total_return'))
            ->groupBy('no_faktur_barang')
            ->get();

        // // Siapkan data yang akan dikirimkan ke view
        // $data = [
        //     'no_faktur_barang' => $no_faktur->no_faktur_barang,
        //     'nama_sales' => $invoice->sales->nama_sales,
        //     'alamat' => now()->format('d/m/Y'),
        //     'pemilik_toko' => $invoice->invoice_number,
        //     'jumlah_stok' => $invoice->customer_name,
        //     'jumlah_penjualan' => $invoice->items, // Asumsikan `items` adalah relasi dengan detail faktur
        //     'jumlah_prnjualan_press' => $invoice->total,
        //     'jumlah_return' => $invoice->sisa_stok_toko,
        // ];

        // Load view dan konversi menjadi PDF
        $pdf = PDF::loadView('app.faktur.cetak-faktur-bayar', compact('faktur', 'no_faktur', 'faktur_pembayaran'));

        // Kirim PDF sebagai respon ke browser
        return $pdf->download('invoice' . $no_faktur_barang . '.pdf');
    }

    public function app_cetak_faktur_barang($no_faktur_barang)
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
                DB::raw('SUM(sisa_stok_toko) as total_sisa_stok_toko'),
                DB::raw('SUM(stok_terjual) as total_stok_terjual'),
                DB::raw('SUM(total_bayar) as total_bayar'),
                DB::raw('SUM(stok_return) as total_return'))
            ->groupBy('no_faktur_barang')
            ->get();

        // Siapkan data yang akan dikirimkan ke view
        return view('app.faktur.app-cetak-faktur-barang', compact('faktur', 'no_faktur', 'faktur_pembayaran'));
    }


    public function app_cetak_faktur_pembayaran($no_faktur_barang)
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
                DB::raw('SUM(sisa_stok_toko) as total_sisa_stok_toko'),
                DB::raw('SUM(stok_terjual) as total_stok_terjual'),
                DB::raw('SUM(total_bayar) as total_bayar'),
                DB::raw('SUM(stok_return) as total_return'))
            ->groupBy('no_faktur_barang')
            ->get();

            // Siapkan data yang akan dikirimkan ke view
            return view('app.faktur.app-cetak-faktur-bayar', compact('faktur', 'no_faktur', 'faktur_pembayaran'));
    }

    public function appLogout (Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login-sales');
    }
}