@extends('template-admin.index')

@section('content-admin')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Toko</h5>
            </div>
            <form action="{{ route('update-toko', $toko->id_toko) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-group-item border-0 pb-0 mb-0">

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Kode Toko <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="kode_toko" class="form-control" placeholder="Kode Toko" value="{{ $toko->kode_toko }}">
                                            @error('kode_toko')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Nama Toko</label>
                                        <div class="col-md-10">
                                            <input type="text" name="nama_toko" class="form-control" placeholder="Nama Toko" value="{{ $toko->nama_toko }}">
                                            @error('nama_toko')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Pemilik Toko</label>
                                        <div class="col-md-10">
                                            <input type="text" name="pemilik_toko" class="form-control" placeholder="Nama Pemilik Toko" value="{{ $toko->pemilik_toko }}">
                                            @error('pemilik_toko')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Alamat</label>
                                        <div class="col-md-10">
                                            <input type="text" name="alamat" class="form-control" placeholder="Alamat Toko" value="{{ $toko->alamat }}">
                                            @error('alamat')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">No. Telp</label>
                                        <div class="col-md-10">
                                            <input type="number" name="no_telp" class="form-control" placeholder="No. Telp" value="{{ $toko->no_telp }}">
                                            @error('no_telp')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Link Gmap Toko</label>
                                        <div class="col-md-10">
                                            <input type="link" name="link_gmap" class="form-control" placeholder="Link Gmap Toko" value="{{ $toko->link_gmap }}">
                                            @error('link_gmap')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Nama Sales</label>
                                        <div class="col-md-10">

                                            <select name="kode_sales" id="kode_sales" class="form-control form-small">
                                                <option value="{{$toko->kode_sales}}"> Masukkan Nama Sales</option>
                                                @foreach ($data_sales as $item)
                                                    <option value="{{ $item->kode_sales }}" data-nama="{{ $item->nama_sales }}">{{ $item->kode_sales }} | {{ $item->nama_sales }}</option>
                                                @endforeach
                                            </select>
                                            @error('kode_sales')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="input-block mb-3 row">
                                        <label class="col-form-label col-md-2">Upload Gambar</label>
                                        <div class="col-md-10">
                                            <div class="input-block service-upload mb-0">
                                                {{-- <span><img src="assets/img/icons/drop-icon.svg" alt="upload"></span> --}}
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
                    <button type="submit" class="btn btn-primary paid-continue-btn" onclick="return confirm('Apakah anda yakin mengubah data ini ?')">
                        <i class="fa fa-home me-2" aria-hidden="true"></i>Update Toko
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

