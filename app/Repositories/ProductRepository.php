<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function create(array $data)
    {
        return Product::create($data);
    }

    public function search(string $term)
    {
        return Product::search($term)->get();
    }
}
