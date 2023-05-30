<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountingRequest;
use App\Models\Accounting;
use Illuminate\Http\Request;

class AccountingController extends Controller
{

    public function index()
    {
        $clients = Accounting::all();
        return response()->json($clients);
    }

    public function store(StoreAccountingRequest $request)
    {
//        dd("knknnk");
        $data['number'] = $request->number;
        $data['number_of_months'] = $request->number_of_months;
        $data['coach_id'] = $request->coach_id;
        $data['player_id'] = $request->player_id;
        $data['discounts'] = $request->discounts;
        $data['draws'] = $request->draws;
        $data['Payments_trainees'] = $request->Payments_trainees;
        $location =Accounting::create($data);
        return response()->json([
            'status' => true,
            'data' => $location,
            'message' => 'accounting Information Added Successfully',
        ]);


    }

    public function show(Request $request)
    {
        $client = accounting::findOrFail($request->id);
        return response()->json($client);
    }

    public function update(StoreAccountingRequest $request)
    {
        $client = accounting::find($request->id);
        if ($client) {
            $data['number'] = $request->number;
            $data['number_of_months'] = $request->number_of_months;
            $data['coach_id'] = $request->coach_id;
            $data['player_id'] = $request->player_id;
            $data['discounts'] = $request->discounts;
            $data['draws'] = $request->draws;
            $data['Payments_trainees'] = $request->Payments_trainees;

            $client->update($data);
            return response()->json($client);
        } else {
            return response()->json('no found Accounting');
        }
    }


    public function destroy(Request $request)
    {
        $account = accounting::destroy($request->id);
        return response()->json('deleted account successfully');
    }
}
