<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function index():Collection
    {
        return Permission::all();
    }

    public function find($id)
    {
        return Permission::findOrFail($id);
    }
    public function paginate()
    {
        return Permission::paginate(10);
    }
    public function create(array $data)
    {
        return Permission::create($data);
    }

    public function update($id, array $data)
    {
        $Permission = Permission::find($id);
        $Permission->update($data);
        return $Permission;
    }

    public function delete($id)
    {
        $Permission = Permission::find($id);
        $Permission->delete();
        return $Permission;
    }

    public function givePermissionTo($role, $permission):void
    {
        $role->givePermissionTo($permission);
    }
}
