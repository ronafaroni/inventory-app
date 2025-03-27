<div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>ID Sales</th>
                <th>Nama Sales</th>
                <th>Nama Toko</th>
                <th>Lokasi</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @if($kunjungan->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">Data tidak ditemukan</td>
                </tr>
            @else

            @foreach ($kunjungan as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->kode_sales }}</td>
                    <td>{{ $data->nama_sales }}</td>
                    <td>{{ $data->nama_toko }}</td>
                    <td>
                        <a href="https://www.google.com/maps?q={{ $data->latitude }},{{ $data->longitude }}" target="_blank">
                            {{ $data->latitude }}, {{ $data->longitude }}
                        </a>
                    </td>
                    <td>{{ $data->created_at }}</td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
