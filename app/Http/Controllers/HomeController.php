<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $settings = $this->getSettings();

        return view('frontend.home', compact('categories', 'settings'));
    }

    public function category(Category $category)
    {
        $products = $category->activeProducts()->paginate(12);
        $settings = $this->getSettings();

        return view('frontend.category', compact('category', 'products', 'settings'));
    }

    public function product(Category $category, Product $product)
    {
        $settings = $this->getSettings();
        return view('frontend.product', compact('category', 'product', 'settings'));
    }

    private function getSettings(): array
    {
        return Setting::pluck('value', 'key')->toArray();
    }
}
