@extends('app.index', ['title' => 'Profile Sales'])

@section('content-app')
<div class="row row-sm">
    <div class="col-sm-12">
      <div class="panel panel-card">
        <div class="r-t pos-rlt" md-ink-ripple style="background:url({{ $data->foto }}) center center; background-size:cover">
          <div class="p-lg bg-white-overlay text-center r-t">
            <div class="m-b m-t-sm h2 text-center">
              <img src="{{ $data->foto }}" class="img-circle img-fluid" style="width: 50%;">
              <br>
              <span>{{ $data->nama_sales }}</span>
          </div>
          
          <div class="text-center">
              @if ($data->pencapaian > 0)
                  @for ($i = 0; $i < $data->pencapaian; $i++)
                      <i class="fa fa-star"></i>
                  @endfor
              @endif
          </div>
          
        </div>

       <div class="panel-body">
            <div class="row">
                <div class="col-xs-6">
                    {{ $data->nama_sales }} <br>
                    ID Sales {{ $data->kode_sales }} <br>
                    {{ $data->alamat }}
                </div>
                <div class="col-xs-6">
                    Total Toko : {{number_format( $data->toko->count(), 0, ',', '.') }} <br>
                    Total Stok : {{ number_format( $stok->total_stok_sales -  $stok_terjual->total_stok_terjual, 0, ',', '.') ?? 0 }}<br>
                    Total Penjualan : {{ number_format( $stok_terjual->total_stok_terjual , 0, ',', '.') ?? 0 }}
                </div>
            </div> 
       </div>
       
       <hr>
      </div>
    </div>
  </div>

  <h4 class="text-center"><b>Stok Sales</b></h4>

@foreach ($stok_sales as $data)
  <div class="card">
    <div class="card-body">
      <h4><b>{{ $data->nama_item }}</b></h4>
      <div class="row">
          <div class="col-xs-12"> 
              Jumlah Stok (pcs) : {{ number_format($data->total_stok_sales - $data->total_stok_terjual, 0, ',', '.') ?? 0 }}<br>
              Jumlah Penjualan (pcs) : {{ number_format($data->total_stok_terjual, 0, ',', '.') ?? 0 }}<br>
              Harga (Rp.) : {{ number_format($data->harga->harga, 0, ',', '.') }}<br>
              Diskon (%) : {{ $data->harga->diskon ?? 0 }} %<br>
              Total Harga : {{ number_format($data->harga->harga_diskon, 0, ',', '.') }}
          </div>
      </div>
    </div>
  </div>
@endforeach

@endsection