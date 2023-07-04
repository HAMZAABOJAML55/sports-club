<?php

namespace App\Http\Controllers\employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreEmployeeRequest;
use App\Http\Traits\imageTrait;
use App\Models\Club;
use App\Models\Employe;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SignUpEmployeeController extends Controller
{
    use imageTrait;

    public function index()
    {
        $sections=Section::all();
        $clubs=Club::all();
        return view('pages.employee.signup',compact('sections','clubs'));
    }


    public function create()
    {

    }

    public function store(StoreEmployeeRequest $request)
    {
        DB::beginTransaction();
        try {
            $employees  = new Employe();
            $employees->club_id = $request->club_id;
            $employees->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $employees->email = $request->email;
            $employees->password = Hash::make($request->password);
            $employees->section_id = $request->section_id;
            $employees->description = $request->description;
            $employees->full_description = $request->full_description;
            $employees->date_of_birth = $request->date_of_birth;
//            $employees->emp_id = $request->emp_id;
//            $employees->emp_status = $request->emp_status;
            $employees->national_id = $request->national_id;
            $employees->start_time_shift = $request->start_time_shift;
            $employees->end_time_shift = $request->end_time_shift;
            $employees->total_salary = $request->total_salary;
            $employees->save();
            if ($request->hasfile('image_path')) {
                $employee_image = $this->saveImage($request->image_path, 'attachments/employees/' .$request->club_id.'/'. $employees->id);
                $employees->image_path = $employee_image;
                $employees->save();
            }
            DB::commit();  // insert data

            session()->flash('Add','Welcome: '.$employees->email );

            return redirect()->route('login.show','employe');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {

    }


    public function destroy(Request $request)
    {

    }
}
