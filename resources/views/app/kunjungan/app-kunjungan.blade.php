@extends('app.index', ['title' => 'Kunjungan Toko'])

@section('content-app')


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading bg-white">
                <b>Kunjungan Toko</b><br>
            </div>
            <div class="panel-body">
                <form action="{{ route('app-simpan-kunjungan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div id="reader" width="100px"></div>
                    </div>
                    <input type="hidden" class="form-control" name="latitude" id="latitude" readonly>
                    <input type="hidden" class="form-control" name="longitude" id="longitude" readonly>

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id_toko" id="id_toko" placeholder="Masukkan ID Toko" readonly>
                        @error('id_toko')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_toko">Kode Toko</label>
                        <input type="text" class="form-control" name="kode_toko" id="kode_toko" placeholder="Masukkan Kode Toko" readonly>
                        @error('kode_toko')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_toko">Nama Toko</label>
                        <input type="text" class="form-control" name="nama_toko" id="nama_toko" placeholder="Masukkan Nama Toko" readonly>
                        @error('nama_toko')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pemilik_toko">Pemilik Toko</label>
                        <input type="text" class="form-control" name="pemilik_toko" id="pemilik_toko" placeholder="Masukkan Pemilik Toko" readonly>
                        @error('pemilik_toko')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary m-b waves-effect">Kirim Lokasi Kunjungan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    document.getElementById('latitude').value = position.coords.latitude;
    document.getElementById('longitude').value = position.coords.longitude;
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
}

// Call the function to get the location when the page loads or when needed
window.onload = function() {
    getLocation();
};

</script>

<script>
    function onScanSuccess(decodedText, decodedResult) {
        console.log(`Code matched = ${decodedText}`, decodedResult);
        document.getElementById('id_toko').value = decodedText;

        fetch(`/get-toko/${decodedText}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('kode_toko').value = data.toko.kode_toko;
                    document.getElementById('nama_toko').value = data.toko.nama_toko;
                    document.getElementById('pemilik_toko').value = data.toko.pemilik_toko;
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function onScanFailure(error) {
        console.warn(`Code scan error = ${error}`);
    }

    let html5QrCode = new Html5Qrcode("reader");

    html5QrCode.start(
        { facingMode: "environment" },  // Ubah ke "user" jika menggunakan kamera depan
        { fps: 10, qrbox: { width: 300, height: 300 } }, // Coba ukuran berbeda jika perlu
        onScanSuccess,
        onScanFailure
    )
    .catch(err => {
        console.error('Unable to start scanning.', err);
    });
</script>

@endsection

