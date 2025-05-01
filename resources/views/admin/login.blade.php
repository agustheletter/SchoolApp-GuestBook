<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Guestbook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('TemplateAdminLTE') }}/plugins/fontawesome-free/css/all.min.css">

    <link rel="icon" href="{{ asset('gambar/icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

</head>
<body class="min-h-screen flex items-center justify-center poppins">

    <!-- Background Layer -->
    <div class="absolute inset-0 bg-no-repeat bg-cover bg-center grayscale" style="background-image: url('{{ asset('gambar/stmnpbdg.jpeg') }}');">
        <!-- Overlay hitam + inner shadow -->
        <div class="w-full h-full bg-black/60 shadow-inner shadow-black/80"></div>
    </div>

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg relative z-10">
        <a href="/" class="inline-flex items-center text-blue-600 hover:underline mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
        </a>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <b>Opps!</b> {{ session('error') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold text-center mb-6">Login admin Guestbook</h2>

        <form action="{{ route('loginaksi') }}" method="post" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" placeholder="Email" required
                    class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" name="password" placeholder="Password" required
                    class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div>
                <label for="thnajaran" class="block text-sm font-medium">Tahun Ajaran</label>
                <select name="thnajaran" id="thnajaran" required
                    class="mt-1 block w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <option disabled selected>Pilih Tahun Ajaran</option>
                    @foreach ($thnajaran as $t)
                        <option value="{{ $t->idthnajaran }}">{{ $t->thnajaran }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-200">
                Log In
            </button>
        </form>
    </div>

</body>
</html>
