<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Diet_Plan;
use App\Models\Foodsystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DietPlanController extends Controller
{
    use GeneralTrait;
    use imageTrait;
    public function index()
    {
        $DietPlan =Diet_Plan::where('club_id',Auth::user()->club_id)->get();
        return response()->json($DietPlan);
    }
    public function store(Request $request):  JsonResponse
    {
        DB::beginTransaction();
        try {
            $foodsystem_id=Foodsystem::find($request->foodsystem_id);
            if (!$foodsystem_id){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'this Id not found of the Meal'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $DietPlan = new Diet_Plan();
            $DietPlan->club_id = Auth::user()->club_id;
            $DietPlan->foodsystem_id = $request->foodsystem_id;
            $DietPlan->name = $request->name;
            $DietPlan->save();

            if ($request->hasfile('image_path')) {
                $DietPlan_image = $this->saveImage($request->image_path, 'attachments/DietPlans/' .Auth::user()->club_id.'/'. $DietPlan->id);
                $DietPlan->image_path = $DietPlan_image;
                $DietPlan->save();
            }
            DB::commit();  // insert data

            return response()->json([
                'status'=>true,
                'message' => 'Diet_Planes Add Successfully',
                'data' =>$DietPlan,
            ],201);

        } catch (\Throwable $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function show(Request $request)
    {
        try {
            $DietPlan = Diet_Plan::where('club_id',Auth::user()->club_id)->find($request->id);
            if(!$DietPlan)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Diet_Plane not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json($DietPlan);

        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }


    public function update(Request $request)
    {
        try {
            $foodsystem_id=Foodsystem::find($request->foodsystem_id);
            if (!$foodsystem_id){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'this Id not found of the Meal'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }

            $DietPlan=Diet_Plan::where('club_id',Auth::user()->club_id)->find($request->id);
            if (!$DietPlan){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'DietPlan not found id'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $DietPlan->foodsystem_id = $request->foodsystem_id;
            $DietPlan->name = $request->name;
            $DietPlan->save();

            if ($request->hasfile('image_path')) {
                $this->deleteFile('DietPlans',$request->id);
                $DietPlan_image = $this->saveImage($request->image_path, 'attachments/DietPlans/'.Auth::user()->club_id.'/' . $DietPlan->id);
                $DietPlan->image_path = $DietPlan_image;
                $DietPlan->save();
            }
            DB::commit();  // insert data

            return response()->json([
                'status'=>true,
                'message' => 'Diet_Planes Add Successfully',
                'data' =>$DietPlan,
            ],201);

        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }


    public function destroy(Request $request)
    {
        try {
            $DietPlan = Diet_Plan::where('club_id',Auth::user()->club_id)->find($request->id);
            if(!$DietPlan)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Diet_Plane not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $this->deleteFile('DietPlans',$request->id);
            $DietPlan->delete();
            return response()->json([
                'status'=>true,
                'message' => 'DietPlan deleted Successfully',
            ]);


        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
