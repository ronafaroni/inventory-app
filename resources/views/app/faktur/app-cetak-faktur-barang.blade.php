<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Faktur Barang</title>
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
        @foreach ($faktur_pembayaran as $item)
            <div>
                <p style="text-align: center;"><b>Faktur Setor Barang</b> <br>
                <b>No. Faktur:</b> {{$item->no_faktur_barang}}</p>
                
                <p>
                    <b>Stok :</b> {{ $item->total_stok_toko ?? 0 }} Pcs <br>
                    <b>Total Harga:</b> Rp. {{ number_format($item->total_harga, 0, ',', '.') ?? 0 }}<br>
                    <b>Sisa Stok:</b> {{ ($item->total_stok_toko ?? 0) - ($item->total_stok_terjual ?? 0) - ($item->total_return ?? 0) }} Pcs<br>
                    <b>Pembayaran:</b> Rp. {{ number_format($item->total_bayar, 0, ',', '.') ?? 0 }}
                </p>
            </div>
            <hr>
        @endforeach

        <table>
            <thead>
                <tr>
                    <th>Nama Item</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faktur as $item)
                    <tr>
                        <td>
                            <b>{{ $item->nama_item }}</b><br>
                            <small>
                                Stok : {{ $item->stok_toko }} Pcs<br>
                                Harga (Rp.): {{ number_format($item->harga, 0, ',', '.') }}<br>
                                Diskon: {{ $item->diskon }} %
                            </small>
                        </td>
                        <td>
                            <b>Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</b>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <!-- Footer Section -->
        <div class="footer">
            <p>Terima Kasih atas Kerjasama Anda!<br>
            Tanggal Cetak: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y H:i:s') }}</p>
        </div>

        <!-- Barcode Section -->
        <div class="barcode">
            <img src="data:image/png;base64,{{ base64_encode(DNS1D::getBarcodePNG($id_toko, 'C39')) }}" alt="Barcode Toko" style="width: 100%; height: auto;">
        </div>
    </div> 
</body>
</html>
