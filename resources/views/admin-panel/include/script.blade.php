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

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

<script>
    (function() {
        let onPageLoad = localStorage.getItem("theme");
        if (!onPageLoad) {
            localStorage.setItem("theme", "{{ asset('panel-assets/dist/css/style-aqua.min.css') }}");
        }
        document.getElementById('themeColors').href = localStorage.getItem("theme");
    })();
</script>

<script>
    /*Theme color change*/
    function toggleTheme(value) {
        localStorage.setItem("theme", value);
        var sheets = document.getElementById("themeColors");
        sheets.href = value;

        console.log('new theme selected : ' + value);
    }
</script>
