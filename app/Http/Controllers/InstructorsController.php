<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstructorsModel;

class InstructorsController extends Controller
{
    public function index()
    {
        $data = InstructorsModel::latest()->get ();
        $total = InstructorsModel::count();
        return view('components/instructors', compact('data','total'));
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
            'FName' => 'required',
            'LName' => 'required',
            'Contact' => 'required',
            'UserName'  => 'required',
            'Password' => 'required',
            'About' => 'required',

        ]);

        // insert Data
        $form_data = array(
            'FName' => $request->FName,
            'LName' => $request->LName,
            'UserName'  => $request->UserName,
            'Contact'  => $request->Contact,
            'Password' => $request->Password,
            'About' => $request->About,

        );
        InstructorsModel::create ($form_data);
        return redirect('InstructorsResource')
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
        $data = InstructorsModel::findOrFail($id);
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
        $data = InstructorsModel::findOrFail($id);
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
            'FName' => 'required',
            'LName' => 'required',
            'UserName'  => 'required',
            'Contact'  => 'required',
            'Password' => 'required',
            'About'=>'required',
        ]);

        // Update Data
        $form_data = array(
            'FName' => $request->FName,
            'LName' => $request->LName,
            'UserName'  => $request->UserName,
            'Contact'  => $request->Contact,
            'Password' => $request->Password,
            'About' => $request->About,
        );
        // update
        InstructorsModel::whereId ($rowId)->update($form_data);
        return redirect('InstructorsResource')
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
        $data = InstructorsModel::findOrFail($rowId);
        $data ->delete();
        return redirect('InstructorsResource')
            ->with('success','Data Is Successfully Deleted');
    }
}
