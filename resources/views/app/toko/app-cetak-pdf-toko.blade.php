<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Detail Toko</title>
    <style>
        @media print {
    @page {
        margin: 0;
        size: 58mm auto; /* Ukuran kertas 58mm */
    }
    body {
        margin: 0;
        font-size: 12px;
    }
    .print-area {
        width: 58mm;
        padding: 0;
        box-sizing: border-box;
        overflow: hidden;
    }
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.invoice-box {
    width: 58mm;
    margin: auto;
    padding: 0;
    font-size: 11px;
    line-height: 14px;
    color: #000;
    box-sizing: border-box;
    /* Remove max-height to avoid content cutting */
}

.invoice-box table {
    width: 100%;
    line-height: 14px;
    text-align: left;
    border-collapse: collapse;
}

.invoice-box table td, .invoice-box table th {
    padding: 0;
    vertical-align: top;
    word-break: break-word;
}

.invoice-box table th {
    text-align: left;
    font-weight: bold;
    border-bottom: 1px solid #000;
}

.invoice-box hr {
    border: 1px dashed #000;
    margin: 5px 0;
}

.footer {
    text-align: center;
    margin-top: 5px;
}

.barcode {
    margin-top: 5px;
    text-align: center;
}

img {
    max-width: 100%; /* Ensures images do not exceed container width */
    height: auto;    /* Ensures proportional scaling */
}

    </style>
</head>
<body>
    <div class="invoice-box print-area">
        <div style="text-align: center;">
            <img src="{{ asset('assets/img/logo bunga coklat.png') }}" alt="Logo">
        </div>
        @foreach ($toko as $item)
            <div>
                <!-- Barcode Section -->
                <div class="barcode">
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($item->id_toko, 'C39') }}" alt="Barcode Toko">
                </div>
                <h3 style="text-align: center;">
                    <b> {{$item->nama_toko}} </b><br>
                    <b>Kode :</b> {{$item->kode_toko}}</b>
                </h3>
                
                <p>
                    <b>Nama Pemilik : </b>{{$item->pemilik_toko}} <br>
                    <b>Nomor Telepon : </b>{{$item->no_telp}} <br>
                    <b>Alamat : </b>{{$item->alamat}} <br>
                    <b>Kode Sales : </b>{{$item->kode_sales}} <br>
                    <b>Nama Sales : </b>{{$item->sales->nama_sales}} <br>
                    <b>Tgl. Gabung : </b>{{$item->created_at}}</b>
                </p>
            </div>
            <hr>
        @endforeach

        <!-- Footer Section -->
        <div class="footer">
            <p>Terima Kasih atas Kerjasama Anda!<br>
            Tanggal Cetak: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y H:i:s') }}</p>
        </div>
    </div> 
</body>
</html>
