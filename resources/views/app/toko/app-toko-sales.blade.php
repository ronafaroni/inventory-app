@extends('app.index', ['title' => 'Toko Sales'])

@section('content-app')
    <br>
    <div class="text-right">
        <a href="{{ route('app-tambah-toko') }}" class="btn btn-addon btn-primary waves-effect"><i class="fa fa-plus"></i>Tambah Toko</a>
    </div>
    <br>

    @if(session('success'))
    <div class="alert alert-primary" role="alert">
            <strong>Selamat! </strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('update'))
    <div class="alert alert-primary" role="alert">
            <strong>Selamat! </strong> {{ session('update') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('delete'))
    <div class="alert alert-primary" role="alert">
            <strong>Selamat! </strong> {{ session('delete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @foreach ($toko as $data)
        
        <div class="row">
            <div class="col-sm-12">
            <div class="panel panel-card">
                <a href="{{ route('app-faktur-barang', $data->kode_toko) }}">
                    <div class="item">
                        <img src="{{ asset($data->gambar_toko) }}" class="w-full r-t" style="max-width: 100%; height: 200px; object-fit: cover;" />
                            <div class="bottom text-white p">
                                <h3><b>{{$data->nama_toko}}</b></h3>
                                <p>{{$data->pemilik_toko}}</p>
                            </div>
                    </div>
                </a>

                @php
                    $stokTokoData = $stok_toko->firstWhere('kode_toko', $data->kode_toko);
                @endphp

                <form action="{{ route('app-delete-toko', $data->id_toko) }}" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" md-ink-ripple class="md-btn md-fab orange m-r md-fab-offset pull-right">
                        <span><i class="mdi-action-delete i-24"></i></span>
                    </button>
                </form> 
                
                <div class="p">
                    <p>Kode Toko : {{ $data->kode_toko }}</p>
                    <p>Alamat : {{ $data->alamat }}</p>
                    <p>Jumlah Stok : {{ $stokTokoData ? ($stokTokoData->total_stok_toko - $stokTokoData->total_terjual - $stokTokoData->total_return) : 0 }}</Jumlah>
                    <p>Jumlah Penjualan : {{ $stok_toko->firstWhere('kode_toko', $data->kode_toko)->total_terjual ?? 0 }} pcs</p>
                    <hr>
                    <div class="btn-group" style="width: 100%; display: flex; justify-content: space-between;">
                        <a href="{{ route('app-edit-toko', $data->id_toko) }}" class="text-muted">
                            <i class="mdi mdi-action-settings" aria-hidden="true" style="margin-right: 2px;"></i> Edit
                        </a>
                        <a href="javascript:void(0);" class="text-muted" onclick="handlePrint('{{ route('app-cetak-toko', $data->kode_toko) }}')">
                            <i class="mdi mdi-action-print" aria-hidden="true" style="margin-right: 2px;"></i> Cetak
                        </a>                     
                    </div>
                    
                </div> 
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

  @endsection