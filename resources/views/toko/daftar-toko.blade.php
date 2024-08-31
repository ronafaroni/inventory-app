@extends('template-admin.index')

@section('content-admin')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Daftar Toko</h5>
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
                        <a class="btn btn-primary" href="{{ route('tambah-toko') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Tambah Toko</a>
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
                                    <th>Kode Toko</th>
                                    <th>Nama Toko</th>
                                    <th>Stok (pcs)</th>
                                    <th>Jual (pcs)</th>
                                    <th>Return (pcs)</th>
                                    <th>Nama Sales</th>
                                    <th>Kunjungan / Minggu ini</th>
                                    <th>Pencapaian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp

                                @foreach ($toko as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->kode_toko }}</td>
                                    <td>
                                        <h2 class="table-avatar">
                                            {{-- <a href="{{ route('edit-toko', $data->id_toko) }}">{{ $data->nama_toko }}</a> --}}
                                            <a href="{{ route('detail-toko', $data->kode_toko) }}">{{ $data->nama_toko }}</a>
                                        </h2>
                                    </td>
                                    <td>{{ number_format($data->faktur->sum('stok_toko') - $data->faktur->sum('stok_terjual'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($data->faktur->sum('stok_terjual'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($data->faktur->sum('stok_return'), 0, ',', '.') }}</td>
                                    <td>{{ $data->sales ? $data->sales->nama_sales : '-' }}</td>
                                    @php
                                        $kunjunganPerMinggu = $data->kunjungan->filter(function ($kunjungan) {
                                            return \Carbon\Carbon::parse($kunjungan->created_at)->isSameWeek(\Carbon\Carbon::now());
                                        })->count();
                                    @endphp

                                    <td>{{ $data->kunjungan->count() }} / {{ $kunjunganPerMinggu }}</td>

                                    <td>
                                        @if ($data->pencapaian > 0 && $data->pencapaian == '' && $data->pencapaian == null)
                                            <i class="fa fa-star"></i>
                                        @elseif ($data->pencapaian == '1')
                                            <i class="fa fa-star"></i>
                                        @elseif ($data->pencapaian == '2')
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        @elseif ($data->pencapaian == '3')
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        @elseif ($data->pencapaian == '4')
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        @elseif ($data->pencapaian == '5')
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <form action="{{ route('delete-toko', $data->id_toko) }}" method="POST">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-import m-2" onclick="return confirm('Apakah anda yakin ingin menghapus data toko ?')">
                                                <span><i class="fa fa-trash-alt"></i></span>
                                            </button>
                                        </form> 
                                        <form action="{{ route('download-barcode', $data->id_toko) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-import m-2">
                                                <span><i class="fa fa-download"></i> Barcode</span>
                                            </button>
                                        </form>
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
