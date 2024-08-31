@extends('template-user.index')

@section('content-user')
    <!-- Page Header -->
    <br>

        <!-- Page Header -->
        <div class="page-header">
            <div class="content-page-header">
                <div class="list-btn">
                    <ul class="filter-list">
                        <li>
                            <a href="{{ route('stok-masuk-sales', $barang->id_toko) }}" class="btn btn-import me-2">
                                <i class="fa fa-folder-plus me-1"></i> Tambah Stok
                            </a> 
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    <div class="page-header">
        <div class="content-page-header">
            <h2>{{ $barang->nama_toko }}</h2>
            <table class="table">
                <tr>
                    <td>
                        <span>Kode : {{ $barang->kode_toko }}</span>
                    </td>
                    <td>
                        <span>No. Telp : {{ $barang->no_telp }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Pemilik Toko : {{ $barang->pemilik_toko }}</p>
                    </td>
                    <td>
                        <p>Alamat : {{ $barang->alamat }}</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- /Page Header -->

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat! </strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! </strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if ($faktur->isEmpty())
    <div class="alert alert-warning" role="alert">
        Data kosong
    </div>
    @else
        @foreach ($faktur as $item)
        <div class="card mb-3">
            <a href="{{ route('faktur-bayar', $item->no_faktur_barang) }}"> 
                <div class="card-body">
                    <p class="card-title">Faktur Setor Barang</p>
                    <h5 class="card-title">{{ $item->no_faktur_barang }}</h5>
                    <hr>
                    <table>
                        <tr>
                            <td>
                                <p class="card-text">Stok (pcs): {{ $item->total_stok_toko ?? 0 }}</p>
                            </td>
                            <td>
                                <p class="card-text">Sisa (pcs): {{ $item->total_sisa_stok_toko ?? 0 }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="card-text">Total Harga: {{ $item->total_harga ?? 0 }}</p>
                            </td>
                            <td>
                                <p class="card-text">Total Pembayaran: {{ $item->setor_gudang ?? 0 }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="card-text">Create at: {{ $item->created_at ?? 0 }}</p>
                            </td>
                            <td>
                                <p class="card-text">Update at: {{ $item->updated_at ?? 0 }}</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </a>
        </div>

        @endforeach
    @endif

@endsection
