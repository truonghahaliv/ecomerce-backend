<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function index()
    {
        return Category::all();
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }
    public function paginate()
    {
        return Category::paginate(10);
    }
    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update($id, array $data)
    {
        $category = Category::find($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return $category;
    }
}
