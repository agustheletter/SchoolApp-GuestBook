@extends('admin/v_admin')
@section('judulhalaman', 'Edit Pegawai')
@section('title', 'Edit Pegawai')

@section('konten')
<div class="p-4 poppins">
    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="w-full md:w-1/4 font-medium" for="nama_pegawai">Nama Pegawai</label>
            <div class="w-full md:w-3/4">
                <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       id="nama_pegawai" name="nama_pegawai" value="{{ $pegawai->nama_pegawai }}" required>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="w-full md:w-1/4 font-medium" for="jenis_kelamin">Jenis Kelamin</label>
            <div class="w-full md:w-3/4">
                <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" {{ $pegawai->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $pegawai->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="w-full md:w-1/4 font-medium" for="id_jabatan">Jabatan</label>
            <div class="w-full md:w-3/4">
                <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        id="id_jabatan" name="id_jabatan" required>
                    <option value="" disabled>Pilih Nama Jabatan</option>
                    @foreach($jabatan as $item)
                    <option value="{{ $item->id }}" {{ $pegawai->id_jabatan == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_jabatan }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="w-full md:w-1/4 font-medium" for="id_agama">Agama</label>
            <div class="w-full md:w-3/4">
                <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        id="id_agama" name="id_agama" required>
                    <option value="" disabled>Pilih Agama</option>
                    @foreach($agama as $item)
                    <option value="{{ $item->idagama }}" {{ $pegawai->idagama == $item->idagama ? 'selected' : '' }}>
                        {{ $item->agama }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="w-full md:w-1/4 font-medium" for="kontak">Kontak</label>
            <div class="w-full md:w-3/4">
                <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       id="kontak" name="kontak" value="{{ $pegawai->kontak }}">
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-4">
            <a href="{{ route('pegawai') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md text-gray-800 transition">
                Kembali
            </a>
            <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 rounded-md text-white transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@endsection