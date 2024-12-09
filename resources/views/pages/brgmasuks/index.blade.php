@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Data Barang Masuk</b></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Barang Masuk</li>
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
                    <h5 class="mb-0">Data Barang Masuk</h5>
                    <button class="btn btn-tambah ml-auto" data-bs-toggle="modal" data-bs-target="#addBrgMasukModal">Tambah
                        Barang Masuk</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Nama Supplier</th>
                                <th>Stok Masuk</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brgmasuks as $brgmasuk)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($brgmasuks->currentPage() - 1) * $brgmasuks->perPage() }}
                                    </td>
                                    <td>{{ $brgmasuk->product->nama }}</td>
                                    <td>{{ $brgmasuk->supplier->nama }}</td>
                                    <td>{{ $brgmasuk->stok }}</td>
                                    <td>{{ $brgmasuk->tanggal }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-dark" type="button"
                                            onclick="showEditModal({{ $brgmasuk }})">
                                            <i class="fas fa-edit"></i>Edit
                                        </button>
                                        <form action="/brgmasuks/{{ $brgmasuk->id }}" method="POST" class="d-inline">
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
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addBrgMasukModal" tabindex="-1" aria-labelledby="addBrgMasukModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header" style="background-color: #dbeb04; color: #000;">
                    <h5 class="modal-title" id="addBrgMasukModalLabel">Tambah Barang Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="{{ route('brgmasuks.store') }}" method="POST">
                        @csrf
                        <!-- Nama Barang -->
                        <div class="mb-3">
                            <label for="product_id" class="form-label fw-bold">Nama Barang</label>
                            <select class="form-control" id="product_id" name="product_id" required>
                                <option value="" disabled selected>Pilih Barang</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Supplier -->
                        <div class="mb-3">
                            <label for="supplier_id" class="form-label fw-bold">Supplier</label>
                            <select class="form-control" id="supplier_id" name="supplier_id" required>
                                <option value="" disabled selected>Pilih Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Stok -->
                        <div class="mb-3">
                            <label for="stok" class="form-label fw-bold">Jumlah Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok"
                                placeholder="Masukkan jumlah stok" min="1" required>
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>

                        <!-- Button Actions -->
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn text-black" style="background-color: #dbeb04;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Barang Masuks -->
    <div class="modal fade" id="editBrgMasukModal" tabindex="-1" aria-labelledby="editBrgMasukModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dbeb04; color: #000;">
                    <h5 class="modal-title" id="editBrgMasukModalLabel">Edit Barang Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 75vh; overflow-y: auto;">
                    <form id="editBrgMasukForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 mt-3">
                            <label for="editBrgMasukProduct" class="form-label fw-bold">Kategori</label>
                            <select class="form-control" id="editBrgMasukProduct" name="product_id" required>
                                <option value="" disabled selected>Pilih Nama Barang</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="editBrgMasukSupplier" class="form-label fw-bold">Kategori</label>
                            <select class="form-control" id="editBrgMasukSupplier" name="supplier_id" required>
                                <option value="" disabled selected>Pilih Nama Barang</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="editBrgMasukStock" class="form-label fw-bold">Stok</label>
                            <input type="number" class="form-control" id="editBrgMasukStock" name="stok"
                                placeholder="Masukkan stok barang" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label for="editBrgMasukDate" class="form-label fw-bold">Nama Barang</label>
                            <input type="date" class="form-control" id="editBrgMasukDate" name="tanggal" required>
                        </div>

                        <!-- Button Actions -->
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
        function showEditModal(brgmasuk) {
            // Set the form action to include the ID of the item being edited
            const editForm = document.getElementById('editBrgMasukForm');
            editForm.action = `/brgmasuks/${brgmasuk.id}`;

            // Set the values of the form fields
            document.getElementById('editBrgMasukProduct').value = brgmasuk.product_id;
            document.getElementById('editBrgMasukSupplier').value = brgmasuk.supplier_id;
            document.getElementById('editBrgMasukStock').value = brgmasuk.stok;

            // Format the date (ensure it's in the correct format for the <input type="date">)
            const formattedDate = new Date(brgmasuk.tanggal).toISOString().split('T')[0];
            document.getElementById('editBrgMasukDate').value = formattedDate;

            // Show the modal
            const editModal = new bootstrap.Modal(document.getElementById('editBrgMasukModal'));
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
