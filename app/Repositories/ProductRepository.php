<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Cloudinary\Cloudinary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    public function paginate($perPage = 500)
    {
        return $this->product->select()->orderBy('id', 'desc')->paginate($perPage);
    }

    public function getById($id)
    {
        return $this->product->find($id);
    }

    public function index()
    {
        return $this->product->get();
    }

    public function create(array $data, )
    {

        return Product::create($data);
    }

    public function update($id, array $data,)
    {
        $product = Product::find($id);

            $product->update($data);
            return $product;

    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            // Delete associated image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            return $product->delete();
        }
        return $product;
    }
}
