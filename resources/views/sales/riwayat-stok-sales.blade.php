
@extends('template-admin.index')

@section('content-admin')
<div class="signature-invoice">
    <div class="page-header">
        <div class="content-page-header">
            <h5>Riwayat Stok Sales</h5>
        </div>    
    </div>                  
    <div class="row">
        <div class="col-md-12">
            <div class="edit-card">
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
                        {{-- <tr>
                            <td width="10%">Nama Toko</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td width="10%">Kode Toko</td>
                            <td>: </td>
                        </tr> --}}
                        {{-- <tr>
                            <td width="10%">Pemilik Toko</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td width="10%">Alamat</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td width="10%">Link Gmap</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td width="10%">Total Penjualan (pcs)</td>
                            <td>: <td>
                        </tr> --}}
                        {{-- <tr>
                            <td width="10%">Total Penjualan (press)</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td width="10%">Pencapaian</td>
                            <td>: </td>
                        </tr> --}}
                        <tr>
                            <td width="10%">Nama Sales</td>
                            <td>: {{ $data_sales->nama_sales }}<td>
                        </tr>
                        <tr>
                            <td width="10%">Kode Sales</td>
                            <td>: {{ $data_sales->kode_sales }} <td>
                        </tr>
                        {{-- <tr>
                            <td width="10%">Stok Sisa (pcs)</td>
                            <td>: </td>
                        </tr> --}}
                        {{-- <tr>
                            <td width="10%">Stok Sekarang</td>
                            <td>:</td>
                        </tr> --}}
                        {{-- <tr>
                            <td width="10%">Stor Pembayaran ke Gudang</td>
                            <td>
                                <form action="{{ route('update-faktur-bayar', $faktur_bayar->id_faktur) }}" method="POST">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3">
                                        <input type="number" name="setor_gudang" id="setorGudang" class="form-control me-2" placeholder="Setor Gudang">
                                        <button type="submit" class="btn btn-import">Setor Gudang</button>
                                    </div>
                            </td>
                        </tr> --}}
                    </table>
                  
                    <div class="form-group-item">
                        <div class="card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-center table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Item</th>
                                                <th>Nama Item</th>
                                                <th>Stok (pcs)</th>
                                                {{-- <th class="no-sort">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($riwayat_stok as $stok)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $stok->kode_item }}</td>
                                                <td>{{ $stok->nama_item }}</td> 
                                                <td>{{ number_format($stok->total_stok_sales, 0, ',', '.') }}</td>
												{{-- <td>
													<a href="{{ route('return-stok-sales', $stok->kode_item) }}" class="btn btn-greys bg-primary-light me-2">
														<i class="fa fa-eye me-1"></i> View
													</a> 
												</td> --}}
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection


