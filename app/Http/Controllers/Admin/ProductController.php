<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->orderBy('category_id')->orderBy('sort_order')->paginate(20);
        $categories = Category::orderBy('sort_order')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.products.form', ['product' => new Product(), 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:10',
            'spec' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'tokped_url' => 'nullable|url',
            'shopee_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            'wa_text' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active', true);

        // Handle specs
        $specKeys = $request->input('spec_keys', []);
        $specVals = $request->input('spec_values', []);
        $specs = [];
        foreach ($specKeys as $i => $key) {
            if ($key && isset($specVals[$i])) {
                $specs[] = [$key, $specVals[$i]];
            }
        }
        $data['specs'] = $specs;

        // Handle image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        // Update category product count
        $product->category->product_count = $product->category->products()->count();
        $product->category->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:10',
            'spec' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'tokped_url' => 'nullable|url',
            'shopee_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            'wa_text' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active', true);

        // Handle specs
        $specKeys = $request->input('spec_keys', []);
        $specVals = $request->input('spec_values', []);
        $specs = [];
        foreach ($specKeys as $i => $key) {
            if ($key && isset($specVals[$i])) {
                $specs[] = [$key, $specVals[$i]];
            }
        }
        $data['specs'] = $specs;

        // Handle image
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $oldCategoryId = $product->category_id;
        $product->update($data);

        // Update category product counts
        if ($oldCategoryId != $data['category_id']) {
            $oldCat = Category::find($oldCategoryId);
            if ($oldCat) {
                $oldCat->product_count = $oldCat->products()->count();
                $oldCat->save();
            }
        }
        $product->category->product_count = $product->category->products()->count();
        $product->category->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        $category = $product->category;
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        $category->product_count = $category->products()->count();
        $category->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
