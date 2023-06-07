<?php

namespace App\Http\Controllers\employee;
use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees=Employe::all();
        return view('pages.Employee.index' , compact('employees'));
    }


    public function create()
    {
        $sections=Section::all();
        return view('pages.employee.create',compact('sections'));
    }

    public function store(Request $request)
    {
        try {
            $employees  = new Employe();
            $employees->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $employees->email = $request->email;
            $employees->password = Hash::make($request->password);
            $employees->number = $request->number;
            $employees->section_id = $request->section_id;
            $employees->description = $request->description;
            $employees->full_description = $request->full_description;
            $employees->date_of_birth = $request->date_of_birth;
            $employees->emp_id = $request->emp_id;
            $employees->save();
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $employees = Employe::findorfail($id) ;
        $sections=Section::all();
        return view('pages.employee.edit', compact('employees','sections'));
    }

    public function update(Request $request, $id)
    {
        try {
            $employees =Employe::findorfail($request->id);
            $employees->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $employees->email = $request->email;
            $employees->password = Hash::make($request->password);
            $employees->number = $request->number;
            $employees->section_id = $request->section_id;
            $employees->description = $request->description;
            $employees->full_description = $request->full_description;
            $employees->date_of_birth = $request->date_of_birth;
            $employees->emp_id = $request->emp_id;
            $employees->save();
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            Employe::destroy($request->id);
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
