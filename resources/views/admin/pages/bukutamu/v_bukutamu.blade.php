@php
    use Carbon\Carbon;
    use Carbon\CarbonLocale;
@endphp

@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Buku Tamu')
@section('title', 'Daftar Buku Tamu')

@section('konten')
<div class="">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <a href="{{ route('bukutamu.input') }}" type="button" class="btn btn-primary">
        Tambah Data Buku Tamu
    </a>

    <p>
    <table class="table table-bordered table-striped table-hover" id="table-bukutamu">
        <thead class="thead-dark">
            <tr>
                <th><center>No</center></th>
                <th><center>Nama Tamu</center></th>
                <th><center>Role</center></th>
                {{-- <th><center>Agama</center></th> --}}
                <th><center>Nama Siswa</center></th>
                <th><center>Instansi</center></th>
                <th><center>Alamat</center></th>
                <th><center>Kontak</center></th>
                <th><center>Bertemu Dengan</center></th>
                <th><center>Keperluan</center></th>
                <th><center>Tanggal Kunjungan</center></th>
                <th><center>Action</center></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukutamu as $index => $tamu)
                <tr>
                    <td align="center" scope="row">{{ $index + 1 }}</td>
                    <td>{{ $tamu->nama }}</td>
                    <td>
                        @if ($tamu->role == 'ortu')
                            Orang Tua
                        @else
                            Tamu Umum
                        @endif
                    </td>
                    {{-- <td>{{ optional($tamu->agama)->agama ?? '-' }}</td> --}}
                    <td>{{ $tamu->siswa->namasiswa ?? '-' }}</td>
                    <td>{{ $tamu->instansi ?? '-' }}</td>
                    <td>{{ $tamu->alamat }}</td>
                    <td>{{ $tamu->kontak }}</td>
                    <td>
                        {{ $tamu->pegawai->nama_pegawai ?? '-' }} -
                        {{ $tamu->jabatan->nama_jabatan ?? '-' }}
                    </td>
                    <td>{{ $tamu->keperluan }}</td>
                    <td>{{ Carbon::parse($tamu->created_at)->locale('id')->translatedFormat('l, d F Y - H:i:s') }}</td>
                    <td align="center">
                        <a href="{{ route('bukutamu.edit', $tamu->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('bukutamu.destroy', $tamu->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-bukutamu').DataTable();
        });
    </script>
@endsection
