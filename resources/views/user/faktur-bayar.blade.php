@extends('template-user.index')

@section('content-user')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Faktur Barang</h5>
            <div class="list-btn">
                <a class="btn btn-import" href="{{ route('detail-faktur', $no_faktur->no_faktur_barang) }}"><span><i class="fe fe-plus me-2"></i>Buat Faktur Pembayaran</span></a>
                <a href="{{ route('toko-sales') }}" class="btn btn-primary"><span><i class="fe fe-printer me-2"></i>Cetak Faktur Barang</span"></a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    @foreach ($faktur_pembayaran as $item)
        <div class="card mb-3">
            
                <div class="card-body">
                    <p class="card-title">Faktur Setor Barang</p>
                    <h5 class="card-title">{{ $item->no_faktur_barang }}</h5>
                    <hr>
                    <table>
                        <tr>
                            <td>
                                <p class="card-text">Stok (pcs): {{ $item->total_stok_toko ?? 0 }}</p>
                            </td>
                            <td>
                                <p class="card-text">Sisa (pcs): {{  $item->total_stok_toko - $item->total_sisa_stok_toko ?? 0 }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="card-text">Total Harga: {{ number_format($item->total_harga) ?? $item->total_harga ?? 0 }}</p>
                            </td>
                            <td>
                                <p class="card-text">Total Pembayaran: {{ $item->setor_gudang ?? 0 }}</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
    
    </div>

    @endforeach


    <div class="row">
        <div class="col-sm-12">
            <div class="card-table">
                <div class="card-body">
                        <table class="table table-center table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Item</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($faktur as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><b>{{ $item->nama_item }}</b><br>
                                        Stok (pcs) : {{ $item->stok_toko }}<br>
                                        Harga (Rp.) : {{ number_format($item->harga, 0, ',', '.') }}<br>
                                        Diskon : {{ $item->diskon }} %<br></td>
                                        <td><b>Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</b></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                </div>
            </div>
        </div>
    </div>

    
    @foreach ($faktur_pembayaran as $item)
        @if ($item->no_faktur_bayar > 0) 
            <div class="card mb-3">
                    <div class="card-body">
                        <p class="card-title">Faktur Setor Barang</p>
                        <h5 class="card-title">{{ $item->no_faktur_barang }}</h5>
                        <hr>
                        <table>
                            <tr>
                                <td>
                                    <p class="card-text">Stok (pcs): {{ $item->total_stok_toko ?? 0 }}</p>
                                </td>
                                <td>
                                    <p class="card-text">Sisa (pcs): {{  $item->total_stok_toko - $item->total_sisa_stok_toko ?? 0 }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="card-text">Total Harga: {{ number_format($item->total_harga) ?? $item->total_harga ?? 0 }}</p>
                                </td>
                                <td>
                                    <p class="card-text">Total Pembayaran: {{ $item->setor_gudang ?? 0 }}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

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
