@extends('app.index', ['title' => 'Tambah Stok Toko'])

@section('content-app')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading bg-white">
                Form Tambah Stok<br>
              </div>
              <div class="panel-body">
                <form id="dataForm">
                    @csrf
                
                    <div class="input-block mb-3 row">
                        <div class="col-md-10">
                            <input type="hidden" name="kode_toko" id="kode_toko" class="form-control" value="{{ $toko->kode_toko }}" disabled>
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <div class="col-md-10">
                            <input type="hidden" name="kode_sales" id="kode_sales" class="form-control" value="{{ $sales->kode_sales }}" disabled>
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <div class="col-md-10">
                            <input type="hidden" name="nama_sales" id="nama_sales" class="form-control" value="{{ $sales->nama_sales }}" disabled>
                        </div>
                    </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Item</label>
                    <select name="kode_item" id="kode_item" class="form-control form-small">
                        <option selected> Masukan Jenis Item</option>
                        @foreach ($item as $item)
                            <option value="{{ $item->kode_item }}" data-nama="{{ $item->nama_item }}">{{ $item->nama_item }}</option>
                        @endforeach
                    </select>
                    @error('kode_item')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tambah Stok</label>
                    <input type="number" name="tambah_stok" id="tambah_stok" class="form-control" placeholder="Tambah Stok (pcs)" value="{{ old('tambah_stok') }}">
                    @error('tambah_stok')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Harga (pcs)</label>
                    <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga') }}" readonly>
                    @error('harga')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Diskon (%)</label>
                    <input type="number" name="diskon" id="diskon" class="form-control" value="{{ old('diskon') }}" readonly>
                    @error('diskon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Total Harga (Rp.)</label>
                    <input type="number" name="total_harga" id="total_harga" class="form-control" value="{{ old('total_harga') }}" readonly>
                    @error('total_harga')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                  <button type="button" id="addData"  class="btn btn-primary m-b waves-effect">Tambah Stok</button>
                </form>

                <div class="panel panel-default">
                    <div class="panel-heading">
                      DataTables
                    </div>
                    <div class="table-responsive">
                      <table ui-jp="dataTable" id="dataTable" ui-options="{
                          sAjaxSource: '{{asset('assets-app/api/datatable.json')}}',
                          aoColumns: [
                            { mData: 'engine' },
                            { mData: 'browser' },
                            { mData: 'platform' },
                            { mData: 'version' },
                            { mData: 'grade' }
                          ]
                        }" class="table table-striped b-t b-b">
                        <thead>
                          <tr>
                            <th  style="width:25%">Nama Item</th>
                            <th  style="width:25%">Harga</th>
                            <th  style="width:15%">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="preview-boxs">
                    <p>Total tambah stok: <span id="totalStok">0</span> pcs</p>
                    <form method="POST" action="{{ route('app-simpan-faktur-barang') }}" id="saveForm" class="text-right">
                        @csrf
                        <input type="hidden" name="data" id="data">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin membuat faktur barang ?')">Simpan Faktur Barang</button>
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
    $(document).ready(function() {
        let dataArray = [];
    
        $('#kode_item').on('change', function() {
            const kodeItem = $(this).val();
    
            if (kodeItem) {
                $.ajax({
                    url: '/item-details/' + kodeItem,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#harga').val(data.harga);
                        $('#diskon').val(data.diskon);
                        calculateTotalHarga();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error getting item details:', error);
                    }
                });
            } else {
                $('#harga').val('');
                $('#diskon').val('');
                $('#total_harga').val('');
            }
        });
    
        $('#tambah_stok, #diskon').on('input', calculateTotalHarga);
    
        function calculateTotalHarga() {
            const harga = parseFloat($('#harga').val()) || 0;
            const diskon = parseFloat($('#diskon').val()) || 0;
            const stok = parseFloat($('#tambah_stok').val()) || 0;
            const totalHarga = stok * harga * ((100 - diskon) / 100);
            $('#total_harga').val(totalHarga);
        }
    
        $('#addData').on('click', function() {
            const kodeToko = $('#kode_toko').val();
            const kodeSales = $('#kode_sales').val();
            const kodeItem = $('#kode_item').val();
            const namaItem = $('#kode_item option:selected').text();
            const stok = $('#tambah_stok').val();
            const harga = $('#harga').val();
            const diskon = $('#diskon').val();
            const totalHarga = $('#total_harga').val();
    
            if (kodeToko && kodeSales && kodeItem && namaItem && stok && harga && diskon && totalHarga) {
                const dataObject = { kodeToko, kodeSales, kodeItem, namaItem, stok, harga, diskon, totalHarga };
                dataArray.push(dataObject);
                updateTable();
                $('#dataForm')[0].reset();
            }
        });
    
        function updateTable() {
            $('#dataTable tbody').empty();
            let totalStok = 0;
    
            if (dataArray.length === 0) {
                $('#totalStok').text('0');
                return;
            }
    
            dataArray.forEach((data, index) => {
                totalStok += parseFloat(data.stok);
                const newRow = `
                    <tr>
                        <td>${data.namaItem}<br>
                        Stok (pcs) : ${data.stok}<br>
                        Harga (Rp.) : ${parseFloat(data.harga)}<br>
                        Diskon (%) : ${data.diskon}</td>
                        <td>${parseFloat(data.totalHarga)}</td>
                        <td class="d-flex">
                            <button type="button" class="btn btn-import btn-sm removeRow" data-index="${index}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                `;
                $('#dataTable tbody').append(newRow);
            });
    
            $('#totalStok').text(totalStok);
        }
    
        $('#dataTable').on('click', '.removeRow', function() {
            const index = $(this).data('index');
            dataArray.splice(index, 1);
            updateTable();
    
            if (dataArray.length === 0) {
                $('#dataForm')[0].reset();
                $('#kode_item').focus();
            }
        });
    
        // Add validation rules in your form submit handler
        $('#saveForm').on('submit', function(e) {
            if (dataArray.length === 0) {
                alert('Data tidak boleh kosong.');
                e.preventDefault();
            }
            $('#data').val(JSON.stringify(dataArray));
        });

    });

    </script>
    
@endsection