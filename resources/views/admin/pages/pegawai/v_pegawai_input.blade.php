@extends('admin.v_admin')

@section('judulhalaman')
<div class="my-2">
    <span class="mr-3">Input Pegawai</span>
</div>
@endsection

@section('title', 'Buku Tamu')

@section('konten')
<div class="p-4 poppins">
    <form action="{{ route('pegawai.store') }}" method="post" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="w-full md:w-1/4 font-medium">Nama Pegawai</label>
            <div class="w-full md:w-3/4">
                <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       name="nama_pegawai" placeholder="Masukan Nama Pegawai" required>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="w-full md:w-1/4 font-medium">Jenis Kelamin</label>
            <div class="w-full md:w-3/4">
                <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="w-full md:w-1/4 font-medium">Jabatan</label>
            <div class="w-full md:w-3/4">
                <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        name="id_jabatan" required>
                    <option value="" disabled selected>Pilih Jabatan</option>
                    @foreach ($jabatan as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="w-full md:w-1/4 font-medium">Agama</label>
            <div class="w-full md:w-3/4">
                <select class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        name="id_agama" required>
                    <option value="" disabled selected>Pilih Agama</option>
                    @foreach ($agama as $a)
                        <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="w-full md:w-1/4 font-medium">Kontak</label>
            <div class="w-full md:w-3/4">
                <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       name="kontak" placeholder="Masukan Nomor/Email" required>
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-4">
            <a href="{{ route('bukutamu.input') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md text-gray-800 transition">Kembali</a>
            <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 rounded-md text-white transition">Tambah</button>
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