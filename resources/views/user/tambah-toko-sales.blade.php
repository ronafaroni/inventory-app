@extends('template-user.index')

@section('content-user')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tambah Toko</h5>
            </div>
            <form action="{{ route('simpan-toko-sales') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-group-item border-0 pb-0 mb-0">

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Kode Toko <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="kode_toko" class="form-control" placeholder="Kode Toko" value="{{ old('kode_toko') }}">
                                            @error('kode_toko')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Nama Toko <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="nama_toko" class="form-control" placeholder="Nama Toko" value="{{ old('nama_toko') }}">
                                            @error('nama_toko')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Pemilik Toko <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="pemilik_toko" class="form-control" placeholder="Nama Pemilik Toko" value="{{ old('pemilik_toko') }}">
                                            @error('pemilik_toko')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Alamat <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="alamat" class="form-control" placeholder="Alamat Toko" value="{{ old('alamat') }}">
                                            @error('alamat')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">No. Telp <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="number" name="no_telp" class="form-control" placeholder="No. Telp" value="{{ old('no_telp') }}">
                                            @error('no_telp')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Link Gmap Toko <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="link" name="link_gmap" class="form-control" placeholder="Link Gmap Toko" value="{{ old('link_gmap') }}">
                                            @error('link_gmap')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Upload Gambar <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <div class="input-block service-upload mb-0">
                                                <span><img src="assets/img/icons/drop-icon.svg" alt="upload"></span>
                                                <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                                <p class="text-muted">Maximum size: 5MB</p>	
                                                <input type="file" name="gambar_toko" multiple="" id="image_sign" @error('gambar_toko') is-invalid @enderror>
                                                <div id="frames"></div>
                                            </div>
                                            @error('gambar_toko')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary paid-continue-btn" onclick="return confirm('Apakah anda yakin menambahkan data ini ?')">
                        <i class="fa fa-home me-2" aria-hidden="true"></i>Tambah Toko
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Mengatur nilai input nama_sales berdasarkan pilihan kode_sales
    $('#kode_sales').change(function() {
        var selectedNama = $(this).find(':selected').data('nama');
        $('#nama_sales').val(selectedNama);
    });
</script>
@endpush

