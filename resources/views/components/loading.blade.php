<!-- Loading Overlay -->

{{-- <div id="loadingOverlay" class="fixed inset-0 bg-white z-[9999] flex items-center opacity-100 pointer-events-auto justify-center transition-opacity duration-500">
    <div class="flex flex-col items-center">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-20 w-20 mb-4 animate-spin border-t-blue-500"></div>
        <p class="text-gray-700 font-medium poppins text-lg">Memuat data...</p>
    </div>
</div> --}}

<div id="loadingOverlay" class="fixed inset-0 bg-white z-[9999] flex items-center opacity-100 pointer-events-auto justify-center transition-opacity duration-500">
    <div class="flex flex-col items-center">
        <div class="loader mb-6">
            <div class="flex items-center justify-center loader-icon">
                <!-- Placeholder for your project icon -->
                <img src="{{ asset('gambar/icon2.png') }}" class="w-20 h-20 cursor" alt="">
            </div>
        </div>
        <p class="text-gray-700 font-medium poppins text-2xl">Memuat data...</p>
        {{-- <p class="text-gray-700 font-medium text-2xl">
            <span id="typedLoading"></span>
        </p> --}}
    </div>
</div>
