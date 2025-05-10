<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
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

    public function new(Request $request) 
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
        ]);

        // \Log::info('Uploaded files:', ['files' => $request->file('images')]);

        $imageFiles = $request->file('images');
        // dd($imageFiles);

        $imageUrls = [];

        foreach ($imageFiles as $file) {

            if ($file && $file->isValid()) {
                $imageUrls[] = asset('storage/' . $file->store('uploads', 'public'));
            }
        }

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'in_stock' => $validated['stock'],
            'image_url' => $imageUrls[0],
            'additional_images' => array_slice($imageUrls, 1),
        ]);

        $categoryInput = $request->input('categories', []);

        $categoryIds = [];

        foreach ($categoryInput as $type => $names) {
            $ids = ProductCategory::whereIn('name', $names)
                ->where('category_type', $type)
                ->pluck('id')
                ->toArray();

            $categoryIds = array_merge($categoryIds, $ids);
        }

        if (!empty($categoryIds)) {
            $product->categories()->attach($categoryIds);
        }

        if ($product) {
            \Log::info('Product created successfully', ['product_id' => $product->id]);
        } else {
            \Log::error('Failed to create product');
        }

        return redirect()->back()->with('success', 'Product created!');
    }

    public function update(Request $request)
    {
        $id = $request->query('id');

        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp',
            'categories.*' => 'array',  // Ensure categories are sent as arrays
        ]);

        // Find the product
        $product = Product::findOrFail($id);

        // Update basic product information
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->in_stock = $validated['stock'];

        // Handle images
        if ($request->hasFile('images')) {
            $imageFiles = $request->file('images');
            $imageUrls = [];

            // Store new images
            foreach ($imageFiles as $file) {
                $imageUrls[] = asset('storage/' . $file->store('uploads', 'public'));
            }

            // Update the main image (if exists)
            $product->image_url = $imageUrls[0];

            // Update additional images
            $product->additional_images = array_slice($imageUrls, 1);
        }

        // Save the updated product
        $product->save();

        // Update categories
        if ($request->has('categories')) {
            // Detach current categories
            $product->categories()->detach();

            // Attach selected categories
            foreach ($request->input('categories') as $categoryType => $categoryNames) {
                $categories = ProductCategory::whereIn('name', $categoryNames)->get();
                foreach ($categories as $category) {
                    // Attach category to product using pivot table (product_tags)
                    $product->categories()->attach($category->id);
                }
            }
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product updated!');    
    }

    public function edit(Request $request)
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

        $id = $request->query('id');
        $edit_product = Product::with('categories')->findOrFail($id);
        $categories = ProductCategory::getCategoriesAsMap();

        $edit_product->all_images = array_filter([
            $edit_product->image_url,
            ...($edit_product->additional_images ?? [])
        ]);

        return view('admin', compact('edit_product', 'products', 'categories'));
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
