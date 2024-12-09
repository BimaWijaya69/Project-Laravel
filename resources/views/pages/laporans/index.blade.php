@extends('layouts.main')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1><b>Laporan Barang</b></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Laporan</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <button class="btn btn-tambah ml-auto"
                        onclick="window.location.href='{{ route('laporan-barang.cetak') }}'">
                        Cetak PDF
                    </button>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Stok Masuk</th>
                                <th>Stok Keluar</th>
                                <th>Total Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporanBarang as $laporan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $laporan['sku'] }}</td>
                                    <td>{{ $laporan['nama_barang'] }}</td>
                                    <td>{{ $laporan['stok_masuk'] }}</td>
                                    <td>{{ $laporan['stok_keluar'] }}</td>
                                    <td>{{ $laporan['total_stok'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>ch
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
