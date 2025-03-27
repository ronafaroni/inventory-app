@extends('template-admin.index')

@section('content-admin')
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-body w-100">
                    <div class="content-page-header">
                        <h5 class="setting-menu">Profile Settings</h5>
                    </div>
                    <div class="row">
                        <div class="profile-picture">
                            <div class="upload-profile me-2">
                                <div class="profile-img">
                                    <img id="blah" class="avatar" src="{{ asset('assets/img/user.jpg') }}"
                                        alt="profile-img">
                                </div>
                            </div>
                            <div class="img-upload">
                                <h2>{{ $user->name }}</h2>
                                <p class="mt-1">Update : {{ $user->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-title">
                                <h5>Update Password</h5>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Selamat! </strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif(session('update'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Selamat! </strong> {{ session('update') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif(session('delete'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Selamat! </strong> {{ session('delete') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('update-profile', $user->id) }}" method="POST">
                            @csrf
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>New Password</label>
                                    <input type="text" class="form-control" name="password"
                                        placeholder="Enter New Password">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <button class="btn btn-primary"
                                    onclick="return confirm('Apakah anda yakin mengubah password?')">Update
                                    Password</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
