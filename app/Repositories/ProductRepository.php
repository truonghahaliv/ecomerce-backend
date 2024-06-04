<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryInterface
{

    public function index()
    {
        return Product::all();
    }

    public function getById($id)
    {
        return Product::find($id);
    }

    public function store(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = Product::find($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return $product;
    }
}
