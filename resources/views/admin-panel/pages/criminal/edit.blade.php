@extends('admin-panel.layout.app')

@section('title', 'Edit Data Pelaku Tindak Pidana')

@push('addon-style')
	<!-- PrismJS -->
	<link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/prismjs/themes/prism-okaidia.min.css') }}">
	<!-- Select2 -->
	<link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card bg-light-warning shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Edit Data Pelaku Tindak Pidana</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted"
                                        href="{{ route('admin-panel.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a class="text-muted"
                                        href="{{ route('admin-panel.criminal.index') }}">Data Pelaku Tindak Pidana</a></li>
                                <li class="breadcrumb-item" aria-current="page">Edit Data Pelaku Tindak Pidana</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n2">
                            <img src="{{ asset('panel-assets/dist/images/breadcrumb/partnership.png') }}" alt=""
                                class="img-fluid mb-n2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h4 class="mb-0 text-white card-title">Edit Data PTP Disini</h4>
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
                        <form method="POST" action="{{ route('admin-panel.criminal.update', $criminal->id) }}">
                            @csrf
							@method('PUT')
                            <div class="form-group mb-3">
                                <label for="name">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $criminal->name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="criteria_id">Kriteria Tindak Pidana <span class="text-danger">*</span></label>
                                <select name="criteria_id" id="criteria_id" class="select2 form-control" style="width: 100%; height: 36px">
									@foreach (\App\Models\Criteria::all() as $criteria)
                                    <option value="{{ $criteria->id }}" {{ $criminal->criteria_id == $criteria->id ? 'selected' : '' }}>{{ $criteria->name }}</option>
                                    @endforeach
								</select>
                            </div>
                            <div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group mb-3">
										<label for="date_of_birth">Tanggal Lahir <span class="text-danger">*</span></label>
										<input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
											value="{{ $criminal->date_of_birth }}">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group mb-3">
										<label for="place_of_birth">Tempat Lahir <span class="text-danger">*</span></label>
										<input type="text" name="place_of_birth" id="place_of_birth" class="form-control"
											value="{{ $criminal->place_of_birth }}">
									</div>
								</div>
                            </div>
							<div class="form-group mb-3">
                                <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="gender" id="gender" class="select2 form-control" style="width: 100%; height: 36px">
									<option value="male" {{ $criminal->gender == 'male' ? 'selected' : ''}}>Laki-laki</option>
									<option value="female" {{ $criminal->gender == 'female' ? 'selected' : ''}}>Perempuan</option>
								</select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="address">Alamat <span class="text-danger">*</span></label>
                                <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{ $criminal->address }}</textarea>
                            </div>
							<div class="form-group mb-3">
								<label for="identification_number">Nomor Identitas (No. KTP/SIM/Identitas Lainnya) <span class="text-danger">*</span></label>
								<input type="number" name="identification_number" id="identification_number" class="form-control"
									value="{{ $criminal->identification_number }}">
							</div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('admin-panel.criminal.index') }}" class="btn btn-warning mx-2">Kembali</a>
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
