<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    //
    public function index();
    public function getById($id);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);
}
