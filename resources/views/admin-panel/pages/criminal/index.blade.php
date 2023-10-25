@extends('admin-panel.layout.app')

@section('title', 'Data Pelaku Tindak Pidana')

@push('addon-style')
	<!-- Datatable -->
    <!-- --------------------------------------------------- -->
    <link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Data Pelaku Tindak Pidana</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('admin-panel.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Data Pelaku Tindak Pidana</li>
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
		<section class="datatables">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<a href="{{ route('admin-panel.criminal.create') }}" class="btn btn-secondary mb-3">Tambah Pelaku Tindak Pidana</a>
							<div class="table-responsive">
								<table id="dataTable" class="table border table-striped table-bordered display nowrap" style="width: 100%">
									<thead>
										<tr>
											<th class="text-center">No</th>
											<th>Nama</th>
											<th>Kriteria</th>
											<th class="text-center">No. Identitas</th>
											<th class="text-center">Tanggal Lahir</th>
											<th>Tempat Lahir</th>
											<th class="text-center">JK</th>
											<th>Alamat</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@forelse ($criminals as $criminal)
											<tr>
												<td class="text-center">{{ $loop->iteration }}</td>
												<td>{{ $criminal->name }}</td>
												<td>{{ $criminal->criteria->name }}</td>
												<td class="text-center">{{ $criminal->identification_number }}</td>
												<td class="text-center">{{ \Carbon\Carbon::parse($criminal->date_of_birth)->locale('id')->isoFormat('LL') }}</td>
												<td>{{ $criminal->place_of_birth }}</td>
												<td class="text-center">{{ $criminal->gender }}</td>
												<td>{{ $criminal->address }}</td>
												<td class="text-center">
													<a href="{{ route('admin-panel.criminal.show', $criminal->id) }} " class="btn btn-sm btn-info"
                                                        data-toggle="tooltip" data-placement="top" title="Lihat">
                                                        <i class="ti ti-eye-check"></i>
                                                    </a>
													<a href="{{ route('admin-panel.criminal.edit', $criminal->id) }} " class="btn btn-sm btn-warning"
                                                        data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                    <form action="{{ route('admin-panel.criminal.destroy', $criminal->id) }}" method="POST" class="d-inline swal-confirm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit"
                                                            data-id="{{ $criminal->id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
												</td>
											</tr>
										@empty
											<tr>
												<td colspan="8" class="text-center">Data Pelaku Tindak Pidana Kosong</td>
											</tr>
										@endforelse
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
				title: 'Yakin Hapus PTP?',
				text: "PTP yang terhapus tidak dapat dikembalikan",
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
