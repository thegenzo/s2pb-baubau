@extends('admin-panel.layout.app')

@section('title', 'Aktivitas User')

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
                        <h4 class="fw-semibold mb-8">Aktivitas User</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('admin-panel.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Aktivitas User</li>
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
		<section class="activity">
			<div class="row">
				<div class="col-12">
					<div class="card w-100">
						<div class="card-header bg-success">
							<h4 class="mb-0 text-white card-title">Data User</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-12 col-md-4">
									<div class="d-flex justify-content-center">
										<img src="{{ $user->avatar }}" class="img-fluid" style="max-height:400px;">
									</div>
								</div>
								<div class="col-sm-12 col-md-8">
									<div class="form-group mb-3">
										<label for="">Nama</label>
										<input type="text" class="form-control" value="{{ $user->name }}" disabled>
									</div>
									<div class="form-group mb-3">
										<label for="">Email</label>
										<input type="text" class="form-control" value="{{ $user->email }}" disabled>
									</div>
									<div class="form-group mb-3">
										<label for="">Level</label>
										<input type="text" class="form-control" value="{{ $user->level }}" disabled>
									</div>
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
						<div class="card-body">
							<div class="table-responsive">
								<table id="dataTable" class="table border table-striped table-bordered display nowrap" style="width: 100%">
									<thead>
										<tr>
											<th class="text-center">No</th>
											<th>Aktivitas</th>
											<th>User-Agent</th>
											<th class="text-center">URL</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($activities as $activity)
											<tr>
												<td class="text-center">{{ $loop->iteration }}</td>
												<td>{{ $activity->activity }}</td>
												<td>{{ $activity->user_agent }}</td>
												<td class="text-center">
													<a href="{{ $activity->url }}" target="_blank">{{ $activity->url }}</a>
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
