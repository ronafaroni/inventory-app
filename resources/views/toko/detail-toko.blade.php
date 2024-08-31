
@extends('template-admin.index')

@section('content-admin')
<div class="signature-invoice">
    <div class="page-header">
        <div class="content-page-header">
            <h5>Detail Toko</h5>
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
                        <tr>
                            <td width="10%">Nama Toko</td>
                            <td>: {{ $data_toko->nama_toko }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Kode Toko</td>
                            <td>: {{ $data_toko->kode_toko }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Pemilik Toko</td>
                            <td>: {{ $data_toko->pemilik_toko }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Alamat</td>
                            <td>: {{ $data_toko->alamat }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Link Gmap</td>
                            <td>: {{ $data_toko->link_gmap }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Total Penjualan (pcs)</td>
                            <td>: {{number_format($data_terjual->sum('stok_terjual'), 0, ',', '.') }}<td>
                        </tr>
                        <tr>
                            <td width="10%">Total Penjualan (press)</td>
                            <td>:
                                {{
                                    number_format(floor($data_terjual->sum('stok_terjual') / 10), 0, ',', '.')
                                }}
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">Pencapaian</td>
                            <td>: 
                                @if ($data_toko->pencapaian > 0 && $data_toko->pencapaian == '' && $data_toko->pencapaian == null)
                                            <i class="fa fa-star"></i>
                                        @elseif ($data_toko->pencapaian == '1')
                                            <i class="fa fa-star"></i>
                                        @elseif ($data_toko->pencapaian == '2')
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        @elseif ($data_toko->pencapaian == '3')
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        @elseif ($data_toko->pencapaian == '4')
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        @elseif ($data_toko->pencapaian == '5')
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        @endif
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">Nama Sales</td>
                            <td>: {{ $data_toko->sales->nama_sales }}<td>
                        </tr>
                        <tr>
                            <td width="10%">Kode Sales</td>
                            <td>: {{ $data_toko->kode_sales }}<td>
                        </tr>
                        <tr>
                            <td width="10%">Terdaftar</td>
                            <td>: {{ $data_toko->created_at }}<td>
                        </tr>
                        <tr>
                            <td width="10%">Kunjungan / Minggu ini</td>
                            @php
                                $kunjunganPerMinggu = $data_toko->kunjungan->filter(function ($kunjungan) {
                                    return \Carbon\Carbon::parse($kunjungan->created_at)->isSameWeek(\Carbon\Carbon::now());
                                })->count();
                            @endphp

                            <td>: {{ $data_toko->kunjungan->count() }} / {{ $kunjunganPerMinggu }}</td>
                        </tr>
                        {{-- <tr>
                            <td width="10%">Stok Sisa (pcs)</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td width="10%">Stok Sekarang</td>
                            <td>:</td>
                        </tr> --}}
                        <tr>
                            <td></td>
                            <td>
                                <a class="btn btn-greys bg-danger-light me-2" data-bs-toggle="modal" data-bs-target="#tokoModal{{ $data_toko->id_toko }}"><i class="fa fa-star" aria-hidden="true"></i> Tambah Pencapaian</></a>
                                <a href="{{ route('edit-toko', $data_toko->id_toko) }}" class="btn btn-greys bg-primary-light me-2"><i class="fa fa-edit" aria-hidden="true"></i> Edit Data Toko</a></a>
                            </td>
                        </tr>
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
                                                <th>Stok (press)</th>
                                                <th>Jual (pcs)</th>
                                                <th>Jual (press)</th>
                                                <th>Return (pcs)</th>
                                                {{-- <th class="no-sort">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp

                                            @foreach ($detail as $item)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->kode_item }}</td>
                                                    <td>{{ $item->nama_item }}</td>
                                                    <td>{{ number_format($item->total_stok - $item->total_stok_terjual, 0, ',', '.') }}</td>
                                                    <td>{{ number_format(floor(($item->total_stok - $item->total_stok_terjual) / 10), 0, ',', '.') }}</td>
                                                    <td>{{ number_format($item->total_stok_terjual, 0, ',', '.') }}</td>
                                                    <td>{{ number_format(floor($item->total_stok_terjual / 10), 0, ',', '.') }}</td>
                                                    <td>{{ number_format($item->total_stok_return, 0, ',', '.') }}</td>
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

<!-- Terjual Modal -->
<div class="modal fade" id="tokoModal{{ $data_toko->id_toko }}" tabindex="-1" aria-labelledby="tokoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('update-capaian', $data_toko->id_toko) }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="terjualModalLabel">Pencapaian Toko</h5>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="pencapaian" class="form-label">Poin Pencapaian</label>
                        <select name="pencapaian" id="pencapaian" class="form-control form-small">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        @error('pencapaian')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-import"><i class="fa fa-star me-2" aria-hidden="true"></i>Buat Pencapaian</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


