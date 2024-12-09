<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $lastProduct = Product::latest('id')->first();
        $nextNumber = $lastProduct ? ((int)substr($lastProduct->sku, 3)) + 1 : 1;
        $kodeBarang = 'BRG' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $products = Product::with('category')->paginate(10); // Mengambil daftar produk
        $categories = Category::all(); // Mengambil daftar kategori

        return view('pages.products.index', [
            "products" => $products,
            "categories" => $categories, // Kirim data kategori ke view
            "kodeBarang" => $kodeBarang, 
        ]);
    }

    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required|min:3",
            "foto" => "nullable|image|file|max:2048",
            "harga" => "required|numeric",
            "stok" => "required|integer",
            "category_id" => "required|exists:categories,id",
            "sku" => "required|unique:products,sku",
        ]);

        // Proses upload foto
        $photoPath = $request->file('foto')->store('post-images');

        $requestData = $request->except('sku'); // Abaikan 'sku' yang dikirim dari form

        $lastProduct = Product::latest('id')->first();
        $nextNumber = $lastProduct ? ((int)substr($lastProduct->sku, 3)) + 1 : 1;
        $kodeBarang = 'BRG' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $requestData['sku'] = $kodeBarang; // Tambahkan ke data yang akan disimpan


        Product::create([
            'nama' => $request->nama,
            'sku' => $kodeBarang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'category_id' => $request->category_id,
            'foto' => $photoPath,
        ]);

        return redirect('/products')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        // 
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            "nama" => "required|min:3",
            "foto" => "nullable|image|file|max:2048",
            "harga" => "required|numeric",
            "stok" => "required|integer",
            "category_id" => "required|exists:categories,id",
            "sku" => "required|unique:products,sku," . $product->id,
        ]);

        // Hapus foto lama jika ada file baru
        if ($request->hasFile('foto')) {
            if ($product->foto) {
                Storage::delete($product->foto);
            }

            // Simpan foto baru
            $path = $request->file('foto')->store('post-images');
            $product->foto = $path;
        }

        // Update properti lain
        $product->nama = $request->nama;
        $product->sku = $request->sku;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->category_id = $request->category_id;

        // Simpan ke database
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }


    public function destroy($id)
    {

        $product = Product::where('id', $id)->delete();

        return redirect('/products')->with('success', 'Produk berhasil dihapus.');
    }
}
