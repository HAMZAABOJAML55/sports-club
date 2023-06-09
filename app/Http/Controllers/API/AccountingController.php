<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountingRequest;
use App\Models\Accounting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountingController extends Controller
{

    public function index()
    {
        $clients = Accounting::all();
        return response()->json($clients);
    }

    public function store(StoreAccountingRequest $request)
    {
        $location =Accounting::create($request->all());
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

            $client->number = $request->number;
            $client->Payment_trainee_id = $request->Payment_trainee_id;
            $client->draws = $request->draws;
            $client->discounts = $request->discounts;
            $client->subtype_id = $request->subtype_id;
            $client->player_id = $request->player_id;
            $client->coach_id = $request->coach_id;
            $client->save();
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
