@extends('admin-panel.layout.app')

@section('title', 'Data Foto Barang Bukti')

@push('addon-style')
	<!-- Datatable -->
    <link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
	<!-- PrismJS -->
	<link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/prismjs/themes/prism-okaidia.min.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Data Foto Barang Bukti</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('admin-panel.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('admin-panel.evidence.index') }}">Data Barang Bukti</a></li>
                                <li class="breadcrumb-item" aria-current="page">Data Foto Barang Bukti</li>
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
		<section class="datatables">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header bg-secondary">
							<div class="cart-title mb-0 text-white">Tambahkan Data Foto Barang Bukti</div>
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
							<form action="{{ route('admin-panel.photos.store', $evidence->id) }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="d-flex justify-content-center">
									<img src="https://accordelectrotechnics.in/img/product/no-preview/no-preview.png" class="img-fluid"
										style="max-height:300px;" id="image_preview" alt="Avatar">
								</div>
								<div class="form-group">
									<label for="image">Foto <span class="text-danger">*</span></label>
									<input type="file" name="image" id="image" class="form-control">
								</div>
								<div class="mt-3">
									<button type="submit" class="btn btn-success">Simpan</button>
									<a href="{{ route('admin-panel.evidence.show', $evidence->id) }}" class="btn btn-warning">Kembali</a>
								</div>
							</form>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="dataTable" class="table border table-bordered display nowrap" style="width: 100%">
									<thead>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">Foto</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@forelse ($photos as $photo)
											<tr>
												<td class="text-center">{{ $loop->iteration }}</td>
												<td class="text-center">
													<img src="{{ $photo->image }}" alt="" width="300px">
												</td>
												<td class="text-center">
                                                    <form action="{{ route('admin-panel.photos.destroy', $photo->id) }}" method="POST" class="d-inline swal-confirm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit"
                                                            data-id="{{ $photo->id }}" data-toggle="tooltip" data-placement="top" title="Hapus Foto BB">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
												</td>
											</tr>
										@empty
											<tr>
												<td colspan="3" class="text-center">Data Foto BB Kosong</td>
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
	<script src="{{ asset('panel-assets/dist/libs/prismjs/prism.js') }}"></script>
	<script type="text/javascript">
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$('#image_preview').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$("#image").change(function() {
			readURL(this);
		});

		$(function () {

		
			$("#dataTable").DataTable({
				scrollX: true,
			});

			$('.swal-confirm').click(function(event) {
				var form = $(this).closest("form");
				var id = $(this).data("id");
				event.preventDefault();
				Swal.fire({
					title: 'Yakin Hapus Foto BB?',
					text: "Foto BB yang terhapus tidak dapat dikembalikan",
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
		});
	</script>
@endpush
