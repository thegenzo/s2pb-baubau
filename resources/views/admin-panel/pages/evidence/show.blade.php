@extends('admin-panel.layout.app')

@section('title', 'Lihat Data Barang Bukti')

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
        <div class="card bg-light-success shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h5 class="fw-semibold mb-8">Lihat Data Barang Bukti</h5>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted"
                                        href="{{ route('admin-panel.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a class="text-muted"
                                        href="{{ route('admin-panel.evidence.index') }}">Data Barang Bukti</a></li>
                                <li class="breadcrumb-item" aria-current="page">Lihat Data Barang Bukti</li>
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
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="mb-0 text-white card-title">Informasi BB</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-3">
                            {!! $evidence->getBarcodeAttribute($evidence->register_number, 3, 100) !!}
                        </div>
                        <hr>
                        <h5 class="text-muted">Pemilik BB</h5>
                        <h5>{{ $evidence->criminal_perpetrator->name }}</h5>
                        <hr>
                        <h5 class="text-muted">Kriteria BB</h5>
                        <h5>{{ $evidence->criteria->name }}</h5>
						<hr>
						<h5 class="text-muted">Nama BB</h5>
                        <h5>{{ $evidence->name }}</h5>
						<hr>
						<h5 class="text-muted">Jumlah</h5>
                        <h5>{{ $evidence->amount }}</h5>
						<hr>
						<h5 class="text-muted">Satuan</h5>
                        <h5>{{ $evidence->unit }}</h5>
						<hr>
						<h5 class="text-muted">Deskripsi BB</h5>
                        <p class="text-black">{!! $evidence->description !!}</p>
						<hr>
						<h5 class="text-muted">Tanggal Masuk</h5>
                        <h5>{{ $evidence->entry_date }}</h5>
						<hr>
						<h5 class="text-muted">Lokasi Penyimpanan</h5>
                        <h5>{{ $evidence->storage_location }}</h5>
						<hr>
                    </div>
                </div>
                <a href="{{ route('admin-panel.evidence.index') }}" class="btn btn-warning mx-2">Kembali</a>
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
