<!DOCTYPE html>
<html>
<head>
    <title>Detail PTP {{ $criminalPerpetrator->name }}</title>
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
            page-break-inside: avoid; /* Prevent content from breaking inside elements */
        }

        .row-container {
            display: flex; /* Use Flexbox to place .detail and .barcode-list on the same row */
            justify-content: space-between; /* Place .detail on the left and .barcode-list on the right */
        }

        .detail {
            width: 48%; /* Adjust the width as needed */
            margin: 5px;
            padding: 15px;
            border: 1px solid #000;
        }

        .barcode-list {
            width: 48%; /* Adjust the width as needed */
            margin: 5px;
            padding: 15px;
            border: 1px solid #000;
        }

        h1 {
            display: block; /* Prevent content from breaking across pages */
        }

        p {
            font-size: 16px;
            margin: 10px 0;
            display: block; /* Prevent content from breaking across pages */
        }

        .detail table, th, td {
            border: 1px solid #000;
            border-collapse: collapse;
            padding: 10px;
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
                    <img src="{{ asset('panel-assets/dist/images/logo-primary.png') }}" style="width: 90px; height: 90px" alt="Logo" />
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
            <h1 style="text-align: center;">Pelaku Tindak Pidana</h1>
            <div class="row-container">
                <div class="detail">
                    <h2 style="text-align: left;">Informasi Pelaku Tindak Pidana</h2>
					<table>
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td>{{ $criminalPerpetrator->name }}</td>
						</tr>
						<tr>
							<td>No. Identitas</td>
							<td>:</td>
							<td>{{ $criminalPerpetrator->identification_number }}</td>
						</tr>
						<tr>
							<td>Kriteria</td>
							<td>:</td>
							<td>{{ $criminalPerpetrator->criteria->name }}</td>
						</tr>
						<tr>
							<td>Tempat, Tanggal Lahir</td>
							<td>:</td>
							<td>{{ $criminalPerpetrator->place_of_birth }}, {{ $criminalPerpetrator->date_of_birth }}</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td>{{ $criminalPerpetrator->address }}</td>
						</tr>
					</table>
                </div>

                <div class="barcode-list">
                    <h2 style="text-align: left;">Data Barang Bukti</h2>
                    <table>
                        <tr>
                            <th>Nama BB</th>
                            <th style="text-align: center;">Barcode (Scan untuk melihat detail)</th>
                        </tr>
                        @foreach ($evidences as $evidence)
                            <tr>
                                <td>{{ $evidence->name }}</td>
                                <td style="text-align: center;">{!! $evidence->getBarcodeAttribute($evidence->register_number, 3, 40) !!}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>
</html>
