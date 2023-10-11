@extends('admin-panel.layout.app')

@section('title', 'Data Transaksi Barang Bukti')

@push('addon-style')
	<!-- Datatable -->
    <link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
	<!-- PrismJS -->
	<link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/prismjs/themes/prism-okaidia.min.css') }}">
	<!-- Select2 -->
	<link rel="stylesheet" href="{{ asset('panel-assets/dist/libs/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Data Transaksi Barang Bukti</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('admin-panel.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('admin-panel.evidence.index') }}">Data Barang Bukti</a></li>
                                <li class="breadcrumb-item" aria-current="page">Data Transaksi Barang Bukti</li>
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
							<div class="cart-title mb-0 text-white">Tambahkan Data Transaksi Barang</div>
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
							<form action="{{ route('admin-panel.transaction.store', $evidence->id) }}" method="POST">
								@csrf
								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group mb-3">
											<label for="transaction_date">Tanggal Transaksi <span class="text-danger">*</span></label>
											<input type="date" name="transaction_date" id="date_of_birth" class="form-control"
												value="{{ old('transaction_date') }}">
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group mb-3">
											<label for="transaction_type">Tipe Transaksi <span class="text-danger">*</span></label>
											<select name="transaction_type" id="transaction_type" class="select2 form-control" style="width: 100%; height: 36px">
												<option value="" selected hidden>--- Pilih Tipe Transaksi ---</option>
												<option value="in" {{ old('transaction_type') == 'in' ? 'selected' : '' }}>Barang Masuk</option>
												<option value="out" {{ old('transaction_type') == 'out' ? 'selected' : '' }}>Barang Keluar</option>
												<option value="returned" {{ old('transaction_type') == 'returned' ? 'selected' : '' }}>Barang Dikembalikan</option>
												<option value="terminated" {{ old('transaction_type') == 'terminated' ? 'selected' : '' }}>Barang Dimusnahkan</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="notes">Keterangan <span class="text-danger">*</span></label>
									<textarea name="notes" id="notes" cols="30" rows="10" class="form-control">{{ old('notes') }}</textarea>
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
											<th class="text-center">Tanggal Transaksi</th>
											<th>Tipe Transaksi</th>
											<th>Catatan</th>
										</tr>
									</thead>
									<tbody>
										@forelse ($transactions as $transaction)
											<tr>
												<td class="text-center">{{ $loop->iteration }}</td>
												<td class="text-center">{{ $transaction->transaction_date }}</td>
												<td>{{ $transaction->transaction_type }}</td>
												<td>{{ $transaction->notes }}</td>
											</tr>
										@empty
											<tr>
												<td colspan="4" class="text-center">Data Transaksi BB Kosong</td>
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
	<script src="{{ asset('panel-assets/dist/libs/select2/dist/js/select2.full.min.js') }}"></script>
	<script src="{{ asset('panel-assets/dist/libs/select2/dist/js/select2.min.js') }}"></script>
	<script src="{{ asset('panel-assets/dist/libs/prismjs/prism.js') }}"></script>
	<script type="text/javascript">
	$(function () {
		$("#dataTable").DataTable({
			scrollX: true,
		});

		$(".select2").select2();
	})
	</script>
@endpush
