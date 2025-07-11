@php
    use Carbon\Carbon;
    use Carbon\CarbonLocale;
@endphp

@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Buku Tamu')
@section('title', 'Daftar Buku Tamu')

@section('konten')
<div class="bg-white rounded-lg shadow">
    <h2 class="text-lg border-b border-gray-300 p-3">Daftar Buku Tamu</h2>
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

        <div class="overflow-x-auto">
            <table class="min-w-full w-full table-auto border-collapse divide-y divide-gray-200" id="table-bukutamu">
                <thead class="bg-gray-800 text-white text-center">
                    <tr>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">No</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Nama Tamu</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Role</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Instansi</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Alamat</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Kontak</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Bertemu Dengan</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Keperluan</th>
                        {{-- <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Foto Tamu</th> --}}
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Foto</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Tanggal Kunjungan</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-600 text-xs font-medium uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($bukutamu as $index => $tamu)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap text-center">{{ $index + 1 }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ $tamu->nama }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">
                            @if ($tamu->role == 'ortu')
                                Orang Tua
                            @else
                                Tamu Umum
                            @endif
                        </td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ $tamu->siswa->namasiswa ?? '-' }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ $tamu->instansi ?? '-' }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ $tamu->alamat }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ $tamu->kontak }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">
                            {{ $tamu->pegawai->nama_pegawai ?? '-' }} -
                            {{ $tamu->jabatan->nama_jabatan ?? '-' }}
                        </td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ $tamu->keperluan }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap text-center">
                            @if (!empty($tamu->foto_tamu))
                                <img class="mx-auto rounded-md max-w-[120px] max-h-[120px]" src="{{ asset('uploads/foto_tamu/' . $tamu->foto_tamu) }}" alt="Foto Tamu">
                            @else
                                <span class="text-gray-400">Tidak ada foto</span>
                            @endif
                        </td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">
                            {{ Carbon::parse($tamu->created_at)->locale('id')->translatedFormat('l, d F Y - H:i:s') }}
                        </td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('bukutamu.edit', $tamu->id) }}" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('bukutamu.destroy', $tamu->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md" onclick="return confirm('Yakin ingin menghapus?')">
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
            scrollX: true,
            responsive: false,
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
