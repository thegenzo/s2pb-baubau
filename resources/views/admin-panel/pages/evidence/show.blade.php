@extends('admin-panel.layout.app')

@section('title', 'Lihat Data Barang Bukti')

@push('addon-style')
    <!-- PrismJS -->
    <link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/prismjs/themes/prism-okaidia.min.css') }}">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('../../dist/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">
@endpush

@php
    $label = [
        'detained' => 'Ditahan',
        'returned' => 'Dikembalikan',
        'terminated' => 'Dimusnahkan',
    ];
@endphp

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
            <div class="col-lg-6 col-md-12 col-sm-12">
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
                        <h5 class="text-muted">Kriteria Kejahatan</h5>
                        <h5>{{ $evidence->criminal_perpetrator->criteria->name }}</h5>
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
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('admin-panel.evidence.index') }}" class="btn btn-warning mx-2">Kembali</a>
                            <a href="{{ route('admin-panel.evidence.print', $evidence->id) }}" class="btn btn-danger mx-2"
                                target="_blank">Cetak</a>
                            
                            <!-- Evidence In Modal Trigger -->
                            <button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#modal-evidence-in">
                                BB Masuk
                            </button>
                            <!-- Evidence In Modal -->
                            <div id="modal-evidence-in" class="modal fade" tabindex="-1"
                                aria-labelledby="modal-evidence-in" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex align-items-center">
                                            <h4 class="modal-title" id="myModalLabel">
                                                Barang Bukti Masuk
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin-panel.transaction.in', $evidence->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="notes" class="control-label">Keterangan:</label>
                                                    <textarea class="form-control" id="notes" name="notes" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-danger text-danger font-medium"
                                                    data-bs-dismiss="modal">
                                                    Tutup
                                                </button>
                                                <button type="submit" class="btn btn-success">
                                                    Simpan Data
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                            <!-- Evidence Out Modal Trigger -->
                            <button class="btn btn-secondary mx-2" data-bs-toggle="modal" data-bs-target="#modal-evidence-out">
                                BB Keluar
                            </button>
                            <!-- Evidence Out Modal -->
                            <div id="modal-evidence-out" class="modal fade" tabindex="-1"
                                aria-labelledby="modal-evidence-out" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex align-items-center">
                                            <h4 class="modal-title" id="myModalLabel">
                                                Barang Bukti Keluar
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin-panel.transaction.out', $evidence->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="notes" class="control-label">Keterangan:</label>
                                                    <textarea class="form-control" id="notes" name="notes" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button"
                                                    class="btn btn-light-danger text-danger font-medium"
                                                    data-bs-dismiss="modal">
                                                    Tutup
                                                </button>
                                                <button type="submit" class="btn btn-success">
                                                    Simpan Data
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header bg-danger">
                        <div class="mb-0 text-white card-title">Foto BB</div>
                    </div>
                    <div class="card-body">
                        <div id="sync1" class="owl-carousel owl-theme">
                            @forelse ($evidence->evidence_photo()->latest()->get() as $key => $value)
                                <div class="item rounded overflow-hidden">
                                    <img src="{{ $value->image }}" alt="" class="img-fluid">
                                </div>
                            @empty
                                <div class="item rounded overflow-hidden">
                                    <h5 class="text-center">Foto Tidak Ada</h5>
                                </div>
                            @endforelse
                        </div>
                        @if (auth()->user()->level == 'admin')
                            <div class="d-flex justify-content-center mt-3">
                                @if ($evidence->status == 'detained')
                                    <a href="{{ route('admin-panel.photos.index', $evidence->id) }}"
                                        class="btn btn-sm btn-danger"><i class="fa fa-image"></i> Tambah Foto BB</a>
                                @else
                                    <p>Tidak bisa menambahkan foto BB karena BB telah {{ $label[$evidence->status] }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="mb-0 text-white card-title">Transaksi BB</div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Tanggal Transaksi</th>
                                    <th>Tipe Transaksi</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($evidence->evidence_transaction()->latest()->get() as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $value->transaction_date }}</td>
                                        <td>{{ $value->transaction_type }}</td>
                                        <td>{{ $value->notes }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Data Transaksi BB ini Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (auth()->user()->level == 'admin')
                            <div class="d-flex justify-content-center">
                                @if ($evidence->status != 'detained')
                                    <p>Tidak bisa menambahkan transaksi BB karena BB telah {{ $label[$evidence->status] }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="{{ asset('panel-assets/dist/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('panel-assets/dist/libs/prismjs/prism.js') }}"></script>
    <script>
        $(function() {
            var sync1 = $("#sync1");
            var slidesPerPage = 4;
            var syncedSecondary = true;

            sync1.owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: true,
                autoplay: false,
                dots: true,
                loop: true,
                responsiveRefreshRate: 200,
                navText: [
                    '<svg width="12" height="12" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 3px;stroke: #fff;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
                    '<svg width="12" height="12" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 3px;stroke: #fff;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'
                ],
            }).on('changed.owl.carousel', syncPosition);
        })
    </script>
@endpush
