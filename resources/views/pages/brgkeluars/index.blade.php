@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Data Barang Keluar</b></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Barang Keluar</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Alert Pesan -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Barang Keluar</h5>
                    <button class="btn btn-tambah ml-auto" data-bs-toggle="modal" data-bs-target="#addBrgKeluarModal">
                        Tambah Barang Keluar
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Stok Keluar</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brgkeluars as $brgkeluar)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($brgkeluars->currentPage() - 1) * $brgkeluars->perPage() }}
                                    </td>
                                    <td>{{ $brgkeluar->product->nama }}</td>
                                    <td>{{ $brgkeluar->stok }}</td>
                                    <td>{{ $brgkeluar->tanggal }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-dark" type="button"
                                            onclick="showEditModal({{ $brgkeluar }})">
                                            <i class="fas fa-edit"></i>Edit
                                        </button>
                                        <form action="/brgkeluars/{{ $brgkeluar->id }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-dark" type="button"
                                                onclick="deleteConfirmation(this)">
                                                <i class="fas fa-trash"></i>Hapus
                                            </button>
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

    <!-- Modal Tambah Barang Keluar -->
    <div class="modal fade" id="addBrgKeluarModal" tabindex="-1" aria-labelledby="addBrgKeluarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dbeb04; color: #000;">
                    <h5 class="modal-title" id="addBrgKeluarModalLabel">Tambah Barang Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('brgkeluars.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="product_id" class="form-label fw-bold">Nama Barang</label>
                            <select class="form-control" id="product_id" name="product_id" required>
                                <option value="" disabled selected>Pilih Barang</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="stok" class="form-label fw-bold">Jumlah Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok"
                                placeholder="Masukkan jumlah stok" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn text-black" style="background-color: #dbeb04;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Barang Keluar -->
    <div class="modal fade" id="editBrgKeluarModal" tabindex="-1" aria-labelledby="editBrgKeluarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dbeb04; color: #000;">
                    <h5 class="modal-title" id="editBrgKeluarModalLabel">Edit Barang Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBrgKeluarForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="editBrgKeluarProduct" class="form-label fw-bold">Nama Barang</label>
                            <select class="form-control" id="editBrgKeluarProduct" name="product_id" required>
                                <option value="" disabled selected>Pilih Barang</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="editBrgKeluarStock" class="form-label fw-bold">Jumlah Stok</label>
                            <input type="number" class="form-control" id="editBrgKeluarStock" name="stok"
                                placeholder="Masukkan jumlah stok" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label for="editBrgKeluarDate" class="form-label fw-bold">Tanggal</label>
                            <input type="date" class="form-control" id="editBrgKeluarDate" name="tanggal" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn text-black" style="background-color: #dbeb04;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showEditModal(brgkeluar) {
            const editForm = document.getElementById('editBrgKeluarForm');
            editForm.action = `/brgkeluars/${brgkeluar.id}`;
            document.getElementById('editBrgKeluarProduct').value = brgkeluar.product_id;
            document.getElementById('editBrgKeluarStock').value = brgkeluar.stok;
            const formattedDate = new Date(brgkeluar.tanggal).toISOString().split('T')[0];
            document.getElementById('editBrgKeluarDate').value = formattedDate;
            const editModal = new bootstrap.Modal(document.getElementById('editBrgKeluarModal'));
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
