<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Siswa')
@section('title', 'Siswa')

<!--awal isi konten dinamis-->
@section('konten')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSiswa">
        Tambah Data Siswa
    </button>

    <p>

        <!-- Awal membuat table-->
    <table class="table table-bordered table-striped table-hover" id="table-siswa">
        <!-- Awal header table-->
        <thead>
            <tr>
                <th>
                    <center>No</center>
                </th>

                <th>
                    <center>NIS</center>
                </th>

                <th>
                    <center>NISN</center>
                </th>

                <th>
                    <center>Nama Siswa</center>
                </th>

                <th>
                    <center>Tempat Lahir</center>
                </th>

                <th>
                    <center>Tanggal Lahir</center>
                </th>

                <th>
                    <center>Jenis Kelamin</center>
                </th>

                <th>
                    <center>Alamat</center>
                </th>

                <th>
                    <center>Agama</center>
                </th>

                <th>
                    <center>Tlp Rumah</center>
                </th>

                <th>
                    <center>HP</center>
                </th>

                <th>
                    <center>Photo</center>
                </th>

                <th>
                    <center>Tahun Masuk</center>
                </th>

                <th>
                    <center>Aksi</center>
                </th>
            </tr>
        </thead>

        <!-- Akhir header table-->

        <!-- Awal menampilkan data dalam table-->
        <tbody>
            @foreach ($siswa as $index=> $s)
                <tr>
                    <td align="center" scope="row">{{ $index + 1 }}</td>
                    <td align="center">{{ $s->nis }}</td>
                    <td align="center">{{ $s->nisn }}</td>
                    <td>{{ $s->namasiswa }}</td>
                    <td>{{ $s->tempatlahir }}</td>
                    <td align="right">{{ $s->tgllahir }}</td>
                    <td>{{ $s->jk }}</td>
                    <td>{{ $s->alamat }}</td>
                    <td>{{ optional($s->agama)->agama }}</td>
                    <td>{{ $s->tlprumah }}</td>
                    <td>{{ $s->hpsiswa }}</td>
                    <td><img width="60px" src="{{ asset('PhotoSiswa/' . $s->photosiswa) }}"></td>
                    <td align="center">{{ $s->thnajaran->thnajaran }}</td>

                    <td align="center">
                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal"
                            data-target="#modalsiswaEdit{{ $s->idsiswa }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Awal Modal EDIT data siswa -->
                        <div class="modal fade" id="modalsiswaEdit{{ $s->idsiswa }}" tabindex="-1" role="dialog"
                            aria-labelledby="modalsiswaEditLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalsiswaEditLabel">Form Edit Data siswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="formsiswaedit" id="formsiswaedit" action="/siswa/edit/{{ $s->idsiswa }}" method="post" enctype="multipart/form-data">
                                            <!--z@csrf-->
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}

                                            <div class="form-group row">
                                                <label for="nis" class="col-sm-3 col-form-label text-left">NIS</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nis" name="nis" value="{{ $s->nis }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nisn" class="col-sm-3 col-form-label text-left">NISN</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nisn" name="nisn" value="{{ $s->nisn }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="namasiswa" class="col-sm-3 col-form-label text-left">Nama Siswa</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="namasiswa" name="namasiswa" value="{{ $s->namasiswa }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tempatlahir" class="col-sm-3 col-form-label text-left">Tempat Lahir</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" value="{{ $s->tempatlahir }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tgllahir" class="col-sm-3 col-form-label text-left">Tanggal Lahir</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="tgllahir" name="tgllahir" value="{{ $s->tgllahir }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="jk" class="col-sm-3 col-form-label text-left">Jenis Kelamin</label>
                                                <div class="col-sm-9 input-group">
                                                    @if ($s->jk == "Laki-laki")
                                                        <div class="input-group-text">
                                                            <input type="radio" id="jk" name="jk" value="Laki-laki" checked>

                                                        </div>
                                                        Laki-laki

                                                        <div class="input-group-text">
                                                            <input type="radio" id="jk" name="jk" value="Perempuan">
                                                        </div>
                                                        Perempuan
                                                    @else
                                                        <div class="input-group-text">
                                                            <input type="radio" id="jk" name="jk" value="Laki-laki" >

                                                        </div>
                                                        Laki-laki

                                                        <div class="input-group-text">
                                                            <input type="radio" id="jk" name="jk" value="Perempuan" checked>
                                                        </div>
                                                        Perempuan
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="alamat" class="col-sm-3 col-form-label text-left">Alamat</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $s->alamat }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="idagama" class="col-sm-3 col-form-label text-left">Agama</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="idagama" name="idagama">
                                                        @foreach ($agama as $a)
                                                            @if ($a->idagama == $s->idagama)
                                                                <option value="{{ $a->idagama }}" selected>{{ $a->agama }}</option>
                                                            @else
                                                                <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tlprumah" class="col-sm-3 col-form-label text-left">Telepon Rumah</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="tlprumah" name="tlprumah" value="{{ $s->tlprumah }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="hpsiswa" class="col-sm-3 col-form-label text-left">HP</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="hpsiswa" name="hpsiswa" value="{{ $s->hpsiswa }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="photo" class="col-sm-3 col-form-label text-left">Photo</label>
                                                <div class="col-sm-9 text-left">
                                                    <input type="file" id="photo" name="photo">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="idthnajaran" class="col-sm-3 col-form-label text-left">Tahun Masuk</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="idthnajaran" name="idthnajaran">
                                                        @foreach ($thnajaran as $t)
                                                            @if ($t->idthnajaran == $s->idthnajaran)
                                                                <option value="{{ $t->idthnajaran }}" selected>{{ $t->thnajaran }}</option>
                                                            @else
                                                                <option value="{{ $t->idthnajaran }}">{{ $t->thnajaran }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="siswaedit" class="btn btn-success">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal EDIT data siswa -->


                        |
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#modalsiswaHapus{{ $s->idsiswa}}">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Awal Modal hapus data siswa -->
                        <div class="modal fade" id="modalsiswaHapus{{ $s->idsiswa }}" tabindex="-1"
                            aria-labelledby="modalsiswaHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modalsiswaHapusLabel">Hapus Data siswa</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Yakin Mau menghapus data siswa ?</h5>
                                        <h3>
                                            <font color="red"><span>{{ $s->siswa }} </span></font>
                                        </h3>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/siswa/hapus/{{ $s->idsiswa }}" method="get">
                                            <button type="submit" name="siswahapus" class="btn btn-danger">Hapus</a></button>
                                        </form>
                                        <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal"
                                            class="float-right">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal hapus data siswa -->
                    </td>
                </tr>
            @endforeach
        <tbody
        <!-- Akhir menampilkan data dalam table-->
    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-siswa').DataTable();
        });
    </script>


    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#table-siswa').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": "{{ asset('ssp') }}/loaddata.php",
            } );
        } );
    </script> --}}


    <!-- Akhir membuat table-->



    {{-- <!--awal pagination-->
    Halaman : {{ $siswa->currentPage() }} <br />
    Jumlah Data : {{ $siswa->total() }} <br />
    Data Per Halaman : {{ $siswa->perPage() }} <br />

    {{ $siswa->links() }}
    <!--akhir pagination--> --}}




    <!-- Awal Modal tambah data siswa -->
    <div class="modal fade" id="modalTambahSiswa" tabindex="-1" role="dialog" aria-labelledby="modalTambahSiswaLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahSiswaLabel">Form Input Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form name="formsiswatambah" id="formsiswatambah" action="/siswa/tambah " method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="nis" class="col-sm-3 col-form-label">NIS</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukan NIS">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nisn" class="col-sm-3 col-form-label">NISN</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukan NISN">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namasiswa" class="col-sm-3 col-form-label">Nama Siswa</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="namasiswa" name="namasiswa"
                                    placeholder="Masukan Nama siswa">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tempatlahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tempatlahir" name="tempatlahir"
                                    placeholder="Masukan Kota Kelahiran">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tgllahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tgllahir" name="tgllahir">
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9 input-group">
                                <div class="input-group-text">
                                    <input type="radio" name="jk" value="L">
                                </div>
                                Laki-laki

                                <div class="input-group-text">
                                    <input type="radio" name="jk" value="P">
                                </div>
                                Perempuan
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    placeholder="Masukan Alamat">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idagama" class="col-sm-3 col-form-label">Agama</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="idagama" name="idagama">
                                    <option></option>
                                    @foreach ($agama as $a)
                                        <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tlprumah" class="col-sm-3 col-form-label">Telepon Rumah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tlprumah" name="tlprumah"
                                    placeholder="Masukan Nomor Telepon Rumah">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hpsiswa" class="col-sm-3 col-form-label">HP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="hpsiswa" name="hpsiswa"
                                    placeholder="Masukan Nomor HP Siswa">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-sm-3 col-form-label">Photo</label>
                            <div class="col-sm-9">
                                <input type="file" id="photo" name="photo">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idthnajaran" class="col-sm-3 col-form-label">Tahun Masuk</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="idthnajaran" name="idthnajaran">
                                    <option></option>
                                    @foreach ($thnajaran as $t)
                                        <option value="{{ $t->idthnajaran }}">{{ $t->thnajaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambahsiswa" class="btn btn-success">Tambah</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Modal tambah data siswa -->



@endsection
<!--akhir isi konten dinamis-->





<!--akhir konten dinamis-->
