<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Faktur Bayar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            
            <div class="col-10">
                <div style="text-align: center;">
                    <img src="{{ asset('assets/img/logo bunga coklat.png') }}" width="60%" alt="">
                </div>
                
                <br>
            
                @foreach ($faktur_pembayaran as $item)
                
                <p style="text-align: center;"><b>Faktur Setor Pembayaran</b> <br>
                <b>No. Faktur:</b> FP-{{$item->no_faktur_barang}}</p>
                
                <div class="d-flex justify-content-center">
                    <p class="text-start">
                        <b>Stok :</b> {{ $item->total_stok_toko ?? 0 }} Pcs <br>
                        <b>Total Harga:</b> Rp. {{ number_format($item->total_harga, 0, ',', '.') ?? 0 }}<br>
                        <b>Sisa Stok:</b> {{ ($item->total_stok_toko ?? 0) - ($item->total_stok_terjual ?? 0) - ($item->total_return ?? 0) }} Pcs<br>
                        <b>Pembayaran:</b> Rp. {{ number_format($item->total_bayar, 0, ',', '.') ?? 0 }}
                    </p>
                </div>
                
                
                <p class="text-center">------------------------------------------------------</p>
                
                @endforeach
            
                <div class="d-flex justify-content-center">
                    <table class="text-start">
                        <thead>
                            <tr>
                                <th>Nama Item</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($faktur as $item)
                            <tr>
                                <td><b>{{ $item->nama_item }}</b><br>
                                    Stok : {{ $item->stok_toko ?? 0 }} Pcs<br>
                                    Jual : {{ $item->stok_terjual ?? 0 }} Pcs<br>
                                    Return : {{ $item->stok_return ?? 0 }} Pcs<br>
                                    Sisa : {{ $item->sisa_stok_toko - $item->stok_return ?? 0 }} Pcs<br>
                                </td>
                                <td>
                                    <b>Rp. {{ number_format($item->total_bayar, 0, ',', '.') }}</b><br>
                                    Diskon : {{ $item->diskon }} %<br>
                                    Harga/pcs : {{ number_format($item->harga, 0, ',', '.') }}<br>
                                    Total Harga : {{ number_format($item->total_harga, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
                </div>
            
                <p class="text-center">------------------------------------------------------</p>
            
                <!-- Footer Section -->
                <div class="text-center">
                    <p>Terima Kasih atas Kerjasama Anda!<br>
                    Tanggal Cetak: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y H:i:s') }}</p>
                </div>

                <!-- Barcode Section -->
                <!--<div class="barcode">-->
                <!--    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($id_toko, 'C39') }}" alt="Barcode Toko" style="width: 60%; height: auto;">-->
                <!--</div>-->
            </div>
            
            <div class="col-1"></div>
        </div>
    </div>
    
</body>

<script>
    window.onload = function() {
        window.print();
    }
</script>

</html>
