<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\SClass;
use Carbon\Carbon;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;

class SClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sclasses = DB::table('s_classes')->get();
        return response()->json($sclasses);
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
        $validateData = $request->validate([
            'class_name' => 'required|unique:s_classes|max:25',
        ]); 

        SClass::insert([
            'class_name' => $request->input('class_name'),
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => "Inserted Successfully!!!"
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sClass = SClass::findOrFail($id);
        return response()->json($sClass);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'class_name' => 'required|unique:s_classes|max:25',
        ]); 

        $sClass = SClass::findOrFail($id);
        $sClass->update([
            'class_name' => $request->input('class_name'),
        ]);
        return response()->json([
            'success' => "Updated Successfully!!!"
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SClass $sClass,$id)
    {
        DB::table('s_classes')->where('id', $id)->delete();
        //$sClass->delete();
        return response()->json([
            'success' => "Deleted Successfully!!!"
        ],200);
    }
}
