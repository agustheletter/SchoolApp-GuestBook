@extends('admin.v_admin')
@section('judulhalaman', 'Home')
@section('title', 'Admin')

@section('konten')
<div class="container mx-auto px-4 py-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Siswa -->
        <div class="flex flex-col bg-blue-500 rounded-lg shadow-md overflow-hidden h-full">
            <div class="p-6 flex-grow">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-3xl font-bold text-white">{{ $totalSiswa ?? 0 }}</h3>
                        <p class="text-blue-100">Total Siswa</p>
                    </div>
                    <div class="text-blue-200">
                        <i class="fas fa-graduation-cap text-4xl"></i>
                    </div>
                </div>
            </div>
            <a href="{{ url('/siswa') }}" class="block bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 transition-colors">
                More info <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>

        <!-- Total Orang Tua -->
        <div class="flex flex-col bg-green-500 rounded-lg shadow-md overflow-hidden h-full">
            <div class="p-6 flex-grow">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-3xl font-bold text-white">{{ $totalOrangtua ?? 0 }}</h3>
                        <p class="text-green-100">Total Data Orang Tua</p>
                    </div>
                    <div class="text-green-200">
                        <i class="fas fa-users text-4xl"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('orangtua') }}" class="block bg-green-600 hover:bg-green-700 text-white text-center py-2 px-4 transition-colors">
                More info <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>

        <!-- Total Jabatan -->
        <div class="flex flex-col bg-indigo-500 rounded-lg shadow-md overflow-hidden h-full">
            <div class="p-6 flex-grow">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-3xl font-bold text-white">{{ $totalJabatan ?? 0 }}</h3>
                        <p class="text-indigo-100">Total Data Jabatan</p>
                    </div>
                    <div class="text-indigo-200">
                        <i class="fas fa-user-tie text-4xl"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('jabatan') }}" class="block bg-indigo-600 hover:bg-indigo-700 text-white text-center py-2 px-4 transition-colors">
                More info <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>

        <!-- Total Pegawai -->
        <div class="flex flex-col bg-red-500 rounded-lg shadow-md overflow-hidden h-full">
            <div class="p-6 flex-grow">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-3xl font-bold text-white">{{ $totalPegawai ?? 0 }}</h3>
                        <p class="text-red-100">Total Data Pegawai</p>
                    </div>
                    <div class="text-red-200">
                        <i class="fas fa-user-shield text-4xl"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('jabatan') }}" class="block bg-red-600 hover:bg-red-700 text-white text-center py-2 px-4 transition-colors">
                More info <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- Buku Tamu Card -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="flex flex-col bg-gray-800 rounded-lg shadow-md overflow-hidden h-full">
            <div class="p-6 flex-grow">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-3xl font-bold text-white">{{ $totalBukuTamu ?? 0 }}</h3>
                        <p class="text-gray-300">Total Data Buku Tamu</p>
                    </div>
                    <div class="text-gray-400">
                        <i class="fas fa-book-open text-4xl"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('bukutamu') }}" class="block bg-gray-700 hover:bg-gray-600 text-white text-center py-2 px-4 transition-colors">
                More info <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>
</div>

    <!-- Chart Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Statistik Kunjungan Tamu</h2>

            <div class="flex flex-col space-y-2 w-full md:w-auto">
                <label for="filterOption" class="text-sm font-medium text-gray-700">Filter Grafik:</label>
                <select id="filterOption" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="hari" selected>Harian</option>
                    <option value="minggu">Mingguan</option>
                    <option value="bulan">Bulanan</option>
                    <option value="tahun">Tahunan</option>
                </select>

                <input type="date" id="tanggalInput" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" style="display: none;">

                <div class="w-full">
                    <div id="filterMinggu" class="flex flex-row flex-wrap gap-2" style="display: none;">
                        <select id="bulanMinggu" class="w-auto border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option disabled selected>Pilih Bulan</option>
                        </select>
                        <select id="tahunMinggu" class="w-auto border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option disabled selected>Pilih Tahun</option>
                        </select>
                        <select id="mingguKe" class="w-auto border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option disabled selected>Pilih Minggu</option>
                        </select>
                    </div>
                </div>

                <div id="filterBulan" class="grid grid-cols-2 gap-2" style="display: none;">
                    <select id="bulanBulan" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option disabled selected>Pilih Bulan</option>
                    </select>
                    <select id="tahunBulan" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option disabled selected>Pilih Tahun</option>
                    </select>
                </div>

                <div id="filterTahun" style="display: none;">
                    <select id="nilaiTahun" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option disabled selected>Pilih Tahun</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4">
            <canvas id="grafikKunjunganHarian" height="100"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // (Keep all the original JavaScript code exactly as is)
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
        filterMinggu.style.display = (selected === 'minggu') ? 'grid' : 'none';
        filterBulan.style.display = (selected === 'bulan') ? 'grid' : 'none';
        filterTahun.style.display = (selected === 'tahun') ? 'block' : 'none';


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
                            borderColor: 'rgba(255, 206, 86, 1)',
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
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
