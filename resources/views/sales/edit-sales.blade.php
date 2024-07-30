@extends('template-admin.index')

@section('content-admin')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Data Sales</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('update-sales', $sales->id_sales) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Kode Sales</label>
                        <div class="col-md-10">
                            <input type="text" name="kode_sales" class="form-control" placeholder="Kode Sales" value="{{ $sales->kode_sales }}">
                            @error('kode_sales')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Nama Sales</label>
                        <div class="col-md-10">
                            <input type="text" name="nama_sales" class="form-control" placeholder="Nama Sales" value="{{ $sales->nama_sales }}">
                            @error('nama_sales')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Alamat</label>
                        <div class="col-md-10">
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat Sales" value="{{ $sales->alamat }}">
                            @error('alamat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">No. Telp</label>
                        <div class="col-md-10">
                            <input type="number" name="no_telp" class="form-control" placeholder="No. Telp Sales" value="{{ $sales->no_telp }}">
                            @error('no_telp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Username</label>
                        <div class="col-md-10">
                            <input type="text" name="username" class="form-control" placeholder="Username Sales" value="{{ $sales->username }}">
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Password</label>
                        <div class="col-md-10">
                            <input type="text" name="password" class="form-control" placeholder="Password Sales">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror   
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Foto</label>
                        <div class="col-md-10">
                            <input type="file" name="foto" class="form-control" value="{{ $sales->foto }}">
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn" onclick="return confirm('Apakah anda yakin mengubah data ini ?')"><i class="fa fa-refresh me-2" aria-hidden="true"></i>Update Sales</button>
                </div>
                </form>
        </div>
    </div>
</div>

@endsection
