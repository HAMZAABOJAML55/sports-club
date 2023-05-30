<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscripeRequest;
use App\Models\Subscripe;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SubscripesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscripes = Subscripe::all();
        return response()->json($subscripes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscripeRequest $request)
    {
        $data[ 'name'] =$request->name ;
        $data['user_name'] =$request->user_name ;
        $data['phone']  = $request->player_id ;
        $data['email']  =$request->email  ;
        $data['subscription_number'] =$request->subscription_number ;
        $data['link_website']   =$request->link_website;
        $data['link_facebook']    =$request->link_facebook;
        $data[ 'link_twitter' ]        =$request->link_twitter;
        $data[ 'link_youtupe' ]      =$request->link_youtupe;
        $data['start_time'] =$request->start_time  ;
        $data['end_time'] =$request->end_time ;
        $data['player_id']  = $request->player_id ;
        $data['location_id']  = $request->location_id ;
        $data['nationality_id']  = $request->nationality_id ;
        $data['date_of_birth']  = $request->date_of_birth ;
        $data['coach_description']  = $request->coach_description;
        $data['employment_type']  = $request->employment_type ;

        $subscripe=Subscripe::create($data);
        return response()->json([
            'status'=>true,
            'date' =>$subscripe,
            'message' => 'Subscripe Information Added Successfully',
    ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $subscripe = Subscripe::findOrFail($request->id);
            return response()->json($subscripe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSubscripeRequest $request, $id)
    {

        $subscripe = Subscripe::findOrFail($id);

        if($subscripe)
        {
            $data[ 'name'] =$request->name ;
            $data['user_name'] =$request->user_name ;
            $data['phone']  = $request->phone ;
            $data['email']  =$request->email  ;
            $data['subscription_number'] =$request->subscription_number ;
            $data['link_website']   =$request->link_website;
            $data['link_facebook']    =$request->link_facebook;
            $data[ 'link_twitter' ]        =$request->link_twitter;
            $data[ 'link_youtupe' ]      =$request->link_youtupe;
            $data['start_time'] =$request->start_time  ;
            $data['end_time'] =$request->end_time ;
            $data['player_id']  = $request->player_id ;
            $data['location_id']  = $request->location_id ;
            $data['nationality_id']  = $request->nationality_id ;
            $data['date_of_birth']  = $request->date_of_birth ;
            $data['coach_description']  = $request->coach_description;
            $data['employment_type']  = $request->employment_type ;
            $subscripe->update($data);
            return response()->json([
                'status'=>true,
                'data' => $subscripe,
                'message' => 'Subscripe Information Updated Successfully',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Subscripe::find($request->id)->delete();
            return response()->json([
            'status'=>true,
            'message' => 'Subscripe Information deleted Successfully',
        ]);
    }
}
