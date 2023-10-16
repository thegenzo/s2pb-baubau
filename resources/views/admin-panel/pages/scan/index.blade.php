@extends('admin-panel.layout.app')

@section('title', 'Scan Barang Bukti')

@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Scan Barang Bukti</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('admin-panel.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Scan Barang Bukti</li>
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
		<section class="scan">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div id="qr-reader" style="width: 100%"></div>
						</div>
					</div>
				</div>
			</div>
		</section>
    </div>
@endsection

@push('addon-script')
	<!-- include the library -->
	<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
	<script type="text/javascript">
		function onScanSuccess(decodedText, decodedResult) {
			// console.log(`Code scanned = ${decodedText}`, decodedResult);

			// Clear the existing canvas
			// html5QrcodeScanner.clear();

			// Redirect to detail evidence page
			window.location.href = `/admin-panel/scan/${decodedText}`;
		}
		var html5QrcodeScanner = new Html5QrcodeScanner(
			"qr-reader", { fps: 10, qrbox: 250 });

		html5QrcodeScanner.render(onScanSuccess);
	</script>
@endpush
