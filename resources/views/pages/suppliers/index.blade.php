@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Data Supplier</b></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Supplier</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Supplier</h5>
                    <button class="btn btn-tambah ml-auto" data-bs-toggle="modal" data-bs-target="#addSupplierModal">Tambah
                        Supplier</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="suppliersList">
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($suppliers->currentPage() - 1) * $suppliers->perPage() }}
                                    </td>
                                    <td>{{ $supplier->nama }}</td>
                                    <td>{{ $supplier->alamat }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->telepon }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-dark" type="button"
                                            onclick="showEditModal({{ $supplier }})"><i
                                                class="fas fa-edit"></i>Edit</button>
                                        <form action="/suppliers/{{ $supplier->id }}" method="post" class="d-inline">
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
                        {{ $suppliers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Supplier -->
    <div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dbeb04; color: #000;">
                    <h5 class="modal-title" id="addSupplierModalLabel">Tambah Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('suppliers.store') }}" method="POST">
                        @csrf
                        <!-- Nama Supplier -->
                        <div class="mb-3">
                            <label for="supplierName" class="form-label">Nama Supplier</label>
                            <input type="text" class="form-control" id="supplierName" name="nama" required>
                        </div>

                        <!-- Alamat Supplier -->
                        <div class="mb-3">
                            <label for="supplierAddress" class="form-label">Alamat</label>
                            <textarea class="form-control" id="supplierAddress" name="alamat" rows="3" required></textarea>
                        </div>

                        <!-- Email Supplier -->
                        <div class="mb-3">
                            <label for="supplierEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="supplierEmail" name="email" required>
                        </div>

                        <!-- Telepon Supplier -->
                        <div class="mb-3">
                            <label for="supplierPhone" class="form-label">Telepon</label>
                            <input type="tel" class="form-control" id="supplierPhone" name="telepon" required
                                pattern="^\d{10,12}$" title="Telepon harus terdiri dari 10-12 digit">
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
    <div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dbeb04; color: #000;">
                    <h5 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editSupplierForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editSupplierName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editSupplierName" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="editSupplierAddress" class="form-label">Alamat</label>
                            <textarea class="form-control" id="editSupplierAddress" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editSupplierEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editSupplierEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editSupplierPhone" class="form-label">Telepon</label>
                            <input type="tel" class="form-control" id="editSupplierPhone" name="telepon" required
                                pattern="^\d{10,12}$" title="Telepon harus terdiri dari 10-12 digit">
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
        // Fungsi showEditModal
        function showEditModal(supplier) {
            const editForm = document.getElementById('editSupplierForm');
            editForm.action = `/suppliers/${supplier.id}`;
            document.getElementById('editSupplierName').value = supplier.nama;
            document.getElementById('editSupplierAddress').value = supplier.alamat;
            document.getElementById('editSupplierEmail').value = supplier.email;
            document.getElementById('editSupplierPhone').value = supplier.telepon;
            const editModal = new bootstrap.Modal(document.getElementById('editSupplierModal'));
            editModal.show();
        }

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
    </script>
@endsection
