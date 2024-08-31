@extends('app.index', ['title' => 'Faktur Barang'])

@section('content-app')

<br>
<div class="text-right">
    <a href="{{ route('app-tambah-stok', $barang->id_toko) }}" class="btn btn-addon btn-primary waves-effect"><i class="fa fa-cart-plus"></i>Tambah Stok</a>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-card">
            <div class="item">
                <img src="{{ asset($barang->gambar_toko) }}" class="w-full r-t" style="max-width: 100%; max-height: 30%; height: auto;" />
                <div class="bottom text-white p">
                    <h3><b>{{$barang->nama_toko}}</b></h3>
                    <p>Kode. {{$barang->kode_toko}}</p>
                </div>
            </div>

            <div class="p">
                <div class="row">
                    <div class="col-xs-6">
                        <p>Pemilik : {{$barang->pemilik_toko}}</p>
                        <p>Alamat : {{$barang->alamat}}</p>
                    </div>
                    <div class="col-xs-6">
                        <p>Jumlah Stok (pcs) : {{ $barang->faktur->sum('stok_toko') - $barang->faktur->sum('stok_terjual') - $barang->faktur->sum('stok_return') ?? 0 }}</p>
                        <p>Jumlah Penjualan (pcs) : {{ $barang->faktur->sum('stok_terjual') ?? 0 }}</p>
                    </div>                        
                </div>
            </div>
            <div class="p">
                @foreach ($faktur as $item)
                    <a href="{{ route('app-faktur-bayar', $item->no_faktur_barang) }}">
                        <div class="card">
                            <div class="card-body bg-light lt">
                                <p>Faktur Setor Barang</p>
                                <h4><b>{{$item->no_faktur_barang}}</b></h4>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-6">
                                        Stok (pcs): {{ $item->total_stok_toko ?? 0 }}<br>
                                        Total Harga : {{ number_format($item->total_harga) ?? 0 }}
                                    </div>
                                    <div class="col-xs-6">
                                        Sisa : {{ $item->total_stok_toko - $item->total_stok_terjual - $item->total_return ?? 0 }}<br>
                                        Pembayaran : {{ number_format($item->total_bayar) ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>        
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
