<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryInterface
{
    protected Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function paginate($perPage = 10)
    {
        return $this->product->select()->orderBy('id', 'desc')->paginate($perPage);
    }

    public function getById($id)
    {
        return $this->product->find($id);
    }

    public function index()
    {
        return $this->product->select('id', 'name', )->orderBy('id', 'desc')->get();
    }

    public function store(array $data)
    {
        return $this->product->create($data);
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
