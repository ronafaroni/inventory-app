@extends('app.index', ['title' => 'Tambah Toko'])

@section('content-app')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading bg-white">
                Form Tambah Toko<br>
              </div>
              <div class="panel-body">
                <form action="{{ route('app-simpan-toko') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kode Toko</label>
                    <input type="text" class="form-control" name="kode_toko" id="exampleInputEmail1" placeholder="Masukkan Kode Toko" value="{{old('kode_toko')}}">
                    @error('kode_toko')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nama Toko</label>
                    <input type="text" class="form-control" name="nama_toko" id="exampleInputPassword1" placeholder="Masukkan Nama Toko" value="{{old('nama_toko')}}">
                    @error('nama_toko')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pemilik Toko</label>
                    <input type="text" class="form-control" name="pemilik_toko" id="exampleInputEmail1" placeholder="Masukkan Pemilik Toko" value="{{old('pemilik_toko')}}">
                    @error('pemilik_toko')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="alamat" placeholder="Masukkan Alamat" value="{{old('alamat')}}">
                    @error('alamat')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">No. Telp</label>
                    <input type="number" class="form-control" name="no_telp" id="exampleInputEmail1" placeholder="Masukkan No. Telp" value="{{old('no_telp')}}">
                    @error('no_telp')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Link Gmaps</label>
                    <input type="text" class="form-control" name="link_gmap" id="exampleInputPassword1" placeholder="Masukkan Link Gmaps" value="{{old('link_gmap')}}">
                    @error('link_gmap')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Upload Gambar</label>
                    <input type="file" name="gambar" id="exampleInputFile">
                    @error('gambar')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-primary m-b waves-effect">Tambah Toko</button>
                </form>
              </div>
            </div>
          </div>
    </div>
@endsection