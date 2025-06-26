@php
    use Carbon\Carbon;
    use Carbon\CarbonLocale;
@endphp

@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Orang Tua')
@section('title', 'Daftar Orang Tua')

@section('konten')
<div class="bg-white rounded-lg shadow">
<h2 class="text-lg border-b border-gray-300 p-3">Daftar Orang Tua</h2>
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
        <a href="{{ route('orangtua.input') }}" class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition">
            Tambah Data Orang Tua
        </a>
    </div>

    <div class="overflow-x-auto bg-white mb-4" >
        <table class="min-w-full w-full table-auto border-collapse divide-y divide-gray-200" id="table-ortu">
            <thead class="bg-gray-800 text-white text-center">
                <tr>
                    <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider ">No</th>
                    <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider ">Nama Orang Tua</th>
                    <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider ">Jenis Kelamin</th>
                    <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider ">Nama Siswa</th>
                    <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider ">Kontak</th>
                    <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider ">Alamat</th>
                    <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider ">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($orangtua as $index => $ortu)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $ortu->nama_ortu }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $ortu->jenis_kelamin }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $ortu->siswa->namasiswa ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $ortu->kontak }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $ortu->alamat }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                        <a href="{{ route('orangtua.edit', $ortu->id) }}" class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded">
                            <i class="fas fa-edit mr-1"></i>
                        </a>
                        <form action="{{ route('orangtua.destroy', $ortu->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash-alt mr-1"></i>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table-ortu').DataTable({
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