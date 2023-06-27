<?php

namespace App\Http\Controllers\employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreEmployeeRequest;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Employe;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    use GeneralTrait;
    use imageTrait;

    public function index()
    {
        $employees=Employe::where('club_id',Auth::user()->club_id)->get();
        return view('pages.employee.index' , compact('employees'));
    }


    public function create()
    {
        $sections=Section::where('club_id',Auth::user()->club_id)->get();
        return view('pages.employee.create',compact('sections'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        DB::beginTransaction();
        try {
            $employees  = new Employe();
            $employees->club_id = Auth::user()->club_id;
            $employees->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $employees->email = $request->email;
            $employees->password = Hash::make($request->password);
            $employees->section_id = $request->section_id;
            $employees->description = $request->description;
            $employees->full_description = $request->full_description;
            $employees->date_of_birth = $request->date_of_birth;
            $employees->emp_id = $request->emp_id;
            $employees->emp_status = $request->emp_status;
            $employees->national_id = $request->national_id;
            $employees->save();
            if ($request->hasfile('image_path')) {
                $employee_image = $this->saveImage($request->image_path, 'attachments/employees/' .Auth::user()->club_id.'/'. $employees->id);
                $employees->image_path = $employee_image;
                $employees->save();
            }
            DB::commit();  // insert data

            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('employee.index');
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
        $employees = Employe::where('club_id',Auth::user()->club_id)->findorfail($id) ;
        $sections=Section::where('club_id',Auth::user()->club_id)->get();
        return view('pages.employee.edit', compact('employees','sections'));
    }

    public function update(Request $request, $id)
    {
        try {
            $employees =Employe::where('club_id',Auth::user()->club_id)->find($request->id);
            $employees->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $employees->email = $request->email;
            $employees->password = Hash::make($request->password);
            $employees->section_id = $request->section_id;
            $employees->description = $request->description;
            $employees->full_description = $request->full_description;
            $employees->date_of_birth = $request->date_of_birth;
            $employees->emp_id = $request->emp_id;
            $employees->emp_status = $request->emp_status;
            $employees->national_id = $request->national_id;
            $employees->save();
            if ($request->hasfile('image_path')) {
                $this->deleteFile('employees',$request->id);
                $_image = $this->saveImage($request->image_path, 'attachments/employees/' .Auth::user()->club_id.'/'. $employees->id);
                $employees->image_path = $_image;
                $employees->save();
            }
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            Employe::where('club_id',Auth::user()->club_id)->destroy($request->id);
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
