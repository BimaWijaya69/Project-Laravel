<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrgMasuk;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BrgMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brgmasuks = BrgMasuk::paginate(10);
        $products = Product::all();
        $suppliers = Supplier::all();

        return view('pages.brgmasuks.index', [
            "brgmasuks" => $brgmasuks,
            "products" => $products,
            "suppliers" => $suppliers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "product_id" => "required|exists:products,id",
            "supplier_id" => "required|exists:suppliers,id",
            "stok" => "required|integer|min:1",
            "tanggal" => "required|date",
        ]);

        BrgMasuk::create([
            'product_id' => $request->product_id,
            'supplier_id' => $request->supplier_id,
            'stok' => $request->stok,
            'tanggal' => $request->tanggal,
        ]);

        // updet stok ke table product
        $product = Product::findOrFail($request->product_id);
        $product->stok += $request->stok;
        $product->save();

        return redirect()->route('brgmasuks.index');
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
    public function update(Request $request, $id)
    {
        $brgmasuk = BrgMasuk::find($id);

        // Ambil data stok lama dan stok baru
        $oldStok = $brgmasuk->stok;
        $newStok = $request->stok;

        // Hitung selisih perubahan stok
        $stokChange = $newStok - $oldStok;

        // Update stok barang masuk
        $brgmasuk->stok = $newStok;
        $brgmasuk->save();

        // Update stok pada produk terkait
        $product = Product::find($brgmasuk->product_id);

        // Update stok produk berdasarkan perubahan stok barang masuk
        $product->stok += $stokChange;
        $product->save();

        return redirect()->route('brgmasuks.index')->with('success', 'Barang Masuk berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BrgMasuk::where('id', $id)->delete();

        return redirect()->route('brgmasuks.index');
    }
}
