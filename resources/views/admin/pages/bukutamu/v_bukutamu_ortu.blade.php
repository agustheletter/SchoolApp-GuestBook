@extends('admin.v_admin')

@section('judulhalaman')
<div class="">
    <span class="mr-3">Input Buku Tamu</span>
    <a href="{{ route('bukutamu.orangtua') }}" type="button" class="btn btn-success">Orang Tua</a>
    <a href="{{ route('bukutamu.umum') }}" type="button" class="btn btn-outline-primary">Tamu Umum</a>
</div>
@endsection

@section('title', 'Buku Tamu')

@section('konten')
<div class="modal-body poppins">
    <form action="{{ route('bukutamu.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}"> <!-- Role dikirim otomatis -->

        @if ($role == 'ortu')
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Orang Tua Dari Siswa</label>
            <div class="col-sm-9">
                <select class="form-control" name="idsiswa" id="idsiswa" required>
                    <option>Pilih Nama Siswa</option>
                    @foreach ($siswa as $s)
                        <option value="{{ $s->idsiswa }}">{{ $s->namasiswa }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Orang Tua</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="nama" id="namaOrtu" placeholder="Masukan Nama Anda" required>
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
            <label class="col-sm-3 col-form-label">Agama</label>
            <div class="col-sm-9">
                <select class="form-control" name="idagama" required>
                    <option value="" disabled selected>Pilih Agama</option>
                    @foreach ($agama as $a)
                        <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @if ($role == 'umum')
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

    document.getElementById('idsiswa').addEventListener('change', function() {
        var idsiswa = this.value;
        if (idsiswa) {
            fetch('/getOrangtua/' + idsiswa)
                .then(response => response.json())
                .then(data => {
                    if (data && data.nama_ortu) {
                        document.getElementById('namaOrtu').value = data.nama_ortu;
                    } else {
                        document.getElementById('namaOrtu').value = '';
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    document.getElementById('namaOrtu').value = '';
                });
        } else {
            document.getElementById('namaOrtu').value = '';
        }
    });
</script>
@endsection
