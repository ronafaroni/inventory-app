<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Detail Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container text-center">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">

                <div class="text-center">
                    <img src="{{ asset('assets/img/logo bunga coklat.png') }}" width="60%" alt="">
                </div>
                <br>

                <div>
                    <div class="barcode" style="text-align: center;">
                        {{-- <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($item->id_toko, 'C39') }}"
                                alt="Barcode Toko" style="width: 50%; height: auto;"> --}}
                        <img src="data:image/png;base64,{{ $barcode }}" alt="QR Code">
                    </div>
                    <br>
                    <h4 style="text-align: center;">
                        <b>{{ $toko->nama_toko }}</b><br>
                        <b>Kode:</b> {{ $toko->kode_toko }}
                    </h4>

                    <div class="d-flex justify-content-center">
                        <p class="text-start">
                            <b>Nama Pemilik:</b> {{ $toko->pemilik_toko }} <br>
                            <b>Nomor Telepon:</b> {{ $toko->no_telp }} <br>
                            <b>Alamat:</b> {{ $toko->alamat }} <br>
                            <b>Kode Sales:</b> {{ $toko->kode_sales }} <br>
                            <b>Nama Sales:</b> {{ $toko->sales->nama_sales }} <br>
                            <b>Tgl. Gabung:</b> {{ $toko->created_at }}
                        </p>
                    </div>
                </div>
                <p class="text-center">------------------------------------------------------</p>

                <div class="gap-3" style="text-align: center;">
                    <p>Terima Kasih atas Kerjasama Anda!<br>
                        Tanggal Cetak: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y H:i:s') }}</p>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>

</body>

<script>
    // Otomatis memulai proses print
    window.onload = function() {
        window.print();
    };
</script>

</html>
