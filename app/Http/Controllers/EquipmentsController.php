<?php

namespace App\Http\Controllers;

use App\Models\EquipmentsModel;
use Illuminate\Http\Request;

class EquipmentsController extends Controller
{
    public function index()
    {
        $data =EquipmentsModel::latest()->get ();
        $total = EquipmentsModel::count();

        return view('components/equipments', compact('data','total'));
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
            'Description' => 'required',
        ]);

        // insert Data
        $form_data = array(
            'Name' => $request->Name,
            'Description' => $request->Description,
        );
        EquipmentsModel::create ($form_data);
        return redirect('EquipmentsResource')
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
        $data =EquipmentsModel::findOrFail($id);
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
        $data =EquipmentsModel::findOrFail($id);
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
            'Safety' => 'required',
        ]);

        // Update Data
        $form_data = array(
            'Name' => $request->Name,
            'Description' => $request->Safety,
            'Safety1' => $request->Safety1,
        );
        // update
        EquipmentsModel::whereId ($rowId)->update($form_data);
        return redirect('EquipmentsResource')
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
        $data =EquipmentsModel::findOrFail($rowId);
        $data ->delete();
        return redirect('EquipmentsResource')
            ->with('success','Data Is Successfully Deleted');
    }
}
