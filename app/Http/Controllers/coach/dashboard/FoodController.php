<?php

namespace App\Http\Controllers\coach\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreFoodRequest;
use App\Models\Food;
use App\Models\Foodsystem;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foodsystems = Foodsystem::all();
        $foods = Food::all();
        return view('pages.coach.dashboard.food.index' , compact('foodsystems', 'foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $foodsystems = Foodsystem::all();
        $foods = Food::all();
        return view('pages.coach.dashboard.food.create', compact('foodsystems', 'foods'));
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
            $food->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $food->foodsystem_id = $request->foodsystem_id;
            $food->number = $request->number;
            $food->start_time = $request->start_time;
            $food->end_time = $request->end_time;
            $food->description = $request->description;
            $food->save();
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('coach.food.index','test');
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
        $food=Food::findorfail($id);
        $foodsystems = Foodsystem::all();
        return view('pages.coach.dashboard.food.edit', compact('foodsystems', 'food'));
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
            $food = Food::findorfail($request->id);
            $food->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $food->foodsystem_id = $request->foodsystem_id;
            $food->number = $request->number;
            $food->start_time = $request->start_time;
            $food->end_time = $request->end_time;
            $food->description = $request->description;
            $food->save();
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('coach.food.index','test');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request ,$id)
    {
        try {
            Food::destroy($request->id);
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('coach.food.index','test');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }
}
