<div class="card-heading">
    <p>Faktur Pembayaran {{ $no_faktur->no_faktur_barang }}</p>
    <h3><b>FP-{{ $no_faktur->no_faktur_barang }}</b></h3>
    <hr>
</div>
<table class="table">
    <thead>
        <tr>
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
                <td><b>{{ $item->nama_item }}</b><br>
                    Stok (pcs) : {{ $item->stok_toko ?? 0 }}<br>
                    Jual (pcs) : {{ $item->stok_terjual ?? 0 }}<br>
                    Return (pcs) : {{ $item->stok_return ?? 0 }}<br>
                    Sisa (pcs) : {{ $item->sisa_stok_toko - $item->stok_return ?? 0 }}<br>
                </td>
                <td>
                    <b>Rp. {{ number_format($item->total_bayar, 0, ',', '.') }}</b><br><br>
                    Diskon : {{ $item->diskon }} %<br>
                    Harga/pcs : {{ number_format($item->harga, 0, ',', '.') }}<br>
                    Total Harga : {{ number_format($item->total_harga, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>    