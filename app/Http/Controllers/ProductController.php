<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
        $query = Product::query();

        // Fulltext Search
        // if ($search = $request->input('search')) {
        //     $tsQuery = implode(' & ', explode(' ', $search)); // convert to tsquery-safe format
        //     $query->whereRaw(
        //         "to_tsvector('english', name) @@ to_tsquery('english', ?)",
        //         [$tsQuery]
        //     );
        // }

        if ($search = $request->input('search')) {
            $query->where('name', 'ILIKE', '%' . $search . '%');
        }

        // Filters
        if ($request->has('brand') && $request->brand !== 'all') {
            $query->where('brand', $request->brand);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->in_stock) {
            $query->where('stock', '>', 0);
        }

        if ($request->on_sale) {
            $query->where('on_sale', true); // adjust if your DB uses a different flag
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
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12)->appends($request->query());

        return view('products', compact('products'));
    }
}
