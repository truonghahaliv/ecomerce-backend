<?php

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;

interface ProductRepositoryInterface
{
    //
    public function index();
    public function paginate();
    public function getById($id);
    public function create(array $data,);
    public function update($id, array $data,);
    public function delete($id);
}
