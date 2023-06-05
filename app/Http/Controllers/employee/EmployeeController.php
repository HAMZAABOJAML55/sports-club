<?php

namespace App\Http\Controllers\employee;
use App\Http\Controllers\Controller;
use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees=Employe::all();
        return view('pages.Employee.index' , compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $employees  = new Employe();
            $employees->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $employees->email = $request->email;
            $employees->password = $request->password;
            $employees->number = $request->number;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employe::findorfail($id) ; 
        return view('pages.employee.edit', compact('employees'));
    }

    public function update(Request $request, $id)
    {
        try {
            $employees = new Employe();
            $employees->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $employees->email = $request->email;
            $employees->password = $request->password;
            $employees->number = $request->number;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
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
