@extends('admin-panel.layout.app')

@section('title', 'Data Barang Bukti yang Dikembalikan')

@push('addon-style')
	<!-- Datatable -->
    <!-- --------------------------------------------------- -->
    <link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endpush

@php
$state = [
	'detained' => 'primary',
	'returned' => 'success',
	'terminated' => 'danger'
];

$label = [
	'detained' => 'Ditahan',
	'returned' => 'Dikembalikan',
	'terminated' => 'Dimusnahkan'
];
@endphp

@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Data Barang Bukti yang Dikembalikan</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('admin-panel.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Data Barang Bukti yang Dikembalikan</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center">
                            <img src="{{ asset('panel-assets/dist/images/breadcrumb/returned.png') }}" alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<section class="datatables">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="dataTable" class="table border table-striped table-bordered display nowrap" style="width: 100%">
									<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">No. Registrasi</th>
											<th>Nama Pelaku</th>
											<th class="text-center">Kriteria</th>
											<th>Nama BB</th>
											<th class="text-center">Jumlah</th>
											<th class="text-center">Satuan</th>
											<th>Tgl. Masuk</th>
											<th>Dikembalikan Tanggal</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($evidences as $evidence)
											<tr>
												<td class="text-center">{{ $loop->iteration }}</td>
												<td class="text-center">{{ $evidence->register_number }}</td>
												<td>{{ $evidence->criminal_perpetrator->name }}</td>
												<td class="text-center">{{ $evidence->criminal_perpetrator->criteria->name }}</td>
												<td>{{ $evidence->name }}</td>
												<td class="text-center">{{ $evidence->amount }}</td>
												<td class="text-center">{{ $evidence->unit }}</td>
												<td>{{ \Carbon\Carbon::parse($evidence->entry_date)->locale('id')->isoFormat('LL') }}</td>
												<td>{{ \Carbon\Carbon::parse($evidence->returned_at)->locale('id')->isoFormat('LL') }}</td>
												<td class="text-center">
													<a href="{{ route('admin-panel.evidence.show', $evidence->id) }} " class="btn btn-sm btn-info"
                                                        data-toggle="tooltip" data-placement="top" title="Lihat">
                                                        <i class="ti ti-eye-check"></i>
                                                    </a>
													<a href="{{ route('admin-panel.evidence.edit', $evidence->id) }} " class="btn btn-sm btn-warning"
                                                        data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
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
				title: 'Yakin Hapus Barang Bukti?',
				text: "Barang Bukti yang terhapus tidak dapat dikembalikan",
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

		$('.return-evidence').click(function(event) {
			var form = $(this).closest("form");
			var id = $(this).data("id");
			event.preventDefault();
			Swal.fire({
				title: 'Kembalikan Barang Bukti?',
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

		$('.terminate-evidence').click(function(event) {
			var form = $(this).closest("form");
			var id = $(this).data("id");
			event.preventDefault();
			Swal.fire({
				title: 'Musnahkan Barang Bukti?',
				icon: 'bomb',
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
