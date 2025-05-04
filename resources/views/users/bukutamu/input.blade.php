<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input | Guestbook</title>
    <link rel="icon" href="{{ asset('gambar/icon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-image: url('{{ asset('gambar/smkn1cimahi.jpg') }}');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 poppins flex flex-col min-h-screen">

    <!-- Navbar -->
    <header id="navbar" class="fixed top-0 w-full z-50 transition duration-300 bg-[#f0c256] text-slate-900 p-5 shadow-2xl">
        <div class="mx-12 flex justify-between items-center">
            <a href="{{ route('landing') }}" class="flex items-center justify-center gap-2 group">
                <img src="{{ asset('gambar/icon.png') }}" alt="" class="w-7 h-7 mx-auto drop-shadow-xl">
                <h1 class="text-2xl font-semibold text-gray-800 drop-shadow-xl group-hover:text-slate-100 transition duration-300">GuestBook</h1>
            </a>
            <nav class="flex items-center justify-center gap-5">
                <a href="{{ route('landing') }}" class="hover:text-slate-100 transition duration-300">Beranda</a>
                <a href="{{ route('landing') }}" class="hover:text-slate-100 transition duration-300">Fitur</a>
                <a href="{{ route('landing') }}" class="hover:text-slate-100 transition duration-300">Tentang</a>
                <a href="{{ route('landing') }}" class="hover:text-slate-100 transition duration-300">Kontak</a>
                @if(Auth::check())
                <a href="{{ route('home') }}" class="ml-1 bg-green-600 hover:bg-green-700 text-white px-6 py-[6px] rounded-md transition duration-300">Admin</a>
                @else
                <a href="{{ route('login') }}" class="ml-1 bg-black text-white px-6 py-[6px] rounded-md transition duration-300 shadow-xl hover:bg-white hover:text-black">Login</a>
                @endif
            </nav>
        </div>
    </header>

    <!-- Login Form -->
    <section class="pt-[120px] flex items-center justify-center mb-16 flex-grow"">
        <div class="bg-[#eee] shadow-lg rounded-xl px-8 py-6 w-full max-w-7xl mx-6 text-slate-800">
            <h2 class="text-center text-2xl font-bold mb-4">Buku Tamu Digital SMK Negeri 1 Cimahi</h2>
            <div class="w-fit mb-4 flex flex-row-reverse text-sm items-center bg-gray-300 gap-2 px-2 py-1 rounded-full group">
                <a href="#umum"
                   id="tamu-umum"
                   onclick="setActiveTab('tamu-umum')"
                   class="tab-btn bg-gray-300 text-gray-500 font-medium px-6 py-2 rounded-full transition">
                    Tamu Umum
                </a>

                <a href="#ortu"
                   id="orang-tua"
                   onclick="setActiveTab('orang-tua')"
                   class="tab-btn bg-white text-slate-800 font-medium px-6 py-2 rounded-full transition">
                    Orang Tua
                </a>
            </div>

            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Oops!</strong> {{ session('error') }}
            </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Sukses! </strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 text-green-700" onclick="this.parentElement.remove()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div id="form-orang-tua" class="">
                <form method="POST" action="{{ route('guestbook.store') }}">
                    @csrf
                    <div class="mb-4 flex items-center gap-4">
                        <label for="idsiswa" class="w-52 text-left font-semibold">Orang Tua dari Siswa</label>
                        <select class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                            name="idsiswa" id="idsiswa" required>
                            <option value="" selected disabled>Pilih Nama Siswa</option>
                            @foreach ($siswa as $s)
                                <option value="{{ $s->idsiswa }}">{{ $s->namasiswa }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="namaOrtu" class="w-52 text-left font-semibold">Nama Orang Tua</label>
                        <input type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="nama" id="namaOrtu" placeholder="Masukan Nama Anda" required>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="agama" class="w-52 text-left font-semibold">Agama</label>
                        <select class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="idagama" id="agama" required>
                            <option value="" disabled selected>Pilih Agama</option>
                            @foreach ($agama as $a)
                                <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="alamat" class="w-52 text-left font-semibold">Alamat</label>
                        <textarea rows="3" type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="alamat" id="alamat" placeholder="Masukan Alamat" required></textarea>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="kontak" class="w-52 text-left font-semibold">Kontak</label>
                        <input type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="kontak" id="kontak" placeholder="Masukan Nomor Handphone / Email" required>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="jabatan" class="w-52 text-left font-semibold">Bertemu Dengan (Jabatan)</label>
                        <select class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="id_jabatan" id="jabatan" required>
                            <option value="" disabled selected>Pilih Jabatan</option>
                            @foreach ($jabatan as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="pegawai" class="w-52 text-left font-semibold">Nama Pegawai</label>
                        <select class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="id_pegawai" id="pegawai" required>
                            <option value="">Pilih Nama Pegawai</option>
                        </select>
                    </div>

                    <div class="mb-6 flex items-center gap-4">
                        <label for="keperluan" class="w-52 text-left font-semibold">Keperluan</label>
                        <textarea rows="3" type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="keperluan" id="keperluan" placeholder="Masukan Keperluan" required></textarea>
                    </div>

                    <div class="flex gap-3 justify-end">
                        <a href="{{ route('landing') }}"
                            class="w-52 bg-[#ffd369] hover:bg-gray-800 hover:text-yellow-500 text-gray-800 font-semibold py-2 rounded-md transition duration-300 text-center">
                            Kembali
                        </a>

                        <button type="submit"
                        class="w-52 bg-[#8fd14f] hover:bg-gray-800 hover:text-[#8fd14f] text-gray-800 font-semibold py-2 rounded-md transition duration-300">
                        Simpan
                    </button>
                    </div>
                </form>
            </div>

            <div id="form-tamu-umum" class="hidden">
                <form method="POST" action="{{ route('guestbook.store') }}">
                    @csrf
                    <div class="mb-4 flex items-center gap-4">
                        <label for="instansi" class="w-52 text-left font-semibold">Asal Instansi</label>
                        <input type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="instansi" id="instansi" placeholder="Masukan Nama Instansi" required>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="namaTamu" class="w-52 text-left font-semibold">Nama</label>
                        <input type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="nama" id="namaTamu" placeholder="Masukan Nama Anda" required>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="agama" class="w-52 text-left font-semibold">Agama</label>
                        <select class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="idagama" id="agama" required>
                            <option value="" disabled selected>Pilih Agama</option>
                            @foreach ($agama as $a)
                                <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="alamat" class="w-52 text-left font-semibold">Alamat</label>
                        <textarea rows="3" type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="alamat" id="alamat" placeholder="Masukan Alamat" required></textarea>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="kontak" class="w-52 text-left font-semibold">Kontak</label>
                        <input type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="kontak" id="kontak" placeholder="Masukan Nomor Handphone / Email" required>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="jabatan" class="w-52 text-left font-semibold">Bertemu Dengan (Jabatan)</label>
                        <select class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="id_jabatan" id="jabatan" required>
                            <option value="" disabled selected>Pilih Jabatan</option>
                            @foreach ($jabatan as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="pegawai" class="w-52 text-left font-semibold">Nama Pegawai</label>
                        <select class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="id_pegawai" id="pegawai" required>
                            <option value="">Pilih Nama Pegawai</option>
                        </select>
                    </div>

                    <div class="mb-6 flex items-center gap-4">
                        <label for="keperluan" class="w-52 text-left font-semibold">Keperluan</label>
                        <textarea rows="3" type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="keperluan" id="keperluan" placeholder="Masukan Keperluan" required></textarea>
                    </div>

                    <div class="flex gap-3 justify-end">
                        <a href="{{ route('landing') }}"
                            class="w-52 bg-[#ffd369] hover:bg-gray-800 hover:text-yellow-500 text-gray-800 font-semibold py-2 rounded-md transition duration-300 text-center">
                            Kembali
                        </a>

                        <button type="submit"
                        class="w-52 bg-[#8fd14f] hover:bg-gray-800 hover:text-[#8fd14f] text-gray-800 font-semibold py-2 rounded-md transition duration-300">
                        Simpan
                    </button>
                    </div>
                </form>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-700 text-white text-center py-6">
        <p>&copy; 2025 Buku Tamu Digital. Development by Software Engineer SMKN 1 Cimahi.</p>
    </footer>

    <script>
        // Fungsi untuk mengatur tab aktif: 'tamu-umum' atau 'orang-tua' dan menampilkan/menghilangkan form terkait
        function setActiveTab(tabId) {
            const tabIds = ['tamu-umum', 'orang-tua'];

            // Menyembunyikan form berdasarkan tab yang dipilih
            const forms = {
                'tamu-umum': document.getElementById('form-tamu-umum'),
                'orang-tua': document.getElementById('form-orang-tua')
            };

            tabIds.forEach(id => {
                const tab = document.getElementById(id);
                if (tab) {
                    tab.classList.remove('bg-white', 'text-slate-800', 'inactive');
                    tab.classList.add('bg-gray-300', 'text-gray-500', 'inactive');
                }

                // Menyembunyikan form yang tidak aktif
                const form = forms[id];
                if (form) {
                    form.classList.remove('fade-in', 'visible');
                    form.classList.add('fade-out', 'hidden');
                }
            });

            const activeTab = document.getElementById(tabId);
            if (activeTab) {
                activeTab.classList.remove('bg-gray-300', 'text-gray-500', 'inactive');
                activeTab.classList.add('bg-white', 'text-slate-800');
            }

            // Menampilkan form yang sesuai dengan tab aktif
            const activeForm = forms[tabId];
            if (activeForm) {
                activeForm.classList.remove('fade-out', 'hidden');
                activeForm.classList.add('fade-in', 'visible');
            }
        }

        // Fungsi untuk menyiapkan efek hover pada tab
        function setupHoverEffects() {
            const tabs = {
                'tamu-umum': document.getElementById('tamu-umum'),
                'orang-tua': document.getElementById('orang-tua')
            };

            Object.entries(tabs).forEach(([id, element]) => {
                const otherId = id === 'tamu-umum' ? 'orang-tua' : 'tamu-umum';
                const otherElement = tabs[otherId];

                if (element && otherElement) {
                    element.addEventListener('mouseenter', () => {
                        if (!element.classList.contains('bg-white')) {
                            otherElement.classList.add('hover-fade');
                        }
                    });

                    element.addEventListener('mouseleave', () => {
                        otherElement.classList.remove('hover-fade');
                    });
                }
            });
        }

        /// Fungsi untuk mengambil hash fragment (contoh: #ortu)
        function getHashParam() {
            return window.location.hash.replace('#', '');
        }

        // Inisialisasi saat DOM siap
        document.addEventListener('DOMContentLoaded', () => {
            setupHoverEffects();

            const tabParam = getHashParam();
            if (tabParam === 'ortu') {
                setActiveTab('orang-tua');
            } else if (tabParam === 'umum') {
                setActiveTab('tamu-umum');
            } else {
                // Default tab jika tidak ada parameter
                setActiveTab('orang-tua');
            }
        });



        // fungsi kolom otomatis
        $(document).ready(function() {
            $('#jabatan').change(function() {
                var jabatan_id = $(this).val();
                $.ajax({
                    url: '/getPegawai/' + jabatan_id,
                    type: 'GET',
                    success: function(data) {
                        $('#pegawai').empty().append('<option>Pilih Nama Pegawai</option>');
                        $.each(data, function(key, value) {
                            $('#pegawai').append('<option value="' + value.id + '">' + value.nama_pegawai + '</option>');
                        });
                    }
                });
            });
        });

        document.getElementById('idsiswa').addEventListener('change', function() {
            var idsiswa = this.value;
            if (idsiswa) {
                fetch('/getOrangtua/' + idsiswa)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.nama_ortu) {
                            document.getElementById('namaOrtu').value = data.nama_ortu;
                        } else {
                            document.getElementById('namaOrtu').value = '';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        document.getElementById('namaOrtu').value = '';
                    });
            } else {
                document.getElementById('namaOrtu').value = '';
            }
        });

    </script>

</body>
</html>
