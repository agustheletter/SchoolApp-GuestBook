<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Guestbook</title>
    <link rel="icon" href="{{ asset('gambar/icon2.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="{{ asset('tailwindcdn.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('TemplateAdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 poppins">

    <!-- Navbar -->
    {{-- <header id="navbar" class="fixed top-0 w-full z-50 transition duration-300 bg-[radial-gradient(circle_800px_at_100%_200px,#60A5FA)] text-slate-900 p-5 shadow-2xl">
        <div class="mx-12 flex justify-between items-center">
            <a href="{{ route('landing') }}" class="flex items-center justify-center gap-2 group">
                <img src="{{ asset('gambar/icon2.png') }}" alt="" class="w-7 h-7 mx-auto drop-shadow-xl">
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
    </header> --}}

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
  <section class="min-h-screen pt-[120px] flex items-center justify-center bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('gambar/smkn1cimahi.jpg') }}');">
    <div class="bg-gray-800/75 shadow-lg rounded-xl p-8 w-full max-w-2xl">
        <h2 class="text-white text-3xl font-bold mb-2">Selamat Datang!</h2>
        <h2 class="text-white text-lg mb-6">Login sebagai admin</h2>

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Oops!</strong> {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('loginaksi') }}">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-white font-semibold mb-1">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-white font-semibold mb-1">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>
        <div class="mb-6">
            <label for="thnajaran" class="block text-sm text-white font-medium">Tahun Ajaran</label>
            <select name="thnajaran" id="thnajaran" required class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-blue-300 focus:outline-none">
                <option value="" disabled selected>Pilih Tahun Ajaran</option>
                @foreach ($thnajaran as $t)
                    <option value="{{ $t->idthnajaran }}">{{ $t->thnajaran }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="w-full bg-[#60A5FA] hover:bg-gray-800 hover:text-[#3B82F6] text-gray-800 font-semibold py-2 rounded-md transition duration-300">Masuk</button>
        </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-slate-700 text-white text-center py-6">
    <p>&copy; 2025 Buku Tamu Digital. Development by Software Engineer SMKN 1 Cimahi.</p>
  </footer>

  <!-- Script sama seperti landing page -->
  <script>
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
  </script>
</body>
</html>
