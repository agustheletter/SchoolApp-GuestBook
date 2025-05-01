<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Guestbook</title>
  <link rel="icon" href="{{ asset('gambar/icon.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- Tombol Scroll ke Atas -->
    <button id="scrollToTopBtn" class="fixed bottom-8 right-8 bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 transition opacity-0 pointer-events-none flex flex-col items-center justify-center">
        <span class="text-2xl font-bold">↑</span>
        <span class="text-xs mt-1">Top</span>
    </button>

    <header class="bg-slate-800 text-white p-5 shadow-md">
        <div class="mx-12 flex justify-between items-center">
            <div class="flex items-center justify-center gap-2">
                <img src="{{ asset('gambar/icon.png') }}" alt="" class="w-7 h-7 mx-auto">
                <h1 class="text-2xl font-bold">Guestbook</h1>
            </div>
            <nav class="flex items-center justify-center gap-5">
                <a href="#fitur" class="hover:underline">Fitur</a>
                <a href="#tentang" class="hover:underline">Tentang</a>
                <a href="#kontak" class="hover:underline">Kontak</a>
                @if(Auth::check())  <!-- Cek apakah pengguna sudah login -->
                    <a href="{{ route('home') }}" class="ml-1 bg-green-600 hover:bg-green-700 text-white px-6 py-[6px] rounded-md transition duration-200">Admin</a>
                @else
                    <a href="{{ route('login') }}" class="ml-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-[6px] rounded-md transition duration-200">Login</a>
                @endif
            </nav>
        </div>
    </header>

    <section class="relative min-h-screen flex items-center justify-center text-center overflow-hidden">
        <!-- Background Layer -->
        <div class="absolute inset-0 bg-no-repeat bg-cover bg-center grayscale" style="background-image: url('{{ asset('gambar/stmnpbdg.jpeg') }}');">
            <!-- Overlay hitam + inner shadow -->
            <div class="w-full h-full bg-black/60 shadow-inner shadow-black/80"></div>
        </div>

        <!-- Konten -->
        <div class="relative z-10 container mx-auto px-6 py-12">
            <img src="{{ asset('gambar/icon.png') }}" alt="" class="w-28 h-28 mx-auto mb-4">
            <h2 class="text-4xl text-gray-100 drop-shadow-lg font-bold mb-4">Selamat Datang di Buku Tamu Digital</h2>
            <p class="text-lg text-gray-100 drop-shadow-md mb-8">Catat kehadiran tamu secara efisien dan terorganisir</p>
            <div class="space-x-4">
                <a href="#progress" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-800 transition">Tamu Orang Tua</a>
                <a href="#progress" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow hover:bg-green-700 transition">Tamu Umum</a>
            </div>
        </div>
    </section>

    <section id="fitur" class="bg-gray-100 py-36 flex items-center justify-center">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-2xl font-semibold mb-10">Fitur Unggulan</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="px-8 py-20 bg-white rounded shadow">
                    <i class="fas fa-keyboard text-6xl mb-4"></i>
                    <h4 class="text-xl font-bold mb-3">Input Otomatis</h4>
                    <p class="text-gray-600">Nama orang tua siswa akan terisi secara otomatis setelah memilih nama siswa dari daftar, sehingga mempercepat dan memudahkan proses pengisian data tamu.</p>
                </div>
                <div class="px-8 py-20 bg-white rounded shadow">
                    <i class="fas fa-signal text-6xl mb-4"></i>
                    <h4 class="text-xl font-bold mb-3">Rekap Kunjungan</h4>
                    <p class="text-gray-600">Setiap data tamu yang tercatat akan tersimpan secara rapi dalam sistem, sehingga memudahkan sekolah dalam melihat riwayat kunjungan kapan saja.</p>
                </div>
                <div class="px-8 py-20 bg-white rounded shadow">
                    <i class="fas fa-database text-6xl mb-4"></i>
                    <h4 class="text-xl font-bold mb-3">Pengelolaan Data</h4>
                    <p class="text-gray-600">Aplikasi ini menyediakan fitur pengelolaan data penting seperti pegawai, jabatan, siswa, dan agama, agar sistem tetap terorganisir dan mudah diperbarui.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="bg-white py-24 flex items-center justify-center">
        <div class="container mx-auto px-6 text-center">
        <h3 class="text-2xl font-semibold mb-4">Tentang Aplikasi</h3>
        <p class="text-gray-600 max-w-5xl mx-auto">Aplikasi Buku Tamu Digital ini adalah proyek tugas akhir kami untuk mata pelajaran pengembangan website, dibangun menggunakan Laravel dan MySQL. Aplikasi ini dirancang untuk membantu sekolah dalam mencatat dan mengelola kunjungan tamu—baik orang tua siswa maupun tamu umum—secara efisien dan terstruktur. Fitur-fitur utamanya meliputi input data tamu secara langsung, pemisahan kategori tamu, pencatatan tujuan kunjungan, serta pengelolaan data pegawai, siswa, jabatan, dan agama. Seluruh data tersimpan secara digital sehingga memudahkan pencarian, rekap, dan pelaporan kunjungan.</p>
        </div>
    </section>

    <section id="kontak" class="bg-gray-100 py-48 flex items-center justify-center">
        <div class="container mx-auto px-6 text-center">
        <h3 class="text-2xl font-semibold mb-4">Kontak</h3>
        <p class="text-gray-600">Hubungi pengembang melalui email: <a href="mailto:admin@sekolah.id" class="text-blue-600 hover:underline">admin@sekolah.id</a></p>
        </div>
    </section>

    <footer class="bg-slate-700 text-white text-center py-6">
        <p>&copy; 2025 Buku Tamu Digital. Development by Software Engineer SMKN 1 Cimahi.</p>
    </footer>

    <script>
        // Ambil tombol
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');

        // Fungsi untuk memunculkan tombol
        window.onscroll = function() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
            scrollToTopBtn.classList.add('opacity-100', 'pointer-events-auto');
        } else {
            scrollToTopBtn.classList.remove('opacity-100', 'pointer-events-auto');
            scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none');
        }
        };

        // Fungsi scroll ke atas saat tombol diklik
        scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>

</body>
</html>
