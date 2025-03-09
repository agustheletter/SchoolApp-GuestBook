@extends('admin.v_admin')

@section('judulhalaman')
<div class="my-2">
    <span class="mr-3">Input Pegawai</span>
</div>
@endsection

@section('title', 'Buku Tamu')

@section('konten')
<div class="modal-body poppins">
    <form action="{{ route('pegawai.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Pegawai</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="nama_pegawai" placeholder="Masukan Nama Pegawai" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-9">
                <select class="form-control" name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-9">
                <select class="form-control" name="id_jabatan" required>
                    <option value="" disabled selected>Pilih Jabatan</option>
                    @foreach ($jabatan as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Agama</label>
            <div class="col-sm-9">
                <select class="form-control" name="id_agama" required>
                    <option value="" disabled selected>Pilih Agama</option>
                    @foreach ($agama as $a)
                        <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kontak</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="kontak" placeholder="Masukan Nomor/Email" required>
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
