@extends('template-admin.index')

@section('content-admin')
<!-- /Main Menu -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-1">
                            <i class="fas fa-cubes"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Stok Barang</div>
                            <div class="dash-counts">
                                <p>{{ number_format($total_stok - $total_sales_stok) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-4">
                            <i class="fa fa-shopping-basket"></i>
                        </span> 
                        <div class="dash-count">
                            <div class="dash-title">Stok Sales</div>
                            <div class="dash-counts">
                                <p>{{ number_format($total_sales_stok - $stok_toko) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-2">
                            <i class="fas fa-store"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Stok Toko</div>
                            <div class="dash-counts">
                                <p>{{ $stok_toko - $stok_terjual }}</<p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-3">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">Toko | Sales</div>
                            <div class="dash-counts">
                                <p>{{ $total_toko }} | {{ $total_sales }}</</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Menu -->

    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Aktifitas Terkini</h5>
            {{-- <div class="list-btn">
                <ul class="filter-list">
                    <li>
                        <a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Filter"><span class="me-2"><img src="assets/img/icons/filter-icon.svg" alt="filter"></span>Filter </a>
                    </li>
                </ul>
            </div> --}}
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Table -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-table"> 
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-stripped table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                   <th>#</th>
                                   <th>ID Sales</th>
                                   <th>Nama Sales</th>
                                   <th>Nama Toko</th>
                                   <th>Lokasi Kunjungan</th>
                                   <th>Tanggal, Jam</th>	
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kunjungan as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>	
                                    <td>{{ $data->kode_sales }}</td>													
                                    <td>{{ $data->nama_sales }}</td>													
                                    <td>{{ $data->nama_toko }}</td>
                                    <td>
                                        <a href="https://www.google.com/maps?q={{ $data->latitude }},{{ $data->longitude }}" target="_blank">
                                            {{ $data->latitude }}, {{ $data->longitude }}
                                        </a>
                                    </td>
                                    <td>{{ $data->created_at }}</td>
                                </tr>
                                @endforeach           						
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Table -->

@endsection