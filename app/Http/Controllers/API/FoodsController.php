<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreFoodRequest;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FoodsController extends Controller
{
    use GeneralTrait;
    use imageTrait;
    public function index()
    {
        $foods = Food::where('club_id',Auth::user()->club_id)->get();
        return response()->json([
            'status' => 'successfully',
            'status_code'=>ResponseAlias::HTTP_OK,
            'data' => $foods ?:[]
        ], ResponseAlias::HTTP_OK);
    }

    public function store(StoreFoodRequest $request)
    {
        DB::beginTransaction();
        try {
            $food = new Food();
            $food->club_id = Auth::user()->club_id;

            $food->name =  ['en' => $request->name_en, 'ar' => $request->name_ar];
            $food->description = $request->description;
            $food->start_time = $request->start_time;
            $food->end_time = $request->end_time;
            $food->components_of_the_diet = $request->components_of_the_diet;
            $food->foodsystem_id = $request->foodsystem_id;
            $food->number = $request->number;
            $food->mail_rating = $request->mail_rating;

            $food->save();
            if ($request->hasfile('image_path')) {
                $_image = $this->saveImage($request->image_path, 'attachments/foods/' .Auth::user()->club_id.'/'. $food->id);
                $food->image_path = $_image;
                $food->save();
            }
            DB::commit();  // insert data
            return response()->json([
                'status' => true,
                'date' => $food ?:[],
                'message' => 'Food Information Added Successfully',
            ]);
        } catch (\Throwable $ex) {
            //            وهنا يعمل رجوع عن الحفظ
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function show(Request $request)
    {
        $food= Food::where('club_id',Auth::user()->club_id)->find($request->id);
        if (!$food) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'food not found',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        return response()->json([
            'status' => true,
            'data' => $food
        ]);
    }

    public function update(StoreFoodRequest $request)
    {
        DB::beginTransaction();
        try {
            $food = Food::where('club_id',Auth::user()->club_id)->find($request->id);
            if (!$food) {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'food not found',
                    'data' => []
                ], ResponseAlias::HTTP_NOT_FOUND);
            }

            $food->club_id = Auth::user()->club_id;
            $food->name =  ['en' => $request->name_en, 'ar' => $request->name_ar];
            $food->description = $request->description;
            $food->start_time = $request->start_time;
            $food->end_time = $request->end_time;
            $food->components_of_the_diet = $request->components_of_the_diet;
            $food->foodsystem_id = $request->foodsystem_id;
            $food->number = $request->number;
            $food->mail_rating = $request->mail_rating;

            $food->save();
            if ($request->hasfile('image_path')) {
                $this->deleteFile('foods',$request->id);
                $_image = $this->saveImage($request->image_path, 'attachments/foods/'.Auth::user()->club_id.'/' . $food->id);
                $food->image_path = $_image;
                $food->save();
            }
            DB::commit();  // insert data
            return response()->json([
                'status' => true,
                'date' => $food,
                'message' => 'Food Information Updated Successfully',
            ]);
        } catch (\Throwable $ex) {
            //            وهنا يعمل رجوع عن الحفظ
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        $food= Food::where('club_id',Auth::user()->club_id)->find($request->id);
        if (!$food) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'food not found',
                'data' => []
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        $this->deleteFile('foods',$request->id);
        $food->delete();
        return response()->json([
            'status' => true,
            'message' => 'Food Information deleted Successfully',
        ]);
    }
}
