<?php

namespace App\Interfaces;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    //
    public function all();

    public function find($id);

    public function create(array $data);

    public function update( $id, array $data);

    public function delete($id );
}
