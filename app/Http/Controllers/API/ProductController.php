<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProductController extends Controller
{
    use GeneralTrait;
    use imageTrait;
    public function index()
    {
        $products = Product::where('club_id',Auth::user()->club_id);
        return response()->json([ 'date' =>ProductResource::collection($products->get()),

        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'name_ar'   => 'required|string|max:60',
                'name_en'   => 'required|string|max:60',
                'product_types_id'   => 'required',
                'description'   => 'string|max:200',
                'price'   => 'integer',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $product = new Product();
            $product->club_id = Auth::user()->club_id;

            $product->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $product->description = $request->description;
            $product->price = $request->price;
            $product->product_types_id = $request->product_types_id;
            $product->save();

            // Insert img in the server
            if ($request->hasfile('images')) {

                foreach ($request->file('images') as $file) {
                    $name = $this->saveImage($file, 'attachments/product/' . $product->id);
                    $images = new Image();
                    $images->file_name = $name;
                    $images->imageable_id = $product->id;
                    $images->imageable_type = 'App\Models\Product';
                    $images->save();
                }
            }

            DB::commit();  // insert data
            return response()->json([
                'status'=>true,
                'date' =>new ProductResource($product),
                'message' => 'product  Added Successfully',
            ]);
        } catch (\Throwable $ex) {
            //            وهنا يعمل رجوع عن الحفظ
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function show(Request $request)
    {
        $product = Product::where('club_id',Auth::user()->club_id)->find($request->id);
        return response()->json([
            'status'=>true,
            'date' =>new ProductResource($product),
            'message' => 'product Successfully',
        ]);
    }


    public function update(StoreProductRequest $request)
    {

        DB::beginTransaction();
        try {
            $product = Product::where('club_id',Auth::user()->club_id)->find($request->id);
            $product->club_id = Auth::user()->club_id;
            $product->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $product->description = $request->description;
            $product->price = $request->price;
            $product->product_types_id = $request->product_types_id;
            $product->save();

            // insert img
            if($request->hasfile('images')) {
                $images=Image::where('imageable_id',$request->id);
                if ($images){
                    $this->deleteFileApi('product',$request->id);
                    $images->delete();
                }
                foreach ($request->file('images') as $file) {
                    $name = $this->saveImage($file, 'attachments/product/' . $product->id);
                    $images = new Image();
                    $images->file_name = $name;
                    $images->imageable_id = $product->id;
                    $images->imageable_type = 'App\Models\Product';
                    $images->save();
                }
            }

            DB::commit();  // insert data
            return response()->json([
                'status'=>true,
                'date' =>new ProductResource($product),
                'message' => 'product updated Successfully',
            ]);
        } catch (\Throwable $ex) {
            //            وهنا يعمل رجوع عن الحفظ
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }


    public function destroy(Request $request)
    {
            $products = Product::where('club_id',Auth::user()->club_id)->find($request->id);
            if (!$products) {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'couch not found',
                    'data' => []
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $images=Image::where('imageable_id',$request->id);
            if ($images){
                $this->deleteFileApi('product',$request->id);
                $images->delete();
            }
            $products->delete();
            return response()->json([
                'status'=>true,
                'message' => 'product deleted Successfully',
            ]);

    }
}
