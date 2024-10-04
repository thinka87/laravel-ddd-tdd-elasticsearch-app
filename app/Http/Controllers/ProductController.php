<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $product = $this->productService->createProduct($validated);

        return response()->json($product, 201);
    }

    public function search(Request $request)
    {
        $term = $request->query('q');
        $products = $this->productService->searchProducts($term);

        return response()->json($products);
    }
}
