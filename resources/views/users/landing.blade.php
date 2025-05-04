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

  <!-- Font Awesome untuk ikon -->
  {{-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> --}}

  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body class="bg-gray-50 text-gray-800 poppins">
  <!-- Tombol Scroll ke Atas -->
  <button id="scrollToTopBtn" class="fixed bottom-8 right-8 bg-yellow-500 text-white p-4 rounded-full shadow-lg hover:bg-yellow-600 transition opacity-0 pointer-events-none flex flex-col items-center justify-center">
    <span class="text-2xl font-bold">↑</span>
    <span class="text-xs mt-1">Top</span>
  </button>

  <header id="navbar" class="fixed top-0 w-full z-50 transition duration-300 bg-transparent text-slate-900 p-5">
    <div class="mx-12 flex justify-between items-center">
        <a href="{{ route('landing') }}" class="flex items-center justify-center gap-2 group">
            <img src="{{ asset('gambar/icon.png') }}" alt="" class="w-7 h-7 mx-auto drop-shadow-xl">
            <h1 class="text-2xl font-semibold text-gray-800 drop-shadow-xl group-hover:text-slate-100 transition duration-300">GuestBook</h1>
        </a>
      <nav class="flex items-center justify-center gap-5">
        <a href="#beranda" class="hover:text-slate-100 transition duration-300">Beranda</a>
        <a href="#fitur" class="hover:text-slate-100 transition duration-300">Fitur</a>
        <a href="#tentang" class="hover:text-slate-100 transition duration-300">Tentang</a>
        <a href="#kontak" class="hover:text-slate-100 transition duration-300">Kontak</a>
        @if(Auth::check())
        <a href="{{ route('home') }}" class="ml-1 bg-green-600 hover:bg-green-700 text-white px-6 py-[6px] rounded-md transition duration-200">Admin</a>
        @else
        <a href="{{ route('login') }}" class="ml-1 bg-black text-white px-6 py-[6px] rounded-md transition duration-300 shadow-xl hover:bg-white hover:text-black">Login</a>
        @endif
      </nav>
    </div>
  </header>

  <section id="beranda" class="relative min-h-screen pt-[88px] flex items-center justify-center text-center overflow-hidden bg-gray-200">
    <!-- Lingkaran Kuning Hanya di Atas -->
    <div class="absolute top-[-3000px] left-1/2 -translate-x-1/2 w-[3600px] h-[3600px] bg-[#ffd369] rounded-full z-0"></div>

    <!-- Konten -->
    <div class="relative z-10 w-full h-[440px] container mx-auto px-6 pb-12">
        <img src="{{ asset('gambar/icon.png') }}" alt="" class="w-36 h-36 mx-auto mb-4 transition duration-300 hover:scale-110">
        <h2 class="text-5xl text-gray-800 drop-shadow-lg font-bold mb-4">Selamat Datang di Buku Tamu Digital</h2>
        <p class="text-xl text-gray-700 drop-shadow-md mb-28">Catat kehadiran tamu secara efisien dan terorganisir</p>
        <div class="w-fit mx-auto flex items-center justify-center bg-white gap-3 p-2 rounded-full">
            <a href="{{ route('bukutamu.user') }}" class="bg-gray-200 text-slate-800 font-medium px-6 py-3 rounded-full shadow hover:bg-blue-600 hover:text-white hover:scale-105 transition duration-300">Orang Tua</a>
            <a href="{{ route('bukutamu.user') }}" class="bg-gray-200 text-slate-800 font-medium px-6 py-3 rounded-full shadow hover:bg-green-500 hover:text-white hover:scale-105 transition duration-300">Tamu Umum</a>
        </div>
    </div>
  </section>


  {{-- Fitur --}}
  <section id="fitur" class="bg-gradient-to-br from-gray-300 via-white to-gray-500 py-36 flex items-center justify-center min-h-screen">

    <div class="container mx-auto px-6 text-center">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900">Features</h2>
            <p class="text-lg text-gray-600 mt-2">Smart solutions, simple experience 🛠️</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="px-8 py-20 bg-white rounded shadow transition duration-300 hover:scale-[1.03] hover:translate-y-2">
                <i class="fas fa-keyboard text-6xl mb-4"></i>
                <h4 class="text-xl font-bold mb-3">Input Otomatis</h4>
                <p class="text-gray-600">Nama orang tua siswa akan terisi secara otomatis setelah memilih nama siswa dari daftar, sehingga mempercepat dan memudahkan proses pengisian data tamu.</p>
            </div>
            <div class="px-8 py-20 bg-white rounded shadow transition duration-300 hover:scale-[1.03] hover:translate-y-2">
                <i class="fas fa-signal text-6xl mb-4"></i>
                <h4 class="text-xl font-bold mb-3">Rekap Kunjungan</h4>
                <p class="text-gray-600">Setiap data tamu yang tercatat akan tersimpan secara rapi dalam sistem, sehingga memudahkan sekolah dalam melihat riwayat kunjungan kapan saja.</p>
            </div>
            <div class="px-8 py-20 bg-white rounded shadow transition duration-300 hover:scale-[1.03] hover:translate-y-2">
                <i class="fas fa-database text-6xl mb-4"></i>
                <h4 class="text-xl font-bold mb-3">Pengelolaan Data</h4>
                <p class="text-gray-600">Aplikasi ini menyediakan fitur pengelolaan data penting seperti pegawai, jabatan, siswa, dan agama, agar sistem tetap terorganisir dan mudah diperbarui.</p>
            </div>
        </div>
    </div>
  </section>

  <section id="tentang" class="bg-white py-24 flex items-center justify-center min-h-screen relative">
    <div class="absolute bottom-0 left-0 right-0 top-0 bg-[linear-gradient(to_right,#4f4f4f2e_1px,transparent_1px),linear-gradient(to_bottom,#4f4f4f2e_1px,transparent_1px)] bg-[size:14px_24px]">
    </div>

    <div class="container mx-auto px-6 text-center">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900">About</h2>
            <p class="text-lg text-gray-600 mt-2">Discover the story behind our code 📖</p>
        </div>

        <!-- Icon -->
        <div class="flex justify-center mb-8">
            <img src="{{ asset('gambar/icon.png') }}" alt="" class="w-48 h-w-48 mx-auto drop-shadow-xl transition duration-300 hover:scale-110">
        </div>

        <p class="text-gray-600 max-w-5xl mx-auto">Aplikasi Buku Tamu Digital ini adalah proyek tugas akhir kami untuk mata pelajaran pengembangan website, dibangun menggunakan Laravel dan MySQL. Aplikasi ini dirancang untuk membantu sekolah dalam mencatat dan mengelola kunjungan tamu—baik orang tua siswa maupun tamu umum—secara efisien dan terstruktur. Fitur-fitur utamanya meliputi input data tamu secara langsung, pemisahan kategori tamu, pencatatan tujuan kunjungan, serta pengelolaan data pegawai, siswa, jabatan, dan agama. Seluruh data tersimpan secara digital sehingga memudahkan pencarian, rekap, dan pelaporan kunjungan.</p>
    </div>
  </section>

  <section id="kontak" class="bg-gradient-to-br from-white via-yellow-100 to-gray-900 py-24 px-4 min-h-screen">
    <!-- Header -->
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold text-gray-900">Contact Us</h2>
      <p class="text-lg text-gray-600 mt-2">Let’s get in touch with the developers 🧑🏻‍💻</p>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-6xl mx-auto">
      <!-- Card -->
      <div class="group bg-white hover:bg-slate-800 rounded-2xl shadow-xl p-8 border-4 border-slate-800 hover:border-white relative overflow-hidden transform hover:scale-105 hover:-translate-y-2 transition duration-500">
        <div class="absolute inset-0 bg-gradient-to-br from-yellow-100 via-white to-gray-100 opacity-40 z-0 transition duration-300 group-hover:opacity-10"></div>
        <div class="relative z-10 text-center">
          <img src="{{ asset('gambar/people/adre.png') }}" alt="Adrenalin" class="w-24 h-24 mx-auto rounded-full object-cover mb-4 shadow-2xl border-4 border-transparent transform hover:scale-110 hover:border-4 hover:border-white transition duration-300">

          <h3 class="text-xl font-semibold relative inline-block text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-600 to-white animate-shine group-hover:bg-gradient-to-r group-hover:from-white group-hover:via-white group-hover:to-white group-hover:text-white transition duration-300 hover:scale-110">
            Adrenalin Muhammad Dewangga
          </h3>

          <p class="text-sm text-gray-600 group-hover:text-gray-100 transition duration-300 hover:scale-110">Fullstack Web Developer</p>
          <p class="text-sm text-gray-500 mt-1 group-hover:text-gray-200 transition duration-300 hover:scale-110">
            🌐 <a href="https://adre.my.id" class="text-blue-600 group-hover:text-blue-300 hover:underline">adre.my.id</a>
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
      <div class="group bg-white hover:bg-slate-800 rounded-2xl shadow-xl p-8 border-4 border-slate-800 hover:border-white relative overflow-hidden transform hover:scale-105 hover:-translate-y-2 transition duration-500">
        <div class="absolute inset-0 bg-gradient-to-br from-yellow-100 via-white to-gray-100 opacity-40 z-0 transition duration-300 group-hover:opacity-10"></div>
        <div class="relative z-10 text-center">
          <img src="{{ asset('gambar/smkn1cimahi.jpg') }}" alt="Evliya" class="w-24 h-24 mx-auto rounded-full object-cover mb-4 shadow-2xl border-4 border-transparent transform hover:scale-110 hover:border-4 hover:border-white transition duration-300">

          <h3 class="text-xl font-semibold relative inline-block text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-600 to-white animate-shine group-hover:bg-gradient-to-r group-hover:from-white group-hover:via-white group-hover:to-white group-hover:text-white transition duration-300 hover:scale-110">
            Evliya Satari Nurarifah
          </h3>

          <p class="text-sm text-gray-600 group-hover:text-gray-100 transition duration-300 hover:scale-110">Frontend & UI/UX Designer</p>
          <p class="text-sm text-gray-500 mt-1 group-hover:text-gray-200 transition duration-300 hover:scale-110">
            🌐 <a href="https://evliya.my.id" class="text-blue-600 group-hover:text-blue-300 hover:underline">evliya.my.id</a>
          </p>
          <p class="italic text-sm mt-4 text-gray-700 group-hover:text-gray-200 transition duration-300 hover:scale-110">
            "Design is not just how it looks, but how it feels."
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
    </div>

    <!-- Paragraf Bawah -->
    <div class="mt-16 text-center max-w-3xl mx-auto">
      <p class="text-base font-medium text-gray-900">
        We are students of Software Engineering (Rekayasa Perangkat Lunak) at SMK Negeri 1 Cimahi, currently in the 11th grade. This project is developed as part of our academic journey to enhance real-world web development skills.
      </p>
    </div>

  </section>

  <footer class="bg-slate-700 text-white text-center py-6">
    <p>&copy; 2025 Buku Tamu Digital. Development by Software Engineer SMKN 1 Cimahi.</p>
  </footer>

  <script>
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
        navbar.classList.add('bg-[#f0c256]', 'shadow-md');
        navbar.classList.remove('bg-transparent');
        } else {
        navbar.classList.remove('bg-[#f0c256]', 'shadow-md');
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

  </script>

</body>
</html>
