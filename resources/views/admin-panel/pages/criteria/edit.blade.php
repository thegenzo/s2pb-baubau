@extends('admin-panel.layout.app')

@section('title', 'Edit Data Kriteria')

@section('content')
    <div class="container-fluid">
        <div class="card bg-light-warning shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Edit Data Kriteria</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted"
                                        href="{{ route('admin-panel.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a class="text-muted"
                                        href="{{ route('admin-panel.criteria.index') }}">Data Kriteria</a></li>
                                <li class="breadcrumb-item" aria-current="page">Edit Data Kriteria</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center">
                            <img src="{{ asset('panel-assets/dist/images/breadcrumb/partnership.png') }}" alt=""
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
                        <h4 class="mb-0 text-white card-title">Edit Data Kriteria Disini</h4>
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
                        <form method="POST" action="{{ route('admin-panel.criteria.update', $criteria->id) }}">
                            @csrf
							@method('PUT')
                            <div class="form-group mb-3">
                                <label for="name">Nama Kriteria <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $criteria->name }}">
						</div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('admin-panel.criteria.index') }}" class="btn btn-warning mx-2">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
