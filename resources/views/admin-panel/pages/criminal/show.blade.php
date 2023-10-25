@extends('admin-panel.layout.app')

@section('title', 'Lihat Pelaku Tindak Pidana')

@push('addon-style')
	<!-- Datatable -->
    <!-- --------------------------------------------------- -->
    <link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card bg-light-success shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Lihat Pelaku Tindak Pidana</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('admin-panel.dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item"><a class="text-muted" href="{{ route('admin-panel.criminal.index') }}">Data Pelaku Tindak Pidana</a></li>
                                <li class="breadcrumb-item" aria-current="page">Lihat Pelaku Tindak Pidana</li>
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
		<section class="activity">
			<div class="row">
				<div class="col-12">
					<div class="card w-100">
						<div class="card-header bg-success">
							<h4 class="mb-0 text-white card-title">Data PTP</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-12 col-md-12">
									<div class="form-group mb-3">
										<label for="">Nama</label>
										<input type="text" class="form-control" value="{{ $criminalPerpetrator->name }}" disabled>
									</div>
									<div class="form-group mb-3">
										<label for="">No. Identitas</label>
										<input type="text" class="form-control" value="{{ $criminalPerpetrator->identification_number }}" disabled>
									</div>
									<div class="form-group mb-3">
										<label for="">Kriteria Kejahatan</label>
										<input type="text" class="form-control" value="{{ $criminalPerpetrator->criteria->name }}" disabled>
									</div>
									<div class="form-group mb-3">
										<label for="">Tanggal Lahir</label>
										<input type="date" class="form-control" value="{{ $criminalPerpetrator->date_of_birth }}" disabled>
									</div>
									<div class="form-group mb-3">
										<label for="">Tempat Lahir</label>
										<input type="text" class="form-control" value="{{ $criminalPerpetrator->place_of_birth }}" disabled>
									</div>
									<div class="form-group mb-3">
										<label for="">Jenis Kelamin</label>
										<input type="text" class="form-control" value="{{ $criminalPerpetrator->gender }}" disabled>
									</div>
									<a href="{{ route('admin-panel.criminal.print', $criminalPerpetrator->id) }}" class="btn btn-outline-danger" target="_blank">Print</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="datatables">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header bg-info">
							<h4 class="mb-0 text-white card-title">Data Barang Bukti dari PTP: {{ $criminalPerpetrator->name }}</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="dataTable" class="table border table-striped table-bordered display nowrap" style="width: 100%">
									<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">Barcode</th>
											<th>Nama BB</th>
											<th class="text-center">Jumlah</th>
											<th class="text-center">Satuan</th>
											<th class="text-center">Tanggal Masuk</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($evidences as $evidence)
											<tr>
												<td class="text-center">{{ $loop->iteration }}</td>
												<td class="text-center">{!! $evidence->getBarcodeAttribute($evidence->register_number, 2.5, 80) !!}</td>
												<td>{{ $evidence->name }}</td>
												<td class="text-center">{{ $evidence->amount }}</td>
												<td class="text-center">{{ $evidence->unit }}</td>
												<td class="text-center">{{ $evidence->entry_date }}</td>
												<td class="text-center">
													<a href="{{ route('admin-panel.evidence.show', $evidence->id) }} " class="btn btn-sm btn-info"
                                                        data-toggle="tooltip" data-placement="top" title="Lihat">
                                                        <i class="ti ti-eye-check"></i>
                                                    </a>
													<a href="{{ route('admin-panel.evidence.edit', $evidence->id) }} " class="btn btn-sm btn-warning"
                                                        data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                    <form action="{{ route('admin-panel.evidence.destroy', $evidence->id) }}" method="POST" class="d-inline swal-confirm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit"
                                                            data-id="{{ $evidence->id }}" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
    </div>
@endsection

@push('addon-script')
	<script src="{{ asset('panel-assets/dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript">
	$(function () {
		$("#dataTable").DataTable({
			scrollX: true,
		});

		$('.swal-confirm').click(function(event) {
			var form = $(this).closest("form");
			var id = $(this).data("id");
			event.preventDefault();
			Swal.fire({
				title: 'Yakin Hapus User?',
				text: "User yang terhapus tidak dapat dikembalikan",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, hapus!'
			}).then((result) => {
				if (result.isConfirmed) {
					form.submit()
				} else if (result.isDenied) {
					Swal.fire('Perubahan tidak disimpan', '', 'info')
				}
			})
		});
	})
	</script>
@endpush
