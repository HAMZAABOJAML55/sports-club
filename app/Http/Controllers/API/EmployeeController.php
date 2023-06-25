<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreEmployeeRequest;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Employe;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class EmployeeController extends Controller
{
    use GeneralTrait;
    use imageTrait;

    public function index()
    {

        $employee =Employe::where('club_id',Auth::user()->club_id)->get();
        return response()->json($employee);
    }
    public function store(StoreEmployeeRequest $request):  JsonResponse
    {
        DB::beginTransaction();
        try {
            $section=Section::where('club_id',Auth::user()->club_id)->find($request->section_id);
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
//            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->national_id = $request->national_id;
            $employee->description = $request->description;
            $employee->full_description = $request->full_description;
            $employee->section_id = $request->section_id;
            $employee->emp_id = $request->emp_id;
            $employee->password = Hash::make($request->password);
            $employee->date_of_birth = $request->date_of_birth;
            $employee->emp_status = $request->emp_status;
            $employee->save();

            if ($request->hasfile('image_path')) {
                $employee_image = $this->saveImage($request->image_path, 'attachments/employees/' .Auth::user()->club_id.'/'. $employee->id);
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
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function show(Request $request)
    {
        try {
            $employee = Employe::where('club_id',Auth::user()->club_id)->find($request->id);
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
            $club_auth=Employe::where('club_id',Auth::user()->club_id)->first();
            if (!$club_auth){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'You are not Auth to this'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }

            $section=Section::where('club_id',Auth::user()->club_id)->find($request->section_id);
            if (!$section){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Section not found id'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $employee=Employe::where('club_id',Auth::user()->club_id)->find($request->id);
            if (!$employee){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'employee not found id'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $employee->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
//            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->national_id = $request->national_id;
            $employee->description = $request->description;
            $employee->full_description = $request->full_description;
            $employee->section_id = $request->section_id;
            $employee->emp_id = $request->emp_id;
            $employee->password = Hash::make($request->password);
            $employee->date_of_birth = $request->date_of_birth;
            $employee->emp_status = $request->emp_status;
            $employee->save();

            if ($request->hasfile('image_path')) {
                $this->deleteFile('employees',$request->id);
                $employee_image = $this->saveImage($request->image_path, 'attachments/employees/' .Auth::user()->club_id.'/'. $employee->id);
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
            $employee = Employe::where('club_id',Auth::user()->club_id)->find($request->id);
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
