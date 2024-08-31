@extends('template-admin.index')

@section('content-admin')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Harga & Diskon</h5>
            </div>
            <form action="{{ route('update-harga', $harga->id_harga) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-group-item border-0 pb-0 mb-0">

                                    <input type="hidden" name="kode_item" id="kode_item" value="{{ $harga->kode_item }}">
                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Nama Item <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="nama_item" id="nama_item" class="form-control" placeholder="Masukan Nama Item" value="{{ $harga->item->nama_item }}" readonly>
                                            @error('nama_item')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Harga Satuan <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="number" name="harga" id="harga" class="form-control" placeholder="Masukan Harga Satuan" value="{{ $harga->harga }}">
                                            @error('harga')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Diskon (%)</label>
                                        <div class="col-md-10">
                                            <input type="number" name="diskon" oninput="cekHarga(this)" id="diskon" class="form-control" placeholder="Masukan Diskon" value="{{ $harga->diskon }}">
                                            @error('diskon')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Harga Diskon</label>
                                        <div class="col-md-10">
                                            <input type="text" name="harga_diskon" id="harga_diskon" class="form-control" value="{{ $harga->harga_diskon }}" readonly>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary paid-continue-btn" onclick="return confirm('Apakah anda yakin memperbarui harga ?')">
                        <i class="fa fa-dollar me-2" aria-hidden="true"></i>Update Harga
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
