@extends('admin/v_admin')
@section('judulhalaman', 'Edit Buku Tamu')
@section('title', 'Edit Buku Tamu')

@section('konten')
<div class="p-4 poppins">
    <form action="{{ route('bukutamu.update', $bukutamu->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nama Field -->
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label for="nama" class="w-full md:w-1/4 font-medium">Nama</label>
            <div class="w-full md:w-3/4">
                <input type="text" id="nama" name="nama" value="{{ $bukutamu->nama }}" 
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <!-- Role Field -->
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label for="roleSelect" class="w-full md:w-1/4 font-medium">Role</label>
            <div class="w-full md:w-3/4">
                <select id="roleSelect" name="role" 
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled>Pilih Role</option>
                    <option value="ortu" {{ $bukutamu->role == 'ortu' ? 'selected' : '' }}>Orang Tua</option>
                    <option value="umum" {{ $bukutamu->role == 'umum' ? 'selected' : '' }}>Tamu Umum</option>
                </select>
            </div>
        </div>

        <!-- Orang Tua Fields (Conditional) -->
        <div id="ortuFields" class="hidden flex flex-col md:flex-row md:items-center gap-4">
            <label for="siswa" class="w-full md:w-1/4 font-medium">Nama Siswa</label>
            <div class="w-full md:w-3/4">
                <select name="idsiswa" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled>Pilih Siswa</option>
                    @foreach ($siswa as $item)
                    <option value="{{ $item->idsiswa }}" {{ $bukutamu->idsiswa == $item->idsiswa ? 'selected' : '' }}>
                        {{ $item->namasiswa }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Instansi Field (Conditional) -->
        <div id="instansiField" class="hidden flex flex-col md:flex-row md:items-center gap-4">
            <label for="instansi" class="w-full md:w-1/4 font-medium">Instansi</label>
            <div class="w-full md:w-3/4">
                <input type="text" name="instansi" value="{{ $bukutamu->instansi ?? '' }}" 
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <!-- Alamat Field -->
        <div class="flex flex-col md:flex-row md:items-start gap-4">
            <label for="alamat" class="w-full md:w-1/4 font-medium">Alamat</label>
            <div class="w-full md:w-3/4">
                <textarea id="alamat" name="alamat" rows="3"
                          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $bukutamu->alamat }}</textarea>
            </div>
        </div>

        <!-- Kontak Field -->
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label for="kontak" class="w-full md:w-1/4 font-medium">Kontak</label>
            <div class="w-full md:w-3/4">
                <input type="text" id="kontak" name="kontak" value="{{ $bukutamu->kontak }}" 
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <!-- Jabatan Field -->
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label for="jabatan" class="w-full md:w-1/4 font-medium">Bertemu Dengan (Jabatan)</label>
            <div class="w-full md:w-3/4">
                <select id="jabatan" name="id_jabatan" 
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled>Pilih Jabatan</option>
                    @foreach ($jabatan as $j)
                    <option value="{{ $j->id }}" {{ $bukutamu->id_jabatan == $j->id ? 'selected' : ''}}>{{ $j->nama_jabatan }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Pegawai Field -->
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label for="pegawai" class="w-full md:w-1/4 font-medium">Nama Pegawai</label>
            <div class="w-full md:w-3/4">
                <select id="pegawai" name="id_pegawai" 
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Pilih Nama Pegawai</option>
                </select>
            </div>
        </div>

        <!-- Keperluan Field -->
        <div class="flex flex-col md:flex-row md:items-start gap-4">
            <label for="keperluan" class="w-full md:w-1/4 font-medium">Keperluan</label>
            <div class="w-full md:w-3/4">
                <textarea id="keperluan" name="keperluan" 
                          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $bukutamu->keperluan }}</textarea>
            </div>
        </div>

        <!-- Tanggal Field -->
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label for="tanggal" class="w-full md:w-1/4 font-medium">Tanggal</label>
            <div class="w-full md:w-3/4">
                <input type="datetime-local" id="tanggal" name="tanggal" value="{{ $bukutamu->created_at }}" 
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end gap-4 pt-4">
            <a href="{{ route('bukutamu') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md">
                Kembali
            </a>
            <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
    // Conditional fields based on role selection
    document.addEventListener("DOMContentLoaded", function () {
        const roleSelect = document.getElementById("roleSelect");
        const ortuFields = document.getElementById("ortuFields");
        const instansiField = document.getElementById("instansiField");
        const siswaSelect = document.querySelector("select[name='idsiswa']");

        function toggleFields() {
            if (roleSelect.value === "ortu") {
                ortuFields.classList.remove("hidden");
                instansiField.classList.add("hidden");
                siswaSelect.disabled = false;
            } else if (roleSelect.value === "umum") {
                ortuFields.classList.add("hidden");
                instansiField.classList.remove("hidden");
                siswaSelect.value = "";
            } else {
                ortuFields.classList.add("hidden");
                instansiField.classList.add("hidden");
                siswaSelect.disabled = true;
                siswaSelect.value = "";
            }
        }

        // Initialize fields based on current role
        toggleFields();

        // Add event listener for role changes
        roleSelect.addEventListener("change", toggleFields);
    });

    // Dynamic employee dropdown based on position
    $(document).ready(function() {
        var selectedJabatan = $('#jabatan').val();
        var selectedPegawai = "{{ $bukutamu->id_pegawai }}";

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

        // Load employees for initial selected position
        if (selectedJabatan) {
            loadPegawai(selectedJabatan, selectedPegawai);
        }

        // Update employees when position changes
        $('#jabatan').change(function() {
            loadPegawai($(this).val());
        });
    });
</script>

@endsection