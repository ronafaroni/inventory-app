@extends('template-admin.index')

@section('content-admin')
<div class="signature-invoice">
    <div class="page-header">
        <div class="content-page-header">
            <h5>Tambah Stok Sales</h5>
        </div>    
    </div>                  
    <div class="row">
        <div class="col-md-12">
            <div class="edit-card">
                <div class="card-body">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat! </strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @elseif(session('update'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Selamat! </strong> {{ session('update') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Selamat! </strong> {{ session('delete') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="form-group-item border-0 mb-0">
                        <div class="row align-item-center">
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                
                                <form id="dataForm">

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Kode Sales</label>
                                        <div class="col-md-10">
                                            <input type="text" name="kode_sales" id="kode_sales" class="form-control" value="{{ $data_sales->kode_sales }}" disabled>
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Nama Sales</label>
                                        <div class="col-md-10">
                                            <input type="text" name="nama_sales" id="nama_sales" class="form-control" value="{{ $data_sales->nama_sales }}" disabled>
                                        </div>
                                    </div>
                
                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Jenis Item</label>
                                        <div class="col-md-10">
                                            <select name="kode_item" id="kode_item" class="form-control form-small">
                                                <option selected> Masukan Jenis Item</option>
                                                @foreach ($data_item as $item)
                                                    <option value="{{ $item->nama_item }}" data-kode="{{ $item->kode_item }}">{{ $item->kode_item }} | {{ $item->nama_item }}</option>
                                                @endforeach
                                            </select>
                                            @error('kode_item')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Tambah Stok (pcs)</label>
                                        <div class="col-md-10">
                                            <input type="number" name="tambah_stok" id="tambah_stok" class="form-control" placeholder="Tambah Stok (pcs)" value="{{ old('tambah_stok') }}">
                                            @error('tambah_stok')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <div class="d-flex justify-content-end">
                                        <button type="button" id="addData" class="btn btn-primary me-3">
                                            <i class="fa fa-cart-plus me-2" aria-hidden="true"></i>Tambahkan
                                        </button>
                                        <a class="btn btn-import" href="{{ route('riwayat-stok-sales', $data_sales->kode_sales) }}">
                                            <i class="fa fa-eye me-2" aria-hidden="true"></i>Riwayat
                                        </a>
                                    </div>
                                    
                                </form>
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group-item">
                        <div class="card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-center table-hover datatable" id="dataTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Item</th>
                                                <th>Nama Item</th>
                                                <th>Stok Item (pcs)</th>
                                                <th class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Rows will be added here dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="preview-boxs">
                        <p>Total tambah stok: <span id="totalStok">0</span> pcs</p>
                        <form method="POST" action="{{ route('simpan-stok-sales') }}" id="saveForm" class="add-customer-btns text-end">
                            @csrf
                            <input type="hidden" name="data" id="data">
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin menambah stok sales ?')"><i class="fa fa-check-circle me-2" aria-hidden="true"></i>Simpan Stok</button>
                        </form>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    let dataArray = [];
    
    $('#addData').on('click', function() {
        const kodeSales = $('#kode_sales').val();
        const namaSales = $('#nama_sales').val();
        const kodeItem = $('#kode_item option:selected').data('kode');
        const namaItem = $('#kode_item').val();
        const tambahStok = $('#tambah_stok').val();
        
        if ( kodeSales && namaSales && kodeItem && namaItem && tambahStok) {
            const dataObject = { kodeSales, namaSales, kodeItem, namaItem, tambahStok };
            dataArray.push(dataObject);
            updateTable();
            $('#dataForm')[0].reset();
        }
    });

    function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Format dengan titik
    }

    function updateTable() {
        const tableBody = $('#dataTable tbody');
        tableBody.empty();
        let totalStok = 0;

        dataArray.forEach((data, index) => {
            totalStok += parseInt(data.tambahStok, 10); // Menambahkan stok item ke total stok
            tableBody.append(`
                <tr>
                    <td>${index + 1}</td>
                    <td>${data.kodeItem}</td>
                    <td>${data.namaItem}</td>
                    <td>${formatRupiah(data.tambahStok)}</td> <!-- Menggunakan formatRupiah -->
                    <td class="d-flex">
                        <button type="button" class="btn btn-import me-2" onclick="deleteData(${index})"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            `);
        });

        $('#totalStok').text(formatRupiah(totalStok)); // Menampilkan total stok dengan format rupiah
    }

    function deleteData(index) {
        dataArray.splice(index, 1); 
        updateTable();
    }

    $('#saveForm').on('submit', function() {
        $('#data').val(JSON.stringify(dataArray));
    });
</script>

@endsection
