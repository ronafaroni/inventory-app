
@extends('template-admin.index')

@section('content-admin')
<div class="signature-invoice">
    <div class="page-header">
        <div class="content-page-header">
            <h5>Detail Sales</h5>
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
					
                    @foreach ($sales as $data)
                    <table class="table">
                        <tr>
                            <td width="10%">Nama Sales</td>
                            <td>: {{ $data->nama_sales }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Kode Sales</td>
                            <td>: {{ $data->kode_sales }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Alamat</td>
                            <td>: {{ $data->alamat }}</td>
                        </tr>
                        <tr>
                            <td width="10%">No. Telp</td>
                            <td>: {{ $data->no_telp }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Terdaftar</td>
                            <td>: {{ $data->created_at }}</td>
                        </tr>
                        <tr>
                            <td>Total Stok (pcs)</td>
                            <td>: {{ number_format($data->stokSales->sum('stok_sales') - $data->faktur->sum('stok_toko')) }} </td>
                        </tr>
                        <tr>
                            <td>Total Setor (pcs)</td>
                            <td>: {{ number_format($data->faktur->sum('stok_toko') - $data->faktur->sum('stok_terjual')) }}</td>
                        </tr>
                        <tr>
                            <td width="10%">Total Penjualan (pcs)</td>
                            <td>: {{ number_format($data->faktur->sum('stok_terjual')) }}<td>
                        </tr>
                        <tr>
                            <td width="10%">Total Penjualan (press)</td>
                            <td>:
                                {{ number_format(floor($data->faktur->sum('stok_terjual') / 10)) }}
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">Pencapaian</td>
                            <td>: 
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
                                <a class="btn btn-greys bg-danger-light me-2" data-bs-toggle="modal" data-bs-target="#salesModal{{ $data->id_sales }}"><i class="fa fa-star" aria-hidden="true"></i> Tambah Pencapaian</></a>
                                <a href="" class="btn btn-greys bg-primary-light me-2"><i class="fa fa-edit" aria-hidden="true"></i> Edit Data Sales</a></a>
                            </td>
                        </tr>
                    </table>
                    @endforeach
                  
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
                                                <th>Setor (pcs)</th>
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
                                                    <td>{{ number_format($item->total_stok_sales - $item->faktur->sum('stok_toko'), 0, ',', '.') }}</td> <!-- Menggunakan formatRupiah --> 
                                                    <td>{{ number_format($item->faktur->sum('stok_toko') - $item->faktur->sum('stok_terjual'), 0, ',', '.') }}</td>
                                                    <td>{{ number_format($item->faktur->sum('stok_terjual'), 0, ',', '.') }}</td>
                                                    <td>{{ number_format(floor($item->faktur->sum('stok_terjual') / 10), 0, ',', '.') }}</td>
                                                    <td>{{ number_format($item->faktur->sum('stok_return') , 0, ',', '.') }}</td>
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

<div class="modal fade" id="salesModal{{ $data->id_sales }}" tabindex="-1" aria-labelledby="tokoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('update-pencapaian-sales', $data->id_sales) }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="terjualModalLabel">Pencapaian Sales</h5>
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


