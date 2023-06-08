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

    public function store(Request $request)
    {
        $sections = new Section();
        $sections->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $sections->number = $request->number;
        $sections->section_description = $request->section_description;
        $sections->department_address = $request->department_address;
        $sections->save();
        return response()->json([
            'status'=>true,
            'date' =>$sections,
            'message' => 'Item  Added Successfully',
        ]);

    }

    public function show(Request $request)
    {
        $item = Section::findOrFail($request->id);
        return response()->json($item);
    }


    public function update(Request $request)
    {
        $sections = Section::findOrFail($request->id);
        if($sections)
        {
            $sections->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $sections->number = $request->number;
            $sections->section_description = $request->section_description;
            $sections->department_address = $request->department_address;
            $sections->save();
            return response()->json([
                'status'=>true,
                'data' => $sections,
                'message' => 'Section Updated Successfully',
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'data' => $sections,
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
