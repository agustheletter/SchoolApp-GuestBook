@extends('admin.v_admin')

@section('judulhalaman')
<div class="">
    <span class="mr-3">Input Buku Tamu</span>
    <a href="{{ route('bukutamu.orangtua') }}" type="button" class="btn btn-outline-success">Orang Tua</a>
    <a href="{{ route('bukutamu.umum') }}" type="button" class="btn btn-primary">Tamu Umum</a>
</div>
@endsection

@section('title', 'Buku Tamu')

@section('konten')
<div class="modal-body">
    <form action="{{ route('bukutamu.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}"> <!-- Role dikirim otomatis -->

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" required>
            </div>
        </div>

        {{-- <div class="form-group row">
            <label class="col-sm-3 col-form-label">Agama</label>
            <div class="col-sm-9">
                <select class="form-control" name="idagama" required>
                    <option value="" disabled selected>Pilih Agama</option>
                    @foreach ($agama as $a)
                        <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}

        @if ($role == 'ortu')
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Orang Tua Dari Siswa</label>
            <div class="col-sm-9">
                <select class="form-control" name="idsiswa" required>
                    <option>Pilih Nama Siswa</option>
                    @foreach ($siswa as $s)
                        <option value="{{ $s->idsiswa }}">{{ $s->namasiswa }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @else
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Asal Instansi</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="instansi" placeholder="Masukan Nama Instansi" required>
            </div>
        </div>
        @endif

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="alamat" rows="3" placeholder="Masukan Alamat" required></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kontak</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="kontak" placeholder="Masukan Nomor/Email" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Bertemu Dengan (Jabatan)</label>
            <div class="col-sm-9">
                <select class="form-control" id="jabatan" name="id_jabatan" required>
                    <option>Pilih Jabatan</option>
                    @foreach ($jabatan as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Pegawai</label>
            <div class="col-sm-9">
                <select class="form-control" id="pegawai" name="id_pegawai" required>
                    <option>Pilih Nama Pegawai</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Keperluan</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="keperluan" rows="3" placeholder="Masukan Keperluan" required></textarea>
            </div>
        </div>

        <div class="modal-footer">
            <a href="{{ route('bukutamu.input') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Tambah</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#jabatan').change(function() {
            var jabatan_id = $(this).val();
            $.ajax({
                url: '/getPegawai/' + jabatan_id,
                type: 'GET',
                success: function(data) {
                    $('#pegawai').empty().append('<option>Pilih Nama Pegawai</option>');
                    $.each(data, function(key, value) {
                        $('#pegawai').append('<option value="' + value.id + '">' + value.nama_pegawai + '</option>');
                    });
                }
            });
        });
    });
</script>
@endsection
