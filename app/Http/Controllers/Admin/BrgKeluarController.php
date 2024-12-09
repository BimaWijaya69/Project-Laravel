<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrgKeluar;
use App\Models\Product;
use Illuminate\Http\Request;

class BrgKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brgkeluars = BrgKeluar::paginate(10);
        $products = Product::all();

        return view('pages.brgkeluars.index', [
            "brgkeluars" => $brgkeluars,
            "products" => $products,
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
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stok' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        // Cari produk berdasarkan product_id
        $product = Product::findOrFail($request->product_id);

        // Validasi stok yang tersedia
        if ($product->stok < $request->stok) {
            return back()->with('error', 'Stok barang tidak mencukupi.');
        }

        // Kurangi stok barang di tabel product
        $product->stok -= $request->stok;
        $product->save();

        // Simpan data ke tabel brg_keluar
        BrgKeluar::create([
            'product_id' => $request->product_id,
            'stok' => $request->stok,
            'tanggal' => $request->tanggal,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('brgkeluars.index')->with('success', 'Data barang keluar berhasil ditambahkan.');
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
        $brgkeluar = BrgKeluar::find($id);

        // Ambil data stok lama dan stok baru
        $oldStok = $brgkeluar->stok;
        $newStok = $request->stok;

        // Hitung selisih perubahan stok
        $stokChange = $newStok - $oldStok;

        // Update stok barang masuk
        $brgkeluar->stok = $newStok;
        $brgkeluar->save();

        // Update stok pada produk terkait
        $product = Product::find($brgkeluar->product_id);

        // Update stok produk berdasarkan perubahan stok barang masuk
        $product->stok -= $stokChange;
        $product->save();

        return redirect()->route('brgkeluars.index')->with('success', 'Barang Keluar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BrgKeluar::where('id', $id)->delete();

        return redirect()->route('brgkeluars.index');
    }
}
