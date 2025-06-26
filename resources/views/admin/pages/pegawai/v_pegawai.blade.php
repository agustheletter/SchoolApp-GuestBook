@php
    use Carbon\Carbon;
    use Carbon\CarbonLocale;
@endphp

@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Pegawai')
@section('title', 'Daftar Pegawai')

@section('konten')
<div class="bg-white rounded-lg shadow">
    <h2 class="text-lg border-b border-gray-300 p-3">Daftar Pegawai</h2>
    <div class="p-4">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-700 rounded flex justify-between items-center">
                <p>{{ session('success') }}</p>
                <button type="button" class="text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>
        @endif

        <div class="flex items-center mb-4">
            <a href="{{ route('bukutamu.user') }}" class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition">
                Tambah Data Buku Tamu
            </a>
        </div>

        <div class="overflow-x-auto bg-white mb-4">
            <table class="min-w-full w-full table-auto border-collapse divide-y divide-gray-200" id="table-bukutamu">
                <thead class="bg-gray-800 text-white text-center">
                    <tr>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">No</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Nama Pegawai</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Jabatan</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Agama</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Kontak</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Aksi</th>
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
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table-bukutamu').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }

        });
    });
</script>
@endsection
