@extends('admin/v_admin')
@section('judulhalaman', 'Edit Orang Tua')
@section('title', 'Edit Orang Tua')

@section('konten')
<div class="container mx-auto px-4 py-6 font-poppins">
    <form action="{{ route('orangtua.update', $orangtua->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')

        <!-- Nama Orang Tua -->
        <div class="mb-4 md:flex md:items-center">
            <label for="nama" class="block text-gray-700 font-medium mb-2 md:mb-0 md:w-1/4">Nama Orang Tua</label>
            <div class="md:w-3/4">
                <input type="text" id="nama" name="nama_ortu" value="{{ $orangtua->nama_ortu }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <!-- Jenis Kelamin -->
        <div class="mb-4 md:flex md:items-center">
            <label class="block text-gray-700 font-medium mb-2 md:mb-0 md:w-1/4">Jenis Kelamin</label>
            <div class="md:w-3/4">
                <select id="jenis_kelamin" name="jenis_kelamin" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ $orangtua->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ $orangtua->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <!-- Nama Siswa -->
        <div class="mb-4 md:flex md:items-center">
            <label for="siswa" class="block text-gray-700 font-medium mb-2 md:mb-0 md:w-1/4">Nama Siswa</label>
            <div class="md:w-3/4">
                <select name="idsiswa" id="idsiswa" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>Pilih Siswa</option>
                    @foreach ($siswa as $item)
                    <option value="{{ $item->idsiswa }}" {{ $orangtua->idsiswa == $item->idsiswa ? 'selected' : '' }}>
                        {{ $item->namasiswa }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Kontak -->
        <div class="mb-4 md:flex md:items-center">
            <label for="kontak" class="block text-gray-700 font-medium mb-2 md:mb-0 md:w-1/4">Kontak</label>
            <div class="md:w-3/4">
                <input type="text" id="kontak" name="kontak" value="{{ $orangtua->kontak }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <!-- Alamat -->
        <div class="mb-6 md:flex md:items-center">
            <label for="alamat" class="block text-gray-700 font-medium mb-2 md:mb-0 md:w-1/4">Alamat</label>
            <div class="md:w-3/4">
                <input type="text" id="alamat" name="alamat" value="{{ $orangtua->alamat }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
            <a href="{{ route('orangtua') }}" 
               class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors">
                Kembali
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-md transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection