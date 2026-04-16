<?php
// ============================================================
// FILE: app/Http/Controllers/HomeController.php  (GANTI file lama)
// ============================================================
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Shared settings dikirim ke semua view frontend
    private function baseSettings(): array
    {
        return Setting::allAsArray();
    }

    public function index()
    {
        $settings   = $this->baseSettings();
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->withCount('products as product_count')
            ->get();

        return view('frontend.home', compact('settings', 'categories'));
    }

    public function category(Category $category)
    {
        $settings = $this->baseSettings();
        $products = $category->products()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->paginate(12);

        return view('frontend.category', compact('settings', 'category', 'products'));
    }

    public function product(Category $category, Product $product)
    {
        $settings = $this->baseSettings();
        return view('frontend.product', compact('settings', 'category', 'product'));
    }
}
