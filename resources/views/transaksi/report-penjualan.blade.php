@extends('template-admin.index')

@section('content-admin')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Report Penjualan</h5>
            <div class="list-btn">
                <ul class="filter-list">
                    <li>
                        <a class="btn btn-primary" href="{{ route('export-penjualan') }}"><i class="fa fa-file-excel me-2" aria-hidden="true"></i>Export Excel</a>
                    </li>
                </ul>
            </div>
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
                                    <th>ID Sales</th>
                                    <th>Nama Sales</th>
                                    <th>ID Toko</th>
                                    <th>Nama Toko</th>
                                    <th>ID Item</th>
                                    <th>Nama Item</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Nominal Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faktur_bayar as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->sales->kode_sales }}</td>
                                    <td>{{ $item->sales->nama_sales }}</td>
                                    <td>{{ $item->toko->kode_toko }}</td>
                                    <td>{{ $item->toko->nama_toko }}</td>
                                    <td>{{ $item->item->kode_item }}</td>
                                    <td>{{ $item->item->nama_item }}</td>
                                    <td>{{ number_format($item->total_terjual) }}</td>
                                    <td>{{ number_format($item->total_bayar) }}</td>
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
