@extends('template-user.index')

@section('content-user')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Faktur Barang</h5>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-table">
                <div class="card-body">
                    <div id="alertContainer"></div>
                    
                    <div class="table-responsive">
                        <table class="table table-center table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Kode Item</th>
                                    <th>Nama Item</th>
                                    <th>Jumlah Stok</th>
                                    <th>Total Harga</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($faktur as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->kode_item }}</td>
                                        <td>{{ $item->nama_item }}</td>
                                        <td>{{ $item->stok_toko }}</td>
                                        <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td class="d-flex align-items-center">
                                            <button class="btn btn-greys bg-history-light me-2" data-toggle="modal" data-target="#terjualModal{{ $item->id_faktur }}">
                                                <i class="fa fa-cart-plus me-1"></i> Terjual
                                            </button> 
                                            <button class="btn btn-greys bg-success-light me-2" data-toggle="modal" data-target="#returnModal{{ $item->id_faktur }}">
                                                <i class="fa fa-exclamation-triangle me-1"></i> Return
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


    @foreach ($faktur as $item)
    <!-- Terjual Modal -->
    <div class="modal fade" id="terjualModal{{ $item->id_faktur }}" tabindex="-1" aria-labelledby="terjualModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('save-terjual', $item->id_faktur) }}" method="POST">
                    @csrf

                    <input type="hidden" class="form-control" name="no_faktur_terjual" value="{{ $item->no_faktur_barang }}" required>
                    <input type="hidden" class="form-control" name="harga" value="{{ $item->harga }}" required>
                    <input type="hidden" class="form-control" name="diskon" value="{{ $item->diskon }}" required>

                    <div class="modal-header">
                        <h5 class="modal-title" id="terjualModalLabel">Terjual (pcs)</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="terjualId">
                        <div class="mb-3">
                            <label for="jumlahTerjual" class="form-label">Jumlah Terjual</label>
                            <input type="number" class="form-control" id="jumlahTerjual" name="jumlah_terjual" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-import">Barang Terjual</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endforeach

    @foreach ($faktur as $item)
        
    <!-- Return Modal -->
    <div class="modal fade" id="returnModal{{ $item->id_faktur }}" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('save-return', $item->id_faktur) }}" method="POST">
                    @csrf

                    <input type="hidden" class="form-control" name="no_faktur_terjual" value="{{ $item->no_faktur_barang }}" required>
                    <input type="hidden" class="form-control" name="sisa_stok" value="{{ $item->sisa_stok_toko }}" required>

                    <div class="modal-header">
                        <h5 class="modal-title" id="returnModalLabel">Return (pcs)</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="returnId">
                        <div class="mb-3">
                            <label for="jumlahReturn" class="form-label">Jumlah Return</label>
                            <input type="number" class="form-control" id="jumlahReturn" name="jumlah_return" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-import">Return Barang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

@endsection
