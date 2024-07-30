@extends('template-admin.index')

@section('content-admin')
    	<!-- Page Header -->
        <div class="page-header">
            <div class="content-page-header ">
                <h5>Stok Sales</h5>
                <div class="list-btn">
                    <ul class="filter-list">
                        <li class="">
                            <div class="dropdown dropdown-action" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="download">
                                <a href="#" class="btn-filters" data-bs-toggle="dropdown" aria-expanded="false"><span><i class="fe fe-download"></i></span></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="d-block">
                                        <li>
                                            <a class="d-flex align-items-center download-item" href="javascript:void(0);" download><i class="far fa-file-pdf me-2"></i>PDF</a>
                                        </li>
                                        <li>
                                            <a class="d-flex align-items-center download-item" href="javascript:void(0);" download><i class="far fa-file-text me-2"></i>CVS</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>														
                        </li>
                        <li>
                            <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="print"><span><i class="fe fe-printer"></i></span> </a>
                        </li>
                        <li>
                            <a class="btn btn-primary" href="{{ route('tambah-sales') }}"><i class="fa fa-user-plus me-2" aria-hidden="true"></i>Tambah Sales</a>
                        </li>
                        <li>
                            <a href="{{ route('tambah-stok-sales') }}" class="btn btn-import" href="javascript:void(0);"><span><i class="fa fa-cart-plus me-2"></i>Tambah Stok Sales</span></a>
                        </li>
                    </ul>	
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <!-- Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class=" card-table">
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
                                        <th>Stok (pcs)</th>
                                        <th>Setor Toko (pcs)</th>
                                        <th>Jual (pcs)</th>
                                        <th>Toko</th>
                                        <th class="no-sort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($sales as $data)
                                    
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->kode_sales }}</td>
                                        <td>{{ $data->nama_sales }}</td>
                                        <td>{{ number_format($data->total_stok) }}</td>
                                        <td>450</td>
                                        <td>120</td>
                                        <td>{{ $data->total_toko }}</td>
                                        <td class="d-flex align-items-center">
                                            <a href="{{ route('riwayat-stok-sales', $data->kode_sales) }}" class="btn btn-greys bg-history-light me-2" >
                                                <i class="far fa-eye me-1"></i> Riwayat
                                            </a> 
                                            <a href="{{ route('stok-masuk', $data->id_sales) }}" class="btn btn-greys bg-success-light me-2">
                                                <i class="fa fa-folder-plus me-1"></i> Stok
                                            </a> 
                                            <a href="{{ route('return-stok-sales', $data->id_sales) }}" class="btn btn-greys bg-danger-light me-2">
                                                <i class="fa fa-folder-minus me-1"></i> Return
                                            </a> 
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_inventory"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_stock"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
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
        <!-- /Table -->

        
@endsection()