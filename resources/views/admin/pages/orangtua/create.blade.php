@extends('admin.v_admin')

@section('judulhalaman')
<div class="my-4">
    <span class="text-xl font-semibold text-gray-800">Input Orang Tua</span>
</div>
@endsection

@section('title', 'Orang Tua')

@section('konten')
<div class="container mx-auto px-4 py-6 font-poppins">
    <form action="{{ route('orangtua.store') }}" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        
        <!-- Nama Orang Tua -->
        <div class="mb-4 md:flex md:items-center">
            <label class="block text-gray-700 font-medium mb-2 md:mb-0 md:w-1/4">Nama Orang Tua</label>
            <div class="md:w-3/4">
                <input type="text" name="nama_ortu" placeholder="Masukan Nama Orang Tua" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <!-- Jenis Kelamin -->
        <div class="mb-4 md:flex md:items-center">
            <label class="block text-gray-700 font-medium mb-2 md:mb-0 md:w-1/4">Jenis Kelamin</label>
            <div class="md:w-3/4">
                <select name="jenis_kelamin" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>

        <!-- Nama Siswa -->
        <div class="mb-4 md:flex md:items-center">
            <label class="block text-gray-700 font-medium mb-2 md:mb-0 md:w-1/4">Nama Siswa</label>
            <div class="md:w-3/4">
                <select name="idsiswa" id="idsiswa" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option>Pilih Nama Siswa</option>
                    @foreach ($siswa as $s)
                        <option value="{{ $s->idsiswa }}">{{ $s->namasiswa }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Kontak -->
        <div class="mb-4 md:flex md:items-center">
            <label class="block text-gray-700 font-medium mb-2 md:mb-0 md:w-1/4">Kontak</label>
            <div class="md:w-3/4">
                <input type="text" name="kontak" placeholder="Masukan Nomor/Email" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <!-- Alamat -->
        <div class="mb-6 md:flex md:items-center">
            <label class="block text-gray-700 font-medium mb-2 md:mb-0 md:w-1/4">Alamat</label>
            <div class="md:w-3/4">
                <input type="text" name="alamat" placeholder="Masukan Alamat" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
            <a href="{{ route('orangtua.input') }}" 
               class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors">
                Kembali
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-md transition-colors">
                Tambah
            </button>
        </div>
    </form>
</div>
@endsection