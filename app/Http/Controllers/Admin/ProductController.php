<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Repositories\ProductRepository;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return response()->json($this->productRepository->index(), 200);
    }

    public function show($id)
    {
        $product = $this->productRepository->getById($id);
        if (is_null($product)) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product, 200);
    }

    public function store(StoreProductRequest $request)
    {
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => 'laravel-test',
        ])->getSecurePath();
        $data = array_merge($request->all(), ['image' => $uploadedFileUrl]);
        $product = $this->productRepository->store($data);
        return response()->json(['message' =>'Add product successful',
            'code' =>201,
            'product' => $product
        ] );
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = $this->productRepository->update($id, $request->all());
            return response()->json([
                'message' => 'Edit product successful',
                'status' => 201,
                'product' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Edit product unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $product = $this->productRepository->getById($id);
        if (is_null($product)) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $this->productRepository->delete($id);
        return response()->json(['message' => 'Product deleted successfully'], 204);
    }

//    public function fileImportIndex(): View
//    {
//
//        return view('admin.products.file');
//    }
//
//    public function fileImportUpload(ImportFileRequest $request)
//    {
//        $data =  file($request->file('file'));
////                $file = file($request->file('file'));
////
////                $chunks = array_chunk($file, 1000);
////
////                $header = [];
////                $batch = Bus::batch([ ])->dispatch();
////
////                foreach ($chunks as $key => $chunk) {
////                    $data = array_map('str_getcsv', $chunk);
////
////                    if ($key == 0) {
////                        $header = $data[0];
////                        unset($data[0]);
////                    }
////
////                    $batch->add(new ProductImportDataJob($data, $header));
////                }
//
//
//
//        $chunks = array_chunk($data, 10000);
//
//        $header = [];
//        $batch  = Bus::batch([])->dispatch();
//
//        foreach ($chunks as $key => $chunk) {
//            $data = array_map('str_getcsv', $chunk);
//
//            if ($key === 0) {
//                $header = $data[0];
//                unset($data[0]);
//            }
//
//            $batch->add(new ProductImportDataJob($data, $header));
//        }
//
//        return redirect(route('product.index'))->with('success', 'Product Import Successfully');
//
//
//    }
//    public function batch()
//    {
//        $batchId = request('id');
//        return Bus::findBatch($batchId);
//    }
//    public function export()
//    {
//        return Excel::download(new ExportProduct(), 'products.csv');
//    }

}
