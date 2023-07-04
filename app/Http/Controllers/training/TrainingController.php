<?php

namespace App\Http\Controllers\training;
use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\Training;
use App\Models\TrainingGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{
    use imageTrait;
    public function index()
    {
        $trainings =Training::where('club_id',Auth::user()->club_id)->get();
        return view('pages.training.index' , compact('trainings'));

    }

    public function create()
    {
        $training_group = TrainingGroup::all();
        return view('pages.training.create', compact('training_group'));
    }

    public function store(Request $request)
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
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('training.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $trainings=Training::where('club_id',Auth::user()->club_id)->find($id);
        $training_group = TrainingGroup::all();
        return view('pages.training.edit', compact('trainings' , 'training_group'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $training=Training::where('club_id',Auth::user()->club_id)->find($request->id);
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
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('training.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $training = Training::where('club_id',Auth::user()->club_id)->find($request->id);
            $this->deleteFile('trainings',$request->id);
            $training->delete();
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('training.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
