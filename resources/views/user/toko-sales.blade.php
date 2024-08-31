@extends('template-user.index')

@section('content-user')

    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <div class="list-btn">
                <ul class="filter-list">
                    <li>
                        <a class="btn btn-primary fixed" href="{{ route('tambah-toko-sales') }}">
                            <i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Tambah Toko
                          </a>                          
                    </li>
                </ul>
            </div>
        </div>
    </div>
    

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Selamat! </strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('update'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Selamat! </strong> {{ session('update') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Selamat! </strong> {{ session('delete') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- /Page Header -->
    
    {{-- <div class="row">
        <div class="col-sm-12">
            <div class="card-table">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Selamat! </strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('update'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Selamat! </strong> {{ session('update') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Selamat! </strong> {{ session('delete') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-center table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Kode Toko</th>
                                    <th>Nama Toko</th>
                                    <th>Pemilik</th>
                                    <th>Alamat</th>
                                    <th>Jumlah Stok</th>
                                    <th>Jumlah Penjualan</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp

                                @foreach ($toko as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->kode_toko }}</td>
                                    <td>{{ $data->nama_toko }}</td>
                                    <td>{{ $data->pemilik_toko }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $stok_toko->firstWhere('kode_toko', $data->kode_toko)->total_stok_toko ?? 0 }}</td>
                                    <td>{{ $data->kode_sales }}</td>
                               
                                    <td class="d-flex align-items-center">
                                        <a href="{{ route('faktur-barang', $data->kode_toko) }}" class="btn btn-greys bg-history-light me-2" >
                                            <i class="far fa-eye me-1"></i> Faktur
                                        </a> 
                                        <a href="{{ route('stok-masuk-sales', $data->id_toko) }}" class="btn btn-greys bg-success-light me-2">
                                            <i class="fa fa-folder-plus me-1"></i> Stok
                                        </a> 
                                        <a href="{{ route('stok-keluar-sales', $data->id_toko) }}" class="btn btn-greys bg-danger-light me-2">
                                            <i class="fa fa-folder-minus me-1"></i> Return
                                        </a> 
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    @foreach ($toko as $data)
        <div class="card">
            <a href="{{ route('faktur-barang', $data->kode_toko) }}">
            <div class="card-body">
                <h2>{{ $data->nama_toko }}</h2>
                <p class="mb-0">Kode. {{ $data->kode_toko }}</p>
                <hr>
                <p class="mb-0">Pemilik : {{ $data->pemilik_toko }}</p>
                <p class="mb-0">Alamat : {{ $data->alamat }}</p>
                <p class="mb-0">Jumlah Stok : {{ $stok_toko->firstWhere('kode_toko', $data->kode_toko)->total_stok_toko ?? 0 }} pcs</p>
                <p class="mb-0">Jumlah Penjualan : {{ $stok_toko->firstWhere('kode_toko', $data->kode_toko)->total_terjual ?? 0 }} pcs</p>
            </div>
            </a>
        </div>
    @endforeach

@endsection
