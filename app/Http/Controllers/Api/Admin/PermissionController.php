<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionRequest;
use App\Http\Requests\Admin\UpdatePermissionRequest;
use App\Repositories\PermissionRepository;

class PermissionController extends Controller
{
    //
    protected PermissionRepository $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        return response()->json($this->permissionRepository->paginate(10), 200);


    }

    public function show($id)
    {
        return response()->json($this->permissionRepository->find($id), 200);
    }

    public function store(StorePermissionRequest $request)
    {
        try {
            $permission = $this->permissionRepository->create($request->all());
            return response()->json([
                'message' => 'Add permission successful',
                'status' => 201,
                'permission' => $permission
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Add permission unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function update(UpdatePermissionRequest $request, $id)
    {
        try {
            $permission = $this->permissionRepository->update($id, $request->all());
            return response()->json([
                'message' => 'Edit permission successful',
                'status' => 201,
                'permission' =>$permission
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Edit permission unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function destroy($id)
    {
        try {
            $permission = $this->permissionRepository->delete($id);
            return response()->json([
                'message' => 'Delete permission successful',
                'status' => 201,
                'permission' => $permission
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Delete permission unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
