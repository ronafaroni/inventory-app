@extends('app.index', ['title' => 'Faktur Bayar'])

@section('content-app')

<div class="row"> <!-- Adjust the padding to match the height of your bottom navigation -->
    <div class="col-md-12">
        <div class="panel panel-card">
            <div class="panel-heading">
                <div class="text-center">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('app-detail-faktur-bayar', $no_faktur->no_faktur_barang) }}" class="btn btn-addon btn-primary waves-effect"><i class="mdi-av-queue"></i>Buat Faktur Pembayaran</a>
                        </div>
                        <br>
                        <div class="col-md-3">
                            <a href="javascript:void(0);" class="btn btn-addon btn-info waves-effect" onclick="handlePrint('{{ route('app-cetak-faktur-barang', $no_faktur->no_faktur_barang) }}')">
                                <i class="mdi mdi-action-print" aria-hidden="true"></i> Cetak Faktur Barang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($faktur_pembayaran as $item)
                <div class="panel-heading">
                    Faktur Setor Barang <br>
                    <h3><b>{{$item->no_faktur_barang}}</b></h3>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            Stok (pcs): {{ $item->total_stok_toko ?? 0 }}</Stok><br>
                            Total Harga : {{ number_format($item->total_harga) ?? 0 }}
                        </div>
                        <div class="col-xs-6">
                            Sisa : {{ $item->total_stok_toko - $item->total_stok_terjual - $item->total_return ?? 0 }}<br>
                            Pembayaran : {{ number_format($item->total_bayar) ?? 0 }}
                        </div>
                    </div>
                </div>
            @endforeach

            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Item</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($faktur as $item)
                        <tr>
                            <td><b>{{ $item->nama_item }}</b><br>
                            Stok (pcs) : {{ $item->stok_toko }}<br>
                            Harga (Rp.) : {{ number_format($item->harga, 0, ',', '.') }}<br>
                            Diskon : {{ $item->diskon }} %<br></td>
                            <td><b>Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</b></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>  
            
            <div class="card bg-primary text-white">
                @foreach ($faktur_bayar as $item)
                    @if ($item->no_faktur_bayar)
                        <div class="panel-heading">
                            Faktur Pembayaran <br>
                            <h3><b>{{ $item->no_faktur_bayar }}</b></h3>
                            <hr>
                            <div class="row">
                                <div class="col-xs-6">
                                    Setor Toko (pcs): {{ $item->total_stok_toko ?? 0 }}<br>
                                    Terjual (pcs): {{ $item->total_stok_terjual ?? 0 }}<br>
                                    Return (pcs): {{ $item->total_return ?? 0 }}<br>
                                    Total Harga: {{ number_format($item->total_harga) ?? 0 }}
                                </div>
                                <div class="col-xs-6">
                                    <b>Sisa: {{ number_format($item->total_stok_toko - $item->total_stok_terjual - $item->total_return) ?? 0 }}</b><br>
                                    <b>Pembayaran: {{ number_format($item->total_bayar) ?? 0 }}</b><br>
                                    <b>Setor Pembayaran Gudang: {{ number_format($item->total_setor_gudang) ?? 0 }}</b>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<script>
    function handlePrint(url) {
        // Lakukan AJAX request ke server
        fetch(url)
            .then(response => response.text())
            .then(data => {
                // Buka window baru untuk print
                const printWindow = window.open('', '_blank');
                printWindow.document.write(data);
                printWindow.document.close();
                printWindow.focus();
                // Tunggu hingga konten selesai di-load, lalu print
                printWindow.onload = function () {
                    printWindow.print();
                    printWindow.close();
                };
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }
</script>

@endsection
