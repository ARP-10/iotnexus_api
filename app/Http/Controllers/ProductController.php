<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|integer',
            'code' => 'required|string|unique:products,code',
            'name' => 'required|string',
        ]);

        $product = Product::create($validated);
        return response()->json($product, 201);
    }
}
