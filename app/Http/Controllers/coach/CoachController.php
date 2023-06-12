<?php

namespace App\Http\Controllers\coach;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoachRequest;
use App\Http\Traits\imageTrait;
use App\Models\Coach;
use App\Models\Employment_type;
use App\Models\Gender;
use App\Models\Location;
use App\Models\Natinality;
use App\Models\Prof;
use App\Models\Sub_Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CoachController extends Controller
{

    public function index()
    {
        $coachs=Coach::all();
        return view('pages.coach.index', compact('coachs'));

    }


    public function create()
    {

        $nationals=Natinality::all();
        $Genders=Gender::all();
        $locations=Location::all();
        $sub_locations=Sub_Location::all();
        $Employment_Types=Employment_type::all();
        $profs_degrees=Prof::all();
        return view('pages.coach.create', compact('profs_degrees','Employment_Types','nationals','Genders','locations','sub_locations'));
    }

    use imageTrait;

    public function store(StoreCoachRequest $request)
    {
        try {
            $coach_image = $this->saveImage($request->image,'attachments/coachs/'.$request->user_name);
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
            $coach->image_path = $coach_image;
            $coach->save();
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('coach.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $coach=Coach::findorfail($id);
        $nationals=Natinality::all();
        $Genders=Gender::all();
        $locations=Location::all();
        $sub_locations=Sub_Location::all();
        $Employment_Types=Employment_type::all();
        $profs_degrees=Prof::all();
        return view('pages.coach.edit', compact('coach','profs_degrees','Employment_Types','nationals','Genders','locations','sub_locations'));
    }

    public function update(Request $request, $id)
    {
        try {
//            return $request->id;
            $coach =Coach::findorfail($request->id);
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
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('coach.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $this->deleteFile('coachs',$request->user_name);
            Coach::destroy($request->id);
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('coach.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
