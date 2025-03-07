@extends('admin/v_admin')
@section('judulhalaman', 'Edit Buku Tamu')
@section('title', 'Edit Buku Tamu')

@section('konten')
    <a href="{{ route('bukutamu') }}" type="button" class="btn btn-secondary">
        Kembali
    </a>
    <p>
    <form action="{{ route('bukutamu.update', $bukutamu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $bukutamu->nama }}" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki" {{ $bukutamu->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $bukutamu->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="id_agama">Agama</label>
            <select class="form-control" id="id_agama" name="id_agama" required>
                @foreach($agama as $item)
                    <option value="{{ $item->id }}" {{ $bukutamu->id_agama == $item->id ? 'selected' : '' }}>
                        {{ $item->agama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="instansi">Instansi</label>
            <input type="text" class="form-control" id="instansi" name="instansi" value="{{ $bukutamu->instansi }}">
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required>{{ $bukutamu->alamat }}</textarea>
        </div>

        <div class="form-group">
            <label for="kontak">Kontak</label>
            <input type="text" class="form-control" id="kontak" name="kontak" value="{{ $bukutamu->kontak }}">
        </div>

        <div class="form-group">
            <label for="id_jabatan">Jabatan</label>
            <select class="form-control" id="id_jabatan" name="id_jabatan" required>
                @foreach($jabatan as $item)
                    <option value="{{ $item->id }}" {{ $bukutamu->id_jabatan == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_jabatan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="keperluan">Keperluan</label>
            <textarea class="form-control" id="keperluan" name="keperluan" required>{{ $bukutamu->keperluan }}</textarea>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="{{ $bukutamu->tanggal->format('Y-m-d\TH:i') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
@endsection
