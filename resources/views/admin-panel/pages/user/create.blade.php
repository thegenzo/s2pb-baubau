@extends('admin-panel.layout.app')

@section('title', 'Tambah Data User')

@push('addon-style')
	<!-- PrismJS -->
	<link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/prismjs/themes/prism-okaidia.min.css') }}">
	<!-- Select2 -->
	<link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card bg-light-secondary shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Tambah Data User</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted"
                                        href="{{ route('admin-panel.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a class="text-muted"
                                        href="{{ route('admin-panel.user.index') }}">Data User</a></li>
                                <li class="breadcrumb-item" aria-current="page">Tambah Data User</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center">
                            <img src="{{ asset('panel-assets/dist/images/breadcrumb/userGroup.png') }}" alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h4 class="mb-0 text-white card-title">Masukkan Data User Disini</h4>
                    </div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <h3 class="text-white">Gagal Simpan Data</h3> 
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('admin-panel.user.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex justify-content-center">
                                <img src="https://via.placeholder.com/500x500.png" class="img-fluid"
                                    style="max-height:400px;" id="avatar_image_preview" alt="Avatar">
                            </div>
                            <div class="form-group mb-3">
                                <label for="avatar">Avatar</label>
                                <input type="file" name="avatar" id="avatar" class="form-control"
                                    value="{{ old('name') }}">
                                <small class="text-muted">File avatar harus berupa gambar (Boleh Dikosongkan)</small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}">
                            </div>
							<div class="form-group mb-3">
                                <label for="name">Level <span class="text-danger">*</span></label>
                                <select name="level" id="level" class="select2 form-control" style="width: 100%; height: 36px">
									<option value="" selected hidden>--- Pilih Level ---</option>
									<option value="admin" {{ old('level') == 'admin' ? 'selected' : ''}}>Admin</option>
									<option value="user" {{ old('level') == 'user' ? 'selected' : ''}}>User</option>
								</select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            value="{{ old('password') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="password_confirmation">Konfirmasi Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('admin-panel.user.index') }}" class="btn btn-warning mx-2">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
	<script src="{{ asset('panel-assets/dist/libs/select2/dist/js/select2.full.min.js') }}"></script>
	<script src="{{ asset('panel-assets/dist/libs/select2/dist/js/select2.min.js') }}"></script>
	{{-- <script src="{{ asset('panel-assets/dist/libs/prismjs/prism.js') }}"></script> --}}
    <script>
		$(".select2").select2();

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#avatar_image_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#avatar").change(function() {
            readURL(this);
        });
    </script>
@endpush
