<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreAccountingRequest;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Accounting;
use App\Models\Coach;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AccountingController extends Controller
{
use GeneralTrait;
use imageTrait;
    public function index()
    {
        $accountings = Accounting::where('club_id',Auth::user()->club_id)->get();
        return response()->json($accountings);
    }

    public function store(StoreAccountingRequest $request)
    {
        DB::beginTransaction();
        try {
            if(isset($request->coach_id)) {
                $couch = Coach::where('club_id', Auth::user()->club_id)->find($request->coach_id);
                if (!$couch) {
                    return response()->json([
                        'status' => 'Error',
                        'status_code' => ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'couch not found',
                        'data' => []
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
            }
            if(isset($request->player_id)) {
                $player = Player::where('club_id', Auth::user()->club_id)->find($request->player_id);
                if (!$player) {
                    return response()->json([
                        'status' => 'Error',
                        'status_code' => ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'Player not found',
                        'data' => []
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
            }
            $accounting = new Accounting();
            $accounting->club_id = Auth::user()->club_id;
            $accounting->number = $request->number;
//            $accounting->Payment_trainee_id = $request->Payment_trainee_id;
            $accounting->Payment_for_trainee = $request->Payment_for_trainee;
            $accounting->draws = $request->draws;
            $accounting->discounts = $request->discounts;
            $accounting->subtype_id = $request->subtype_id;
            $accounting->player_id = $request->player_id;
            $accounting->coach_id = $request->coach_id;
            $accounting->total_salary = $request->total_salary;
            $accounting->tax = $request->tax;
            $accounting->deposit = $request->deposit;
            $accounting->save();
            if ($request->hasfile('image_path')) {
                $_image = $this->saveImage($request->image_path, 'attachments/accountings/'.Auth::user()->club_id.'/'. $accounting->id);
                $accounting->image_path = $_image;
                $accounting->save();
            }
            DB::commit();  // insert data
            return response()->json([
                'status' => true,
                'date' => $accounting,
                'message' => 'Accounting Information Added Successfully',
            ]);
        } catch (\Throwable $ex) {
            //            وهنا يعمل رجوع عن الحفظ
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function show(Request $request)
    {
        $accounting= Accounting::where('club_id',Auth::user()->club_id)->find($request->id);
        if (!$accounting) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'accounting not found',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        return response()->json([
            'status' => true,
            'data' => $accounting
        ]);
    }

    public function update(StoreAccountingRequest $request)
    {
        DB::beginTransaction();
        try {
            if(isset($request->coach_id)) {
                $couch = Coach::where('club_id', Auth::user()->club_id)->find($request->coach_id);
                if (!$couch) {
                    return response()->json([
                        'status' => 'Error',
                        'status_code' => ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'couch not found',
                        'data' => []
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
            }
            if(isset($request->player_id)) {
                $player = Player::where('club_id', Auth::user()->club_id)->find($request->player_id);
                if (!$player) {
                    return response()->json([
                        'status' => 'Error',
                        'status_code' => ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'Player not found',
                        'data' => []
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
            }
            $accounting = Accounting::where('club_id',Auth::user()->club_id)->find($request->id);
            if (!$accounting) {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'accounting not found',
                    'data' => []
                ], ResponseAlias::HTTP_NOT_FOUND);
            }

            $accounting->club_id = Auth::user()->club_id;
            $accounting->number = $request->number;
//            $accounting->Payment_trainee_id = $request->Payment_trainee_id;
            $accounting->Payment_for_trainee = $request->Payment_for_trainee;
            $accounting->draws = $request->draws;
            $accounting->discounts = $request->discounts;
            $accounting->subtype_id = $request->subtype_id;
            $accounting->player_id = $request->player_id;
            $accounting->coach_id = $request->coach_id;
            $accounting->total_salary = $request->total_salary;
            $accounting->tax = $request->tax;
            $accounting->deposit = $request->deposit;
            $accounting->save();
            if ($request->hasfile('image_path')) {
                $this->deleteFile('accountings',$request->id);
                $_image = $this->saveImage($request->image_path, 'attachments/accountings/' .Auth::user()->club_id.'/'. $accounting->id);
                $accounting->image_path = $_image;
                $accounting->save();
            }
            DB::commit();  // insert data
            return response()->json([
                'status' => true,
                'date' => $accounting,
                'message' => 'Accounting Information Updated Successfully',
            ]);
        } catch (\Throwable $ex) {
            //            وهنا يعمل رجوع عن الحفظ
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        $accounting= Accounting::where('club_id',Auth::user()->club_id)->find($request->id);
        if (!$accounting) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'accounting not found',
                'data' => []
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        $this->deleteFile('accountings',$request->id);
        $accounting->delete();
        return response()->json([
            'status' => true,
            'message' => 'Accounting Information deleted Successfully',
        ]);
    }
}
