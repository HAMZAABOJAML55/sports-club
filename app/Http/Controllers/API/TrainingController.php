<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
//use App\Http\Requests\api\StoreTraineeRequest;
use App\Http\Requests\api\StoreTrainininRequest;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TrainingController extends Controller
{
use GeneralTrait;
use imageTrait;
    public function index()
    {
        $trainings = Training::where('club_id',Auth::user()->club_id)->get();
        return response()->json($trainings);
    }

    public function store(StoreTrainininRequest $request)
    {
        try {
            $training = new Training();
            $training->club_id = Auth::user()->club_id;
            $training->number = $request->number;
            $training->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $training->description = $request->description;
            $training->training_group_id = $request->training_group_id;
            $training->link_website = $request->link_website;
            $training->duration_of_training = $request->duration_of_training;
            $training->training_number = $request->training_number;
            $training->number_of_iterations = $request->number_of_iterations;
            $training->save();
            if ($request->hasfile('image_path')) {
                $_image = $this->saveImage($request->image_path, 'attachments/trainings/'.Auth::user()->club_id.'/'. $training->id);
                $training->image_path = $_image;
                $training->save();
            }
            return response()->json([
                'status' => true,
                'date' => $training,
                'message' => 'Training Information Added Successfully',
            ]);
        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function show(Request $request)
    {
        $training= Training::where('club_id',Auth::user()->club_id)->find($request->id);
        if (!$training) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Training not found',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        return response()->json([
            'status' => true,
            'data' => $training
        ]);
    }

    public function update(StoreTrainininRequest $request)
    {
        try {
            $training = Training::where('club_id',Auth::user()->club_id)->find($request->id);
            if (!$training) {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Training not found',
                    'data' => []
                ], ResponseAlias::HTTP_NOT_FOUND);
            }

            $training->club_id = Auth::user()->club_id;
            $training->number = $request->number;
            $training->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $training->description = $request->description;
            $training->training_group_id = $request->training_group_id;
            $training->link_website = $request->link_website;
            $training->duration_of_training = $request->duration_of_training;
            $training->training_number = $request->training_number;
            $training->number_of_iterations = $request->number_of_iterations;
            $training->save();
            if ($request->hasfile('image_path')) {
                $this->deleteFile('trainings',$request->id);
                $_image = $this->saveImage($request->image_path, 'attachments/trainings/'.Auth::user()->club_id.'/'. $training->id);
                $training->image_path = $_image;
                $training->save();
            }
            return response()->json([
                'status' => true,
                'date' => $training,
                'message' => 'Training Information Updated Successfully',
            ]);
        } catch (\Throwable $ex) {
            //            وهنا يعمل رجوع عن الحفظ
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        $training= Training::where('club_id',Auth::user()->club_id)->find($request->id);
        if (!$training) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Training not found',
                'data' => []
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        $this->deleteFile('trainings',$request->id);
        $training->delete();
        return response()->json([
            'status' => true,
            'message' => 'Training Information deleted Successfully',
        ]);
    }
}
