@extends('template-admin.index')

@section('content-admin')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Item</h5>
            </div>
            <form action="{{ route('update-item', $item->id_item) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-group-item border-0 pb-0 mb-0">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 mb-3">
                                            <label>Kode Item <span class="text-danger">*</span></label>
                                            <input type="text" name="kode_item" value="{{ $item->kode_item }}" class="form-control" autocomplete="off" placeholder="ID Item Barang" @error('kode_item') is-invalid @enderror>
                                            @error('kode_item')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 col-sm-12 mb-3">
                                            <label>Nama Item <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_item" value="{{ $item->nama_item }}" class="form-control" autocomplete="off" placeholder="Nama Item Barang" @error('nama_item') is-invalid @enderror>
                                            @error('nama_item')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
        
                                        <div class="col-lg-12 col-sm-12 mb-0 pb-0">
                                            <label>Upload Gambar</label>
                                            <div class="input-block service-upload mb-0">
                                                <span><img src="{{ asset('assets/img/icons/drop-icon.svg') }}" alt="upload"></span>
                                                <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                                <p class="text-muted">Maximum size: 5MB</p>
                                                <input type="file" name="upload_gambar" value="{{ $item->gambar_produk }}" multiple="" id="image_sign" @error('upload_gambar') is-invalid @enderror>
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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-refresh me-2" aria-hidden="true"></i> Update Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
