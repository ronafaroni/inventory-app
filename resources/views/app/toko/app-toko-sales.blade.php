@extends('app.index', ['title' => 'Toko Sales'])

@section('content-app')
    <br>
    <div class="text-right">
        <a href="{{ route('app-tambah-toko') }}" class="btn btn-addon btn-primary waves-effect"><i class="fa fa-plus"></i>Tambah Toko</a>
    </div>
    <br>

    @if(session('success'))
    <div class="alert alert-primary" role="alert">
            <strong>Selamat! </strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('update'))
    <div class="alert alert-primary" role="alert">
            <strong>Selamat! </strong> {{ session('update') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('delete'))
    <div class="alert alert-primary" role="alert">
            <strong>Selamat! </strong> {{ session('delete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @foreach ($toko as $data)
        <a href="{{ route('app-faktur-barang', $data->kode_toko) }}">
        <div class="row">
            <div class="col-sm-12">
            <div class="panel panel-card">
                <div class="item">
                    <img src="{{ asset($data->gambar_toko) }}" class="w-full r-t" style="max-width: 100%; max-height: 30%; height: auto;" />
                <div class="bottom text-white p">
                    <h3><b>{{$data->nama_toko}}</b></h3>
                    <p>{{$data->pemilik_toko}}</p>
                </div>
                </div>

                @php
                    $stokTokoData = $stok_toko->firstWhere('kode_toko', $data->kode_toko);
                @endphp

    
                <div class="p">
                <p>Kode Toko : {{ $data->kode_toko }}</p>
                <p>Alamat : {{ $data->alamat }}</p>
                <p>Jumlah Stok : {{ $stokTokoData ? ($stokTokoData->total_stok_toko - $stokTokoData->total_terjual - $stokTokoData->total_return) : 0 }}</Jumlah>
                <p>Jumlah Penjualan : {{ $stok_toko->firstWhere('kode_toko', $data->kode_toko)->total_terjual ?? 0 }} pcs</p>
                </div>
            </div>
            </div>
        </div>
        </a>
    @endforeach

  @endsection