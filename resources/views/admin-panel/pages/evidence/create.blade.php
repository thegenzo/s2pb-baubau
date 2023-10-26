@extends('admin-panel.layout.app')

@section('title', 'Tambah Data Barang Bukti')

@push('addon-style')
	<!-- PrismJS -->
	<link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/prismjs/themes/prism-okaidia.min.css') }}">
	<!-- Select2 -->
	<link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/select2/dist/css/select2.min.css') }}">
	<!-- Summernote -->
	<link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/summernote/dist/summernote-lite.min.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card bg-light-secondary shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Tambah Data Barang Bukti</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted"
                                        href="{{ route('admin-panel.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a class="text-muted"
                                        href="{{ route('admin-panel.evidence.index') }}">Data Barang Bukti</a></li>
                                <li class="breadcrumb-item" aria-current="page">Tambah Data Barang Bukti</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center">
                            <img src="{{ asset('panel-assets/dist/images/breadcrumb/box.png') }}" alt=""
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
                        <h4 class="mb-0 text-white card-title">Masukkan Data BB Disini</h4>
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
                        <form method="POST" action="{{ route('admin-panel.evidence.store') }}">
                            @csrf
							<div class="form-group mb-3">
                                <label for="criminal_perpetrator_id">Nama Pelaku <span class="text-danger">*</span></label>
                                <select name="criminal_perpetrator_id" id="criminal_perpetrator_id" class="select2 form-control" style="width: 100%; height: 36px">
									<option value="" selected hidden>--- Pilih Nama Pelaku ---</option>
									@foreach (\App\Models\CriminalPerpetrator::all() as $criminal)
									<option value="{{ $criminal->id }}" {{ old('criminal_perpetrator_id') == $criminal->id ? 'selected' : '' }}>{{ $criminal->name }}</option>
									@endforeach
								</select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="register_number">Nomor Registrasi <span class="text-danger">*</span></label>
                                <input type="text" name="register_number" id="register_number" class="form-control"
                                    value="{{ old('register_number') }}">
                            </div>
							<div class="form-group mb-3">
                                <label for="name">Nama BB <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group mb-3">
										<label for="amount">Jumlah <span class="text-danger">*</span></label>
										<input type="number" name="amount" id="amount" class="form-control"
											value="{{ old('amount') }}">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group mb-3">
										<label for="unit">Satuan <span class="text-danger">*</span></label>
										<input type="text" name="unit" id="unit" class="form-control"
											value="{{ old('unit') }}">
									</div>
								</div>
                            </div>
							<div class="form-group mb-3">
								<label for="description">Deskripsi <span class="text-danger">*</span></label>
								<textarea name="description" id="" cols="30" rows="50" class="summernote">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="entry_date">Tanggal Masuk <span class="text-danger">*</span></label>
								<input type="date" name="entry_date" id="entry_date" class="form-control"
									value="{{ old('entry_date') }}">
                            </div>
							<div class="form-group mb-3">
								<label for="storage_location">Lokasi Penyimpanan <span class="text-danger">*</span></label>
								<input type="text" name="storage_location" id="storage_location" class="form-control"
									value="{{ old('storage_location') }}">
							</div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('admin-panel.evidence.index') }}" class="btn btn-warning mx-2">Kembali</a>
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
	<script src="{{ asset('panel-assets/dist/libs/summernote/dist/summernote-lite.min.js') }}"></script>
	<script src="{{ asset('panel-assets/dist/libs/prismjs/prism.js') }}"></script>
    <script>
		$(".select2").select2();

		$(".summernote").summernote({
			height: '200px'
		});
    </script>
@endpush
