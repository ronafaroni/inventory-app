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
                size: 58mm auto; /* Menyesuaikan ukuran kertas 58mm */
            }
            body {
                margin: 0;
                font-size: 12px; /* Ukuran font lebih besar untuk cetakan */
            }
            .print-area {
                width: 100%;
                padding: 0;
                box-sizing: border-box;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .invoice-box {
            width: 58mm; /* Lebar disesuaikan dengan kertas 58mm */
            margin: auto;
            padding: 5px;
            font-size: 11px; /* Ukuran font lebih besar untuk cetakan */
            line-height: 14px; /* Sesuaikan line-height */
            color: #000;
            box-sizing: border-box;
        }
        .invoice-box table {
            width: 100%;
            line-height: 14px; /* Sesuaikan line-height */
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td, .invoice-box table th {
            padding: 2px 0; /* Sesuaikan padding */
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
            margin-top: 10px;
        }
        .barcode {
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>

<script>
    window.onload = function() {
        window.print();
    }
</script>

<body>
    <div class="invoice-box print-area">
        <div style="text-align: center;">
            <img src="{{ asset('assets/img/logo bunga coklat.png') }}" width="80%" alt="">
        </div>
        @foreach ($toko as $item)
            <div>
                <!-- Barcode Section -->
                <div class="barcode">
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($item->kode_toko, 'C39') }}" alt="Barcode Toko" style="width: 100%; height: auto;">
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
