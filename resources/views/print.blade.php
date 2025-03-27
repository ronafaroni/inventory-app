<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Faktur</title>
    <style>
        body {
            font-size: 12px;
            width: 58mm;
            margin: 0;
            padding: 0;
            font-family: 'Courier New', Courier, monospace;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .line {
            border-bottom: 1px dashed #000;
            margin: 5px 0;
        }

        .item {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div class="center bold">Toko XYZ</div>
    <div class="center">Jl. Contoh No. 1</div>
    <div class="center">Telp: 08123456789</div>
    <div class="line"></div>

    <div>Tanggal: {{ $tanggal }}</div>
    <div class="line"></div>

    @foreach ($items as $item)
        <div class="item">
            <span>{{ $item['nama'] }}</span>
            <span>{{ $item['jumlah'] }} x {{ $item['harga'] }}</span>
        </div>
    @endforeach

    <div class="line"></div>
    <div class="item bold">
        <span>Total</span>
        <span>{{ $total }}</span>
    </div>

    <div class="center">-- Terima Kasih --</div>
</body>

</html>
