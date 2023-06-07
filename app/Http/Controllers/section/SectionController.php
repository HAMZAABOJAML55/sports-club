<?php

namespace App\Http\Controllers\section;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return view('pages.section.index', compact('sections'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $sections = Section::all();
        return view('pages.section.create', compact('sections'));
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
            $sections = new Section();
            $sections->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $sections->number = $request->number;
            $sections->section_description = $request->section_description;
            $sections->department_address = $request->department_address;
            $sections->save();
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('section.index');
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
        $sections=Section::findorfail($id);
        return view('pages.section.create', compact('sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $sections = new Section();
            $sections->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $sections->number = $request->number;
            $sections->section_description = $request->section_description;
            $sections->department_address = $request->department_address;
            $sections->save();
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('section.index');
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
            Section::destroy($request->id);
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('section.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
