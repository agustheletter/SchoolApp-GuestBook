{{--
    File: resources/views/slider_berita.blade.php
    Deskripsi:
    Versi final yang sudah diperbaiki. Menggunakan CSS yang lebih kuat
    agar tombol navigasi muncul di dalam slider dan posisi sudah sesuai.
--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slider Berita SMKN 1 Cimahi</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7fafc;
        }
        .slide-item {
            position: relative;
            background-size: cover;
            background-position: center;
            height: 400px;
            color: white;
            transition: all 0.3s ease;
        }
        .slide-item:hover .overlay {
            background-color: rgba(0, 0, 0, 0.6);
        }
        .overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.1));
            transition: background-color 0.3s ease;
        }

        /* --- CSS Kustom untuk Tombol Navigasi (DIUBAH) --- */
        .splide__arrow {
            /* Pastikan posisi absolut relatif terhadap container */
            position: absolute !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            z-index: 10 !important;

            /* Gaya tombol agar terlihat jelas */
            width: 2.5rem !important;
            height: 2.5rem !important;
            background: rgba(255, 255, 255, 0.2) !important;
            color: white !important;
            border-radius: 50% !important;
            transition: all 0.3s ease !important;
        }
        .splide__arrow svg {
            fill: currentColor !important;
            width: 1.5rem !important;
            height: 1.5rem !important;
        }
        .splide__arrow:hover {
            background: rgba(255, 255, 255, 0.6) !important;
        }
        .splide__arrow--prev {
            left: 1rem !important;
        }
        .splide__arrow--next {
            right: 1rem !important;
        }
        @media (max-width: 640px) {
            .splide__arrow {
                width: 2rem !important;
                height: 2rem !important;
            }
            .splide__arrow svg {
                width: 1rem !important;
                height: 1rem !important;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    @php
        use Illuminate\Support\Facades\Http;
        $posts = [];
        $error = null;
        try {
            $response = Http::get('https://www.smkn1-cmi.sch.id/wp-json/wp/v2/posts?per_page=5&_embed');
            if ($response->successful()) {
                $posts = $response->json();
            } else {
                $error = 'Gagal mengambil data dari API. Status: ' . $response->status();
            }
        } catch (\Exception $e) {
            $error = 'Terjadi kesalahan saat mengambil data: ' . $e->getMessage();
        }
    @endphp

    <div class="max-w-6xl w-full mx-auto p-4 md:p-8 bg-white shadow-xl rounded-xl">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Berita Terbaru</h2>
        @if ($error)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ $error }}</span>
            </div>
        @else
            <div id="splide-slider" class="splide" role="group" aria-label="Berita Terbaru">
                <div class="splide__track">
                    <ul class="splide__list">
                        @forelse ($posts as $post)
                            <li class="splide__slide">
                                <a href="{{ $post['link'] }}" target="_blank" rel="noopener noreferrer" class="block slide-item rounded-lg"
                                   style="background-image: url('{{ isset($post['_embedded']['wp:featuredmedia'][0]['source_url']) ? $post['_embedded']['wp:featuredmedia'][0]['source_url'] : 'https://placehold.co/800x400/CCCCCC/333333?text=Tidak+ada+gambar' }}');">
                                    <div class="overlay w-full h-full flex flex-col justify-end p-6">
                                        <div class="mb-2">
                                            @if (isset($post['_embedded']['wp:term'][0]))
                                                @foreach ($post['_embedded']['wp:term'][0] as $category)
                                                    <span class="inline-block bg-white text-gray-800 text-xs font-semibold px-2 py-1 rounded-full mr-2 mb-2">
                                                        {{ html_entity_decode($category['name']) }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                        <h3 class="text-2xl font-bold leading-tight mb-2">{{ html_entity_decode(strip_tags($post['title']['rendered'])) }}</h3>
                                        <div class="flex items-center text-sm text-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>{{ date('d M, Y', strtotime($post['date'])) }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <div class="text-center text-gray-500 py-8">Tidak ada berita yang ditemukan.</div>
                        @endforelse
                    </ul>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const postsCount = {{ count($posts) }};
            if (postsCount > 0) {
                new Splide('#splide-slider', {
                    type: 'loop',
                    perPage: 1,
                    perMove: 1,
                    gap: '1rem',
                    autoplay: true,
                    interval: 4000,
                    arrows: true,
                    pagination: true,
                    pauseOnHover: true,
                }).mount();
            }
        });
    </script>
</body>
</html>
