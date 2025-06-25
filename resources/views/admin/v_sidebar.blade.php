<aside class="bg-white w-72 min-h-screen border-r border-gray-200 shadow-sm">
    <!-- User Panel -->
    <div class="p-4 border-b border-gray-200">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('gambar/icon2.png') }}" alt="User" class="h-10 w-10 rounded-full">
            <a href="/about" class="font-medium text-gray-700 hover:text-blue-600 transition-colors">Tentang Aplikasi</a>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="p-4 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('home') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-blue-600 transition-colors">
            <i class="fas fa-tachometer-alt w-5 text-center text-gray-500"></i>
            <span class="ml-2">Dashboard</span>
        </a>

        <!-- Siswa Menu -->
        <div x-data="{ open: false }" class="space-y-2">
            <button @click="open = !open" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-blue-600 transition-colors">
                <div class="flex items-center">
                    <i class="fa-solid fa-graduation-cap w-5 text-center text-gray-500"></i>
                    <span class="ml-2">Siswa</span>
                    <span class="ml-2 bg-gray-200 text-gray-700 text-xs px-2 py-0.5 rounded-full">2</span>
                </div>
                <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" x-collapse class="pl-8 space-y-2">
                <a href="{{url('siswa')}}" class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-blue-600 transition-colors">
                    <div class="flex items-center gap-2">
                        {{-- <input type="checkbox" class="rounded mr-2 text-blue-600 focus:ring-blue-500"> --}}
                        <i class="fas fa-user-shield w-5 text-center text-gray-500"></i>
                        <span>Data Siswa</span>
                    </div>
                    <span class="bg-gray-200 text-gray-700 text-xs px-2 py-0.5 rounded-full">{{ $totalSiswa }}</span>
                </a>
                <a href="{{ route('orangtua') }}" class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-blue-600 transition-colors">
                    <div class="flex items-center gap-2">
                        {{-- <input type="checkbox" class="rounded mr-2 text-blue-600 focus:ring-blue-500"> --}}
                        <i class="fas fa-user-friends w-5 text-center text-gray-500"></i>
                        <span>Data Orang Tua</span>
                    </div>
                    <span class="bg-gray-200 text-gray-700 text-xs px-2 py-0.5 rounded-full">{{ $totalOrangtua }}</span>
                </a>
            </div>
        </div>

        <!-- Pegawai Menu -->
        <div x-data="{ open: false }" class="space-y-2">
            <button @click="open = !open" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-blue-600 transition-colors">
                <div class="flex items-center">
                    <i class="fa-solid fa-user-tie w-5 text-center text-gray-500"></i>
                    <span class="ml-2">Pegawai</span>
                    <span class="ml-2 bg-gray-200 text-gray-700 text-xs px-2 py-0.5 rounded-full">2</span>
                </div>
                <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" x-collapse class="pl-8 space-y-2">
                <a href="{{ route('jabatan') }}" class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-blue-600 transition-colors">
                    <div class="flex items-center gap-2">
                        {{-- <input type="checkbox" class="rounded mr-2 text-blue-600 focus:ring-blue-500"> --}}
                        <i class="fas fa-user-secret w-5 text-center text-gray-500"></i>
                        <span>Data Jabatan</span>
                    </div>
                    <span class="bg-gray-200 text-gray-700 text-xs px-2 py-0.5 rounded-full">{{ $totalJabatan }}</span>
                </a>
                <a href="{{ route('pegawai') }}" class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-blue-600 transition-colors">
                    <div class="flex items-center gap-2">
                        {{-- <input type="checkbox" class="rounded mr-2 text-blue-600 focus:ring-blue-500"> --}}
                        <i class="fas fa-users w-5 text-center text-gray-500"></i>
                        <span>Data Pegawai</span>
                    </div>
                    <span class="bg-gray-200 text-gray-700 text-xs px-2 py-0.5 rounded-full">{{ $totalPegawai }}</span>
                </a>
                {{-- <a href="{{ route('pegawai.input') }}" class="flex items-center p-2 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-blue-600 transition-colors">
                    <input type="checkbox" class="rounded mr-2 text-blue-600 focus:ring-blue-500">
                    <span>Input Pegawai</span>
                </a> --}}
            </div>
        </div>

        <!-- Buku Tamu Menu -->
        <div x-data="{ open: true }" class="space-y-2">
            <button @click="open = !open" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-blue-600 transition-colors">
                <div class="flex items-center">
                    <i class="fas fa-book-open w-5 text-center text-gray-500"></i>
                    <span class="ml-2">Buku Tamu</span>
                    <span class="ml-2 bg-gray-200 text-gray-700 text-xs px-2 py-0.5 rounded-full">1</span>
                </div>
                <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" x-collapse class="pl-8 space-y-2">
                <a href="{{ route('bukutamu') }}" class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-blue-600 transition-colors">
                    <div class="flex items-center gap-2">
                        {{-- <input type="checkbox" class="rounded mr-2 text-blue-600 focus:ring-blue-500"> --}}
                        <i class="fas fa-book-open w-5 text-center text-gray-500"></i>
                        <span>Data Buku Tamu</span>
                    </div>
                    <span class="bg-gray-200 text-gray-700 text-xs px-2 py-0.5 rounded-full">{{ $totalBukuTamu }}</span>
                </a>
                {{-- <a href="{{ route('bukutamu.user') }}" class="flex items-center p-2 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-blue-600 transition-colors">
                    <input type="checkbox" class="rounded mr-2 text-blue-600 focus:ring-blue-500">
                    <span>Input Buku Tamu</span>
                </a> --}}
            </div>
        </div>
    </nav>
</aside>

<!-- Include Alpine.js for the dropdown functionality -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
