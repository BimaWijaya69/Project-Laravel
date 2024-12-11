<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class CetakPDFController extends Controller
{
    public function generateReport()
    {
        // Ambil data barang, stok masuk, dan stok keluar
        $products = Product::with(['brgmasuk', 'brgkeluar'])->get();

        // Format data untuk ditampilkan di PDF
        $data = $products->map(function ($product) {
            $stokMasuk = $product->brgmasuk->sum('stok');
            $stokKeluar = $product->brgkeluar->sum('stok');
            $totalStok = $product->stok;

            return [
                'sku' => $product->sku,
                'nama_barang' => $product->nama,
                'stok_masuk' => $stokMasuk,
                'stok_keluar' => $stokKeluar,
                'total_stok' => $totalStok
            ];
        });

        // Load view untuk PDF dan kirim data ke view
        $pdf = PDF::loadView('pages.reports.pdf_report', ['data' => $data]);

        // Return PDF sebagai response untuk download
        return $pdf->download('laporan_barang.pdf');
    }
}
