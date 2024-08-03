@extends('template-user.index')

@section('content-user')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Faktur Barang</h5>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-table">
                <div class="card-body">
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

                    <div class="table-responsive">
                        <table class="table table-center table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>No Faktur Barang</th>
                                    <th>Jumlah Item</th>
                                    <th>Total Harga</th>
                                    <th class="no-sort"> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($faktur as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->no_faktur_barang }}</td>
                                        <td>{{ $item->total_stok_toko }}</td>
                                        <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td class="d-flex align-items-center">
                                            <a href="{{ route('faktur-bayar', $item->no_faktur_barang) }}" class="btn btn-greys bg-history-light me-2" >
                                                <i class="fa fa-file-alt me-1"></i> Faktur Pembayaran
                                            </a> 
                                            <a href" class="btn btn-greys bg-success-light me-2">
                                                <i class="fa fa-print me-1"></i> Cetak Faktur Barang
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
    </div>
@endsection
