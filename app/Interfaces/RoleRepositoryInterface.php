<?php

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    //
public function index();
    public function paginate();

    public function find($id);

    public function create(array $data);

    public function update( $id, array $data);

    public function delete($id );
    public function syncPermissions($role, $permissions);
    public function deleteModelRolesByRoleId($roleId);
}
