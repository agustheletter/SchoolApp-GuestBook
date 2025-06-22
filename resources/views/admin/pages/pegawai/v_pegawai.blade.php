@php
    use Carbon\Carbon;
    use Carbon\CarbonLocale;
@endphp

@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Pegawai')
@section('title', 'Daftar Pegawai')

@section('konten')
<div class="p-4">
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
            <div class="flex justify-between items-center">
                <p>{{ session('success') }}</p>
                <button type="button" class="text-green-700 hover:text-green-900" onclick="this.parentElement.parentElement.remove()">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>
        </div>
    @endif

    <a href="{{ route('pegawai.input') }}" class="mb-4 inline-block px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-md text-white transition">
        Tambah Data Pegawai
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="table-bukutamu">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Nama Pegawai</th>
                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Jenis Kelamin</th>
                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Jabatan</th>
                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Agama</th>
                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Kontak</th>
                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($datapegawai as $index => $pegawai)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $pegawai->nama_pegawai }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $pegawai->jenis_kelamin }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $pegawai->jabatan->nama_jabatan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $pegawai->agama->agama ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $pegawai->kontak }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 rounded-md text-white transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 rounded-md text-white transition" onclick="return confirm('Yakin ingin menghapus pegawai?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table-bukutamu').DataTable();
    });
</script>
@endsection