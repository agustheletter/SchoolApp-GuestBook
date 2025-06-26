@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Jabatan')
@section('title', 'Jabatan')

@section('konten')
<div class="bg-white rounded-lg shadow">
    <h2 class="text-lg border-b border-gray-300 p-3">Daftar Jabatan</h2>
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

        <!-- Add Button -->
        <button onclick="toggleModal('addModal')" class="mb-4 px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition">
            Tambah Data Jabatan
        </button>

        <!-- Table -->
        <div class="bg-white overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200" id="table-jabatan">
                <thead class="bg-yellow-500 text-white text-center">
                    <tr>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">No</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">Nama Jabatan</th>
                        <th class="px-3 py-3 border-[0.5px] border-gray-100 text-xs font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($datajabatan as $index=> $jabatan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap text-center">{{ $index + 1 }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap">{{ $jabatan->nama_jabatan }}</td>
                        <td class="px-3 py-3 border-[0.5px] border-gray-100 whitespace-nowrap text-center space-x-1">
                            <!-- Edit Button -->
                            <button onclick="toggleModal('editModal{{ $jabatan->id }}')"
                                    class="inline-flex items-center px-2 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-xs rounded">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>

                            <!-- Delete Button -->
                            <button onclick="toggleModal('deleteModal{{ $jabatan->id }}')"
                                    class="inline-flex items-center px-2 py-1 bg-red-500 hover:bg-red-600 text-white text-xs rounded">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Position Modal -->
<div id="addModal" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center p-4 z-50 transition-opacity duration-300">
    <div class="relative w-full max-w-md">
        <!-- Modal Content -->
        <div class="relative bg-white rounded-lg shadow-xl transform transition-all duration-300 scale-95 opacity-0"
             id="addModalContent">
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b px-6 py-4">
                <h3 class="text-lg font-bold">Form Input Data Jabatan</h3>
                <button onclick="toggleModal('addModal')" class="text-gray-500 hover:text-gray-700 transition-colors">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form name="formjabatantambah" id="formjabatantambah" action="{{ route('jabatan.store') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="nama_jabatan" class="block text-gray-700 font-medium mb-2">Nama Jabatan</label>
                        <input type="text" id="nama_jabatan" name="nama_jabatan" placeholder="Masukan Nama Jabatan"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                    </div>
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <button type="button" onclick="toggleModal('addModal')"
                                class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors">
                            Tutup
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-md transition-colors">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modals (for each item) -->
@foreach ($datajabatan as $jabatan)
<div id="editModal{{ $jabatan->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center p-4 z-50">
    <div class="relative w-full max-w-md">
        <div class="relative bg-white rounded-lg shadow-xl transform transition-all duration-300 scale-95 opacity-0"
             id="editModalContent{{ $jabatan->id }}">
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b px-6 py-4">
                <h3 class="text-lg font-bold">Form Edit Data Jabatan</h3>
                <button onclick="toggleModal('editModal{{ $jabatan->id }}')" class="text-gray-500 hover:text-gray-700 transition-colors">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form name="formjabatanedit" id="formjabatanedit" action="{{ route('jabatan.update', $jabatan->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nama_jabatan" class="block text-gray-700 font-medium mb-2">Nama Jabatan</label>
                        <input type="text" id="nama_jabatan" name="nama_jabatan" value="{{ $jabatan->nama_jabatan }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                    </div>
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <button type="button" onclick="toggleModal('editModal{{ $jabatan->id }}')"
                                class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors">
                            Tutup
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-md transition-colors">
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modals (for each item) -->
<div id="deleteModal{{ $jabatan->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center p-4 z-50">
    <div class="relative w-full max-w-md">
        <div class="relative bg-white rounded-lg shadow-xl transform transition-all duration-300 scale-95 opacity-0"
             id="deleteModalContent{{ $jabatan->id }}">
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b px-6 py-4">
                <h3 class="text-lg font-bold">Hapus Data Jabatan</h3>
                <button onclick="toggleModal('deleteModal{{ $jabatan->id }}')" class="text-gray-500 hover:text-gray-700 transition-colors">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <p class="mb-4">Yakin mau menghapus data jabatan?</p>
                <p class="text-red-500 font-bold mb-6">{{ $jabatan->nama_jabatan }}</p>
                <form action="{{ route('jabatan.destroy', $jabatan->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <button type="button" onclick="toggleModal('deleteModal{{ $jabatan->id }}')"
                                class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-md transition-colors">
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    // Enhanced toggleModal function with animations
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        const modalContent = document.getElementById(modalId + 'Content') ||
                            modal.querySelector('.relative.bg-white');

        if (modal.classList.contains('hidden')) {
            modal.classList.add('flex');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        } else {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('fixed') && e.target.classList.contains('inset-0')) {
            const modalId = e.target.id;
            if (modalId) toggleModal(modalId);
        }
    });

    // Initialize DataTable
    $(document).ready(function() {
        $('#table-jabatan').DataTable({
            responsive: true,
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
