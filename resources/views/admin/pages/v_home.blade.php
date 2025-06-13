@extends('admin.v_admin')
@section('judulhalaman', 'Home')
@section('title', 'Admin')

@section('konten')
<div class="container-fluid">
    <div class="row">
        <!-- Total Siswa -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalSiswa ?? 0 }}</h3>
                    <p>Total Siswa</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ url('/siswa') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Total Orang Tua -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalOrangtua ?? 0 }}</h3>
                    <p>Total Data Orang Tua</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('orangtua') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Total Jabatan -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3 class="text-white">{{ $totalJabatan ?? 0 }}</h3>
                    <p class="text-white">Total Data Jabatan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('jabatan') }}" class="small-box-footer">
                    <span class="text-white">More info </span>
                    <i class="fas fa-arrow-circle-right text-white"></i>
                </a>
            </div>
        </div>

        <!-- Total Pegawai -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalPegawai ?? 0 }}</h3>
                    <p>Total Data Pegawai</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('jabatan') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Total Buku Tamu -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3>{{ $totalBukuTamu ?? 0 }}</h3>
                    <p>Total Data Buku Tamu</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('bukutamu') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- <div class="mb-3" style="width: 100%;">
        <h2 class="text-end my-4 d-inline-block">Statistik Kunjungan Tamu</h2>
        <label for="filterOption" class="form-label">Filter Grafik</label>
        <select id="filterOption" class="form-control w-25">
            <option value="hari">Harian</option>
            <option value="minggu">Mingguan</option>
            <option value="bulan">Bulanan</option>
            <option value="tahun">Tahunan</option>
        </select>
    </div> --}}

    <div class="d-flex justify-content-between align-items-center mt-4 mb-3" style="width: 100%;">
        <h2 class="my-0">Statistik Kunjungan Tamu</h2>

        <div>
            <label for="filterOption" class="form-label mb-0 me-2">Filter Grafik:</label>
            <select id="filterOption" class="form-control d-inline-block w-auto">
                <option value="hari">Harian</option>
                <option value="minggu">Mingguan</option>
                <option value="bulan">Bulanan</option>
                <option value="tahun">Tahunan</option>
            </select>
        </div>
    </div>


    <div class="mb-3" id="rangeTahunContainer" style="display:none;">
        <label for="tahunMulai" class="form-label">Mulai Tahun</label>
        <select id="tahunMulai" class="form-control d-inline w-auto"></select>

        <label for="tahunAkhir" class="form-label ms-3">Akhir Tahun</label>
        <select id="tahunAkhir" class="form-control d-inline w-auto"></select>
    </div>

    <div class="card">
        <div class="card-body">
            <canvas id="grafikKunjunganHarian" height="100"></canvas>
        </div>
    </div>
</div>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let chart;

    function isiDropdownTahun() {
        const tahunMulai = document.getElementById('tahunMulai');
        const tahunAkhir = document.getElementById('tahunAkhir');
        const tahunSekarang = new Date().getFullYear();
        const tahunAwal = 2023;

        tahunMulai.innerHTML = '';
        tahunAkhir.innerHTML = '';

        for(let t = tahunAwal; t <= tahunSekarang; t++) {
            tahunMulai.innerHTML += `<option value="${t}">${t}</option>`;
            tahunAkhir.innerHTML += `<option value="${t}">${t}</option>`;
        }

        tahunMulai.value = tahunAwal;
        tahunAkhir.value = tahunSekarang;
    }

    function fetchAndRenderChart(filter = 'hari') {
        fetch(`{{ url('/admin/grafik-data') }}?filter=${filter}`)
            .then(res => res.json())
            .then(data => {
                const labels = data.map(item => item.label);
                const jumlah = data.map(item => item.jumlah);

                const ctx = document.getElementById('grafikKunjunganHarian').getContext('2d');

                if (chart) chart.destroy();

                chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Tamu',
                            data: jumlah,
                            // borderColor: 'rgba(54, 162, 235, 1)',
                            // backgroundColor: 'rgba(54, 162, 235, 0.2)',

                            // borderColor: 'rgba(255, 99, 132, 1)',
                            // backgroundColor: 'rgba(255, 99, 132, 0.2)',

                            borderColor: 'rgba(255, 206, 86, 1)',
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',

                            // borderColor: 'rgba(75, 192, 192, 1)',
                            // backgroundColor: 'rgba(75, 192, 192, 0.2)',

                            // borderColor: 'rgba(153, 102, 255, 1)',
                            // backgroundColor: 'rgba(153, 102, 255, 0.2)',

                            // borderColor: 'rgba(255, 159, 64, 1)',
                            // backgroundColor: 'rgba(255, 159, 64, 0.2)',

                            // borderColor: 'rgba(255, 105, 180, 1)',
                            // backgroundColor: 'rgba(255, 105, 180, 0.2)',

                            // borderColor: 'rgba(64, 224, 208, 1)',
                            // backgroundColor: 'rgba(64, 224, 208, 0.2)',

                            // borderColor: 'rgba(144, 238, 144, 1)',
                            // backgroundColor: 'rgba(144, 238, 144, 0.2)',

                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: true } },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { stepSize: 1, precision: 0 }
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Gagal fetch data grafik:', error);
            });
    }

    document.getElementById('filterOption').addEventListener('change', function () {
        fetchAndRenderChart(this.value);
    });

    window.onload = () => {
        isiDropdownTahun();
        fetchAndRenderChart();
    };
</script>
@endpush

@endsection
