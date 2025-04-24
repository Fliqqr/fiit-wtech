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

        return view('item', compact('product'));
    }

    public function index(Request $request)
    {
        $query = Product::query();

        // Fulltext search with ILIKE
        if ($search = $request->input('search')) {
            $query->where('name', 'ILIKE', '%' . $search . '%');
        }

        // Category (brand) filter
        if ($request->filled('brand') && $request->brand !== 'all') {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('name', $request->brand);
            });
        }

        // Max price filter
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // In stock filter
        if ($request->boolean('in_stock')) {
            $query->where('in_stock', '>', 0);
        }

        // On sale filter
        if ($request->boolean('on_sale')) {
            $query->where('on_sale', true);
        }

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
        $categories = ProductCategory::all();

        return view('products', compact('products', 'categories'));
    }
}
