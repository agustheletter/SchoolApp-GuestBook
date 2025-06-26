<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Kelas Siswa')
@section('title', 'Kelas Siswa')

<!--awal isi konten dinamis-->
@section('konten')

    <p>
    <form action="/siswadetail/cari" method="GET">
        <div class="form-group row">
            <div class="col-md-3">
                <select type="text" class="form-control" id="carisiswa" name="carisiswa">
                    <option></option>
                    @foreach($siswakelas as $sk)
                        <option value="{{ $sk->idsiswa}}">{{ $sk->siswa->nis }} | {{ $sk->siswa->namasiswa }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="CARI" class="btn btn-primary">
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#carisiswa').select2({
                placeholder: 'Pilih Siswa',
                allowClear: true
            });
        });
    </script>

    <p>

    <!-- Awal membuat table Detail Siswa -->
    <table id="table-siswacari" class="table table-bordered table-striped table-hover">
        @foreach ($siswa as $s)
            <tr>
                <td width="30%">ID Siswa</></td>
                <td width="70%"><b>{{$s->idsiswa}}</b></td>
            </tr>

            <tr>
                <td>NIS</></td>
                <td><b>{{$s->nis}}</b></td>
            </tr>
            <tr>
                <td>NISN</td>
                <td><b>{{$s->nisn}}</b></td>
            </tr>
            <tr>
                <td>Nama Siwa</td>
                <td><b>{{$s->namasiswa}}</b></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td><b>{{$s->tempatlahir}}</b></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td><b>{{$s->tgllahir}}</b></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td><b>{{$s->jk}}</b></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><b>{{$s->alamat}}</b></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td><b>{{$s->agama->agama}}</b></td>
            </tr>
            <tr>
                <td>HP</td>
                <td><b>{{$s->kontak}}</b></td>
            </tr>
            <tr>
                <td>Photo</td>
                <td><b><img width="150px" height="220px" src="{{ url('/PhotoSiswa/'. $s->photosiswa) }}"></b></td>
            </tr>
            <tr>
                <td>Tahun Masuk</td>
                <td><b>{{$s->thnajaran->thnajaran}}</b></td>
            </tr>

            @foreach($kelassiswa as $k)
                <tr>
                    <td>Kelas Tahun Ajaran <b>{{optional(optional($k->kelasdetail)->thnajaran)->thnajaran}}</b></td>
                    <td><b>{{optional(optional($k->kelasdetail)->kelas)->namakelas}}</b></td>
                </tr>
            @endforeach
        @endforeach
    </table>
    <!-- AKHIR membuat table Detail Siswa -->

@endsection
<!--akhir isi konten dinamis-->
