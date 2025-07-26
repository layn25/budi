<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.styles.css')
</head>
<body id="page-top" class="fixed-nav sidebar-toggled">
    <div class="berhasil" data-berhasil="{{ ucWords(Session::get('success')) }}"></div>
    <div class="gagal" data-gagal="{{ ucWords(Session::get('error')) }}"></div>
    <div class="warning" data-warning="{{ ucWords(Session::get('warning')) }}"></div>

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    @include('layouts.components.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('layouts.components.navbar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('main-content')
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('layouts.components.footer')
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Semua Modal-->
@include('layouts.components.logoutModal')
@include('pages.pengguna.components.tambah')


<!-- Scripts -->
@include('layouts.styles.js')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (window.location.hash) {
            const el = document.querySelector(window.location.hash);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                el.style.backgroundColor = "#fff3cd";
                setTimeout(() => el.style.backgroundColor = "", 3000);
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>
