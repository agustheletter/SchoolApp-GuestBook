<!DOCTYPE html>
<html lang="id" class="scroll-smooth overflow-x-hidden">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Guestbook</title>
  <link rel="icon" href="{{ asset('gambar/icon2.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>

  <script src="{{ asset('tailwindcdn.js') }}"></script>

  <!-- Font Awesome -->
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('TemplateAdminLTE') }}/plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body class="bg-gray-50 text-gray-800 poppins overflow-x-hidden">
  <!-- Tombol Scroll ke Atas -->
  <button id="scrollToTopBtn" class="fixed bottom-8 right-8 bg-[#60A5FA] text-white p-4 rounded-full shadow-lg hover:bg-[#3B82F6] transition opacity-0 pointer-events-none flex flex-col items-center justify-center z-[9999]">
    <span class="text-2xl font-bold">↑</span>
    <span class="text-xs mt-1">Top</span>
  </button>

  <header id="navbar" class="fixed top-0 w-full z-50 transition duration-300 bg-transparent text-slate-900 p-5">
    <div class="mx-12 flex justify-between items-center">
        <a href="{{ route('landing') }}" class="flex items-center justify-center gap-2 group">
            <img src="{{ asset('gambar/icon2.png') }}" alt="" class="w-7 h-7 mx-auto drop-shadow-xl">
            <h1 class="text-2xl font-semibold text-slate-100 drop-shadow-xl group-hover:text-gray-800 transition duration-300">GuestBook</h1>
        </a>
      <nav class="flex items-center justify-center gap-5">
        <a href="#beranda" class="hover:text-slate-100 transition duration-300">Beranda</a>
        <a href="#fitur" class="hover:text-slate-100 transition duration-300">Fitur</a>
        <a href="#tentang" class="hover:text-slate-100 transition duration-300">Tentang</a>
        <a href="#kontak" class="hover:text-slate-100 transition duration-300">Kontak</a>
        @if(Auth::check())
        <a href="{{ route('home') }}" class="ml-1 bg-green-600 hover:bg-green-700 text-white px-6 py-[6px] rounded-md transition duration-200">Admin</a>
        @else
        <a href="{{ route('login') }}" class="ml-1 bg-white text-black px-6 py-[6px] rounded-md transition duration-300 shadow-xl hover:bg-sky-600 hover:text-white">Login</a>
        @endif
      </nav>
    </div>
  </header>



  {{-- Versi 1 --}}
  {{-- <section id="beranda" class="relative min-h-screen pt-[88px] flex items-center justify-center text-center overflow-hidden">
    <!-- Lingkaran Kuning Hanya di Atas -->
    <!-- <div class="absolute top-[-3000px] left-1/2 -translate-x-1/2 w-[3600px] h-[3600px] bg-[#ffd369] rounded-full z-0"></div> -->
    <!-- <div class="absolute top-[-3000px] left-1/2 -translate-x-1/2 w-[3600px] h-[3600px] bg-[#699bff] rounded-full z-0"></div> -->

    <!-- Lingkaran Gradasi Biru Cool -->
    <div class="absolute top-[-3000px] left-1/2 -translate-x-1/2 w-[3600px] h-[3600px] rounded-full z-0" style="background: linear-gradient(135deg, #1E3A8A, #2563EB, #3B82F6, #60A5FA, #93C5FD);"></div>
    <!--- <div class="absolute left-1/2 -translate-x-1/2 -top-[1800px] aspect-square rounded-full z-0" style="width: min(3600px, 300vw); background: linear-gradient(135deg, #1E3A8A, #2563EB, #3B82F6, #60A5FA, #93C5FD);"></div> -->


    <div class="absolute inset-0 -z-10 h-full w-full bg-white bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px]"></div>

    <!-- Konten -->
    <div class="relative z-10 w-full h-[440px] container mx-auto px-6 pb-12">

        <img src="{{ asset('gambar/icon2.png') }}" alt="" class="w-36 h-36 mx-auto mb-4 transition duration-300 hover:scale-110" data-aos="fade-in" data-aos-duration="500" data-aos-delay="100">
        <h2 class="text-5xl text-slate-100 drop-shadow-lg font-bold mb-4" data-aos="fade-in" data-aos-duration="500" data-aos-delay="600">Selamat Datang di Buku Tamu Digital</h2>
        <p class="text-xl text-slate-100 drop-shadow-md mb-28" data-aos="fade-in" data-aos-duration="500" data-aos-delay="1000">Catat kehadiran tamu secara efisien dan terorganisir</p>
        <div class="w-fit mx-auto flex items-center justify-center bg-white gap-3 p-2 rounded-full" data-aos="fade-in" data-aos-duration="500" data-aos-delay="1400">
            <a href="{{ route('bukutamu.user') }}#ortu" class="bg-gray-200 text-slate-800  font-medium px-9 py-5 text-xl rounded-full shadow hover:bg-blue-600 hover:text-white hover:scale-105 transition duration-300">Orang Tua</a>
            <a href="{{ route('bukutamu.user') }}#umum" class="bg-gray-200 text-slate-800 font-medium px-9 py-5 text-xl rounded-full shadow hover:bg-green-500 hover:text-white hover:scale-105 transition duration-300">Tamu Umum</a>
        </div>
    </div>
  </section> --}}

  {{-- Versi 2 --}}
  {{-- <section id="beranda" class="relative min-h-screen pt-[88px] flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-100 via-blue-200 to-blue-300">
      <!-- Blue Gradient Circle Background -->
      <div class="absolute top-[-3000px] left-1/2 -translate-x-1/2 w-[3600px] h-[3600px] rounded-full z-0" style="background: linear-gradient(135deg, #1E3A8A, #2563EB, #3B82F6, #60A5FA, #93C5FD);"></div>

      <!-- Dot Pattern Background -->
      <div class="absolute inset-0 -z-10 h-full w-full bg-white/10 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px]"></div>

      <!-- Main Content Container -->
      <div class="relative z-10 w-full container mx-auto px-6 flex items-center justify-between min-h-[600px]">

        <!-- Left Side - Content -->
        <div class="w-1/2 flex flex-col items-center text-center space-y-8">
          <img src="{{ asset('gambar/icon2.png') }}" alt="School Icon" class="w-36 h-36 transition duration-300 hover:scale-110" data-aos="fade-in" data-aos-duration="500" data-aos-delay="100">

          <div class="space-y-4">
            <h2 class="text-5xl text-slate-100 drop-shadow-lg font-bold" data-aos="fade-in" data-aos-duration="500" data-aos-delay="600">
              Selamat Datang di Buku Tamu Digital
            </h2>
            <p class="text-xl text-slate-100 drop-shadow-md" data-aos="fade-in" data-aos-duration="500" data-aos-delay="1000">
              Catat kehadiran tamu secara efisien dan terorganisir
            </p>
          </div>

          <div class="w-fit flex items-center justify-center bg-white/90 backdrop-blur-sm gap-3 p-2 rounded-full shadow-lg" data-aos="fade-in" data-aos-duration="500" data-aos-delay="1400">
            <a href="{{ route('bukutamu.user') }}#ortu" class="bg-blue-500 text-white font-medium px-9 py-5 text-xl rounded-full shadow hover:bg-blue-600 hover:scale-105 transition duration-300">
              Orang Tua
            </a>
            <a href="{{ route('bukutamu.user') }}#umum" class="bg-green-500 text-white font-medium px-9 py-5 text-xl rounded-full shadow hover:bg-green-600 hover:scale-105 transition duration-300">
              Tamu Umum
            </a>
          </div>
        </div>

        <!-- Right Side - YouTube Video -->
        <div class="w-1/2 flex items-center justify-center pl-12">
          <div class="w-full max-w-2xl">
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-blue-200">
              <h3 class="text-2xl font-semibold text-blue-800 mb-6 text-center">
                Video Profil Sekolah
              </h3>
              <div class="relative aspect-video rounded-xl overflow-hidden shadow-md">
                <iframe
                  class="w-full h-full"
                  src="https://www.youtube.com/embed/RfwrndR_uAU?si=vjVTr_eEebuqppfd"
                  title="School Profile Video"
                  frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  referrerpolicy="strict-origin-when-cross-origin"
                  allowfullscreen
                ></iframe>
              </div>
              <p class="text-sm text-blue-600 text-center mt-4">
                Tonton video profil sekolah kami untuk mengetahui lebih lanjut tentang program dan komunitas kami
              </p>
            </div>
          </div>
        </div>

      </div>
    </section> --}}

    {{-- Versi 3 --}}
    <section id="beranda" class="relative min-h-screen pt-[88px] flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-800">

      <!-- Main Gradient Orb - Top Center -->
      <div class="absolute top-[-2800px] left-1/2 -translate-x-1/2 w-[3400px] h-[3400px] rounded-full z-0 pulse-glow"
           style="background: radial-gradient(circle, #3B82F6 0%, #1D4ED8 25%, #1E40AF 50%, #1E3A8A 75%, transparent 100%);"></div>

      <!-- Secondary Gradient Orb - Right Side -->
      <div class="absolute top-[-2000px] right-[-1500px] w-[2800px] h-[2800px] rounded-full z-0 opacity-40"
           style="background: radial-gradient(circle, #06B6D4 0%, #0891B2 30%, #0E7490 60%, transparent 100%);"></div>

      <!-- Left Side Accent Orb -->
      <div class="absolute top-[-1800px] left-[-1200px] w-[2400px] h-[2400px] rounded-full z-0 opacity-30"
           style="background: radial-gradient(circle, #8B5CF6 0%, #7C3AED 40%, #6D28D9 70%, transparent 100%);"></div>

      <!-- Floating Geometric Shapes -->
      <div class="absolute top-20 left-20 w-16 h-16 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-xl opacity-20 float-animation z-0" style="animation-delay: 0s;"></div>
      <div class="absolute top-40 right-32 w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full opacity-25 float-animation z-0" style="animation-delay: 1s;"></div>
      <div class="absolute bottom-32 left-40 w-20 h-20 bg-gradient-to-br from-emerald-400 to-teal-500 rotate-45 opacity-15 drift z-0" style="animation-delay: 2s;"></div>
      <div class="absolute top-60 left-1/3 w-8 h-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full opacity-30 float-animation z-0" style="animation-delay: 3s;"></div>
      <div class="absolute bottom-48 right-20 w-14 h-14 bg-gradient-to-br from-rose-400 to-red-500 rounded-lg opacity-20 drift z-0" style="animation-delay: 4s;"></div>

      <!-- Hexagonal Shapes -->
      <div class="absolute top-32 right-1/4 w-10 h-10 opacity-25 float-animation z-0" style="animation-delay: 1.5s; background: linear-gradient(135deg, #F59E0B, #D97706); clip-path: polygon(30% 0%, 70% 0%, 100% 50%, 70% 100%, 30% 100%, 0% 50%);"></div>
      <div class="absolute bottom-40 left-1/4 w-16 h-16 opacity-20 drift z-0" style="animation-delay: 2.5s; background: linear-gradient(135deg, #10B981, #059669); clip-path: polygon(30% 0%, 70% 0%, 100% 50%, 70% 100%, 30% 100%, 0% 50%);"></div>

      <!-- Diamond Shapes -->
      <div class="absolute top-80 left-16 w-12 h-12 bg-gradient-to-br from-indigo-400 to-purple-600 opacity-30 float-animation z-0 rotate-45" style="animation-delay: 0.5s;"></div>
      <div class="absolute bottom-60 right-40 w-8 h-8 bg-gradient-to-br from-pink-400 to-rose-600 opacity-25 drift z-0 rotate-45" style="animation-delay: 3.5s;"></div>

      <!-- Dot Pattern Overlay -->
      <div class="absolute inset-0 -z-10 h-full w-full bg-white/5 bg-[radial-gradient(#ffffff20_1px,transparent_1px)] [background-size:20px_20px]"></div>

      <!-- Subtle Grid Overlay -->
      <div class="absolute inset-0 -z-10 h-full w-full bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:40px_40px]"></div>

      <!-- Main Content Container -->
      <div class="relative z-10 w-full container mx-auto px-6 flex items-center justify-between min-h-[600px]">

        <!-- Left Side - Content -->
        <div class="w-1/2 flex flex-col items-center text-center space-y-8">
          <img src="{{ asset('gambar/icon2.png') }}" alt="School Icon" class="w-36 h-36 transition duration-300 hover:scale-110 drop-shadow-2xl" data-aos="fade-in" data-aos-duration="500" data-aos-delay="100">

          <div class="space-y-4">
            <h2 class="text-5xl text-white drop-shadow-2xl font-bold" data-aos="fade-in" data-aos-duration="500" data-aos-delay="600">
              Selamat Datang di Buku Tamu Digital
            </h2>
            <p class="text-xl text-blue-100 drop-shadow-lg" data-aos="fade-in" data-aos-duration="500" data-aos-delay="1000">
              Catat kehadiran tamu secara efisien dan terorganisir
            </p>
          </div>

          <div class="w-fit flex items-center justify-center bg-white/95 backdrop-blur-lg gap-3 p-2 rounded-full shadow-2xl border border-white/20" data-aos="fade-in" data-aos-duration="500" data-aos-delay="1400">
            <a href="{{ route('bukutamu.user') }}#ortu" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium px-9 py-5 text-xl rounded-full shadow-lg hover:from-blue-600 hover:to-blue-700 hover:scale-105 transition duration-300">
              Orang Tua
            </a>
            <a href="{{ route('bukutamu.user') }}#umum" class="bg-gradient-to-r from-green-500 to-green-600 text-white font-medium px-9 py-5 text-xl rounded-full shadow-lg hover:from-green-600 hover:to-green-700 hover:scale-105 transition duration-300">
              Tamu Umum
            </a>
          </div>
        </div>

        <!-- Right Side - YouTube Video -->
        <div class="w-1/2 flex items-center justify-center pl-12">
          <div class="w-full max-w-2xl">
            <div class="bg-white/90 backdrop-blur-lg rounded-2xl p-6 shadow-2xl border border-white/30">
              <h3 class="text-2xl font-semibold text-slate-800 mb-6 text-center">
                Video Profil Sekolah
              </h3>
              <div class="relative aspect-video rounded-xl overflow-hidden shadow-xl">
                <iframe
                  class="w-full h-full"
                  src="https://www.youtube.com/embed/RfwrndR_uAU?si=vjVTr_eEebuqppfd"
                  title="School Profile Video"
                  frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  referrerpolicy="strict-origin-when-cross-origin"
                  allowfullscreen
                ></iframe>
              </div>
              <p class="text-sm text-slate-600 text-center mt-4">
                Tonton video profil sekolah kami untuk mengetahui lebih lanjut tentang program dan komunitas kami
              </p>
            </div>
          </div>
        </div>

      </div>
    </section>

  {{-- Fitur --}}
  <section id="fitur" class="py-36 min-h-screen relative">

    {{-- <div class="absolute bottom-0 left-0 right-0 top-0 bg-[linear-gradient(to_right,#4f4f4f2e_1px,transparent_1px),linear-gradient(to_bottom,#4f4f4f2e_1px,transparent_1px)] bg-[size:14px_24px] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_0%,#000_70%,transparent_110%)]"></div> --}}
    <div class="absolute bottom-0 -z-10 left-0 right-0 top-0 pointer-events-none bg-[linear-gradient(to_right,#4f4f4f2e_1px,transparent_1px),linear-gradient(to_bottom,#4f4f4f2e_1px,transparent_1px)] bg-[size:14px_24px] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_0%,#000_70%,transparent_110%)]"></div>


    <div class="container mx-auto px-6 text-center">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900" data-aos="fade-down" data-aos-duration="500" data-aos-delay="400">Features</h2>
            <p class="text-lg text-gray-600 mt-2" data-aos="fade-down" data-aos-duration="500" data-aos-delay="1200">Smart solutions, simple experience 🛠️</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex flex-col group px-8 py-20 bg-white text-gray-600 rounded shadow transition-all duration-300 hover:scale-[1.03] hover:translate-y-2 hover:bg-slate-800 hover:text-white" data-aos="fade-right" data-aos-duration="500" data-aos-delay="1600">
                <i class="fas fa-keyboard text-6xl mb-4"></i>
                <h4 class="text-xl font-bold mb-3">Input Otomatis</h4>
                <p class="text-base">Nama orang tua siswa akan terisi secara otomatis setelah memilih nama siswa dari daftar, sehingga mempercepat dan memudahkan proses pengisian data tamu.</p>
            </div>
            <div class="flex flex-col group px-8 py-20 bg-white text-gray-600 rounded shadow transition-all duration-300 hover:scale-[1.03] hover:translate-y-2 hover:bg-slate-800 hover:text-white" data-aos="fade-up" data-aos-duration="500" data-aos-delay="2000">
                <i class="fas fa-signal text-6xl mb-4"></i>
                <h4 class="text-xl font-bold mb-3">Rekap Kunjungan</h4>
                <p class="text-base">Setiap data tamu yang tercatat akan tersimpan secara rapi dalam sistem, sehingga memudahkan sekolah dalam melihat riwayat kunjungan kapan saja.</p>
            </div>
            <div class="flex flex-col group px-8 py-20 bg-white text-gray-600 rounded shadow transition-all duration-300 hover:scale-[1.03] hover:translate-y-2 hover:bg-slate-800 hover:text-white" data-aos="fade-left" data-aos-duration="500" data-aos-delay="2400">
                <i class="fas fa-database text-6xl mb-4"></i>
                <h4 class="text-xl font-bold mb-3">Pengelolaan Data</h4>
                <p class="text-base">Aplikasi ini menyediakan fitur pengelolaan data penting seperti pegawai, jabatan, siswa, dan agama, agar sistem tetap terorganisir dan mudah diperbarui.</p>
            </div>
        </div>
    </div>
  </section>

  <section id="tentang" class="py-28 flex items-center justify-center min-h-screen relative">

    <div class="absolute inset-0 -z-10 h-full w-full bg-white bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:6rem_4rem]">
        <div class="absolute bottom-0 left-0 right-0 top-0 bg-[radial-gradient(circle_800px_at_100%_200px,#60A5FA,transparent)]"></div>
    </div>


    <div class="container mx-auto px-6 text-center">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900" data-aos="fade-down" data-aos-duration="500" data-aos-delay="400">About</h2>
            <p class="text-lg text-gray-600 mt-2" data-aos="fade-down" data-aos-duration="500" data-aos-delay="1200">Discover the story behind our code 📖</p>
        </div>

        <!-- Icon -->
        <div class="flex justify-center mb-8" data-aos="fade-up" data-aos-duration="500" data-aos-delay="1200">
            <img src="{{ asset('gambar/icon2.png') }}" alt="" class="w-48 h-w-48 mx-auto drop-shadow-xl transition duration-300 hover:scale-110">
        </div>

        <p class="text-lg text-gray-600 max-w-5xl mx-auto" data-aos="fade-up" data-aos-duration="500" data-aos-delay="1600">Aplikasi Buku Tamu Digital ini adalah proyek tugas akhir kami untuk mata pelajaran pengembangan website, dibangun menggunakan Laravel dan MySQL. Aplikasi ini dirancang untuk membantu sekolah dalam mencatat dan mengelola kunjungan tamu—baik orang tua siswa maupun tamu umum—secara efisien dan terstruktur. Fitur-fitur utamanya meliputi input data tamu secara langsung, pemisahan kategori tamu, pencatatan tujuan kunjungan, serta pengelolaan data pegawai, siswa, jabatan, dan agama. Seluruh data tersimpan secara digital sehingga memudahkan pencarian, rekap, dan pelaporan kunjungan.</p>
    </div>
  </section>

  <section id="kontak" class="py-28 px-4 min-h-screen relative">

    {{-- biru --}}
    {{-- <div class="absolute inset-0 -z-10 h-full w-full bg-white [background:radial-gradient(125%_125%_at_50%_10%,#fff_40%,#3b82f6_100%)]"></div> --}}

    {{-- hitam --}}
    {{-- <div class="absolute inset-0 -z-10 h-full w-full bg-white [background:radial-gradient(125%_125%_at_50%_10%,#fff_40%,#000_100%)]"></div> --}}

    {{-- ungu --}}
    <div class="absolute inset-0 -z-10 h-full w-full bg-white [background:radial-gradient(125%_125%_at_50%_10%,#fff_40%,#63e_100%)]"></div>

    {{-- kuning --}}
    {{-- <div class="absolute inset-0 -z-10 h-full w-full bg-white [background:radial-gradient(125%_125%_at_50%_10%,#fff_40%,#facc15_100%)]"></div> --}}

    {{-- abu --}}
    {{-- <div class="absolute inset-0 -z-10 h-full w-full bg-white [background:radial-gradient(125%_125%_at_50%_10%,#fff_40%,#1e293b_100%)]"></div> --}}

    {{-- hijau --}}
    {{-- <div class="absolute inset-0 -z-10 h-full w-full bg-white [background:radial-gradient(125%_125%_at_50%_10%,#fff_40%,#22c55e_100%)]"></div> --}}

    <div class="">
        <!-- Header -->
        <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-900" data-aos="fade-down" data-aos-duration="500" data-aos-delay="400">Contact Us</h2>
        <p class="text-lg text-gray-600 mt-2" data-aos="fade-down" data-aos-duration="500" data-aos-delay="1200">Let’s get in touch with the developers 🧑🏻‍💻</p>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-6xl mx-auto">
            <!-- Card -->
            <div class="group bg-white hover:bg-slate-800 rounded-2xl shadow-xl p-8 border-4 border-slate-800 relative overflow-hidden transform hover:scale-105 hover:-translate-y-2 transition duration-500" data-aos="fade-right" data-aos-duration="500" data-aos-delay="1600">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-300 via-white to-gray-100 opacity-40 z-0 transition duration-300 group-hover:opacity-10"></div>
                <div class="relative z-10 text-center">
                <img src="{{ asset('gambar/people/adre.png') }}" alt="Adrenalin" class="w-24 h-24 mx-auto rounded-full object-cover mb-4 shadow-2xl border-4 border-transparent transform hover:scale-110 hover:border-4 hover:border-white transition duration-300">

                <h3 class="text-xl font-semibold relative inline-block text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-600 to-white animate-shine group-hover:bg-gradient-to-r group-hover:from-white group-hover:via-white group-hover:to-white group-hover:text-white transition duration-300 hover:scale-110">
                    Adrenalin Muhammad Dewangga
                </h3>

                <p class="text-sm text-gray-600 group-hover:text-gray-100 transition duration-300 hover:scale-110">Fullstack Web Developer</p>
                <p class="text-sm text-gray-500 mt-1 group-hover:text-gray-200 transition duration-300 hover:scale-110">
                    🌐 <a href="https://adre.my.id" target="_blank" class="text-blue-600 group-hover:text-blue-300 hover:underline">adre.my.id</a>
                </p>
                <p class="italic text-sm mt-4 text-gray-700 group-hover:text-gray-200 transition duration-300 hover:scale-110">
                    "Engineer by logic, artist by code."
                </p>

                <div class="flex justify-center space-x-5 mt-6 text-gray-700 group-hover:text-gray-200 transition duration-300">
                    <a href="https://instagram.com/akuadre" target="_blank" class="hover:text-pink-400 transition duration-300 hover:scale-125">
                    <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="mailto:dreenation21@gmail.com" class="hover:text-blue-400 transition duration-300 hover:scale-125">
                    <i class="fas fa-envelope text-xl"></i>
                    </a>
                    <a href="https://wa.me/628xxxxxxx" target="_blank" class="hover:text-green-400 transition duration-300 hover:scale-125">
                    <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                    <a href="https://github.com/akuadre" target="_blank" class="hover:text-white transition duration-300 hover:scale-125">
                    <i class="fab fa-github text-xl"></i>
                    </a>
                </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="group bg-white hover:bg-pink-950 rounded-2xl shadow-xl p-8 border-4 border-slate-800 relative overflow-hidden transform hover:scale-105 hover:-translate-y-2 transition duration-500" data-aos="fade-left" data-aos-duration="500" data-aos-delay="2000">
                <div class="absolute inset-0 bg-gradient-to-br from-pink-300 via-white to-gray-100 opacity-40 z-0 transition duration-300 group-hover:opacity-10"></div>
                <div class="relative z-10 text-center">
                <img src="{{ asset('gambar/people/evliya.jpg') }}" alt="Evliya" class="w-24 h-24 mx-auto rounded-full object-cover mb-4 shadow-2xl border-4 border-transparent transform hover:scale-110 hover:border-4 hover:border-white transition duration-300">

                <h3 class="text-xl font-semibold relative inline-block text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-600 to-white animate-shine group-hover:bg-gradient-to-r group-hover:from-white group-hover:via-white group-hover:to-white group-hover:text-white transition duration-300 hover:scale-110">
                    Evliya Satari Nurarifah
                </h3>

                <p class="text-sm text-gray-600 group-hover:text-gray-100 transition duration-300 hover:scale-110">Frontend & UI/UX Designer</p>
                <p class="text-sm text-gray-500 mt-1 group-hover:text-gray-200 transition duration-300 hover:scale-110">
                    🌐 <a href="https://evliya.my.id" target="_blank" class="text-blue-600 group-hover:text-blue-300 hover:underline">evliya.my.id</a>
                </p>
                <p class="italic text-sm mt-4 text-gray-700 group-hover:text-gray-200 transition duration-300 hover:scale-110">
                    "Design is not just how it looks, but how it feels."
                </p>

                <div class="flex justify-center space-x-5 mt-6 text-gray-700 group-hover:text-gray-200 transition duration-300">
                    <a href="https://instagram.com/liyayyaya" target="_blank" class="hover:text-pink-400 transition duration-300 hover:scale-125">
                    <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="mailto:evliyasatarii@gmail.com" class="hover:text-blue-400 transition duration-300 hover:scale-125">
                    <i class="fas fa-envelope text-xl"></i>
                    </a>
                    <a href="https://wa.me/6281222678810" target="_blank" class="hover:text-green-400 transition duration-300 hover:scale-125">
                    <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                    <a href="https://github.com/evliyasatari" target="_blank" class="hover:text-white transition duration-300 hover:scale-125">
                    <i class="fab fa-github text-xl"></i>
                    </a>
                </div>
                </div>
            </div>
        </div>

        <!-- Paragraf Bawah -->
        <div class="mt-8 text-center max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="500" data-aos-delay="2000">
            <p class="text-lg font-medium text-gray-900">
                We are students of Software Engineering (Rekayasa Perangkat Lunak) at SMKN 1 Cimahi, currently in the 11th grade. This project is developed as part of our academic journey to enhance real-world web development skills.
            </p>
        </div>
    </div>

  </section>

  <footer class="bg-slate-700 text-white text-center py-6">
    <p>&copy; {{ date('Y') }} Buku Tamu Digital. Development by Software Engineer SMKN 1 Cimahi.</p>
  </footer>

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#EAB308'
            });
        });
    </script>
@endif

  <script>
    // Scroll ke atas sebelum reload (opsional tambahan keamanan)
    window.addEventListener('beforeunload', function () {
        window.scrollTo(0, 0);
    });

    // Scroll ke atas saat halaman selesai dimuat
    document.addEventListener("DOMContentLoaded", function () {
        window.scrollTo({ top: 0, behavior: "auto" });
    });

    // navbar aktif
    document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll("nav a[href^='#']");

    function updateActiveNav() {
        let current = "";

        sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        const sectionHeight = section.offsetHeight;
        if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
            current = section.getAttribute("id");
        }
        });

        navLinks.forEach(link => {
        link.classList.remove("active");
        if (link.getAttribute("href") === `#${current}`) {
            link.classList.add("active");
        }
        });
    }

    window.addEventListener("scroll", updateActiveNav);
    updateActiveNav(); // Jalankan sekali saat halaman dimuat
    });

    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
    window.onscroll = function () {
      if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
        scrollToTopBtn.classList.add('opacity-100', 'pointer-events-auto');
      } else {
        scrollToTopBtn.classList.remove('opacity-100', 'pointer-events-auto');
        scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none');
      }
    };
    scrollToTopBtn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // navbar scrolling
    const navbar = document.getElementById('navbar');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 10) {
        // navbar.classList.add('bg-[#f0c256]', 'shadow-md');

        navbar.classList.add('bg-[#568ef8]', 'shadow-md');
        navbar.classList.remove('bg-transparent');
        } else {
        // navbar.classList.remove('bg-[#f0c256]', 'shadow-md');

        navbar.classList.remove('bg-[#568ef8]', 'shadow-md');
        navbar.classList.add('bg-transparent');
        }
    });

    // const navbar = document.getElementById('navbar');

    // window.addEventListener('scroll', () => {
    //     if (window.scrollY > 10) {
    //         navbar.classList.add('scrolled', 'bg-slate-800', 'shadow-md');
    //         navbar.classList.remove('bg-transparent');
    //     } else {
    //         navbar.classList.remove('scrolled', 'bg-slate-800', 'shadow-md');
    //         navbar.classList.add('bg-transparent');
    //     }
    // });


    AOS.init();

  </script>

</body>
</html>
