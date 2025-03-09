@extends('admin/v_admin')
@section('judulhalaman', 'Edit Pegawai')
@section('title', 'Edit Pegawai')

@section('konten')
<div class="my-4 poppins">
    <p>
    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="nama_pegawai">Nama Pegawai</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" value="{{ $pegawai->nama_pegawai }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
            <div class="col-sm-9">
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" {{ $pegawai->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $pegawai->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="id_jabatan">Agama</label>
            <div class="col-sm-9">
                <select class="form-control" id="id_jabatan" name="id_jabatan" required>
                    <option value="" disabled>Pilih Nama Jabatan</option>
                    @foreach($jabatan as $item)
                    <option value="{{ $item->id }}" {{ $pegawai->id_jabatan == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_jabatan }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="id_agama">Agama</label>
            <div class="col-sm-9">
                <select class="form-control" id="id_agama" name="id_agama" required>
                    <option value="" disabled>Pilih Agama</option>
                    @foreach($agama as $item)
                    <option value="{{ $item->idagama }}" {{ $pegawai->idagama == $item->idagama ? 'selected' : '' }}>
                        {{ $item->agama }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="kontak">Kontak</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="kontak" name="kontak" value="{{ $pegawai->kontak }}">
            </div>
        </div>

        <div class="mt-3 modal-footer">
            <a href="{{ route('pegawai') }}" type="button" class="btn btn-secondary">
                Kembali
            </a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>
    </form>
</div>

@endsection
