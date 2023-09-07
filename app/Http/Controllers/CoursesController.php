<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoursesModel;

class CoursesController extends Controller
{
    public function index()
    {
        $data = CoursesModel::latest()->get ();
        $total = CoursesModel::count();
        return view('components/courses', compact('data','total'));
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
        $request -> validate ([
            'Name' => 'required',
            'Cost' => 'required',
            'Period' => 'required',
            'Description'  => 'required',
        ]);

        // insert Data
        $form_data = array(
            'Name' => $request->Name,
            'Cost' => $request->Cost,
            'Description'  => $request->Description,
            'Period'  => $request->Period,

        );
        CoursesModel::create ($form_data);
        return redirect('CoursesResource')
            ->with('success','Data Added successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $data = CoursesModel::findOrFail($id);
        // echo json_encode($data);
        return view('components/doctor/show', compact('data'));
        // echo $data;
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $data = CoursesModel::findOrFail($id);
        return response()->json(['data' => $data]);
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
        $rowId = $request->editId;

        $request -> validate ([
            'Name' => 'required',
            'Cost' => 'required',
            'Description'  => 'required',
            'Period'  => 'required',
        ]);

        // Update Data
        $form_data = array(
            'Name' => $request->Name,
            'Cost' => $request->Cost,
            'Description'  => $request->Description,
            'Period'  => $request->Period,
        );
        // update
        CoursesModel::whereId ($rowId)->update($form_data);
        return redirect('CoursesResource')
            ->with('success','Data Is Successfully Updated');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request, $id)
    {
        $rowId = $request->deleteId;

        // delete
        $data = CoursesModel::findOrFail($rowId);
        $data ->delete();
        return redirect('CoursesResource')
            ->with('success','Data Is Successfully Deleted');
    }
}
