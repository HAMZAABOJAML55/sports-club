<?php


namespace App\Http\Controllers\accounting;
use App\Http\Controllers\Controller;
use App\Models\Accounting;
use App\Models\Coach;
use App\Models\Paymentstrainee;
use App\Models\Player;
use App\Models\Subtype;
use Illuminate\Http\Request;

class AccountingController extends Controller
{

    public function index()
    {
        $accountings=Accounting::all();
        return view('pages.accounting.index', compact('accountings'));
    }


    public function create()
    {
        $coachs=Coach::all();
        $players=Player::all();
        $subtype=Subtype::all();
        $Payment_trainee=Paymentstrainee::all();
        return view('pages.accounting.create', compact('subtype','Payment_trainee','players','coachs'));
    }


    public function store(Request $request)
    {
        try {
            $accounting = new Accounting();
            $accounting->draws = $request->draws;
            $accounting->discounts = $request->discounts;
            $accounting->coach_id = $request->coach_id;
            $accounting->Payment_trainee_id = $request->Payment_trainee_id;
            $accounting->player_id = $request->player_id;
            $accounting->subtype_id = $request->subtype_id;
            $accounting->number = $request->number;
            $accounting->save();
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('accounting.index');
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
        $coachs=Coach::all();
        $players=Player::all();
        $subtype=Subtype::all();
        $Payment_trainee=Paymentstrainee::all();
        $accountings=Accounting::findorfail($id);
        return view('pages.accounting.edit', compact('players','coachs','accountings','subtype','Payment_trainee'));
    }


    public function update(Request $request, $id)
    {
        try {
            $accounting = Accounting::findOrFail($request->id);
            $accounting->draws = $request->draws;
            $accounting->discounts = $request->discounts;
            $accounting->coach_id = $request->coach_id;
            $accounting->Payment_trainee_id = $request->Payment_trainee_id;
            $accounting->player_id = $request->player_id;
            $accounting->subtype_id = $request->subtype_id;
            $accounting->number = $request->number;
            $accounting->save();
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('accounting.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request,$id)
    {
        try {
            Accounting::destroy($request->id);
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('accounting.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
