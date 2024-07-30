@extends('template-user.index')

@section('content-user')

    <div class="card">

        @if (!empty($toko) && is_iterable($toko))
            @foreach ($toko as $sale)
                <tr>
                    <td>{{ $sale->nama_toko }}</td>
                </tr>
            @endforeach
        @else
        <tr>
            <td colspan="4">Tidak ada data sales tersedia.</td>
        </tr>
        @endif

    </div>

@endsection
