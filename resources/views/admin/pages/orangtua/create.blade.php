@extends('admin.v_admin')

@section('judulhalaman')
<div class="my-2">
    <span class="mr-3">Input Orang Tua</span>
</div>
@endsection

@section('title', 'Orang Tua')

@section('konten')
<div class="modal-body poppins">
    <form action="{{ route('orangtua.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Orang Tua</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="nama_ortu" placeholder="Masukan Nama Orang Tua" required>
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
            <label class="col-sm-3 col-form-label">Nama Siswa</label>
            <div class="col-sm-9">
                <select class="form-control" name="idsiswa" id="idsiswa" required>
                    <option>Pilih Nama Siswa</option>
                    @foreach ($siswa as $s)
                        <option value="{{ $s->idsiswa }}">{{ $s->namasiswa }}</option>
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
            <a href="{{ route('orangtua.input') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Tambah</button>
        </div>
    </form>
</div>

@endsection
