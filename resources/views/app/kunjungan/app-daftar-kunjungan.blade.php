@extends('app.index', ['title' => 'Riwayat Kunjungan'])

@section('content-app')

<br>
<div class="text-center">
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('app-kunjungan') }}" class="btn btn-addon btn-success waves-effect"><i class="mdi-device-now-wallpaper"></i>Scan Lokasi</a>
        </div>
    </div>
</div>
<br>
<div class="panel panel-card">
    <div class="panel-heading">Historis Kunjungan</div>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Toko</th>
          <th>Waktu</th>
        </tr>
      </thead>
      <tbody>

        @foreach ( $kunjungan as $data)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $data->nama_toko }}</td>
          <td>{{ $data->created_at }}</td>
        </tr>
        @endforeach

      </tbody>
    </table>    
  </div>
@endsection