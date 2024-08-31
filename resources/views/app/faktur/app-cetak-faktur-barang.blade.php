<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Faktur Barang</title>
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan */
        @media print {
            @page {
                margin: 0;
                size: auto; /* Adjusts the size based on content */
            }
            body {
                margin: 10mm;
            }
            .print-area {
                width: 100%;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
    </style>
</head>

<script>
    window.onload = function() {
        window.print(); // Automatically trigger the print dialog
    }
</script>

<body>
    <div class="print-area">
    @foreach ( $faktur_pembayaran as $item)
    <div class="panel-heading">
        Faktur Setor Barang <br>
        <h3><b>{{$item->no_faktur_barang}}</b></h3>
        <hr>
        <div class="row">
            <div class="col-xs-6">
                Stok (pcs): {{ $item->total_stok_toko ?? 0 }}<br>
                Total Harga : {{ number_format($item->total_harga) ?? 0 }}
            </div>
            <div class="col-xs-6">
                Sisa : {{ ($item->total_stok_toko ?? 0) - ($item->total_stok_terjual ?? 0) - ($item->total_return ?? 0) }}<br>
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
    </div> 
</body>
</html>
