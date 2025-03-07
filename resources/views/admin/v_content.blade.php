<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>Blank Page</h1>-->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">

            <!-- awal judul -->
            <div class="card-header">
                <h3 class="card-title">

                    <!-- koneksi ke judul -->
                    @yield('judulhalaman')

                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button> --}}
                </div>
            </div>
            <!-- akhir judul -->

            <!--awal konten dinamis-->
            <div class="card-body">


                <!-- bisa juga pake_@include('admin.pages.v_spp') -->
                <!--b@include('/admin/pages/v_spp')-->

                <!-- koneksi ke konten -->
                @yield('konten')

            </div>
            <!-- /.card-body -->
            <!--akhir konten dinamis-->



            <div class="card-footer">
                <!-- Footer -->
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->


</div>
<!-- /.content-wrapper -->
