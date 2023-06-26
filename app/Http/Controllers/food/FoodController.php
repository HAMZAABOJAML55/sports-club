<?php

namespace App\Http\Controllers\food;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreFoodRequest;
use App\Http\Traits\imageTrait;
use App\Models\Food;
use App\Models\Foodsystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    use imageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foodsystems = Foodsystem::all();
        $foods = Food::where('club_id',Auth::user()->club_id)->get();
        return view('pages.food.index' , compact('foodsystems', 'foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foodsystems = Foodsystem::all();
        return view('pages.food.create', compact('foodsystems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFoodRequest $request)
    {
        try {
            $food = new Food();
            $food->club_id = Auth::user()->club_id;
            $food->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $food->foodsystem_id = $request->foodsystem_id;
            $food->number = $request->number;
            $food->start_time = $request->start_time;
            $food->end_time = $request->end_time;
            $food->description = $request->description;
//            $food->components_of_the_diet = $request->components_of_the_diet;
            if ($request->hasfile('image_path')) {
                $_image = $this->saveImage($request->image_path, 'attachments/foods/' .Auth::user()->club_id.'/'. $food->id);
                $food->image_path = $_image;
                $food->save();
            }
            $food->save();
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('food.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {

        $food=Food::where('club_id',Auth::user()->club_id)->find($id);
        $foodsystems = Foodsystem::all();
        return view('pages.food.edit', compact('foodsystems', 'food'));
    }

    public function update(Request $request)
    {
        try {
            $food = Food::where('club_id',Auth::user()->club_id)->find($request->id);
            $food->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $food->foodsystem_id = $request->foodsystem_id;
            $food->number = $request->number;
            $food->start_time = $request->start_time;
//            $food->components_of_the_diet = $request->components_of_the_diet;
            $food->end_time = $request->end_time;
            $food->description = $request->description;
            $food->save();
            if ($request->hasfile('image_path')) {
                $this->deleteFile('foods',$request->id);
                $_image = $this->saveImage($request->image_path, 'attachments/foods/' .Auth::user()->club_id.'/'. $food->id);
                $food->image_path = $_image;
                $food->save();
            }
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('food.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $food = Food::where('club_id',Auth::user()->club_id)->find($request->id);
            $this->deleteFile('foods',$request->id);
            $food->delete();

            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('food.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
