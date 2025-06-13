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

    <div class="d-flex justify-content-between align-items-center mb-3" style="width: 100%;">
        <h2 class="my-0">Statistik Kunjungan Tamu</h2>

        <div class="text-end d-flex flex-column align-items-end">
            <label for="filterOption" class="form-label mb-1">Filter Grafik:</label>
            <select id="filterOption" class="form-control d-inline-block w-auto mb-2">
                <option value="hari" selected>Harian</option>
                <option value="minggu">Mingguan</option>
                <option value="bulan">Bulanan</option>
                <option value="tahun">Tahunan</option>
            </select>

            <input type="date" id="tanggalInput" class="form-control w-auto mb-2" style="display: none;">

            <div id="filterMinggu" class="flex-wrap justify-content-end" style="display: none; gap: 8px;">
                <select id="bulanMinggu" class="border p-2 rounded">
                    <option disabled selected>Pilih Bulan</option>
                </select>

                <select id="tahunMinggu" class="border p-2 rounded">
                    <option disabled selected>Pilih Tahun</option>
                </select>

                <select id="mingguKe" class="border p-2 rounded">
                    <option disabled selected>Pilih Minggu</option>
                </select>
            </div>

            <div id="filterBulan" class="flex-wrap justify-content-end" style="display: none; gap: 8px;">
                <select id="bulanBulan" class="border p-2 rounded">
                    <option disabled selected>Pilih Bulan</option>
                </select>

                <select id="tahunBulan" class="border p-2 rounded">
                    <option disabled selected>Pilih Tahun</option>
                </select>
            </div>

            <div id="filterTahun" class="flex-wrap justify-content-end" style="display: none; gap: 8px;">
                <select id="nilaiTahun" class="border p-2 rounded">
                    <option disabled selected>Pilih Tahun</option>
                </select>
            </div>

        </div>
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

    document.addEventListener('DOMContentLoaded', function () {
        const tanggalInput = document.getElementById('tanggalInput');
        const filterOption = document.getElementById('filterOption');

        const today = new Date().toISOString().split('T')[0];
        tanggalInput.value = today;

        // Tampilkan atau sembunyikan tanggal sesuai nilai awal filter
        tanggalInput.style.display = (filterOption.value === 'hari') ? 'block' : 'none';

        fetchAndRenderChart(filterOption.value);
    });

    document.getElementById('tanggalInput').addEventListener('change', function () {
        const currentFilter = document.getElementById('filterOption').value;
        if (currentFilter === 'hari') {
            fetchAndRenderChart(currentFilter);
        }
    });

    let chart;

    // filter mingguan
    const filterOption = document.getElementById('filterOption');
    const filterMinggu = document.getElementById('filterMinggu');
    const bulanMinggu = document.getElementById('bulanMinggu');
    const tahunMinggu = document.getElementById('tahunMinggu');
    const mingguKe = document.getElementById('mingguKe');

    // filter bulanan
    const filterBulan = document.getElementById('filterBulan');
    const bulanBulan = document.getElementById('bulanBulan');
    const tahunBulan = document.getElementById('tahunBulan');

    // filter tahunan
    const filterTahun = document.getElementById('filterTahun');
    const nilaiTahun = document.getElementById('nilaiTahun');

    // Isi dropdown tahun dan bulan awal
    function initMingguFilter() {
        const now = new Date();
        const tahunSekarang = now.getFullYear();
        const tahunAwal = 2023;

        tahunMinggu.innerHTML = '<option disabled selected>Pilih Tahun</option>';
        bulanMinggu.innerHTML = '<option disabled selected>Pilih Bulan</option>';
        mingguKe.innerHTML = '<option disabled selected>Pilih Minggu</option>';

        for (let t = tahunAwal; t <= tahunSekarang; t++) {
            tahunMinggu.innerHTML += `<option value="${t}">${t}</option>`;
        }

        const namaBulan = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        namaBulan.forEach((nama, index) => {
            bulanMinggu.innerHTML += `<option value="${index}">${nama}</option>`;
        });
    }

    function initBulanFilter() {
        const now = new Date();
        const tahunSekarang = now.getFullYear();
        const tahunAwal = 2023;

        tahunBulan.innerHTML = '<option disabled selected>Pilih Tahun</option>';
        bulanBulan.innerHTML = '<option disabled selected>Pilih Bulan</option>';

        for (let t = tahunAwal; t <= tahunSekarang; t++) {
            tahunBulan.innerHTML += `<option value="${t}">${t}</option>`;
        }

        const namaBulan = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        namaBulan.forEach((nama, index) => {
            bulanBulan.innerHTML += `<option value="${index + 1}">${nama}</option>`;
        });
    }

    function initTahunFilter() {
        const now = new Date();
        const tahunSekarang = now.getFullYear();
        const tahunAwal = 2023;

        nilaiTahun.innerHTML = '<option disabled selected>Pilih Tahun</option>';

        for (let t = tahunAwal; t <= tahunSekarang; t++) {
            nilaiTahun.innerHTML += `<option value="${t}">${t}</option>`;
        }
    }

    // Hitung minggu ke-1 s.d. ke-N dari bulan dan tahun
    function generateMingguan(tahun, bulan) {
        mingguKe.innerHTML = '<option disabled selected>Pilih Minggu</option>';

        const firstDay = new Date(tahun, bulan, 1);
        const lastDay = new Date(tahun, bulan + 1, 0);
        const mingguList = [];

        let start = new Date(firstDay);
        start.setDate(1 - start.getDay() + 1); // Awal minggu = Senin

        let index = 1;
        while (start <= lastDay) {
            const end = new Date(start);
            end.setDate(end.getDate() + 6);

            const display = `Minggu ke-${index} (${formatDate(start)} ~ ${formatDate(end)})`;
            mingguList.push({
                label: display,
                start: formatDate(start),
                end: formatDate(end)
            });

            start.setDate(start.getDate() + 7);
            index++;
        }

        mingguList.forEach((minggu, i) => {
            mingguKe.innerHTML += `<option value="${minggu.start}|${minggu.end}">${minggu.label}</option>`;
        });
    }

    // Format YYYY-MM-DD
    function formatDate(date) {
        return date.toISOString().split('T')[0];
    }

    // Event ketika filter diganti
    filterOption.addEventListener('change', function () {
        const selected = this.value;
        const tanggalInput = document.getElementById('tanggalInput');

        tanggalInput.style.display = (selected === 'hari') ? 'block' : 'none';
        filterMinggu.style.display = (selected === 'minggu') ? 'flex' : 'none';
        filterBulan.style.display = (selected === 'bulan') ? 'flex' : 'none';
        filterTahun.style.display = (selected === 'tahun') ? 'flex' : 'none';


        if (selected === 'minggu') {
            initMingguFilter();

            // Tunggu sejenak isi dropdown selesai (karena innerHTML)
            setTimeout(() => {
                const now = new Date();
                const bulanSekarang = now.getMonth(); // 0 = Januari
                const tahunSekarang = 2025;

                // Set dropdown tahun dan bulan
                tahunMinggu.value = tahunSekarang;
                bulanMinggu.value = bulanSekarang;

                // Generate daftar minggu berdasarkan tahun & bulan
                generateMingguan(tahunSekarang, bulanSekarang);

                // Cari dan pilih minggu yang cocok dengan tanggal hari ini
                setTimeout(() => {
                    const options = mingguKe.options;
                    for (let i = 0; i < options.length; i++) {
                        const [start, end] = options[i].value.split('|');
                        const today = new Date().toISOString().split('T')[0];
                        if (today >= start && today <= end) {
                            mingguKe.selectedIndex = i;
                            break;
                        }
                    }

                    fetchAndRenderChart('minggu');
                }, 50);
            }, 50);
        }

        if (selected === 'bulan') {
            initBulanFilter();

            // Tunggu dropdown terisi, lalu set default otomatis
            setTimeout(() => {
                const now = new Date();
                const bulanSekarang = now.getMonth() + 1; // 1 = Januari
                const tahunSekarang = 2025;

                bulanBulan.value = bulanSekarang;
                tahunBulan.value = tahunSekarang;

                fetchAndRenderChart('bulan');
            }, 50);
        }

        if (selected === 'tahun') {
            initTahunFilter();

            // Tunggu dropdown terisi, lalu set default otomatis
            setTimeout(() => {
                const now = new Date();
                const tahunSekarang = now.getFullYear();
                nilaiTahun.value = tahunSekarang;

                fetchAndRenderChart('tahun');
            }, 50);
        }

        fetchAndRenderChart(selected);
    });

    // mingguan
    bulanMinggu.addEventListener('change', () => {
        if (tahunMinggu.value) generateMingguan(parseInt(tahunMinggu.value), parseInt(bulanMinggu.value));
    });

    tahunMinggu.addEventListener('change', () => {
        if (bulanMinggu.value) generateMingguan(parseInt(tahunMinggu.value), parseInt(bulanMinggu.value));
    });

    mingguKe.addEventListener('change', () => {
        const currentFilter = filterOption.value;
        if (currentFilter === 'minggu') fetchAndRenderChart(currentFilter);
    });

    // bulanan
    bulanBulan.addEventListener('change', () => {
        const currentFilter = filterOption.value;
        if (currentFilter === 'bulan' && tahunBulan.value) {
            fetchAndRenderChart(currentFilter);
        }
    });

    tahunBulan.addEventListener('change', () => {
        const currentFilter = filterOption.value;
        if (currentFilter === 'bulan' && bulanBulan.value) {
            fetchAndRenderChart(currentFilter);
        }
    });


    // tahunan
    nilaiTahun.addEventListener('change', () => {
        const currentFilter = filterOption.value;
        if (currentFilter === 'tahun' && nilaiTahun.value) {
            fetchAndRenderChart(currentFilter);
        }
    });


    // fetch data
    function fetchAndRenderChart(filter = 'hari') {
        let url = `{{ url('/admin/grafik-data') }}?filter=${filter}`;

        if (filter === 'hari') {
            const tanggal = document.getElementById('tanggalInput').value;
            if (tanggal) {
                url += `&date=${tanggal}`;
            }
        }

        if (filter === 'minggu') {
            const value = mingguKe.value;
            if (value) {
                const [start, end] = value.split('|');
                url += `&start=${start}&end=${end}`;
            }
        }

        if (filter === 'bulan') {
            const bulan = bulanBulan.value;
            const tahun = tahunBulan.value;
            if (bulan && tahun) {
                url += `&bulan=${bulan}&tahun=${tahun}`;
            }
        }

        if (filter === 'tahun') {
            const tahun = nilaiTahun.value;
            if (tahun) {
                url += `&tahun=${tahun}`;
            }
        }

        fetch(url)
            .then(res => res.json())
            .then(data => {
                const labels = data.map(item => item.label);
                const jumlah = data.map(item => item.jumlah);

                const ctx = document.getElementById('grafikKunjunganHarian').getContext('2d');

                if (chart) chart.destroy();

                // Tentukan label X sesuai filter
                let labelX = 'Waktu';
                if (filter === 'hari') labelX = 'Jam';
                else if (filter === 'minggu' || filter === 'bulan') labelX = 'Tanggal';
                else if (filter === 'tahun') labelX = 'Bulan';

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
                            x: {
                                title: {
                                    display: true,
                                    text: labelX,
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Total Tamu'
                                },
                                ticks: {
                                    stepSize: 1,
                                    precision: 0
                                }
                            },
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Gagal fetch data grafik:', error);
            });
    }

    window.onload = () => {
        fetchAndRenderChart();
    };
</script>
@endpush

@endsection
