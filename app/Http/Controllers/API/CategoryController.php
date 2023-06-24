<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Category;
use App\Models\Foodsystem;
use App\Models\Prof;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CategoryController extends Controller
{
    use GeneralTrait;
    use imageTrait;
    public function index()
    {

        $category =Category::where('club_id',Auth::user()->club_id)->get();
        return response()->json($category);
    }
    public function store(Request $request):  JsonResponse
    {
        DB::beginTransaction();
        try {
            $prof_id=Prof::find($request->prof_id);
            if (!$prof_id){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'this Id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $category = new Category();
            $category->club_id = Auth::user()->club_id;
            $category->prof_id = $request->prof_id;
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();

            if ($request->hasfile('image_path')) {
                $category_image = $this->saveImage($request->image_path, 'attachments/categorys/' . $category->id);
                $category->image_path = $category_image;
                $category->save();
            }
            DB::commit();  // insert data

            return response()->json([
                'status'=>true,
                'message' => 'Categoryes Add Successfully',
                'data' =>$category,
            ],201);

        } catch (\Throwable $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function show(Request $request)
    {
        try {
            $category = Category::where('club_id',Auth::user()->club_id)->find($request->id);
            if(!$category)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Category not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json($category);

        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }


    public function update(Request $request)
    {
        try {
            $prof_id=Prof::find($request->prof_id);
            if (!$prof_id){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'this Id not found '
                ], ResponseAlias::HTTP_NOT_FOUND);
            }

            $category=Category::where('club_id',Auth::user()->club_id)->find($request->id);
            if (!$category){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'category not found id'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $category->prof_id = $request->prof_id;
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();

            if ($request->hasfile('image_path')) {
                $this->deleteFile('categorys',$request->id);
                $category_image = $this->saveImage($request->image_path, 'attachments/categorys/' . $category->id);
                $category->image_path = $category_image;
                $category->save();
            }
            DB::commit();  // insert data

            return response()->json([
                'status'=>true,
                'message' => 'Categoryes Add Successfully',
                'data' =>$category,
            ],201);

        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }


    public function destroy(Request $request)
    {
        try {
            $category = Category::where('club_id',Auth::user()->club_id)->find($request->id);
            if(!$category)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Categorye not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $this->deleteFile('categorys',$request->id);
            $category->delete();
            return response()->json([
                'status'=>true,
                'message' => 'category deleted Successfully',
            ]);


        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
