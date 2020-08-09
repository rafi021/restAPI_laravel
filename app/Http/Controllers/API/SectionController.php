<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Section;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return response()->json($sections);
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
            'class_id' => 'required',
            'section_name' => 'required',
        ]);

        Section::insert([
            'class_id' => $request->input('class_id'),
            'section_name' => $request->input('section_name'),
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'success' => 'Data Inserted Successfully!!!',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::findOrFail($id);
        return response()->json($section);
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
            'class_id' => 'required',
            'section_name' => 'required',
        ]);

        $section = Section::findOrFail($id);
        $section->update([
            'class_id' => $request->input('class_id'),
            'section_name' => $request->input('section_name'),
        ]);
        return response()->json([
            'success' => 'Data Updated Successfully!!!',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        return response()->json([
            'success' => 'Data Deleted Successfully!!!',
        ], 200);
    }
}
