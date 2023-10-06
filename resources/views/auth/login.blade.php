<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Oct 2023 05:34:27 GMT -->

<head>
    <!--  Title -->
    <title>Mordenize</title>
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
    <link id="themeColors" rel="stylesheet" href="{{ asset('panel-assets/dist/css/style.min.css') }}" />
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico"
            alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico"
            alt="loader" class="lds-ripple img-fluid" />
    </div>
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
                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg"
                                        width="180" alt="">
                                </a>
                                <div class="row">
                                    <div class="col-6 mb-2 mb-sm-0">
                                        <a class="btn btn-white text-dark border fw-normal d-flex align-items-center justify-content-center rounded-2 py-8"
                                            href="javascript:void(0)" role="button">
                                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/google-icon.svg"
                                                alt="" class="img-fluid me-2" width="18" height="18">
                                            <span class="d-none d-sm-block me-1 flex-shrink-0">Sign in with</span>Google
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a class="btn btn-white text-dark border fw-normal d-flex align-items-center justify-content-center rounded-2 py-8"
                                            href="javascript:void(0)" role="button">
                                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/facebook-icon.svg"
                                                alt="" class="img-fluid me-2" width="18" height="18">
                                            <span class="d-none d-sm-block me-1 flex-shrink-0">Sign in with</span>FB
                                        </a>
                                    </div>
                                </div>
                                <div class="position-relative text-center my-4">
                                    <p
                                        class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative">
                                        or sign in with</p>
                                    <span
                                        class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                                </div>
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
                                    <button type="submit" href="index.html" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign In</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-medium">New to Modernize?</p>
                                        <a class="text-primary fw-medium ms-2"
                                            href="authentication-register.html">Create an account</a>
                                    </div>
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
