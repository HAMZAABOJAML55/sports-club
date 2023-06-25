<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreCoachRequest;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CoachsController extends Controller
{
    use imageTrait;
    use GeneralTrait;

    public function index()
    {
        $coachs = Coach::where('club_id',Auth::user()->club_id)->get();
        return response()->json([
            'status'=>true,
            'date' =>$coachs,
            'message' => 'Coach Information Successfully',
        ]);
    }


    public function store(StoreCoachRequest $request)
    {
        DB::beginTransaction();
        try {
        $coach = new Coach();
        $coach->club_id = Auth::user()->club_id;
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
        $coach->height = $request->height;
        $coach->weight = $request->weight;
        $coach->postal_code = $request->postal_code;
        $coach->link_Instagram = $request->link_Instagram;
        $coach->coach_status = $request->coach_status;
        $coach->save();

            if ($request->hasfile('image_path')) {
                $coach_image = $this->saveImage($request->image_path, 'attachments/coachs/' .Auth::user()->club_id.'/'. $coach->id);
                $coach->image_path = $coach_image;
                $coach->save();
            }
            DB::commit();  // insert data

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
    } catch (\Throwable $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
}

    }



    public function update(StoreCoachRequest $request)
    {
        $coach = Coach::where('club_id',Auth::user()->club_id)->find($request->id);
        if(!$coach)
        {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Coach not found'
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
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
            $coach->height = $request->height;
            $coach->weight = $request->weight;
            $coach->postal_code = $request->postal_code;
            $coach->coach_status = $request->coach_status;
            $coach->link_Instagram = $request->link_Instagram;
            $coach->save();
            if ($request->hasfile('image_path')) {
                $this->deleteFile('coachs',$request->id);

                $coach_image = $this->saveImage($request->image_path, 'attachments/coachs/' .Auth::user()->club_id.'/'. $coach->id);
                $coach->image_path = $coach_image;
                $coach->save();
            }
            return response()->json([
                'status'=>true,
                'data' => $coach,
                'message' => 'Coach Information Updated Successfully',
            ]);


    }


    public function show(Request $request)
    {
        try {
            $coach = Coach::where('club_id',Auth::user()->club_id)->find($request->id);
            if(!$coach)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Coach not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json($coach);

        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        try {
            $emloyee = Coach::where('club_id',Auth::user()->club_id)->find($request->id);
            if(!$emloyee)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Coach not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $this->deleteFile('coachs',$request->id);
            $emloyee->delete();
            return response()->json([
                'status'=>true,
                'message' => 'Coach deleted Successfully',
            ]);


        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
}





