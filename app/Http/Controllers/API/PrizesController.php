<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrizeRequest;
use App\Models\Prize;
use Illuminate\Http\Request;

class PrizesController extends Controller
{

    public function index()
    {
        $prizes = Prize::all();
        return response()->json($prizes);
    }

    public function store(StorePrizeRequest $request)
    {
        $data['name']  = $request->name ;

        $prize = Prize::create($data);
        return response()->json([
            'status'=>true,
            'date' => $prize,
            'message' => 'Prize Information Added Successfully',
        ]);

    }


    public function show(Request $request)
    {
        $prize = Prize::findOrFail($request->id);
        return response()->json($prize);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePrizeRequest $request)
    {
        $prize = Prize::findOrFail($request->id);
        if($prize){
            $data['name']  = $request->name;

            $prize->update($data);
            return response()->json([
                'status'=>true,
                'data' => $prize,
                'message' => 'Prize Information Updated Successfully',
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
        Prize::find($request->id)->delete();
        return response()->json([
        'status'=>true,
        'message' => 'Prize Information deleted Successfully',
        ]);
    }
}
