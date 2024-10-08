@extends('app.index', ['title' => 'Faktur Bayar'])

@section('content-app')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-card">
            <div class="panel-heading">
                <div class="text-center">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="javascript:void(0);" class="btn btn-addon btn-info waves-effect btn-print" onclick="handlePrint('{{ route('app-cetak-faktur-pembayaran', $no_faktur->no_faktur_barang) }}')">
                                <i class="mdi mdi-action-print" aria-hidden="true"></i> Cetak Faktur Pembayaran
                            </a>  
                        </div>
                    </div>
                </div>
            </div>
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
                        <tr>
                            <td colspan="2" class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-success bg-history-light me-2" data-toggle="modal" data-target="#terjualModal{{ $item->id_faktur }}">
                                        <i class="fa fa-cart-plus me-1"></i> Terjual
                                    </button> 
                                    <button class="btn btn-info bg-success-light me-2" data-toggle="modal" data-target="#returnModal{{ $item->id_faktur }}">
                                        <i class="fa fa-exclamation-triangle me-1"></i> Return
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>    
        </div>
    </div>
</div>


<!-- Terjual Modal -->
@foreach ($faktur as $item)
<div class="modal fade" id="terjualModal{{ $item->id_faktur }}" tabindex="-1" aria-labelledby="terjualModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="terjualForm{{ $item->id_faktur }}" action="{{ route('app-save-terjual', $item->id_faktur) }}" method="POST">
                @csrf

                <input type="hidden" name="no_faktur_terjual" value="{{ $item->no_faktur_barang }}" required>
                <input type="hidden" name="harga" value="{{ $item->harga }}" required>
                <input type="hidden" name="diskon" value="{{ $item->diskon }}" required>

                <div class="modal-header">
                    <h5 class="modal-title" id="terjualModalLabel">Terjual (pcs)</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="terjualId">
                    <div class="mb-3">
                        <label for="jumlahTerjual" class="form-label">Jumlah Terjual</label>
                        <input type="number" class="form-control" id="jumlahTerjual" name="jumlah_terjual" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Barang Terjual</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Return Modal -->
@foreach ($faktur as $item)
<div class="modal fade" id="returnModal{{ $item->id_faktur }}" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="returnForm{{ $item->id_faktur }}" action="{{ route('app-save-return', $item->id_faktur) }}" method="POST">
                @csrf

                <input type="hidden" name="no_faktur_terjual" value="{{ $item->no_faktur_barang }}" required>
                <input type="hidden" name="sisa_stok" value="{{ $item->sisa_stok_toko }}" required>

                <div class="modal-header">
                    <h5 class="modal-title" id="returnModalLabel">Return (pcs)</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="returnId">
                    <div class="mb-3">
                        <label for="jumlahReturn" class="form-label">Jumlah Return</label>
                        <input type="number" class="form-control" id="jumlahReturn" name="jumlah_return" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Return Barang</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // AJAX for Terjual Form
    @foreach ($faktur as $item)
    $('#terjualForm{{ $item->id_faktur }}').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        var form = $(this);
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                // Update the table or any part of the page with new data
                location.reload(); // Optional: Refresh the page to see the changes
                $('#terjualModal{{ $item->id_faktur }}').modal('hide'); // Hide the modal
            },
            error: function(xhr) {
                alert('Something went wrong. Please try again.');
            }
        });
    });
    @endforeach

    // AJAX for Return Form
    @foreach ($faktur as $item)
    $('#returnForm{{ $item->id_faktur }}').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        var form = $(this);
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                // Update the table or any part of the page with new data
                location.reload(); // Optional: Refresh the page to see the changes
                $('#returnModal{{ $item->id_faktur }}').modal('hide'); // Hide the modal
            },
            error: function(xhr) {
                alert('Something went wrong. Please try again.');
            }
        });
    });
    @endforeach
});
</script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Fungsi untuk mencetak faktur
    function printFaktur(noFaktur) {
        $.ajax({
            url: '{{ url('/app-cetak-faktur-pembayaran') }}/' + noFaktur,
            type: 'GET',
            success: function(response) {
                // Buat jendela popup baru
                var printWindow = window.open('', '', 'width=800,height=600');
                
                // Tambahkan konten HTML ke jendela popup
                printWindow.document.open();
                printWindow.document.write('<html><head><title>Print Faktur</title>');
                printWindow.document.write('</head><body >');
                printWindow.document.write(response);
                printWindow.document.write('</body></html>');
                printWindow.document.close();

                // Tunggu jendela popup siap dan cetak
                printWindow.onload = function() {
                    printWindow.print();
                    printWindow.onafterprint = function() {
                        printWindow.close();
                    };
                };
            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat mengambil data untuk dicetak.');
            }
        });
    }

    // Tambahkan event handler untuk tombol print
    $('.btn-print').on('click', function(e) {
        e.preventDefault();
        var noFaktur = $(this).data('nofaktur'); // Ambil no_faktur dari data attribute
        printFaktur(noFaktur);
    });
});
</script> --}}




@endsection