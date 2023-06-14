<?php

namespace App\Http\Controllers\employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employe;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignUpEmployeeController extends Controller
{

    public function index()
    {
        $sections=Section::all();
        return view('pages.employee.signup',compact('sections'));
    }


    public function create()
    {

    }

    public function store(StoreEmployeeRequest $request)
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
            session()->flash('Add','Welcome: '.$employees->email );
            return redirect()->route('login.show','employe');
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
    }

    public function update(Request $request, $id)
    {

    }


    public function destroy(Request $request)
    {

    }
}
