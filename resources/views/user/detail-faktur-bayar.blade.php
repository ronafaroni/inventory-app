@extends('template-user.index')

@section('content-user')
    <!-- Page Header -->
    <br>

        <!-- Page Header -->
        <div class="page-header">
            <div class="content-page-header">
                <div class="list-btn">
                    <a href="{{ route('toko-sales') }}" class="btn btn-primary"><span><i class="fe fe-printer me-2"></i>Cetak Faktur Pembayaran</span"></a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

    <p>Faktur Pembayaran {{ $no_faktur->no_faktur_barang }}</p>
    <h4>FP-{{ $no_faktur->no_faktur_barang }}</h4>
    <hr>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat! </strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! </strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="card-table">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Item</th>
                                <th>Pembayaran</th>
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
                                        Stok (pcs) : {{ $item->stok_toko ?? 0 }}<br>
                                        Jual (pcs) : {{ $item->stok_terjual ?? 0 }}<br>
                                        Return (pcs) : {{ $item->stok_return ?? 0 }}<br>
                                        Sisa (pcs) : {{ $item->sisa_stok_toko ?? 0 }}<br>
                                    </td>
                                    <td>
                                        <b>Rp. {{ number_format($item->total_bayar, 0, ',', '.') }}</b><br><br>
                                        Diskon : {{ $item->diskon }} %<br>
                                        Harga/pcs : {{ number_format($item->harga, 0, ',', '.') }}<br>
                                        Total Harga : {{ number_format($item->total_harga, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-greys bg-history-light me-2" data-bs-toggle="modal" data-bs-target="#terjualModal{{ $item->id_faktur }}">
                                            <i class="fa fa-cart-plus me-1"></i> Terjual
                                        </button> 
                                        <button class="btn btn-greys bg-success-light me-2" data-bs-toggle="modal" data-bs-target="#returnModal{{ $item->id_faktur }}">
                                            <i class="fa fa-exclamation-triangle me-1"></i> Return
                                        </button>
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
