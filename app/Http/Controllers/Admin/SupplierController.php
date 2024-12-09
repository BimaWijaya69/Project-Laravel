<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::paginate(10);

        return view('pages.suppliers.index', [
            "suppliers" => $suppliers,
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
            'nama' => 'required|string|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|digits:12',
        ]);

        Supplier::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telepon' => $request->telepon,
        ]);
        return redirect('/suppliers')->with('succses', 'supplier baru ditambahkan!');
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
    public function update(Request $request, Supplier $supplier)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|digits:12',
        ]);

        $supplier->update($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil di perbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::where('id', $id)->delete();

        return redirect('/suppliers')->with('success', 'Data berhasil di hapus!');
    }
}
