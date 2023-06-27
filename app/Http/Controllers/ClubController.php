<?php

namespace App\Http\Controllers;

use App\Http\Traits\imageTrait;
use App\Models\Club;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ClubController extends Controller
{
    use imageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(Club $club)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
        $club=Club::where('id',Auth::user()->club_id)->find(Auth::user()->club_id);
        return view('pages.club.edit', compact('club'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    /**
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = Auth::user()->club_id;
            $club =Club::find($id);

                $club->name = $request->name;
                $club->user_name = $request->user_name;
                $club->email = $request->email;
                $club->phone = $request->phone;
                $club->subscribes_id = $request->subscribes_id;
                $club->subscription_period = $request->subscription_period;
                if (isset($request->password)){
                    $club->password =Hash::make($request->password);
                }
                $club->save();
                #update in table users #admin
                $admin = User::find($club->id);
                $admin->club_id = $club->id;
                $admin->name = $club->name;
                $admin->email = $club->email;
                $admin->password = $club->password;
                $admin->permission = 'admin';
                $admin->save();
                #add photo
            if ($request->hasfile('image_path')) {
                $this->deleteFile('club',$request->id);
                $club_image = $this->saveImage($request->image_path, 'attachments/club/' .Auth::user()->club_id);
                $club->image_path = $club_image;
                $club->save();
            }
                DB::commit();
                session()->flash('Add', trans('notifi.add'));
                return redirect()->route('dashboard');

        } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        //
    }
}
