<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input | Guestbook</title>
    <link rel="icon" href="{{ asset('gambar/icon2.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CSS Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (wajib) -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('TemplateAdminLTE') }}/plugins/jquery/jquery.min.js"></script>

    <!-- JS Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script src="{{ asset('tailwindcdn.js') }}"></script>

    {{-- WebcamJS --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script> --}}
    <script src="{{ asset('webcam.js') }}"></script>

    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('TemplateAdminLTE') }}/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
        body {
            background-image: url('{{ asset('gambar/smkn1cimahi.jpg') }}');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
        }

        #camera_ortu video,
        #camera_umum video {
            transform: scaleX(-1); /* efek mirror */
            -webkit-transform: scaleX(-1); /* untuk Safari */
        }

        .select2-container--default .select2-selection--single {
            background-color: white;
            border: 1px solid #cbd5e1; /* border-slate-300 */
            border-radius: 0.375rem;   /* rounded-md */
            padding: 0 0.75rem;        /* px-3 */
            height: 42px;              /* sama kayak input biasa */
            display: flex;
            align-items: center;
            box-sizing: border-box;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-left: 0; /* biar ga dobel padding */
            line-height: normal;
        }

        .select2-container {
            width: 100% !important;
            max-width: 100%; /* batasi biar nggak lebih lebar */
            box-sizing: border-box; /* ini penting */
        }

        span.select2 {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 poppins flex flex-col min-h-screen">
    <!-- Loading Overlay -->
    @include('components.loading')

    <!-- Navbar -->
    <header id="navbar" class="fixed top-0 w-full z-50 transition duration-300 bg-[#213374] text-slate-300 p-5">
        <div class="mx-4 md:mx-12 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('landing') }}" class="flex items-center justify-center gap-2 group">
            <img src="{{ asset('gambar/icon2.png') }}" alt="" class="w-7 h-7 mx-auto drop-shadow-xl">
            <h1 class="text-2xl font-semibold text-slate-100 drop-shadow-xl group-hover:text-slate-300 transition duration-300">GuestBook</h1>
            </a>

            <!-- Desktop Nav -->
            <nav class="flex md:flex items-center justify-center gap-5">
            <a href="{{ route('landing') }}" class="hover:text-white transition duration-300">Beranda</a>
            <a href="{{ route('landing') }}" class="hover:text-white transition duration-300">Fitur</a>
            <a href="{{ route('landing') }}" class="hover:text-white transition duration-300">Tentang</a>
            <a href="{{ route('landing') }}" class="hover:text-white transition duration-300">Kontak</a>
            @if(Auth::check())
            <a href="{{ route('home') }}" class="ml-1 bg-green-600 hover:bg-green-700 text-white px-6 py-[6px] rounded-md transition duration-200">Admin</a>
            @else
            <a href="{{ route('login') }}" class="ml-1 bg-sky-500 text-slate-100 px-6 py-[6px] rounded-md transition duration-300 shadow-xl hover:bg-sky-600 hover:text-slate-200">Login</a>
            @endif
            </nav>

            <!-- Hamburger (Mobile Only) -->
            <div class="md:hidden">
            <button id="menuBtn" class="text-white text-2xl focus:outline-none">☰</button>
            </div>
        </div>

        <!-- Mobile Menu (Dropdown) -->
        <div id="mobileMenu" class="md:hidden hidden mt-4 px-4">
            <a href="{{ route('landing') }}" class="block py-2 text-white hover:text-blue-400 transition">Beranda</a>
            <a href="{{ route('landing') }}" class="block py-2 text-white hover:text-blue-400 transition">Fitur</a>
            <a href="{{ route('landing') }}" class="block py-2 text-white hover:text-blue-400 transition">Tentang</a>
            <a href="{{ route('landing') }}" class="block py-2 text-white hover:text-blue-400 transition">Kontak</a>
            @if(Auth::check())
            <a href="{{ route('home') }}" class="block py-2 mt-2 bg-green-600 hover:bg-green-700 text-white px-6 rounded-md transition duration-200 w-fit">Admin</a>
            @else
            <a href="{{ route('login') }}" class="block py-2 mt-2 bg-sky-500 text-white px-6 rounded-md transition duration-300 shadow-xl hover:bg-sky-600 hover:text-slate-200 w-fit">Login</a>
            @endif
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

                {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: '{{ session('success') }}',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#EAB308'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('landing') }}";
                                }
                            });
                        });
                    </script> --}}
            @endif

            <div id="form-orang-tua" class="">
                <form method="POST" action="{{ route('guestbook.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="role" value="ortu">

                    <div class="mb-6 flex items-center gap-4">
                        <label for="foto_tamu_ortu" class="w-52 text-left font-semibold">Ambil Foto</label>
                        <div class="flex flex-row gap-4 items-center justify-center">
                            <!-- Video Kamera (Preview) -->
                            <div id="camera_ortu" class="rounded-xl border-4 border-[#60A5FA] overflow-hidden w-[320px] h-[240px] bg-gray-200"></div>

                            <!-- Tombol Ambil Foto -->
                            <button type="button" onclick="take_snapshot_ortu()" class="bg-[#60A5FA] text-white px-4 py-2 w-40 h-12 rounded-md hover:bg-[#3B82F6] transition">
                                Ambil Foto
                            </button>

                            <!-- Hasil Foto (Awalnya hidden) -->
                            <div id="result_ortu" class="rounded-xl border-4 border-[#60A5FA] overflow-hidden w-[320px] h-[240px] hidden">
                                <img src="" class="w-full h-full object-cover" id="foto-result-ortu">
                            </div>
                        </div>
                        <input type="hidden" name="foto_tamu" id="foto_tamu_ortu">
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="idsiswa" class="w-52 text-left font-semibold">Orang Tua dari Siswa</label>
                        <select class="select2 flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                            style="width: 300px" name="idsiswa" id="idsiswa" required>
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

                    {{-- <div class="mb-4 flex items-center gap-4">
                        <label for="agama" class="w-52 text-left font-semibold">Agama</label>
                        <select class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="idagama" id="agama" required>
                            <option value="" disabled selected>Pilih Agama</option>
                            @foreach ($agama as $a)
                                <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="mb-4 flex items-center gap-4">
                        <label for="kontakOrtu" class="w-52 text-left font-semibold">Nomor Handphone</label>
                        <input type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="kontak" id="kontakOrtu" placeholder="Masukan Nomor Handphone" required>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="alamatOrtu" class="w-52 text-left font-semibold">Alamat</label>
                        <textarea rows="3" type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="alamat" id="alamatOrtu" placeholder="Masukan Alamat Anda" required></textarea>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="jabatan" class="w-52 text-left font-semibold">Bertemu Dengan (Jabatan)</label>
                        <select class="select2 flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                            name="id_jabatan" id="jabatan" required>
                            <option value="" disabled selected>Pilih Jabatan</option>
                            @foreach ($jabatan as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="pegawai" class="w-52 text-left font-semibold">Nama Pegawai / Guru</label>
                        <select class="select2 flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                            name="id_pegawai" id="pegawai" required>
                            <option value="" disabled selected>Pilih Nama Pegawai / Guru</option>
                        </select>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="keperluan" class="w-52 text-left font-semibold">Keperluan</label>
                        <textarea rows="3" type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="keperluan" id="keperluan" placeholder="Masukan Keperluan" required></textarea>
                    </div>

                    <div class="flex gap-3 justify-end">
                        <a href="{{ route('landing') }}"
                            class="w-52 bg-[#60A5FA] hover:bg-gray-800 hover:text-[#60A5FA] text-gray-800 font-semibold py-2 rounded-md transition duration-300 text-center">
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
                <form method="POST" action="{{ route('guestbook.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="role" value="umum">

                    <div class="mb-6 flex items-center gap-4">
                        <label for="foto_tamu_umum" class="w-52 text-left font-semibold">Ambil Foto</label>
                        <div class="flex flex-row gap-4 items-center justify-center">
                            <!-- Video Kamera (Preview) -->
                            <div id="camera_umum" class="rounded-xl border-4 border-[#60A5FA] overflow-hidden w-[320px] h-[240px] bg-gray-200"></div>

                            <!-- Tombol Ambil Foto -->
                            <button type="button" onclick="take_snapshot_umum()" class="bg-[#60A5FA] text-white px-4 py-2 w-40 h-12 rounded-md hover:bg-[#3B82F6] transition">
                                Ambil Foto
                            </button>

                            <!-- Hasil Foto (Awalnya hidden) -->
                            <div id="result_umum" class="rounded-xl border-4 border-[#60A5FA] overflow-hidden w-[320px] h-[240px] hidden">
                                <img src="" class="w-full h-full object-cover" id="foto-result-umum">
                            </div>
                        </div>
                        <input type="hidden" name="foto_tamu" id="foto_tamu_umum">
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="namaTamu" class="w-52 text-left font-semibold">Nama</label>
                        <input type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="nama" id="namaTamu" placeholder="Masukan Nama Anda" required>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="kontak" class="w-52 text-left font-semibold">Nomor Handphone</label>
                        <input type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="kontak" id="kontak" placeholder="Masukan Nomor Handphone" required>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="instansi" class="w-52 text-left font-semibold">Asal Instansi</label>
                        <input type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="instansi" id="instansi" placeholder="Masukan Nama Instansi" required>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="alamat" class="w-52 text-left font-semibold">Alamat Instansi</label>
                        <textarea rows="3" type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="alamat" id="alamat" placeholder="Masukan Alamat Instansi" required></textarea>
                    </div>

                    {{-- <div class="mb-4 flex items-center gap-4">
                        <label for="agama" class="w-52 text-left font-semibold">Agama</label>
                        <select class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="idagama" id="agama" required>
                            <option value="" disabled selected>Pilih Agama</option>
                            @foreach ($agama as $a)
                                <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="mb-4 flex items-center gap-4">
                        <label for="jabatan2" class="w-52 text-left font-semibold">Bertemu Dengan (Jabatan)</label>
                        <select class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="id_jabatan" id="jabatan2" required>
                            <option value="" disabled selected>Pilih Jabatan</option>
                            @foreach ($jabatan as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="pegawai2" class="w-52 text-left font-semibold">Nama Pegawai / Guru</label>
                        <select class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="id_pegawai" id="pegawai2" required>
                            <option value="">Pilih Nama Pegawai / Guru</option>
                        </select>
                    </div>

                    <div class="mb-4 flex items-center gap-4">
                        <label for="keperluan" class="w-52 text-left font-semibold">Keperluan</label>
                        <textarea rows="3" type="text" class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" name="keperluan" id="keperluan" placeholder="Masukan Keperluan" required></textarea>
                    </div>

                    <div class="flex gap-3 justify-end">
                        <a href="{{ route('landing') }}"
                            class="w-52 bg-[#60A5FA] hover:bg-gray-800 hover:text-[#60A5FA] text-gray-800 font-semibold py-2 rounded-md transition duration-300 text-center">
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


    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
        // Fungsi untuk select two
        $(document).ready(function() {
            $('#idsiswa').select2({
                placeholder: 'Pilih Nama Siswa',
                allowClear: true,
                width: '80%'
            });

            $('#jabatan').select2({
                placeholder: 'Pilih Jabatan',
                allowClear: true,
                width: 'resolve'
            });

            $('#pegawai').select2({
                placeholder: 'Pilih Nama Pegawai / Guru',
                allowClear: true,
                width: 'resolve'
            });

            $('#jabatan2').select2({
                placeholder: 'Pilih Jabatan',
                allowClear: true,
                width: 'resolve'
            });

            $('#pegawai2').select2({
                placeholder: 'Pilih Nama Pegawai / Guru',
                allowClear: true,
                width: 'resolve'
            });

        });

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

        // fungsi kolom otomatis (jabatan - pegawai)
        function setupJabatanDropdown(jabatanSelector, pegawaiSelector) {
            $(jabatanSelector).change(function() {
                const jabatan_id = $(this).val();
                $.ajax({
                    url: '/getPegawai/' + jabatan_id,
                    type: 'GET',
                    success: function(data) {
                        const $pegawai = $(pegawaiSelector);
                        $pegawai.empty();

                        if (jabatan_id == 1 && data.length > 0) {
                            const kepala = data[0];
                            $pegawai.append('<option value="' + kepala.id + '" selected>' + kepala.nama_pegawai + '</option>');
                        } else {
                            $pegawai.append('<option value="">Pilih Nama Pegawai / Guru</option>');
                            $.each(data, function(_, value) {
                                $pegawai.append('<option value="' + value.id + '">' + value.nama_pegawai + '</option>');
                            });
                        }
                    }
                });
            });
        }

        // fungsi kolom otomatis (jabatan - pegawai)
        $(document).ready(function() {
            setupJabatanDropdown('#jabatan', '#pegawai');
            setupJabatanDropdown('#jabatan2', '#pegawai2');
        });

        // $(document).ready(function() {
        //     $('#jabatan').change(function() {
        //         var jabatan_id = $(this).val();
        //         $.ajax({
        //             url: '/getPegawai/' + jabatan_id,
        //             type: 'GET',
        //             success: function(data) {
        //                 var $pegawai = $('#pegawai');
        //                 $pegawai.empty();

        //                 if (jabatan_id == 1) {
        //                     // Kalau jabatan kepala sekolah, langsung isi satu option dan selected
        //                     if (data.length > 0) {
        //                         var kepala = data[0];
        //                         $pegawai.append('<option value="' + kepala.id + '" selected>' + kepala.nama_pegawai + '</option>');
        //                     } else {
        //                         $pegawai.append('<option>Pegawai tidak ditemukan</option>');
        //                     }
        //                 } else {
        //                     // Default: opsi pilih nama pegawai
        //                     $pegawai.append('<option>Pilih Nama Pegawai</option>');
        //                     $.each(data, function(key, value) {
        //                         $pegawai.append('<option value="' + value.id + '">' + value.nama_pegawai + '</option>');
        //                     });
        //                 }
        //             }
        //         });
        //     });
        // });

        // fungsi kolom otomatis (nama siswa - nama ortu)
        // document.getElementById('idsiswa').addEventListener('change', function() {
        //     var idsiswa = this.value;
        //     if (idsiswa) {
        //         fetch('/getOrangtua/' + idsiswa)
        //             .then(response => {
        //                 if (!response.ok) throw new Error('Data tidak ditemukan');
        //                 return response.json();
        //             })
        //             .then(data => {
        //                 document.getElementById('namaOrtu').value   = data.nama_ortu || '';
        //                 document.getElementById('kontakOrtu').value = data.kontak || '';
        //                 document.getElementById('alamatOrtu').value = data.alamat || '';
        //             })
        //             .catch(error => {
        //                 console.error('Error fetching data:', error);
        //                 document.getElementById('namaOrtu').value   = '';
        //                 document.getElementById('kontakOrtu').value = '';
        //                 document.getElementById('alamatOrtu').value = '';
        //             });
        //     } else {
        //         document.getElementById('namaOrtu').value = '';
        //         document.getElementById('kontakOrtu').value = '';
        //         document.getElementById('alamatOrtu').value = '';
        //     }
        // });

        $(document).ready(function() {
            $('#idsiswa').on('change', function () {
                var idsiswa = $(this).val();
                if (idsiswa) {
                    fetch('/getOrangtua/' + idsiswa)
                        .then(response => {
                            if (!response.ok) throw new Error('Data tidak ditemukan');
                            return response.json();
                        })
                        .then(data => {
                            $('#namaOrtu').val(data.nama_ortu || '');
                            $('#kontakOrtu').val(data.kontak || '');
                            $('#alamatOrtu').val(data.alamat || '');
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                            $('#namaOrtu').val('');
                            $('#kontakOrtu').val('');
                            $('#alamatOrtu').val('');
                        });
                } else {
                    $('#namaOrtu').val('');
                    $('#kontakOrtu').val('');
                    $('#alamatOrtu').val('');
                }
            });
        });


        // $(document).ready(function() {
        //     $('#jabatan2').change(function() {
        //         var jabatan_id = $(this).val();
        //         $.ajax({
        //             url: '/getPegawai/' + jabatan_id,
        //             type: 'GET',
        //             success: function(data) {
        //                 var $pegawai = $('#pegawai2');
        //                 $pegawai.empty();

        //                 if (jabatan_id == 1) {
        //                     // Kalau jabatan kepala sekolah, langsung isi satu option dan selected
        //                     if (data.length > 0) {
        //                         var kepala = data[0];
        //                         $pegawai.append('<option value="' + kepala.id + '" selected>' + kepala.nama_pegawai + '</option>');
        //                     } else {
        //                         $pegawai.append('<option>Pegawai tidak ditemukan</option>');
        //                     }
        //                 } else {
        //                     // Default: opsi pilih nama pegawai
        //                     $pegawai.append('<option>Pilih Nama Pegawai</option>');
        //                     $.each(data, function(key, value) {
        //                         $pegawai.append('<option value="' + value.id + '">' + value.nama_pegawai + '</option>');
        //                     });
        //                 }
        //             }
        //         });
        //     });
        // });

        // Inisialisasi WebcamJS
        Webcam.set({
            width: 320,
            height: 233,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        // Deteksi jika webcam gagal digunakan
        Webcam.on('error', function(err) {
            alert('Kamera tidak bisa digunakan. Pastikan sudah memberi izin atau cek apakah perangkat memiliki webcam.');
        });

        // Attach kamera ke elemen video
        Webcam.attach('#camera_ortu');
        Webcam.attach('#camera_umum');

        function take_snapshot(target, resultSelector, hiddenInputId) {
            if (typeof Webcam === 'undefined') return;

            // Webcam.snap(function(data_uri) {
            //     document.querySelector(resultSelector).src = data_uri;
            //     document.querySelector(resultSelector).parentElement.classList.remove('hidden');
            //     document.getElementById(hiddenInputId).value = data_uri;
            // });

            Webcam.snap(function(data_uri) {
                const img = new Image();
                img.onload = function () {
                    const canvas = document.createElement('canvas');
                    canvas.width = img.width;
                    canvas.height = img.height;

                    const ctx = canvas.getContext('2d');

                    // Mirror horizontal
                    ctx.translate(img.width, 0);
                    ctx.scale(-1, 1);
                    ctx.drawImage(img, 0, 0);

                    const mirroredDataUri = canvas.toDataURL('image/jpeg', 0.9);

                    // Tampilkan dan simpan
                    const resultImage = document.querySelector(resultSelector);
                    resultImage.src = mirroredDataUri;
                    resultImage.parentElement.classList.remove('hidden');

                    document.getElementById(hiddenInputId).value = mirroredDataUri;
                };

                img.src = data_uri;
            });
        }

        // Fungsi Ambil Foto (Orang Tua)
        function take_snapshot_ortu() {
            take_snapshot('camera_ortu', '#foto-result-ortu', 'foto_tamu_ortu');
        }

        // Fungsi Ambil Foto (Tamu Umum)
        function take_snapshot_umum() {
            take_snapshot('camera_umum', '#foto-result-umum', 'foto_tamu_umum');
        }

        // function take_snapshot_ortu() {
        //     Webcam.snap(function(data_uri) {
        //         const resultDiv = document.getElementById('result_ortu');
        //         const fotoResult = document.getElementById('foto-result-ortu');

        //         // Tampilkan hasil foto di bawah video
        //         fotoResult.src = data_uri;
        //         resultDiv.classList.remove('hidden');

        //         // Simpan data foto ke input hidden
        //         document.getElementById('foto_tamu_ortu').value = data_uri;
        //     });
        // }

        // function take_snapshot_umum() {
        //     Webcam.snap(function(data_uri) {
        //         const resultDiv = document.getElementById('result_umum');
        //         const fotoResult = document.getElementById('foto-result-umum');

        //         // Tampilkan hasil foto di bawah video
        //         fotoResult.src = data_uri;
        //         resultDiv.classList.remove('hidden');

        //         // Simpan data foto ke input hidden
        //         document.getElementById('foto_tamu_umum').value = data_uri;
        //     });
        // }

    </script>

</body>
</html>
