@extends('template-admin.index')

@section('content-admin')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Daftar Sales</h5>
            <div class="list-btn">
                <ul class="filter-list">
                    <li>
                        <a class="btn btn-primary" href="{{ route('tambah-sales') }}"><i class="fa fa-user-plus me-2" aria-hidden="true"></i>Tambah Sales</a>
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
                                    <th>ID Sales</th>
                                    <th>Nama Sales</th>
                                    <th>Alamat</th>
                                    <th>No. Handphone</th>
                                    <th>Kunjungan / Minggu ini</th>
                                    <th>Jumlah Penjualan</th>
                                    <th>Pencapaian</th>
                                    <th class="no-sort">Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp

                                @foreach ($sales_data as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->kode_sales }}</td>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="{{ route('edit-item', $data->id_sales) }}" class="avatar avatar-md me-2 companies">
                                                <img class="avatar-img sales-rep"
                                                    src="{{ $data->foto }}"
                                                    alt="User Image"></a>
                                            <a href="{{ route('edit-sales', $data->id_sales) }}">{{ $data->nama_sales }}</a>
                                        </h2>
                                    </td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->no_telp }}</td>

                                    @php
                                    // Menghitung kunjungan per minggu
                                        $kunjunganPerMinggu = $data->kunjungan->filter(function ($kunjungan) {
                                            return \Carbon\Carbon::parse($kunjungan->created_at)->isSameWeek(\Carbon\Carbon::now());
                                        })->count();

                                        // Menghitung jumlah stok terjual dari faktur
                                        $stokTerjual = $data->faktur->sum('stok_terjual');

                                    @endphp
    
                                    <td> {{ $data->kunjungan->count() }} / {{ $kunjunganPerMinggu }}</td>
                                    <td>{{ number_format($stokTerjual) ?? 0 }} Pcs</td>
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
                                        <form action="{{ route('delete-sales', $data->id_sales) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button {{ route('delete-sales', $data->id_sales) }} class="btn btn-import me-2" onclick="return confirm('Apakah anda yakin ingin menghapus sales ?')"><span><i class="fa fa-trash me-1"></i></span></button>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-greys btn-sm" data-kode_sales="{{ $data->kode_sales }}" data-bs-toggle="modal" data-bs-target="#kunjunganModal">
                                            Lihat Kunjungan
                                        </button>
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

<!-- Modal HTML -->
<div class="modal fade" id="kunjunganModal" tabindex="-1" aria-labelledby="kunjunganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kunjunganModalLabel">Detail Kunjungan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="kunjungan-details">
                <!-- Konten detail kunjungan akan dimuat di sini -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kunjunganModal').on('show.bs.modal', function (e) {
            var button = $(e.relatedTarget); // Tombol yang memicu modal
            var kodeSales = button.data('kode_sales'); // Ambil ID dari data-id

            // Memuat data kunjungan melalui AJAX
            $.ajax({
                url: '/kunjungan-details/' + kodeSales,
                type: 'GET',
                success: function(response) {
                    $('#kunjungan-details').html(response); // Tampilkan data di dalam modal
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection()
