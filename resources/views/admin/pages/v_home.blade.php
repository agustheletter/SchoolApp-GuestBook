<!--awal konten dinamis-->
@extends('admin.v_admin')
@section('judulhalaman', 'Home')
@section('title', 'Admin')

<!--awal isi konten dinamis-->
@section('konten')



    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">

                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalSiswa ?? 0 }}</h3>

                        <p>Total Siswa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ url('/siswa') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalOrangtua ?? 0 }}</h3>

                        <p>Total Data Orang Tua</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('orangtua') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3 class="text-white">{{ $totalJabatan ?? 0 }}</h3>

                        <p class="text-white">Total Data Jabatan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('jabatan') }}" class="small-box-footer"><text class="text-white">More info </text><i class="fas fa-arrow-circle-right text-white"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $totalPegawai ?? 0 }}</h3>

                        <p>Total Data Pegawai</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('jabatan') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
        <!-- /.row -->
        <!-- Main row -->

        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-dark">
                    <div class="inner">
                        <h3>{{ $totalBukuTamu ?? 0 }}</h3>

                        <p>Total Data Buku Tamu</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('bukutamu') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="card-body">
                <canvas id="grafikKunjunganHarian" height="100"></canvas>
            </div>
        </div>
    </div><!-- /.container-fluid -->


@endsection
<!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.onload = function () {
        fetch("{{ route('admin.grafik.data') }}")
            .then(res => res.json())
            .then(data => {
                // Ambil tanggal dan jumlah dari response JSON
                const labels = data.map(item => item.tanggal);
                const jumlah = data.map(item => item.jumlah);

                const ctx = document.getElementById('grafikKunjunganHarian').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Tamu',
                            data: jumlah,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: true }
                        },
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Gagal fetch data grafik:', error);
            });
    };
</script>

