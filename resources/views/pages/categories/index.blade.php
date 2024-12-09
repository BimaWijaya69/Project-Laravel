@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Data Kategori</b></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Kategori</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <!-- Tambahkan SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Kategori</h5>
                    <button class="btn btn-tambah ml-auto" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Tambah
                        Kategori</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="categoryList">
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                                    </td>
                                    <td>{{ $category->nama }}</td>
                                    <td>{{ $category->deskripsi }}</td>
                                    <td class="text-center">
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-sm btn-dark" type="button"
                                            onclick="showEditModal({{ $category }})"><i
                                                class="fas fa-edit"></i>Edit</button>
                                        <!-- Tombol Hapus -->
                                        <form action="/categories/{{ $category->id }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-dark" type="button"
                                                onclick="deleteConfirmation(this)"><i
                                                    class="fas fa-trash"></i>Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dbeb04; color: #000;">
                    <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="categoryName" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryDescription" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="categoryDescription" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="d-flex justify-content-end mr-2 mt-4">
                            <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn text-black" style="background-color: #dbeb04;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kategori -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dbeb04; color: #000;">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="editCategoryName" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCategoryDescription" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="editCategoryDescription" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="d-flex justify-content-end mr-2 mt-4">
                            <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn text-black"
                                style="background-color: #dbeb04;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi deleteConfirmation
        async function deleteConfirmation(e) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = e.closest('form');
                    form.submit();
                }
            });
        }

        // Fungsi showEditModal
        function showEditModal(category) {
            const editForm = document.getElementById('editCategoryForm');
            editForm.action = `/categories/${category.id}`;
            document.getElementById('editCategoryName').value = category.nama;
            document.getElementById('editCategoryDescription').value = category.deskripsi;
            const editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
            editModal.show();
        }
    </script>
@endsection
