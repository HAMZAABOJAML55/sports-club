<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

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
        $coach = new Coach();
        $coach->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $coach->user_name = $request->user_name;
        $coach->phone = $request->phone;
        $coach->email = $request->email;
        $coach->password = Hash::make($request->password);
        $coach->subscription_number = $request->subscription_number;
        $coach->salary = $request->salary;
        $coach->date_of_birth = $request->date_of_birth;
        $coach->start_time = $request->start_time;
        $coach->end_time = $request->end_time;
        $coach->link_website = $request->link_website;
        $coach->link_facebook = $request->link_facebook;
        $coach->link_twitter = $request->link_twitter;
        $coach->link_youtupe = $request->link_youtupe;
        $coach->employment_type_id = $request->employment_type_id;
        $coach->profs_id = $request->profs_id;
        $coach->location_id = $request->location_id;
        $coach->sub_location_id = $request->sub_location_id;
        $coach->coach_description = $request->coach_description;
        $coach->nationality_id = $request->nationality_id;
        $coach->genders_id = $request->genders_id;
        $coach->save();
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
            $coach->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $coach->user_name = $request->user_name;
            $coach->phone = $request->phone;
            $coach->email = $request->email;
            $coach->password = Hash::make($request->password);
            $coach->subscription_number = $request->subscription_number;
            $coach->salary = $request->salary;
            $coach->date_of_birth = $request->date_of_birth;
            $coach->start_time = $request->start_time;
            $coach->end_time = $request->end_time;
            $coach->link_website = $request->link_website;
            $coach->link_facebook = $request->link_facebook;
            $coach->link_twitter = $request->link_twitter;
            $coach->link_youtupe = $request->link_youtupe;
            $coach->employment_type_id = $request->employment_type_id;
            $coach->profs_id = $request->profs_id;
            $coach->location_id = $request->location_id;
            $coach->sub_location_id = $request->sub_location_id;
            $coach->coach_description = $request->coach_description;
            $coach->nationality_id = $request->nationality_id;
            $coach->genders_id = $request->genders_id;
            $coach->save();
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





