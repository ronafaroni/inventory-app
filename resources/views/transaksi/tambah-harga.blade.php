@extends('template-admin.index')

@section('content-admin')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tambah Harga & Diskon</h5>
            </div>
            <form action="{{ route('simpan-harga') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-group-item border-0 pb-0 mb-0">

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Nama Item <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select name="kode_item" mid="kode_item" class="form-control form-small">
                                                <option selected disabled> Pilih Item</option>
                                                @foreach ($items as $data)
                                                    <option value="{{ $data->kode_item }}" data-nama="{{ $data->nama_item }}">{{ $data->kode_item }} | {{ $data->nama_item }}</option>
                                                @endforeach
                                            </select>
                                            @error('kode_item')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Harga Satuan <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="number" name="harga" id="harga" class="form-control" placeholder="Masukan Harga Satuan" value="{{ old('harga') }}">
                                            @error('harga')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Diskon (%)</label>
                                        <div class="col-md-10">
                                            <input type="number" name="diskon" oninput="cekHarga(this)" id="diskon" class="form-control" placeholder="Masukan Diskon" value="{{ old('diskon') }}">
                                            @error('diskon')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Harga Diskon</label>
                                        <div class="col-md-10">
                                            <input type="text" name="harga_diskon" id="harga_diskon" class="form-control" readonly>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary paid-continue-btn" onclick="return confirm('Apakah anda yakin menambahkan harga ?')">
                        <i class="fa fa-dollar me-2" aria-hidden="true"></i>Simpan Harga
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<script>
    function cekHarga(e) {
        let diskon = e.value;
        let harga = document.getElementById('harga').value;
        let harga_diskon = document.getElementById('harga_diskon');
        let total = (diskon / 100) * harga;
        let total_diskon = harga - total;
        harga_diskon.value = total_diskon;
    }
</script>
