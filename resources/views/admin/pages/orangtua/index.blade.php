@php
    use Carbon\Carbon;
    use Carbon\CarbonLocale;
@endphp

@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Orang Tua')
@section('title', 'Daftar Orang Tua')

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

    <a href="{{ route('orangtua.input') }}" type="button" class="btn btn-primary">
        Tambah Data Orang Tua
    </a>

    <p>
    <table class="table table-bordered table-striped table-hover" id="table-ortu">
        <thead class="thead-dark">
            <tr>
                <th><center>No</center></th>
                <th><center>Nama Orang Tua</center></th>
                <th><center>Jenis Kelamin</center></th>
                <th><center>Nama Siswa</center></th>
                <th><center>Kontak</center></th>
                <th><center>Alamat</center></th>
                <th><center>Action</center></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orangtua as $index => $ortu)
                <tr>
                    <td align="center" scope="row">{{ $index + 1 }}</td>
                    <td>{{ $ortu->nama_ortu }}</td>
                    <td>{{ $ortu->jenis_kelamin }}</td>
                    <td>{{ $ortu->siswa->namasiswa ?? '-' }}</td>
                    <td>{{ $ortu->kontak }}</td>
                    <td>{{ $ortu->alamat }}</td>
                    <td align="center">
                        <a href="{{ route('orangtua.edit', $ortu->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('orangtua.destroy', $ortu->id) }}" method="POST" style="display:inline;">
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
            $('#table-ortu').DataTable();
        });
    </script>
@endsection
