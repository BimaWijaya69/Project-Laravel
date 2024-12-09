<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::paginate(10); // 10 item per halaman


        return view('pages.categories.index', [
            "categories" => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable',
        ]);

        Category::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect('/categories')->with('success', 'Categori berhasil ditambahkan!');
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }


    public function destroy($id)
    {

        $category = Category::where('id', $id)->delete();

        return redirect('/categories')->with('success', 'Produk berhasil dihapus.');
    }
}
