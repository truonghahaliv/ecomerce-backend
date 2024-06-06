<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    //
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return response()->json($this->categoryRepository->paginate(10), 200);

//        $users = $this->userRepository->paginate(5);
//
//        // Return the products to a view
//        return view('admin.users.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function show($id)
    {
        return response()->json($this->categoryRepository->find($id), 200);
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = $this->categoryRepository->create($request->all());
            return response()->json([
                'message' => 'Add category successful',
                'status' => 201,
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Add category unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $category = $this->categoryRepository->update($id, $request->all());
            return response()->json([
                'message' => 'Edit category successful',
                'status' => 201,
                'category' =>$category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Edit category unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function destroy($id)
    {
        try {
            $category = $this->categoryRepository->delete($id);
            return response()->json([
                'message' => 'Delete category successful',
                'status' => 201,
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Delete category unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
