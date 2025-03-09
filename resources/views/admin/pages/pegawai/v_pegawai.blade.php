@php
    use Carbon\Carbon;
    use Carbon\CarbonLocale;
@endphp

@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Pegawai')
@section('title', 'Daftar Pegawai')

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

    <a href="{{ route('pegawai.input') }}" type="button" class="btn btn-primary">
        Tambah Data Pegawai
    </a>

    <p>
    <table class="table table-bordered table-striped table-hover" id="table-bukutamu">
        <thead class="thead-dark">
            <tr>
                <th><center>No</center></th>
                <th><center>Nama Pegawai</center></th>
                <th><center>Jenis Kelamin</center></th>
                <th><center>Jabatan</center></th>
                <th><center>Agama</center></th>
                <th><center>Kontak</center></th>
                <th><center>Action</center></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datapegawai as $index => $pegawai)
                <tr>
                    <td align="center" scope="row">{{ $index + 1 }}</td>
                    <td>{{ $pegawai->nama_pegawai }}</td>
                    <td>{{ $pegawai->jenis_kelamin }}</td>
                    <td>{{ $pegawai->jabatan->nama_jabatan }}</td>
                    <td>{{ $pegawai->agama->agama ?? '-' }}</td>
                    <td>{{ $pegawai->kontak }}</td>
                    <td align="center">
                        <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pegawai?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            {{-- @foreach ($bukutamu as $index => $tamu)
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
                    <td>{{ $tamu->jenis_kelamin }}</td>
                    <td>{{ optional($tamu->agama)->agama ?? '-' }}</td>
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
            @endforeach --}}
        </tbody>
    </table>
</div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-bukutamu').DataTable();
        });
    </script>
@endsection
