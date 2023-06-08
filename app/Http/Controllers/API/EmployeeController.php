<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class EmployeeController extends Controller
{

    public function index()
    {
        $tasks =Employe::all();
        return response()->json($tasks);
    }


    public function store(Request $request)
    {
        $task =Employe::create($request->all());
        return response()->json([
            'status'=>true,
            'date' =>$task,
            'message' => 'Employees Add Successfully',
        ]);
    }

    public function show(Request $request)
    {
        $task = Employe::findOrFail($request->id);
        return response()->json($task);
    }


    public function update(Request $request)
    {
        $task = Employe::findOrFail($request->id);
        if($task)
        {
            $task->update($request->all());
            return response()->json([
                'status'=>true,
                'data' => $task,
                'message' => 'Employees Updated Successfully',
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
        Employe::find($request->id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Task deleted Successfully',
        ]);
    }
}
