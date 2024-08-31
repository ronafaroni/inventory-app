@extends('template-admin.index')

@section('content-admin')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Detail Faktur Pembayaran</h5>
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
                            <td width="10%">No. Faktur Bayar</td>
                            <td>: {{ $faktur_bayar->no_faktur_bayar }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Nama Sales</td>
                            <td>: {{ $faktur_bayar->sales->kode_sales }} | {{ $faktur_bayar->sales->nama_sales }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Toko</td>
                            <td>: {{ $faktur_bayar->toko->kode_toko }} | {{ $faktur_bayar->toko->nama_toko }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Pemilik</td>
                            <td>: {{ $faktur_bayar->toko->pemilik_toko }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Total Setor (pcs)</td>
                            <td>: {{ $faktur_bayar->stok_toko }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Total Jual (Rp.)</td>
                            <td>: {{ number_format($faktur_bayar->stok_terjual) }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Total Return (Rp.)</td>
                            <td>: {{ number_format($faktur_bayar->stok_return) }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Sisa</td>
                            <td>: {{ number_format($faktur_bayar->sisa_stok_toko) }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Total Pembayaran</td>
                            <td>: {{ number_format($faktur_bayar->total_harga) }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Create at</td>
                            <td>: {{ $faktur_bayar->created_at }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Update at</td>
                            <td>: {{ $faktur_bayar->updated_at }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Stor Pembayaran ke Gudang</td>
                            <td>: {{ number_format($faktur_bayar->setor_gudang) }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Stor Pembayaran ke Gudang</td>
                            <td>
                                <form action="{{ route('update-faktur-bayar', $faktur_bayar->id_faktur) }}" method="POST">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3">
                                        <input type="number" name="setor_gudang" id="setorGudang" class="form-control me-2" placeholder="Setor Gudang">
                                        <button type="submit" class="btn btn-import">Setor Gudang</button>
                                    </div>
                            </td>
                        </tr>
                    </table>
                    
                    <div class="table-responsive">
                        <table class="table table-center table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>ID Item</th>
                                    <th>Nama Item</th>
                                    <th>Harga (Rp.)</th>
                                    <th>Diskon (%)</th>
                                    <th>Total Harga</th>
                                    <th>Setor (pcs)</th>
                                    <th>Jual (pcs)</th>
                                    <th>Return (pcs)</th>
                                    <th>Sisa (pcs)</th>
                                    <th>Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rows will be added here dynamically -->
                                @php
                                    $no = 1;
                                @endphp

                                @foreach ($detail_faktur_bayar as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->item->kode_item }}</td>
                                        <td>{{ $item->item->nama_item }}</td>
                                        <td>{{ number_format($item->harga) }}</td>
                                        <td>{{ $item->diskon }} %</td>
                                        <td>{{ number_format($item->total_harga) }}</td>
                                        <td>{{ number_format($item->stok_toko) }}</td>
                                        <td>{{ number_format($item->stok_terjual) }}</td>
                                        <td>{{ number_format($item->stok_return) }}</td>
                                        <td>{{ number_format($item->sisa_stok_toko) }}</td>
                                        <td>{{ number_format($item->setor_gudang) }}</td>
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