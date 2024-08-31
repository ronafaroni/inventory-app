@extends('template-admin.index')

@section('content-admin')
     <!-- Page Header -->
     <div class="page-header">
        <div class="content-page-header">
            <h5>Stok Barang</h5>
            <div class="list-btn">
                <ul class="filter-list">
                    {{-- <li>
                        <div class="dropdown dropdown-action" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
                            <a href="#" class="btn-filters" data-bs-toggle="dropdown" aria-expanded="false"><span><i class="fe fe-download"></i></span></a>
                            <div class="dropdown-menu dropdown-menu-end">
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
                        <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print"><span><i class="fe fe-printer"></i></span> </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('tambah-item') }}" class="btn btn-import" href="javascript:void(0);"><span><i class="fe fe-box me-2"></i>Tambah Item</span></a>
                    </li>
                    <li>
                        <a class="btn btn-primary" href="{{ route('tambah-stok')}}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Tambah Stok</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    
    <!-- Table daftar stok barang -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-center table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>ID Item</th>
                                    <th>Nama Item</th>
                                    <th>Stok (pcs)</th>
                                    <th>Sales (pcs)</th>
                                    <th>Setor Toko (pcs)</th>
                                    <th>Jual (pcs)</th>
                                    <th>Jual (press)</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($items as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->kode_item }}</td>
                                    <td>{{ $item->nama_item }}</td>
                                    <td>
                                        {{ 
                                            number_format($item->stoks->sum('stok_item') - $item->stok_sales->sum('stok_sales'), 0, ',', '.')
                                        }}
                                    </td>
                                    <td>
                                        {{ 
                                            number_format($item->stok_sales->sum('stok_sales') - $item->faktur->sum('stok_toko'), 0, ',', '.')
                                        }}
                                    </td>
                                    <td>{{ 
                                            number_format($item->faktur->sum('stok_toko') - $item->faktur->sum('stok_terjual'), 0, ',', '.');
                                        }}
                                    </td>
                                    <td>
                                        {{
                                            number_format($item->faktur->sum('stok_terjual'), 0, ',', '.')
                                        }}
                                    </td>
                                    <td>
                                        {{
                                            number_format(floor($item->faktur->sum('stok_terjual') / 10), 0, ',', '.')
                                        }}
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
    <!-- Table daftar stok barang -->

@endsection()