<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | School Guestbook</title>
    <link rel="icon" href="{{ asset('gambar/icon2.png') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> --}}

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('tailwindcdn.js') }}"></script>

    <!-- Font Awesome (diperlukan jika masih menggunakan ikon-ikon dari Font Awesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- DataTables CSS -->
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> --}}

    {{-- OLD --}}
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('TemplateAdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('TemplateAdminLTE') }}/dist/css/adminlte.min.css">


    <!--DATA TABLE MENGGUNKAN CDN-->
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> --}}



    <!--AWAL LIBRARY SELECT 2-->
    <script src="{{ asset('TemplateAdminLTE') }}/plugins/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('TemplateAdminLTE') }}/dist/select2/css/select2.min.css" />
    <script src="{{ asset('TemplateAdminLTE') }}/dist/select2/js/select2.full.min.js"></script>
    <!--AKHIR LIBRARY SELECT 2-->


    <!--AWAL LIBRARY DATA TABLE-->
    <script type="text/javascript" src="{{ asset('TemplateAdminLTE') }}/dist/datatable/DataTables-1.11.5/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('TemplateAdminLTE') }}/dist/datatable/DataTables-1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('TemplateAdminLTE') }}/dist/datatable/DataTables-1.11.5/css/dataTables.bootstrap.css">

    {{-- Datatables header --}}
    <style>
        .dataTables_scrollBody thead {
            visibility: collapse !important;
        }

        /* .loader {
            border-top-color: #3498db;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0%   { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        } */

        /* Loading Style */

    </style>

    <!--AKHIR LIBRARY DATA TABLE-->
    @stack('styles')
</head>

<body class="bg-gray-50 font-sans">

    <!-- Loading Overlay -->
    @include('components.loading')

    <div class="min-h-screen flex flex-col">
        @include('admin.v_header')

        <div class="flex flex-1">
            <div class="w-72 flex-shrink-0">
                @include('admin.v_sidebar')
            </div>

            <main class="flex-1 p-6 bg-gray-50 min-w-0">
                @yield('konten')
            </main>
        </div>

        @include('admin.v_footer')
    </div>

    <!-- Scripts -->

        {{-- OLD --}}
    <!-- jQuery -->
    <!--<script src="{{ asset('TemplateAdminLTE') }}/plugins/jquery/jquery.min.js"></script>-->

    <!-- Bootstrap 4 -->
    <script src="{{ asset('TemplateAdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--<script src="{{ asset('TemplateAdminLTE') }}/dist/select2/js/select2.full.min.js"></script>-->

    <!-- AdminLTE App -->
    <script src="{{ asset('TemplateAdminLTE') }}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('TemplateAdminLTE') }}/dist/js/demo.js"></script>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

    {{-- NEW --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> --}}
    <script>
        // Toggle sidebar on mobile
        $(document).ready(function() {
            $('#sidebarToggle').click(function() {
                $('#sidebar').toggleClass('-translate-x-full');
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
