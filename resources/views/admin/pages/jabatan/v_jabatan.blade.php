<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Jabatan')
@section('title', 'Jabatan')

<!--awal isi konten dinamis-->
@section('konten')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahJabatan">
        Tambah Data Jabatan
    </button>

    <p>

        <!-- Awal membuat table-->
    <table class="table table-bordered table-striped table-hover" id="table-jabatan">
        <!-- Awal header table-->
        <thead>
            <tr>
                <th>
                    <center>No</center>
                </th>

                <th>
                    <center>Nama Jabatan</center>
                </th>

                <th>
                    <center>Aksi</center>
                </th>
            </tr>
        </thead>

        <!-- Akhir header table-->

        <!-- Awal menampilkan data dalam table-->
        <tbody>
            @foreach ($datajabatan as $index=> $jabatan)
                <tr>
                    <td align="center" scope="row">{{ $index + 1 }}</td>
                    <td>{{ $jabatan->nama_jabatan }}</td>
                    <td align="center">
                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal"
                            data-target="#modalJabatanEdit{{ $jabatan->id }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Awal Modal EDIT data jabatan -->
                        <div class="modal fade" id="modalJabatanEdit{{ $jabatan->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modalJabatanEditLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalJabatanEditLabel">Form Edit Data Jabatan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="formjabatanedit" id="formjabatanedit" action="{{ route('jabatan.update', $jabatan->id) }}}}" method="post">
                                            <!--z@csrf-->
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}

                                            <div class="form-group row">
                                                <label for="nama_jabatan" class="col-sm-3 col-form-label text-left">Nama Jabatan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="{{ $jabatan->nama_jabatan }}">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="jabatanedit" class="btn btn-success">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal EDIT data siswa -->


                        |
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#modalJabatanHapus{{ $jabatan->id }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Awal Modal hapus data siswa -->
                        <div class="modal fade" id="modalJabatanHapus{{ $jabatan->id }}" tabindex="-1"
                            aria-labelledby="modalJabatanHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modalJabatanHapusLabel">Hapus Data Jabatan</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Yakin Mau Hapus Data Jabatan?</h5>
                                        <h3>
                                            <font color="red"><span>{{ $jabatan->nama_jabatan }} </span></font>
                                        </h3>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('jabatan.destroy', $jabatan->id) }}}}" method="POST">
                                            <button type="submit" name="jabatanhapus" class="btn btn-danger">Hapus</a></button>
                                        </form>
                                        <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal"
                                            class="float-right">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal hapus data jabatan -->
                    </td>
                </tr>
            @endforeach
        <tbody
        <!-- Akhir menampilkan data dalam table-->
    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-jabatan').DataTable();
        });
    </script>


    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#table-jabatan').DataTable( {
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
    <div class="modal fade" id="modalTambahJabatan" tabindex="-1" role="dialog" aria-labelledby="modalTambahJabatanLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahJabatanLabel">Form Input Data Jabatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form name="formjabatantambah   " id="formjabatantambah    " action="{{ route('jabatan.store') }} " method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="nama_jabatan" class="col-sm-3 col-form-label">Nama Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Masukan Nama Jabatan">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambahjabatan" class="btn btn-success">Tambah</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Modal tambah data jabatan -->



@endsection
<!--akhir isi konten dinamis-->





<!--akhir konten dinamis-->
