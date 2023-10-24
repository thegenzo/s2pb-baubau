<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2023 05:34:27 GMT -->

<head>
    <!--  Title -->
    <title>Login &dash; SP2B Baubau</title>
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
        href="{{ asset('panel-assets/dist/images/logo-primary.ico') }}" />
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('panel-assets/dist/css/style.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="index.html" class="text-nowrap logo-img text-center d-block mb-5 w-100">
                                    <img src="{{ asset('panel-assets/dist/images/logo-primary.png') }}"
                                        width="90" class="rounded" alt="">
                                </a>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control" id="password">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Import Js Files -->
    <script src="{{ asset('panel-assets/dist/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('panel-assets/dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('panel-assets/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!--  core files -->
    <script src="{{ asset('panel-assets/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('panel-assets/dist/js/app.init.js') }}"></script>
    <script src="{{ asset('panel-assets/dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('panel-assets/dist/js/sidebarmenu.js') }}"></script>

    <script src="{{ asset('panel-assets/dist/js/custom.js') }}"></script>
</body>

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2023 05:34:27 GMT -->

</html>
