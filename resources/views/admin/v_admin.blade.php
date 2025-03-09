<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aplikasi Keuangan | SMK Negeri 1 Cimahi | @yield('title')</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('TemplateAdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('TemplateAdminLTE') }}/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">



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
        <!--AKHIR LIBRARY DATA TABLE-->

    </head>

    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            @include('admin/v_header')
            @include('admin/v_sidebar')
            @include('admin/v_content')
            @include('admin/v_footer')


            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <!--<script src="{{ asset('TemplateAdminLTE') }}/plugins/jquery/jquery.min.js"></script>-->
        <!-- Bootstrap 4 -->
        <script src="{{ asset('TemplateAdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!--<script src="{{ asset('TemplateAdminLTE') }}/dist/select2/js/select2.full.min.js"></script>-->

        <!-- AdminLTE App -->
        <script src="{{ asset('TemplateAdminLTE') }}/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('TemplateAdminLTE') }}/dist/js/demo.js"></script>
        @stack('script')
    </body>



</html>
