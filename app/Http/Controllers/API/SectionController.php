<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;
class SectionController extends Controller
{

    public function index()
    {
        $items = Section::all();
        return response()->json($items);
    }

    public function store(StoreSectionRequest $request)
    {
        $data['name'] = $request->name ;
        $data['description'] = $request->description ;

        $item = Section::create($data);
        return response()->json([
            'status'=>true,
            'date' =>$item,
            'message' => 'Item  Added Successfully',
        ]);

    }

    public function show(Request $request)
    {
        $item = Section::findOrFail($request->id);
        return response()->json($item);
    }


    public function update(StoreSectionRequest $request)
    {

        $section = Section::findOrFail($request->id);
        if($section)
        {
            $data['name'] = $request->name ;
            $data['description'] = $request->description  ;

            $section->update($data);
            return response()->json([
                'status'=>true,
                'data' => $section,
                'message' => 'Section Updated Successfully',
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'data' => $section,
                'message' => 'Section Not Updated Successfully',
            ]);
        }
    }

    public function destroy(Request $request)
    {
        Section::find($request->id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Item deleted Successfully',
        ]);
    }
}
