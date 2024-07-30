@extends('template-admin.index')

@section('content-admin')
    
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Stok Barang / Tambah Item</h5>
            </div>
            <form action="{{ route('simpan-item') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-group-item border-0 pb-0 mb-0">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Kode Item <span class="text-danger">*</span></label>
                                                <input type="text" name="kode_item" class="form-control" autocomplete="off" value="{{ old('kode_item') }}" placeholder="ID Item Barang" @error('kode_item') is-invalid @enderror>
                                                @error('kode_item')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>											
                                        </div>
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Nama Item <span class="text-danger">*</span></label>
                                                <input type="text" name="nama_item" class="form-control" autocomplete="off" value="{{ old('nama_item') }}" placeholder="Nama Item Barang" @error('nama_item') is-invalid @enderror>
                                                @error('nama_item')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror										
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>Stok Barang (pcs) <span class="text-danger">*</span></label>
                                                <input type="number" name="stok_item" class="form-control" autocomplete="off" value="{{ old('stok_item') }}" placeholder="Stok Barang Gudang" @error('stok_item') is-invalid @enderror>
                                                @error('stok_item')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror	
                                            </div>									
                                        </div>
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="input-block mb-0 pb-0">
                                                <label>Upload Gambar</label>
                                                <div class="input-block service-upload mb-0">
                                                    <span><img src="assets/img/icons/drop-icon.svg" alt="upload"></span>
                                                    <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                                    <p class="text-muted">Maximum size: 5MB</p>	
                                                    <input type="file" name="upload_gambar" multiple="" value="{{ old('upload_gambar') }}" id="image_sign" @error('upload_gambar') is-invalid @enderror>
                                                    <div id="frames"></div>
                                                </div>
                                                @error('upload_gambar')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror										
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn"><i class="fa fa-download me-2" aria-hidden="true"></i>Tambah Item</button>
                </div>
            </form> 
        </div>
    </div>
</div>

@endsection