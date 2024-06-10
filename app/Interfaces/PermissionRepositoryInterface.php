<?php

namespace App\Interfaces;

interface PermissionRepositoryInterface
{
    //
public function index();
    public function paginate();

    public function find($id);

    public function create(array $data);

    public function update( $id, array $data);

    public function delete($id );
    public function givePermissionTo($role, $permission);
}
