@extends('template-admin.index')

@section('content-admin')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Faktur Pembayaran</h5>
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
                                    <th>Faktur Barang</th>
                                    <th>Nama Toko</th>
                                    <th>Sales</th>
                                    <th>Setor (pcs)</th>
                                    <th>Jual (Rp.)</th>
                                    <th>Sisa (pcs)</th>
                                    <th>Return (pcs)</th>
                                    <th>Pembayaran</th>
                                    <th>Setor Gudang</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($faktur_bayar as $dt)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $dt->no_faktur_bayar }}</td>
                                        <td>{{ $dt->toko->nama_toko ?? '-' }}</td>
                                        <td>{{ $dt->sales->nama_sales ?? '-' }}</td>
                                        <td>{{ number_format($dt->total_stok_toko, 0, ',', '.') }}</td>  
                                        <td>{{ number_format($dt->sisa_stok_toko, 0, ',', '.') }}</td>                                      <td>{{ $dt->total_stok_terjual }}</td>
                                        <td>{{ number_format($dt->stok_return, 0, ',', '.') }}</td>
                                        <td>{{ number_format($dt->total_bayar, 0, ',', '.') }}</td>
                                        <td>
                                            {{ $dt->setor_gudang || $dt->setor_gudang > 0 ? 'Sudah' : 'Belum' }}
                                        </td>
                                        <td class="d-flex align-items-center">
                                            <a href="{{ route('detail-faktur-bayar', $dt->no_faktur_bayar) }}" class="btn btn-greys bg-history-light me-2">
                                                <i class="fa fa-file me-1"></i> Setor Gudang
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
