<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    protected RoleRepository $roleRepository;
    protected PermissionRepository $permissionRepository;
    protected UserRepository $userRepository;

    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository, UserRepository $userRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
        $this->userRepository = $userRepository;
    }


    public function index()
    {
        return response()->json($this->roleRepository->paginate(10), 200);


    }

    public function show($id)
    {
        return response()->json($this->roleRepository->find($id), 200);
    }

    public function store(StoreRoleRequest $request)
    {
        try {
            // Giải mã JSON string thành mảng
            $permissions = json_decode($request->input('permissions'), true);

            // Tạo role mới
            $role = $this->roleRepository->create($request->all());


            if (is_array($permissions)) {
                foreach ($permissions as $permission) {
                    if ($permission != null) {
                        $this->permissionRepository->givePermissionTo($role, $permission);
                    }
                }
            }

            $userId = $request->input('user_id');
            if ($userId) {
                $user = $this->userRepository->find($userId);
                if ($user) {
                    $this->userRepository->assignRole($user, $role->id);
                }
            }

            return response()->json([
                'message' => 'Add role successful',
                'status' => 201,
                'role' => $role
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Add role unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $role = $this->roleRepository->update($id, $request->all());
            $this->roleRepository->syncPermissions($role, $request->permission);

            $this->roleRepository->deleteModelRolesByRoleId($request->id);

            $userId = $request->input('user_id');
            if ($userId) {
                $user = $this->userRepository->find($userId);
                if ($user) {
                    $this->userRepository->assignRole($user, $role->id);
                }
            }
            return response()->json([
                'message' => 'Edit role successful',
                'status' => 201,
                'role' => $role
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Edit role unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function destroy($id)
    {
        try {
            $role = $this->roleRepository->delete($id);
            return response()->json([
                'message' => 'Delete role successful',
                'status' => 201,
                'role' => $role
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Delete role unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
