<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Employe;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class EmployeeController extends Controller
{
    use GeneralTrait;
    use imageTrait;
    public function index()
    {
        $employee =Employe::all();
        return response()->json($employee);
    }
    public function store(StoreEmployeeRequest $request):  JsonResponse
    {
        DB::beginTransaction();
        try {
            $section=Section::find($request->section_id);
            if (!$section){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Section not found id'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $employee = new Employe();
            $employee->club_id = Auth::user()->club_id;
            $employee->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $employee->email = $request->email;
            $employee->number = $request->number;
            $employee->description = $request->description;
            $employee->full_description = $request->full_description;
            $employee->section_id = $request->section_id;
            $employee->emp_id = $request->emp_id;
            $employee->password = Hash::make($request->password);
            $employee->date_of_birth = $request->date_of_birth;
            $employee->save();

            $employee_image = $this->saveImage($request->image_path,'attachments/employees/'.$employee->id);
            $employee->image_path = $employee_image;
            $employee->save();
            DB::commit();  // insert data

            return response()->json([
                'status'=>true,
                'message' => 'Employees Add Successfully',
                'data' =>$employee,
            ],201);

        } catch (\Throwable $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function show(Request $request)
    {
        try {
            $employee = Employe::find($request->id);
            if(!$employee)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Employee not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json($employee);

        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }


    public function update(StoreEmployeeRequest $request)
    {
        try {
            $section=Section::find($request->section_id);
            if (!$section){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Section not found id'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $employee=Section::find($request->section_id);
            if (!$employee){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'employee not found id'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $employee->club_id = Auth::user()->club_id;
            $employee->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $employee->email = $request->email;
            $employee->number = $request->number;
            $employee->description = $request->description;
            $employee->full_description = $request->full_description;
            $employee->section_id = $request->section_id;
            $employee->emp_id = $request->emp_id;
            $employee->password = Hash::make($request->password);
            $employee->date_of_birth = $request->date_of_birth;
            $employee->save();
            if ($request->hasfile('image_path')) {
                $employee_image = $this->saveImage($request->image_path, 'attachments/employees/' . $employee->id);
                $employee->image_path = $employee_image;
                $employee->save();
            }
            DB::commit();  // insert data

            return response()->json([
                'status'=>true,
                'message' => 'Employees Add Successfully',
                'data' =>$employee,
            ],201);

        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }


    public function destroy(Request $request)
    {
        try {
            $employee = Employe::find($request->id);
            if(!$employee)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Employee not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $this->deleteFile('employees',$request->id);
            $employee->delete();
            return response()->json([
                'status'=>true,
                'message' => 'employee deleted Successfully',
            ]);


        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }
}
