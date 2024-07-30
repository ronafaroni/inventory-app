@extends('template-admin.index')

@section('content-admin')

    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Item Barang</h5>
            <div class="list-btn">
                <ul class="filter-list">
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
                    </li>
                    <li>
                        <a class="btn btn-import" href="{{ route('tambah-item') }}"><span><i class="fe fe-box me-2"></i>Tambah Item</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Table daftar item -->
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
                                    <th>ID Item</th>
                                    <th>Nama Item</th>
                                    <th>Stok Barang (pcs)</th>
                                    <th>Datetime</th>
                                    <th class="no-sort">Action</th>
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
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="{{ route('edit-item', $item->id_item) }}" class="avatar avatar-md me-2 companies">
                                                <img class="avatar-img sales-rep"
                                                    src="{{ $item->gambar_produk }}"
                                                    alt="User Image"></a>
                                            <a href="{{ route('edit-item', $item->id_item) }}">{{ $item->nama_item }}</a>
                                        </h2>
                                    </td>
                                    <td>{{ number_format($item->stok_item, 0, ',', '.') }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td class="d-flex">
                                        <form action="{{ route('delete-item', $item->id_item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button {{ route('delete-item', $item->id_item) }} class="btn btn-import me-2" onclick="return confirm('Apakah anda yakin ingin menghapus item ?')"><span><i class="fa fa-trash me-1"></i></span></button>
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
    <!-- Table daftar item -->

    <script>
        $(document).ready(function(){
            // Menutup alert otomatis setelah 5 detik (5000 milidetik)
            setTimeout(function() {
                $(".alert").alert('close');
            }, 2000);
        });
    </script>


@endsection()