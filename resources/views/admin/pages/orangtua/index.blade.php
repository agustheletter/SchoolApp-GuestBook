@php
    use Carbon\Carbon;
    use Carbon\CarbonLocale;
@endphp

@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Orang Tua')
@section('title', 'Daftar Orang Tua')

@section('konten')
<div class="container mx-auto px-4 py-6">
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 relative" role="alert">
            <p>{{ session('success') }}</p>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                <span class="text-xl">&times;</span>
            </button>
        </div>
    @endif

    <a href="{{ route('orangtua.input') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center mb-4">
        <i class="fas fa-plus mr-2"></i>
        Tambah Data Orang Tua
    </a>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200" id="table-ortu">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-center text-xs ">No</th>
                    <th class="px-6 py-3 text-center text-xs ">Nama Orang Tua</th>
                    <th class="px-6 py-3 text-center text-xs ">Jenis Kelamin</th>
                    <th class="px-6 py-3 text-center text-xs ">Nama Siswa</th>
                    <th class="px-6 py-3 text-center text-xs ">Kontak</th>
                    <th class="px-6 py-3 text-center text-xs ">Alamat</th>
                    <th class="px-6 py-3 text-center text-xs ">Action</th>
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
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <form action="{{ route('orangtua.destroy', $ortu->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                            </button>
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