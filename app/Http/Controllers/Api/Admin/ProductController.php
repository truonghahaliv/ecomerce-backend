<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
//        $products = Cache::remember('products', 60, function () {
//            return Product::paginate(1000);
//        });
        $products = $this->productRepository->index();
        Cache::put('product', $products, 60);
        return response()->json($products, 200);
    }


    public function show($id)
    {
       $product =$this->productRepository->getById($id);
//
        if (is_null($product)) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product, 200);
    }

    public function store(StoreProductRequest $request)
    {
        Log::info('Request data:', $request->all());
        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('product_images', 'public');
            }
            $product = $this->productRepository->create($data);
            //   $this->productRepository->store($data);
            $categories = json_decode($request->categories);
            $product->categories()->sync($categories);

            return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error creating product:', ['message' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(StoreProductRequest $request, $id)
    {
        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('product_images', 'public');
            }
            $product = $this->productRepository->update($id, $data);
            $product->categories()->sync($request->categories);
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
        try {
            $product = $this->productRepository->getById($id);
            if (is_null($product)) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            $this->productRepository->delete($id);
            return response()->json(['message' => 'Product deleted successfully', 'status' => 204]
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Edit product unsuccessful',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
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
