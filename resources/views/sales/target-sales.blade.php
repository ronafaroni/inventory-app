@extends('template-admin.index')

@section('content-admin')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Target Sales</h5>
        </div>
    </div>
    <!-- /Page Header -->
    
    <div class="row">
        <div class="col-sm-12">
            <div class="card-table">
                <div class="card-body">
                    <div class="form-group-item border-0 mb-0">
                        <div class="row align-item-center">
                            <div class="col-lg-12 col-md-6 col-sm-12">    
                                <form id="dataForm" action="{{ route('pencarian-target-sales') }}" method="GET">
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-block mb-3">
                                                <input type="date" id="tgl_awal" name="tgl_awal" class="form-control form-small" placeholder="Tanggal Awal" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-block mb-3">
                                                <input type="date" id="tgl_akhir" name="tgl_akhir" class="form-control form-small" placeholder="Tanggal Akhir" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <button type="submit" id="addData" class="btn btn-primary"><i class="fa fa-search me-2" aria-hidden="true"></i>Pencarian Data</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-center table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>ID Sales</th>
                                    <th>Nama Sales</th>
                                    <th>Kunjungan</th>
                                    <th>Jumlah Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($sales as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->kode_sales }}</td>
                                    <td>{{ $data->nama_sales }}</td>
                                    <td>{{ $data->total_kunjungan ?? 0 }}</td>
                                    <td>{{ number_format($data->total_penjualan) ?? 0 }} Pcs</td>
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
