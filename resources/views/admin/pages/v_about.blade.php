@extends('admin/v_admin')
@section('judulhalaman', 'Tentang Aplikasi')
@section('title','About')

@section('konten')
<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="text-center">
        <!-- Logo Aplikasi -->
        <div class="flex justify-center">
            <img src="{{ asset('gambar/icon2.png') }}" alt="App Logo" 
                 class="rounded-full h-40 w-40 object-cover shadow-lg border-4 border-white ring-2 ring-blue-500">
        </div>
        
        <!-- Judul -->
        <h1 class="mt-6 text-3xl font-bold text-gray-900">Tentang Aplikasi</h1>
        
            <!-- Pembimbing -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Pembimbing:</h2>
                <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-medium text-blue-600">Agus Suratna Permadi, S.Pd.</h3>
                    <a href="https://agussuratna.net" target="_blank" 
                       class="text-blue-500 hover:text-blue-700 transition-colors inline-flex items-center">
                        <span>agussuratna.net</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            </div>

        <!-- Pembuat Aplikasi -->
        <div class="mt-8 space-y-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Dikembangkan oleh:</h2>
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <h3 class="text-lg font-medium text-blue-400">Adrenalin Muhammad Dewangga</h3>
                        <a href="https://adre.my.id" target="_blank" 
                           class="text-blue-500 hover:text-blue-700 transition-colors inline-flex items-center">
                            <span>adre.my.id</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <h3 class="text-lg font-medium text-pink-400">Evliya Satari Nurarifah</h3>
                        <a href="https://evliya.my.id" target="_blank" 
                           class="text-blue-500 hover:text-blue-700 transition-colors inline-flex items-center">
                            <span>evliya.my.id</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection