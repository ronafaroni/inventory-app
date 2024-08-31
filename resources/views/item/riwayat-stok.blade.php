@extends('template-admin.index')

@section('content-admin')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Daftar Riwayat Stok</h5>
            <div class="list-btn">
                {{-- <ul class="filter-list">
                    <li>
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
                        <a class="btn btn-primary" href="{{ route('tambah-stok')}}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Tambah Stok</a>
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
                                    <th>ID Transaksi</th>
                                    <th>Kode Item</th>
                                    <th>Nama Item</th>
                                    <th>Stok (pcs)</th>
                                    <th>Created at</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($stoks as $stok)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $stok->id_transaksi }}</td>
                                    <td>{{ $stok->kode_item }}</td>
                                    <td>{{ $stok->item->nama_item }}</td>
                                    <td>{{ number_format($stok->stok_item, 0, ',', '.') }}</td>
                                    <td>{{ $stok->created_at }}</td>
                                    <td class="d-flex">
                                        <form action="{{ route('delete-stok', $stok->id_stok) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button {{ route('delete-stok', $stok->id_stok) }} class="btn btn-import me-2" onclick="return confirm('Apakah anda yakin ingin menghapus item ?')"><span><i class="fa fa-trash me-1"></i></span></button>
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

      <!-- Modal Tambah Item -->
	<div class="modal custom-modal fade" id="tambah_sales" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="form-header modal-header-title text-start mb-0">
                        <h4 class="mb-0">Tambah Sales</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        
                    </button>
                </div>
                <form action="{{ route('simpan-item') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="form-group-item border-0 pb-0 mb-0">
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-block mb-3">
                                                    <label>Kode Sales <span class="text-danger">*</span></label>
                                                    <input type="text" name="kode_sales" class="form-control" autocomplete="off" placeholder="Kode Sales" @error('kode_sales') is-invalid @enderror>
                                                    @error('kode_sales')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>											
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-block mb-3">
                                                    <label>Nama Sales <span class="text-danger">*</span></label>
                                                    <input type="text" name="nama_sales" class="form-control" autocomplete="off" placeholder="Nama Sales" @error('nama_sales') is-invalid @enderror>
                                                    @error('nama_sales')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror										
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-block mb-3">
                                                    <label>No. Hp <span class="text-danger">*</span></label>
                                                    <input type="number" name="no_hp" class="form-control" autocomplete="off" placeholder="No Hp" @error('no_hp') is-invalid @enderror>
                                                    @error('no_hp')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror										
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-block mb-3">
                                                    <label>Alamat <span class="text-danger">*</span></label>
                                                    <textarea type="text" name="alamat" class="form-control" autocomplete="off" placeholder="Alamat Sales" @error('alamat') is-invalid @enderror></textarea>
                                                    @error('alamat')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror	
                                                </div>									
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="input-block mb-0 pb-0">
                                                    <label>Upload Gambar</label>
                                                    <div class="input-block service-upload mb-0">
                                                        <span><img src="assets/img/icons/drop-icon.svg" alt="upload"></span>
                                                        <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                                        <p class="text-muted">Maximum size: 5MB</p>	
                                                        <input type="file" name="upload_gambar" multiple="" id="image_sign" @error('upload_gambar') is-invalid @enderror>
                                                        <div id="frames"></div>
                                                    </div>
                                                    @error('upload_gambar')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror										
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Tambah Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Item -->
@endsection()