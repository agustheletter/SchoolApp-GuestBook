@extends('admin/v_admin')
@section('judulhalaman', 'Edit Orang Tua')
@section('title', 'Edit Orang Tua')

@section('konten')
<div class="my-4 poppins">
    <p>
    <form action="{{ route('orangtua.update', $orangtua->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="nama">Nama Orang Tua</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama_ortu" value="{{ $orangtua->nama_ortu }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" class="">Jenis Kelamin</label>
            <div class="col-sm-9">
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="" disabled>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="siswa">Nama Siswa</label>
            <div class="col-sm-9">
                <select class="form-control" name="idsiswa" id="idsiswa" required>
                    <option value="" disabled selected>Pilih Siswa</option>
                    @foreach ($siswa as $item)
                    <option value="{{ $item->idsiswa }}" {{ $orangtua->idsiswa == $item->idsiswa ? 'selected' : '' }}>
                        {{ $item->namasiswa }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="kontak">Kontak</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="kontak" name="kontak" value="{{ $orangtua->kontak }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="alamat">Alamat</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $orangtua->alamat }}" required>
            </div>
        </div>

        <div class="mt-3 modal-footer">
            <a href="{{ route('orangtua') }}" type="button" class="btn btn-secondary">
                Kembali
            </a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>
    </form>
</div>

@endsection
