<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CoachsController extends Controller
{

    public function index()
    {
        $coachs = Coach::all();
        return response()->json([
            'status'=>true,
            'date' =>$coachs,
            'message' => 'Coach Information Successfully',
        ]);
    }


    public function store(Request $request)

    {
        $data['name'] =$request->name ;
        $data['user_name'] =$request->user_name ;
        $data['phone']  =$request->phone ;
        $data['email'] =$request->email ;
        $data['subscription_number'] =$request->subscription_number ;
        $data['date_of_birth'] =$request->date_of_birth ;
        $data['start_time'] =$request->start_time ;
        $data['end_time'] =$request->end_time ;
        $data['coach_description'] =$request->coach_description ;
        $data['link_webiste']   =$request->link_webiste;
        $data['link_facebook']    =$request->link_facebook;
        $data[ 'link_twitter' ]        =$request->link_twitter;
        $data[ 'link_youtube' ]      =$request->link_youtube;
        $data['link_linkedin']    =$request->link_linkedin;
        $data['employment_type'] =$request->employment_type ? $request->start_time :Carbon::now() ;
        $data['salary_id']  = $request->salary_id ;
        $data['location_id']  = $request->location_id ;
        $data['sub_location_id']  = $request->sub_location_id ;
        $data['nationality_id']  = $request->nationality_id ;
        $data['genders_id']  = $request->genders_id ;
//dd($data);
        $coach=Coach::create($data);
   if ($coach){
       return response()->json([
           'status'=>true,
           'date' =>$coach,
           'message' => 'Coach Information Added Successfully',
       ]);
   }else{
       return response()->json([
           'status'=>false,
           'date' =>$coach,
           'message' => 'Coach Information Not Added Successfully',
       ]);
   }

    }



    public function update(Request $request)
    {
        $coach = Coach::findOrFail($request->id);
        if($coach)
        {
            $data[ 'name'] =$request->name ? $request->name : $coach->name;
            $data['user_name'] =$request->user_name ? $request->user_name : $coach->user_name;
            $data['player_id']  = $request->player_id ? $request->player_id : $coach->player_id;
            $data['phone']  =$request->phone ? $request->phone : $coach->phone;
            $data['email'] =$request->email ? $request->email : $coach->email;
            $data['link_webiste']   =$request->link_webiste;
            $data['link_facebook']    =$request->link_facebook;
            $data[ 'link_twitter' ]        =$request->link_twitter;
            $data[ 'link_youtube' ]      =$request->link_youtube;
            $data['link_linkedin']    =$request->link_linkedin;
            $data['start_time'] =$request->start_time ? $request->start_time :Carbon::now() ;
            $data['end_time'] =$request->end_time ? $request->end_time : Carbon::tomorrow() ;
            $data['salary_id']  = $request->salary_id ? $request->salary_id : $coach->salary_id;
            $data['gender_id']  = $request->gender_id ? $request->gender_id : $coach->gender_id;
            $data['location_id']  = $request->location_id ? $request->location_id : $coach->location_id;
            $data['nationality_id']  = $request->nationality_id ? $request->nationality_id : $coach->nationality_id;
            $data['date_of_birth']  = $request->date_of_birth ? $request->date_of_birth : $coach->date_of_birth;
            $data['subscription_number']  = $request->subscription_number ? $request->subscription_number : $coach->subscription_number;
            $data['employment_type']  = $request->employment_type ? $request->employment_type : $coach->employment_type;
            $data['coach_description']  = $request->coach_description ? $request->coach_description : $coach->coach_description;

            $coach->update($data);
            return response()->json([
                'status'=>true,
                'data' => $coach,
                'message' => 'Coach Information Updated Successfully',
            ]);

        }
    }


    public function show(Request $request)
    {
        $coach = Coach::findOrFail($request->id);
        return response()->json($coach);
    }


    public function destroy(Request $request)
    {
        Coach::find($request->id)->delete();
            return response()->json([
            'status'=>true,
            'message' => 'Coach Information deleted Successfully',
        ]);
    }
}





