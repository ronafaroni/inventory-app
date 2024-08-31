@extends('template-admin.index')

@section('content-admin')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Detail Faktur Stor Barang</h5>
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
                    <table class="table"> 
                        <tr>
                            <td width="10%">No. Faktur Barang</td>
                            <td>: {{ $faktur_barang->no_faktur_barang }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Nama Sales</td>
                            <td>: {{ $faktur_barang->sales->kode_sales }} | {{ $faktur_barang->sales->nama_sales }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Toko</td>
                            <td>: {{ $faktur_barang->toko->kode_toko }} | {{ $faktur_barang->toko->nama_toko }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Pemilik</td>
                            <td>: {{ $faktur_barang->toko->pemilik_toko }}</td>
                        </tr>
                        {{-- <tr>
                            <td width="10%">Stor (pcs)</td>
                            <td>: {{ $faktur_barang->stok_toko }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Total Harga</td>
                            <td>: {{ number_format($faktur_barang->total_harga) }}</td>
                        </tr> --}}
                        <tr>
                            <td width="10%">Create at</td>
                            <td>: {{ $faktur_barang->created_at }}</td>
                        </tr>
                    </table>
                    <div class="table-responsive">
                        <table class="table table-center table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>ID Item</th>
                                    <th>Nama Item</th>
                                    <th>Tambah Stok (pcs)</th>
                                    <th>Harga (Rp.)</th>
                                    <th>Diskon (%)</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rows will be added here dynamically -->
                                @php
                                    $no = 1;
                                @endphp

                                @foreach ($detail_faktur_barang as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->item->kode_item }}</td>
                                        <td>{{ $item->item->nama_item }}</td>
                                        <td>{{ $item->stok_toko }}</td>
                                        <td>{{ number_format($item->harga) }}</td>
                                        <td>{{ $item->diskon }} %</td>
                                        <td>{{ number_format($item->total_harga) }}</td>
                                    </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()