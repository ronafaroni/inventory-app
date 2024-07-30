@extends('template-admin.index')

@section('content-admin')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tambah Sales</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('kirim-sales') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Kode Sales</label>
                        <div class="col-md-10">
                            <input type="text" name="kode_sales" class="form-control" placeholder="Kode Sales" value="{{ old('kode_sales') }}">
                            @error('kode_sales')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Nama Sales</label>
                        <div class="col-md-10">
                            <input type="text" name="nama_sales" class="form-control" placeholder="Nama Sales" value="{{ old('nama_sales') }}">
                            @error('nama_sales')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Alamat</label>
                        <div class="col-md-10">
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat Sales" value="{{ old('alamat') }}">
                            @error('alamat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">No. Telp</label>
                        <div class="col-md-10">
                            <input type="number" name="no_telp" class="form-control" placeholder="No. Telp Sales" value="{{ old('no_telp') }}">
                            @error('no_telp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Username</label>
                        <div class="col-md-10">
                            <input type="text" name="username" class="form-control" placeholder="Username Sales" value="{{ old('username') }}">
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Password</label>
                        <div class="col-md-10">
                            <input type="password" name="password" class="form-control" placeholder="Password Sales" value="{{ old('password') }}">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror   
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Foto</label>
                        <div class="col-md-10">
                            <input type="file" name="foto" class="form-control" value="{{ old('foto') }}">
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn"><i class="fa fa-user-plus me-2" aria-hidden="true"></i>Tambah Sales</button>
                </div>
                </form>
        </div>
    </div>
</div>

@endsection
