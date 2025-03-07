@extends('admin/v_admin')
@section('judulhalaman', 'Edit Buku Tamu')
@section('title', 'Edit Buku Tamu')

@section('konten')
<div class="my-4">
    <p>
    <form action="{{ route('bukutamu.update', $bukutamu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="nama">Nama</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $bukutamu->nama }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="role">Role</label>
            <div class="col-sm-9">
                <select class="form-control" name="role" id="roleSelect" required>
                    <option value="" disabled>Pilih Role</option>
                    <option value="ortu" {{ $bukutamu->role == 'ortu' ? 'selected' : '' }}>Orang Tua</option>
                    <option value="umum" {{ $bukutamu->role == 'umum' ? 'selected' : '' }}>Tamu Umum</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
            <div class="col-sm-9">
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" {{ $bukutamu->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $bukutamu->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="idagama">Agama</label>
            <div class="col-sm-9">
                <select class="form-control" id="idagama" name="idagama" required>
                    <option value="" disabled>Pilih Agama</option>
                    @foreach($agama as $item)
                    <option value="{{ $item->idagama }}" {{ $bukutamu->idagama == $item->idagama ? 'selected' : '' }}>
                        {{ $item->agama }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Input untuk Orang Tua (Hanya muncul jika role=ortu) -->
        <div class="form-group row" id="ortuFields" style="display: none;">
            <label class="col-sm-3 col-form-label" for="siswa">Nama Siswa</label>
            <div class="col-sm-9">
                <select class="form-control" name="idsiswa">
                    <option value="" disabled>Pilih Siswa</option>
                    @foreach ($siswa as $item)
                    <option value="{{ $item->id }}" {{ $bukutamu->idsiswa == $item->id ? 'selected' : '' }}>
                        {{ $item->namasiswa }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Input untuk Instansi (Hanya muncul jika role=umum) -->
        <div class="form-group row" id="instansiField" style="display: none;">
            <label class="col-sm-3 col-form-label" for="instansi">Instansi</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="instansi" value="{{ $bukutamu->instansi ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="alamat">Alamat</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $bukutamu->alamat }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="kontak">Kontak</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="kontak" name="kontak" value="{{ $bukutamu->kontak }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" class="">Bertemu Dengan (Jabatan)</label>
            <div class="col-sm-9">
                <select class="form-control" id="jabatan" name="id_jabatan" required>
                    <option value="" disabled>Pilih Jabatan</option>
                    @foreach ($jabatan as $j)
                    <option value="{{ $j->id }}" {{ $bukutamu->id_jabatan == $j->id ? 'selected' : ''}}>{{ $j->nama_jabatan }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" class="">Nama Pegawai</label>
            <div class="col-sm-9">
                <select class="form-control" id="pegawai" name="id_pegawai" required>
                    <option value="">Pilih Nama Pegawai</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="keperluan">Keperluan</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="keperluan" name="keperluan" required>{{ $bukutamu->keperluan }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="tanggal">Tanggal</label>
            <div class="col-sm-9">
                <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="{{ $bukutamu->created_at }}" required>
            </div>
        </div>

        <div class="mt-3 modal-footer">
            <a href="{{ route('bukutamu') }}" type="button" class="btn btn-secondary">
                Kembali
            </a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script>
    // Otomatis mengganti kolom input (Instansi / Orang Tua dari Siswa)
    document.addEventListener("DOMContentLoaded", function () {
        const roleSelect = document.getElementById("roleSelect");
        const ortuFields = document.getElementById("ortuFields");
        const instansiField = document.getElementById("instansiField");
        const siswaSelect = document.querySelector("select[name='idsiswa']");

        // Simpan role awal
        let initialRole = roleSelect.value;

        function toggleFields() {
            if (roleSelect.value === "ortu") {
                ortuFields.style.display = "flex";
                instansiField.style.display = "none";

                // Reset pilihan siswa jika sebelumnya "Umum"
                if (initialRole === "umum") {
                    siswaSelect.value = "";
                }
            } else if (roleSelect.value === "umum") {
                ortuFields.style.display = "none";
                instansiField.style.display = "flex";
            } else {
                ortuFields.style.display = "none";
                instansiField.style.display = "none";
            }

            // Update role awal setelah perubahan
            initialRole = roleSelect.value;
        }

        // Jalankan saat halaman dimuat
        toggleFields();

        // Tambahkan event listener untuk perubahan select
        roleSelect.addEventListener("change", toggleFields);
    });


    // Otomatis menampilkan nama pegawai dan jabatan dari data sebelumnya
    $(document).ready(function() {
        var selectedJabatan = $('#jabatan').val();  // Ambil id_jabatan yang tersimpan
        var selectedPegawai = "{{ $bukutamu->id_pegawai }}"; // Ambil id_pegawai yang tersimpan

        function loadPegawai(jabatan_id, selectedPegawai = null) {
            if (jabatan_id) {
                $.ajax({
                    url: '/getPegawai/' + jabatan_id,
                    type: 'GET',
                    success: function(data) {
                        $('#pegawai').empty().append('<option value="">Pilih Nama Pegawai</option>');
                        $.each(data, function(key, value) {
                            let isSelected = (selectedPegawai == value.id) ? "selected" : "";
                            $('#pegawai').append('<option value="' + value.id + '" ' + isSelected + '>' + value.nama_pegawai + '</option>');
                        });
                    }
                });
            }
        }

        // **JALANKAN AJAX SAAT HALAMAN DIBUKA** dengan id_pegawai yang sudah ada
        if (selectedJabatan) {
            loadPegawai(selectedJabatan, selectedPegawai);
        }

        // **JALANKAN LAGI SAAT JABATAN BERUBAH**
        $('#jabatan').change(function() {
            loadPegawai($(this).val());
        });
    });

</script>

@endsection
