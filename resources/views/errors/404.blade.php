<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-error.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2023 05:34:27 GMT -->

<head>
    <!--  Title -->
    <title>Halaman Tidak Ditemukan &dash; SP2B Baubau</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png"
        href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
    <!-- Core Css -->
    @include('admin-panel.include.style')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-lg-4">
                        <div class="text-center">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/backgrounds/errorimg.svg"
                                alt="" class="img-fluid" width="500">
                            <h1 class="fw-semibold mb-7 fs-9">Opps!!!</h1>
                            <h4 class="fw-semibold mb-7">Halaman yang Anda Cari Tidak Ditemukan</h4>
                            <a class="btn btn-primary" href="{{ route('admin-panel.dashboard') }}" role="button">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	@include('admin-panel.include.script')
</body>

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-error.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2023 05:34:27 GMT -->

</html>
