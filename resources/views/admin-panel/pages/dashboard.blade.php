@extends('admin-panel.layout.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!--  Owl carousel -->
        <div class="owl-carousel counter-carousel owl-theme">
            <div class="item">
                <div class="card border-0 zoom-in bg-light-primary shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-user-male.svg"
                                width="50" height="50" class="mb-1" alt="" />
                            <p class="fw-semibold fs-3 text-primary mb-1"> Total Admin </p>
                            <h5 class="fw-semibold text-primary mb-0">{{ $admin }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-warning shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-briefcase.svg"
                                width="50" height="50" class="mb-1" alt="" />
                            <p class="fw-semibold fs-3 text-warning mb-1">Total User</p>
                            <h5 class="fw-semibold text-warning mb-0">{{ $user }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-info shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-mailbox.svg"
                                width="50" height="50" class="mb-1" alt="" />
                            <p class="fw-semibold fs-3 text-info mb-1">Total PTP</p>
                            <h5 class="fw-semibold text-info mb-0">{{ $criminal }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-danger shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-favorites.svg"
                                width="50" height="50" class="mb-1" alt="" />
                            <p class="fw-semibold fs-3 text-danger mb-1">BB Ditahan</p>
                            <h5 class="fw-semibold text-danger mb-0">{{ $detainedEvidence }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-success shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-speech-bubble.svg"
                                width="50" height="50" class="mb-1" alt="" />
                            <p class="fw-semibold fs-3 text-success mb-1">BB Kembali</p>
                            <h5 class="fw-semibold text-success mb-0">{{ $returnedEvidence }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 zoom-in bg-light-info shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-connect.svg"
                                width="50" height="50" class="mb-1" alt="" />
                            <p class="fw-semibold fs-3 text-info mb-1">BB Musnah</p>
                            <h5 class="fw-semibold text-info mb-0">{{ $terminatedEvidence }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="text-center">Grafik Barang Bukti berdasarkan status</h3>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <!--  current page js files -->
    <script src="{{ asset('panel-assets/dist/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('panel-assets/dist/js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Ditahan', 'Dikembalikan', 'Dimusnahkan'],
                datasets: [{
                    label: '# of Votes',
                    data: [{{ $detainedEvidence }}, {{ $returnedEvidence }}, {{ $terminatedEvidence }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgb(54, 162, 235)',
                        'rgb(75, 192, 192)',
                        'rgb(255, 99, 132)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
