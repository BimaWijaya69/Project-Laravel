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
    public function index(Request $request)
    {
        // Ambil input pencarian
        $search = $request->input('search');

        // Query untuk produk, termasuk filter pencarian
        $products = Product::when($search, function ($query, $search) {
            return $query->where('sku', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%");
        })->get();

        // Mengambil stok masuk dan keluar per produk
        $laporanBarang = $products->map(function ($product) {
            // Stok Masuk (Barang Masuk)
            $stokMasuk = BrgMasuk::where('product_id', $product->id)->sum('stok');

            // Stok Keluar (Barang Keluar)
            $stokKeluar = BrgKeluar::where('product_id', $product->id)->sum('stok');

            // Total stok diambil langsung dari kolom stok produk
            $totalStok = $product->stok;

            return [
                'sku' => $product->sku,
                'nama_barang' => $product->nama,
                'stok_masuk' => $stokMasuk,
                'stok_keluar' => $stokKeluar,
                'total_stok' => $totalStok
            ];
        });

        // Kirim data ke view
        return view('pages.laporans.index', [
            'laporanBarang' => $laporanBarang,
            'search' => $search
        ]);
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
