@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Siswa')
@section('title', 'Siswa')

@section('konten')
<div class="bg-white rounded-lg shadow">
    <h2 class="text-lg border-b border-gray-300 p-3">Daftar Siswa</h2>
    <div class="p-4">
        <!-- Success Alert -->
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-700 rounded flex justify-between items-center">
                <p>{{ session('success') }}</p>
                <button type="button" class="text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>
        @endif

        <!-- Add Student Button -->
        <button type="button" class="mb-4 px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition"
                onclick="document.getElementById('modalTambahSiswa').classList.remove('hidden')">
            Tambah Data Siswa
        </button>

        <!-- Student Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full w-full table-auto border-collapse divide-y divide-gray-200" id="table-siswa">
                <thead class="bg-green-500 text-white text-center">
                    <tr>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">No</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">NIS</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">NISN</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">Tempat Lahir</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">Tanggal Lahir</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">Alamat</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">Agama</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">Tlp Rumah</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">HP</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">Photo</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">Tahun Masuk</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($siswa as $index => $s)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap text-center">{{ $index + 1 }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap text-center">{{ $s->nis }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap text-center">{{ $s->nisn }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ $s->namasiswa }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ $s->tempatlahir }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap text-right">{{ $s->tgllahir }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ $s->jk }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ $s->alamat }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ optional($s->agama)->agama }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ $s->tlprumah }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ $s->hpsiswa }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">
                            <img class="w-16 h-16 object-cover" src="{{ asset('PhotoSiswa/' . $s->photosiswa) }}" alt="Photo">
                        </td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap text-center">{{ $s->thnajaran->thnajaran }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap text-center space-x-2">
                            <!-- Edit Button -->
                            <button type="button" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded"
                                    onclick="document.getElementById('modalsiswaEdit{{ $s->idsiswa }}').classList.remove('hidden')">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Delete Button -->
                            <button type="button" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded"
                                    onclick="document.getElementById('modalsiswaHapus{{ $s->idsiswa }}').classList.remove('hidden')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Student Modal -->
<div id="modalTambahSiswa" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
    <div class="relative bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4">
        <!-- Modal Header -->
        <div class="flex justify-between items-start p-5 border-b rounded-t">
            <h3 class="text-xl font-semibold text-gray-900">Form Input Data Siswa</h3>
            <button type="button" onclick="document.getElementById('modalTambahSiswa').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-500">
                <span class="text-2xl">&times;</span>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-4">
            <form name="formsiswatambah" id="formsiswatambah" action="/siswa/tambah" method="post" enctype="multipart/form-data">
                @csrf
                <!-- NIS Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="nis" class="md:col-span-1 font-medium text-gray-700">NIS</label>
                    <input type="text" id="nis" name="nis" placeholder="Masukan NIS"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- NISN Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="nisn" class="md:col-span-1 font-medium text-gray-700">NISN</label>
                    <input type="text" id="nisn" name="nisn" placeholder="Masukan NISN"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Nama Siswa Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="namasiswa" class="md:col-span-1 font-medium text-gray-700">Nama Siswa</label>
                    <input type="text" id="namasiswa" name="namasiswa" placeholder="Masukan Nama siswa"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Tempat Lahir Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="tempatlahir" class="md:col-span-1 font-medium text-gray-700">Tempat Lahir</label>
                    <input type="text" id="tempatlahir" name="tempatlahir" placeholder="Masukan Kota Kelahiran"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Tanggal Lahir Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="tgllahir" class="md:col-span-1 font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" id="tgllahir" name="tgllahir"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Jenis Kelamin Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label class="md:col-span-1 font-medium text-gray-700">Jenis Kelamin</label>
                    <div class="md:col-span-3 flex items-center space-x-6">
                        <label class="inline-flex items-center">
                            <input type="radio" name="jk" value="L" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2">Laki-laki</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="jk" value="P" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2">Perempuan</span>
                        </label>
                    </div>
                </div>

                <!-- Alamat Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="alamat" class="md:col-span-1 font-medium text-gray-700">Alamat</label>
                    <input type="text" id="alamat" name="alamat" placeholder="Masukan Alamat"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Agama Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="idagama" class="md:col-span-1 font-medium text-gray-700">Agama</label>
                    <select id="idagama" name="idagama"
                            class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value=""></option>
                        @foreach ($agama as $a)
                            <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Telepon Rumah Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="tlprumah" class="md:col-span-1 font-medium text-gray-700">Telepon Rumah</label>
                    <input type="text" id="tlprumah" name="tlprumah" placeholder="Masukan Nomor Telepon Rumah"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- HP Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="hpsiswa" class="md:col-span-1 font-medium text-gray-700">HP</label>
                    <input type="text" id="hpsiswa" name="hpsiswa" placeholder="Masukan Nomor HP Siswa"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Photo Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="photo" class="md:col-span-1 font-medium text-gray-700">Photo</label>
                    <input type="file" id="photo" name="photo"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Tahun Masuk Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="idthnajaran" class="md:col-span-1 font-medium text-gray-700">Tahun Masuk</label>
                    <select id="idthnajaran" name="idthnajaran"
                            class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value=""></option>
                        @foreach ($thnajaran as $t)
                            <option value="{{ $t->idthnajaran }}">{{ $t->thnajaran }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end space-x-4 pt-6 border-t">
                    <button type="button" onclick="document.getElementById('modalTambahSiswa').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md transition">
                        Tutup
                    </button>
                    <button type="submit" name="tambahsiswa"
                            class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md transition">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Student Modals -->
@foreach ($siswa as $s)
<div id="modalsiswaEdit{{ $s->idsiswa }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
<div class="relative bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4">
        <!-- Modal Header -->
        <div class="flex justify-between items-start p-5 border-b rounded-t">
            <h3 class="text-xl font-semibold text-gray-900">Form Edit Data Siswa</h3>
            <button type="button" onclick="document.getElementById('modalsiswaEdit{{ $s->idsiswa }}').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-500">
                <span class="text-2xl">&times;</span>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-4">
            <form name="formsiswaedit" id="formsiswaedit" action="/siswa/edit/{{ $s->idsiswa }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <!-- NIS Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="nis" class="md:col-span-1 font-medium text-gray-700">NIS</label>
                    <input type="text" id="nis" name="nis" value="{{ $s->nis }}"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- NISN Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="nisn" class="md:col-span-1 font-medium text-gray-700">NISN</label>
                    <input type="text" id="nisn" name="nisn" value="{{ $s->nisn }}"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Nama Siswa Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="namasiswa" class="md:col-span-1 font-medium text-gray-700">Nama Siswa</label>
                    <input type="text" id="namasiswa" name="namasiswa" value="{{ $s->namasiswa }}"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Tempat Lahir Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="tempatlahir" class="md:col-span-1 font-medium text-gray-700">Tempat Lahir</label>
                    <input type="text" id="tempatlahir" name="tempatlahir" value="{{ $s->tempatlahir }}"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Tanggal Lahir Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="tgllahir" class="md:col-span-1 font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" id="tgllahir" name="tgllahir" value="{{ $s->tgllahir }}"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Jenis Kelamin Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label class="md:col-span-1 font-medium text-gray-700">Jenis Kelamin</label>
                    <div class="md:col-span-3 flex items-center space-x-6">
                        <label class="inline-flex items-center">
                            <input type="radio" name="jk" value="L" class="h-4 w-4 text-blue-600 focus:ring-blue-500"
                                {{ $s->jk == "L" ? 'checked' : '' }}>
                            <span class="ml-2">Laki-laki</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="jk" value="P" class="h-4 w-4 text-blue-600 focus:ring-blue-500"
                                {{ $s->jk == "P" ? 'checked' : '' }}>
                            <span class="ml-2">Perempuan</span>
                        </label>
                    </div>
                </div>

                <!-- Alamat Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="alamat" class="md:col-span-1 font-medium text-gray-700">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ $s->alamat }}"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Agama Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="idagama" class="md:col-span-1 font-medium text-gray-700">Agama</label>
                    <select id="idagama" name="idagama"
                            class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach ($agama as $a)
                            <option value="{{ $a->idagama }}" {{ $a->idagama == $s->idagama ? 'selected' : '' }}>
                                {{ $a->agama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Telepon Rumah Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="tlprumah" class="md:col-span-1 font-medium text-gray-700">Telepon Rumah</label>
                    <input type="text" id="tlprumah" name="tlprumah" value="{{ $s->tlprumah }}"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- HP Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="hpsiswa" class="md:col-span-1 font-medium text-gray-700">HP</label>
                    <input type="text" id="hpsiswa" name="hpsiswa" value="{{ $s->hpsiswa }}"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Photo Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="photo" class="md:col-span-1 font-medium text-gray-700">Photo</label>
                    <input type="file" id="photo" name="photosiswa"
                           class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Tahun Masuk Field -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="idthnajaran" class="md:col-span-1 font-medium text-gray-700">Tahun Masuk</label>
                    <select id="idthnajaran" name="idthnmasuk"
                            class="md:col-span-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach ($thnajaran as $t)
                            <option value="{{ $t->idthnajaran }}" {{ $t->idthnajaran == $s->idthnajaran ? 'selected' : '' }}>
                                {{ $t->thnajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end space-x-4 pt-6 border-t">
                    <button type="button" onclick="document.getElementById('modalsiswaEdit{{ $s->idsiswa }}').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md transition">
                        Tutup
                    </button>
                    <button type="submit" name="siswaedit"
                            class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md transition">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="modalsiswaHapus{{ $s->idsiswa }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
    <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <!-- Modal Header -->
        <div class="flex justify-between items-start p-5 border-b rounded-t">
            <h3 class="text-lg font-semibold text-gray-900">Hapus Data Siswa</h3>
            <button type="button" onclick="document.getElementById('modalsiswaHapus{{ $s->idsiswa }}').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-500">
                <span class="text-2xl">&times;</span>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <p class="mb-4">Yakin mau menghapus data siswa?</p>
            <p class="text-red-500 font-medium">{{ $s->siswa }}</p>
        </div>

        <!-- Modal Footer -->
        <div class="flex justify-end space-x-4 p-6 border-t">
            <button type="button" onclick="document.getElementById('modalsiswaHapus{{ $s->idsiswa }}').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md transition">
                Tutup
            </button>
            <form action="/siswa/hapus/{{ $s->idsiswa }}" method="get" class="inline">
                <button type="submit" name="siswahapus"
                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md transition">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endforeach

<script type="text/javascript">
    $(document).ready(function() {
        $('#table-siswa').DataTable({
            scrollX: true,
            responsive: false,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }


        });
    });
</script>
@endsection
