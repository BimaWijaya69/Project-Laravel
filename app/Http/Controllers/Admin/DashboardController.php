<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $totalBarang = Product::count();
        $totalSupplier = Supplier::count();
        return view('pages.dashboard.index', compact('totalBarang', 'totalSupplier'));
    }
}
