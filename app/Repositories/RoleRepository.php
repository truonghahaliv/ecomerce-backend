<?php

namespace App\Repositories;



use App\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    protected Role $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }
    public function index():Collection
    {
        return Role::all();
    }

    public function find($id)
    {
        return Role::findOrFail($id);
    }
    public function paginate()
    {
        return Role::paginate(10);
    }
    public function create(array $data)
    {
        return Role::create($data);
    }

    public function update($id, array $data)
    {
        $Role = Role::find($id);
        $Role->update($data);
        return $Role;
    }

    public function delete($id)
    {
        $Role = Role::find($id);
        $Role->delete();
        return $Role;
    }

    public function syncPermissions($role, $permissions):void
    {
        $role->syncPermissions($permissions);
    }
    public function deleteModelRolesByRoleId($roleId):void
    {
        DB::table('model_has_roles')->where('role_id', $roleId)->delete();
    }
}
