<!--awal konten dinamis-->
@extends('admin.v_admin')
@section('judulhalaman', 'Home')
@section('title', 'Home')

<!--awal isi konten dinamis-->
@section('konten')



    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">

                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalPegawai ?? 0 }}</h3>

                        <p>Total Pegawai</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Prosentase Pendapatan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 class="text-white">{{$jurusan}}</h3>

                        <p class="text-white">Jumlah Jurusan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/jurusan" class="small-box-footer"><text class="text-white">More info </text><i class="fas fa-arrow-circle-right text-white"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$kelas}}</h3>

                        <p>Jumlah Kelas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="/kelas" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
        <!-- /.row -->
        <!-- Main row -->

        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$siswa}}</h3>

                        <p>Jumlah Siswa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="/siswakelas" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

    </div><!-- /.container-fluid -->




@endsection
<!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->
