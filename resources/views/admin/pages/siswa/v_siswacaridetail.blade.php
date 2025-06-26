<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Form Data Siswa')
@section('title','Data Siswa')

    <!--awal isi konten dinamis-->
    @section('konten')
        <table width="100%">
            <tr>
                <td width="55%">

                </td>


                <td width="45%">
                    <form action="/siswa/cari/detail" method="GET">
                        <select type="text" class="form-control col-sm-9 float-right" name="siswacari" id="siswacari">
                            <option></option>
                            @foreach($datasiswa as $ds)
                                <option value="{{ $ds->nis}}">{{ $ds->nis }} | {{ $ds->namasiswa }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="CARI" class="btn btn-primary">
                    </form>
                </td>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#siswacari').select2({
                            placeholder: 'Cari NIS atau Nama Siswa',
                            allowClear: true
                        });
                    });
                </script>
            </tr>
        </table>

        <p>

        <!-- Awal membuat table Detail Siswa -->
        <table id="table-siswacari" class="table table-bordered table-striped table-hover">
            @foreach ($carisiswa as $s)
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
                    <td><b>{{$s->tmplahir}}</b></td>
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

                @foreach($kelas as $k)
                    <tr>
                        <td>Kelas Tahun Ajaran <b>{{$k->thnajaran}}</b></td>
                        <td><b>{{$k->namakelas}}</b></td>
                    </tr>
                @endforeach
            @endforeach
        </table>
        <!-- AKHIR membuat table Detail Siswa -->



    @endsection
    <!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->
