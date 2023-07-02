<?php


namespace App\Http\Controllers\accounting;
use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\Accounting;
use App\Models\Coach;
use App\Models\Employe;
use App\Models\Paymentstrainee;
use App\Models\Player;
use App\Models\Subtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountingController extends Controller
{
    use imageTrait;

    public function index()
    {
        $accountings=Accounting::where('club_id',Auth::user()->club_id)->get();
        return view('pages.accounting.index', compact('accountings'));
    }


    public function create()
    {
        $coachs=Coach::where('club_id',Auth::user()->club_id)->get();
        $players=Player::where('club_id',Auth::user()->club_id)->get();
        $employee=Employe::where('club_id',Auth::user()->club_id)->get();
        $subtype=Subtype::all();
        $Payment_trainee=Paymentstrainee::all();
        return view('pages.accounting.create', compact('employee','subtype','Payment_trainee','players','coachs'));
    }


    public function store(Request $request)
    {
        try {
            $accounting = new Accounting();
            $accounting->club_id = Auth::user()->club_id;
            $accounting->number = $request->number;
            $accounting->Payment_for_trainee = $request->Payment_for_trainee;
            $accounting->draws = $request->draws;
            $accounting->discounts = $request->discounts;
            $accounting->subtype_id = $request->subtype_id;
            $accounting->player_id = $request->player_id;
            $accounting->coach_id = $request->coach_id;
            $accounting->total_salary = $request->total_salary;
            $accounting->tax = $request->tax;
            $accounting->save();
            if ($request->hasfile('image_path')) {
                $_image = $this->saveImage($request->image_path, 'attachments/accountings/'.Auth::user()->club_id.'/'. $accounting->id);
                $accounting->image_path = $_image;
                $accounting->save();
            }
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
        $coachs=Coach::where('club_id',Auth::user()->club_id)->get();
        $players=Player::where('club_id',Auth::user()->club_id)->get();
        $employee=Employe::where('club_id',Auth::user()->club_id)->get();
        $subtype=Subtype::all();
        $Payment_trainee=Paymentstrainee::all();
        $accountings=Accounting::where('club_id',Auth::user()->club_id)->find($id);
        return view('pages.accounting.edit', compact('employee','players','coachs','accountings','subtype','Payment_trainee'));
    }


    public function update(Request $request, $id)
    {
        try {
            $accounting = Accounting::where('club_id',Auth::user()->club_id)->find($request->id);
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
            $accounting->save();
            if ($request->hasfile('image_path')) {
                $this->deleteFile('accountings',$request->id);
                $_image = $this->saveImage($request->image_path, 'attachments/accountings/'.Auth::user()->club_id.'/'. $accounting->id);
                $accounting->image_path = $_image;
                $accounting->save();
            }
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('accounting.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request,$id)
    {
        try {
            $accounting = Accounting::where('club_id',Auth::user()->club_id)->find($request->id);

            $this->deleteFile('accountings',$request->id);
            $accounting->delete();
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('accounting.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
