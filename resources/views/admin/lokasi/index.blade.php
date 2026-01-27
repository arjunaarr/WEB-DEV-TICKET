<x-layouts.admin title="Manajemen Lokasi">

    @if (session('success'))
        <div class="toast toast-bottom toast-center z-50">
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.remove();
            }, 3000);
        </script>
    @endif

    <div class="container mx-auto p-10">
        <div class="flex">
            <h1 class="text-3xl font-semibold mb-4">Manajemen Lokasi</h1>
            <button class="btn btn-primary ml-auto" onclick="add_modal.showModal()">Tambah Lokasi</button>
        </div>
        <div class="overflow-x-auto rounded-box bg-white p-5 shadow-xs">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="w-3/4">Nama Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lokasis as $index => $lokasi)
                        <tr>
                            <th>{{ $index + 1 }}</th>
                            <td>{{ $lokasi->nama }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary mr-2" 
                                    onclick="openEditModal(this)" 
                                    data-id="{{ $lokasi->id }}" 
                                    data-nama="{{ $lokasi->nama }}">
                                    Edit
                                </button>
                                <button class="btn btn-sm bg-red-500 text-white border-none" 
                                    onclick="openDeleteModal(this)" 
                                    data-id="{{ $lokasi->id }}">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data lokasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <dialog id="add_modal" class="modal">
        <form method="POST" action="{{ route('admin.lokasi.store') }}" class="modal-box">
            @csrf
            <h3 class="text-lg font-bold mb-4">Tambah Lokasi</h3>
            <div class="form-control w-full mb-4">
                <label class="label"><span class="label-text">Nama Lokasi</span></label>
                <input type="text" name="nama" class="input input-bordered w-full" required />
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn" type="button" onclick="add_modal.close()">Batal</button>
            </div>
        </form>
    </dialog>

    <dialog id="edit_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('PUT')
            <h3 class="text-lg font-bold mb-4">Edit Lokasi</h3>
            <div class="form-control w-full mb-4">
                <label class="label"><span class="label-text">Nama Lokasi</span></label>
                <input type="text" id="edit_lokasi_name" name="nama" class="input input-bordered w-full" required />
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Update</button>
                <button class="btn" type="button" onclick="edit_modal.close()">Batal</button>
            </div>
        </form>
    </dialog>

    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('DELETE')
            <h3 class="text-lg font-bold mb-4 text-red-600">Konfirmasi Hapus</h3>
            <p>Apakah Anda yakin ingin menghapus lokasi ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="modal-action">
                <button class="btn bg-red-500 text-white border-none" type="submit">Ya, Hapus</button>
                <button class="btn" type="button" onclick="delete_modal.close()">Batal</button>
            </div>
        </form>
    </dialog>

    <script>
        function openEditModal(button) {
            const name = button.dataset.nama;
            const id = button.dataset.id;
            const modal = document.getElementById('edit_modal');
            const form = modal.querySelector('form');
            
            // Set value input
            document.getElementById("edit_lokasi_name").value = name;

            // Set action URL (Pastikan URL ini sesuai dengan route resource/update Anda)
            form.action = `/admin/lokasi/${id}`;

            modal.showModal();
        }

        function openDeleteModal(button) {
            const id = button.dataset.id;
            const modal = document.getElementById('delete_modal');
            const form = modal.querySelector('form');

            // Set action URL
            form.action = `/admin/lokasi/${id}`;

            modal.showModal();
        }
    </script>

</x-layouts.admin>