<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrgKeluar;
use App\Models\BrgMasuk;
use App\Models\Product;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data produk
        $products = Product::all();

        // Mengambil stok masuk dan keluar per produk
        $laporanBarang = $products->map(function ($product) {
            // Stok Masuk (Barang Masuk)
            $stokMasuk = BrgMasuk::where('product_id', $product->id)->sum('stok');

            // Stok Keluar (Barang Keluar)
            $stokKeluar = BrgKeluar::where('product_id', $product->id)->sum('stok');

            // Cukup tampilkan stok yang ada pada barang (tanpa menghitung stok masuk dan keluar)
            $totalStok = $product->stok;  // Mengambil stok yang ada di tabel products

            return [
                'sku' => $product->sku,
                'nama_barang' => $product->nama,
                'stok_masuk' => $stokMasuk,
                'stok_keluar' => $stokKeluar,
                'total_stok' => $totalStok  // Menampilkan stok yang ada
            ];
        });

        // Kirim data ke view
        return view('pages.laporans.index', compact('laporanBarang'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
