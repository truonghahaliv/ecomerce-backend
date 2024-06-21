<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    //
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return response()->json($this->userRepository->paginate(10), 200);
     //   return response()->json($this->userRepository->all(), 200);


//        $users = $this->userRepository->paginate(5);
//
//        // Return the products to a view
//        return view('admin.users.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function show($id)
    {
        return response()->json($this->userRepository->find($id), 200);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = $this->userRepository->store($request->all());
            return response()->json([
                'message' => 'Add user successful',
                'status' => 201,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Add user unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = $this->userRepository->update($id, $request->all());
            return response()->json([
                'message' => 'Edit user successful',
                'status' => 201,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Edit user unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function destroy($id)
    {
        try {
            $user = $this->userRepository->delete($id);
            return response()->json([
                'message' => 'Delete user successful',
                'status' => 201,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Delete user unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }


//    public function fileImport(): View
//    {
//
//        return view('admin.users.file');
//    }
//
//    public function importFile(ImportFileRequest $request):RedirectResponse
//    {
//
//        $file = file($request->file('file'));
//
//        $chunks = array_chunk($file, 1000);
//
//        $header = [];
//        $batch = Bus::batch([ ])->dispatch();
//
//        foreach ($chunks as $key => $chunk) {
//            $data = array_map('str_getcsv', $chunk);
//
//            if ($key == 0) {
//                $header = $data[0];
//                unset($data[0]);
//            }
//
//            $batch->add(new UserImportDataJob($data, $header));
//        }
//
//
//        return  redirect()->route('user.index')->with('success', 'User imported successfully.');
//
//        //    return(array_map('str_getcsv', file($request->file('file'))));
//        // $csv = array_map('str_getcsv', file('data.csv'));
//
//        //        foreach ($csv as  $value) {
//        //            $record = array_combine($header, $value);
//        //            dd($record);
//        //        }
//
//        //        $chunks = array_chunk($a, 1000);
//        //        $part = storage_path('temp');
//        //        dd($part);
//        //        foreach ($chunks as $chunk) {
//        //            $fi
//        //        }
//        //        Excel::import(new UserFileImport,$request->file('file'));
//        //        $users = $this->userRepository->paginate(5);
//
//    }
//
//    public function exportFile(Request $request)
//    {
//
//        return Excel::download(new UserFileExport(), 'users.csv');
//
//    }
}
