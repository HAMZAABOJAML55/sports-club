<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Subscribe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SubscribeController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $subscribe =Subscribe::all();
        return response()->json($subscribe);
    }
    public function store(Request $request):  JsonResponse
    {
        try {
            $rules = [
                "monthly" => "string|max:15",
                "yearly" => "string|max:15",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $subscribe = new Subscribe();
            $subscribe->monthly = $request->monthly;
            $subscribe->yearly = $request->yearly;
//            $subscribe->status = $request->status;
            $subscribe->save();

            return response()->json([
                'status'=>true,
                'message' => 'Subscribes Add Successfully',
                'data' =>$subscribe,
            ],201);

        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function show(Request $request)
    {
        try {
            $subscribe = Subscribe::find($request->id);
            if(!$subscribe)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Subscribe not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json($subscribe);

        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function update(Request $request)
    {
        try {
            $rules = [
                "monthly" => "string|max:15",
                "yearly" => "string|max:15",
                "status" => "integer|max:1",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $subscribe=Subscribe::find($request->id);
            if (!$subscribe){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'subscribe not found id'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $subscribe->monthly = $request->monthly;
            $subscribe->yearly = $request->yearly;
            $subscribe->status = $request->status;

            $subscribe->save();
            return response()->json([
                'status'=>true,
                'message' => 'Subscribes Add Successfully',
                'data' =>$subscribe,
            ],201);

        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }


    public function destroy(Request $request)
    {
        try {
            $subscribe = Subscribe::find($request->id);
            if(!$subscribe)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Subscribe not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $subscribe->delete();
            return response()->json([
                'status'=>true,
                'message' => 'subscribe deleted Successfully',
            ]);
        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
