<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        $id = $request->query('id');
        $product = Product::findOrFail($id);
        $categories = $product->categories;

        return view('item', compact('product', 'categories'));
    }

    public function new_item(Request $request) 
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $imageFiles = $request->file('images[]') ?? [];

        $imageUrls = [];
        foreach ($imageFiles as $file) {
            $imageUrls[] = $file->store('uploads', 'public');
        }

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'in_stock' => $validated['stock'],
            'image_url' => $imageUrls[0],
            'additional_images' => array_slice($imageUrls, 1),
        ]);

        if ($product) {
            \Log::info('Product created successfully', ['product_id' => $product->id]);
        } else {
            \Log::error('Failed to create product');
        }

        // // Attach categories
        // if (!empty($validated['categories'])) {
        //     $product->categories()->attach($validated['categories']);
        // }

        return redirect()->back()->with('success', 'Product created!');
    }

    public function edit(Request $request)
    {
        $id = $request->query('id');
        $product = Product::findOrFail($id);
        $categories = $product->categories;

        return view('edit_product', compact('product', 'categories'));
    }

    public function index(Request $request)
    {
        $query = Product::query();

        $this->applyFilters($query, $request);

        // Sorting
        switch ($request->sort) {
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'date-asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'date-desc':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12)->appends($request->query());
        $categories = ProductCategory::getCategoriesAsMap();

        return view('products', compact('products', 'categories'));
    }

    public function admin(Request $request)
    {
        $query = Product::query();

        $this->applyFilters($query, $request);

        // Sorting
        switch ($request->sort) {
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'date-asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'date-desc':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12)->appends($request->query());
        $categories = ProductCategory::getCategoriesAsMap();

        return view('admin', compact('products', 'categories'));
    }

    private function applyFilters($query, Request $request)
    {
        if ($search = $request->input('search')) {
            $query->where('name', 'ILIKE', '%' . $search . '%');
        }

        foreach (['Component', 'Model', 'Brand'] as $type) {
            if ($request->filled($type) && $request->input($type) !== 'all') {
                $query->whereHas('categories', function ($q) use ($request, $type) {
                    $q->where('category_type', $type)
                      ->where('name', $request->input($type));
                });
            }
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->boolean('in_stock')) {
            $query->where('in_stock', '>', 0);
        }

        if ($request->boolean('on_sale')) {
            $query->where('on_sale', true);
        }
    }
}
