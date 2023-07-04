<?php

namespace App\Http\Controllers\coach\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingGroup;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings =Training::all();
        return view('pages.coach.dashboard.training.index' , compact('trainings'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $training_group = TrainingGroup::all();
        return view('pages.coach.dashboard.training.create', compact('training_group'));
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

            $training_groupsroup = new Training();
            $training_groupsroup->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $training_groupsroup->link_website = $request->link_website;
            $training_groupsroup->training_group_id = $request->training_group_id;
            $training_groupsroup->number = $request->number;
            $training_groupsroup->duration_of_training = $request->duration_of_training;
            $training_groupsroup->training_number = $request->training_number;
            $training_groupsroup->description = $request->description;
            $training_groupsroup->number_of_iterations = $request->number_of_iterations;
            $training_groupsroup->save();
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('coach.training.index','test');
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
        $trainings=Training::findorfail($id);
        $training_group = TrainingGroup::all();
        return view('pages.coach.dashboard.training.edit', compact('trainings' , 'training_group'));
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
            $training_groupsroup=Training::findorfail($request->id);
            $training_groupsroup->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $training_groupsroup->link_website = $request->link_website;
            $training_groupsroup->training_group_id = $request->training_group_id;
            $training_groupsroup->number = $request->number;
            $training_groupsroup->duration_of_training = $request->duration_of_training;
            $training_groupsroup->training_number = $request->training_number;
            $training_groupsroup->description = $request->description;
            $training_groupsroup->number_of_iterations = $request->number_of_iterations;
            $training_groupsroup->save();
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('coach.training.index','test');
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
            Training::destroy($request->id);
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('coach.training.index','test');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
