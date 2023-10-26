<!DOCTYPE html>
<html>
<head>
    <title>BB {{ $evidence->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .page {
            margin: 0 auto;
            padding: 10mm;
            background-color: #fff;
        }

        .header {
            page-break-inside: avoid; /* Prevent page breaks inside the header */
        }

        .header-content {
            display: flex;
            align-items: center;
        }

        .header-logo {
            margin-right: 10px;
        }

        .header-text {
            display: inline-block;
			margin-bottom: 15px;
        }

        .content {
            text-align: center;
            page-break-inside: avoid; /* Prevent content from breaking inside elements */
        }

        .barcode {
            width: 100%;
            display: block; /* Prevent content from breaking across pages */
        }

        h1 {
            display: block; /* Prevent content from breaking across pages */
        }

        p {
            font-size: 16px;
            margin: 10px 0;
            display: block; /* Prevent content from breaking across pages */
        }

        @page {
            size: A4 landscape; /* Set the page size to A4 landscape layout */
            margin: 0;
        }

        @media print {
            body {
                margin: 0; /* Remove default margins for printing */
                box-shadow: none; /* Remove box shadow for printing */
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <div class="header-content">
                <div class="header-logo">
                    <img src="{{ asset('panel-assets/dist/images/logo-primary.png') }}" style="width: 90px; height: 90px" alt="Logo" /> <!-- Replace "logo.png" with the path to your logo image -->
                </div>
                <div class="header-text">
                    <h2>Kejaksaan Negeri Baubau</h2>
                    <p>Alamat: Jl. Betoambari No.61, Tanganapada, Kec. Murhum, Kota Bau-Bau, Sulawesi Tenggara 93713</p>
                    <p>Telpon: (0402) 282022</p>
                </div>
            </div>
        </div>
		<hr style="border: 3px solid black">
        <div class="content">
            <h1>Detail Barang Bukti:</h1>
            <p><strong>Nama Pelaku:</strong> {{ $evidence->criminal_perpetrator->name }}</p>
            <p><strong>Nama Barang:</strong> {{ $evidence->name }}</p>
            <p><strong>Jumlah:</strong> {{ $evidence->amount }}</p>
            <p><strong>Satuan:</strong> {{ $evidence->unit }}</p>
            <!-- Add more evidence details as needed -->

            <!-- Barcode -->
            <div class="barcode">
				<a href="{{ route('admin-panel.evidence.show', $evidence->id) }}">
					{!! $evidence->getBarcodeAttribute($evidence->register_number, 6, 250) !!}
				</a>
            </div>
            <p><strong>Lokasi Penyimpanan:</strong> {{ $evidence->storage_location }}</p>
            <p><strong>Tanggal Masuk:</strong> {{ \Carbon\Carbon::parse($evidence->entry_date)->locale('id')->isoFormat('LL') }}</p>
        </div>
    </div>
</body>
<script>
	window.print();
</script>
</html>
