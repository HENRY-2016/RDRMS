<?php

namespace App\Http\Controllers;

use App\Models\DivesModel;
use Illuminate\Http\Request;

use App\Models\InstructorsModel;
use App\Models\EquipmentsModel;

class DivesController extends Controller
{
    public function index()
    {
        $data =DivesModel::latest()->get ();
        $total = DivesModel::count();
        $instructors = InstructorsModel::get(['id']);
        $equipments = EquipmentsModel::get(['id']);
        return view('components/dives', compact('data','total','instructors','equipments'));
    }

    public function viewDives (Request $request)
    {
        $viewType = $request->viewType;
        $keyId = $request->keyId;

        if($viewType == 'student')
        {
            $data =DivesModel::where('Student',$keyId)->get ();
            $total = DivesModel::where('Student',$keyId)->count();
            $instructors = InstructorsModel::get(['id']);
            $equipments = EquipmentsModel::get(['id']);
            return view('components/dives', compact('data','total','instructors','equipments'));
        }
        if($viewType == 'instructor')
        {
            $data =DivesModel::where('Instructor',$keyId)->get ();
            $total = DivesModel::where('Instructor',$keyId)->count();
            $instructors = InstructorsModel::get(['id']);
            $equipments = EquipmentsModel::get(['id']);
            return view('components/dives', compact('data','total','instructors','equipments'));
        }
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
        $keyId = $request->Student;
        // $ViewStudent = $request->input('ViewStudent');
        // $StoreStudent = $request->input('StoreStudent');

    
        $request -> validate ([
            'Student' => 'required',
            'Date' => 'required',
            'DiveNo' => 'required',
            'Location' => 'required',
            'Site' => 'required',
            'TimeIn' => 'required',
            'TimeOut' => 'required',
            'Instructor' => 'required',
            'Depth' => 'required',
            'Equipments' => 'required',

        ]);

        // insert Data
        $status = 'Pending';
        $form_data = array(
            'Student' => $request->Student,
            'Date' => $request->Date,
            'DiveNo' => $request->DiveNo,
            'Location' => $request->Location,
            'Site' => $request->Site,
            'TimeIn' => $request->TimeIn,
            'TimeOut' => $request->TimeOut,
            'Instructor' => $request->Instructor,
            'Depth' => $request->Depth,
            'Equipments' => $request->Equipments,

            'Remarks' => $status,
            'FeedBackStatus' => $status,
            'FeedBack' => $status,

        );

        DivesModel::create ($form_data);
        $data =DivesModel::where ('Student',$keyId)->get ();
        $total = DivesModel::where ('Student',$keyId)->count();
        $instructors = InstructorsModel::get(['id']);
        $equipments = EquipmentsModel::get(['id']);
        return view('components.dives', compact('data','total','instructors','equipments'))
            ->with('success','Your Dive Was Successfully Recorded');
        // return redirect('DivesResource')
        //     ->with('success','Data Added successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $data =DivesModel::findOrFail($id);
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
        $data =DivesModel::findOrFail($id);
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
        $studentFeedBack = $request->input('studentFeedBack');
        $instructorRemark = $request->input('instructorRemark');
        $adminEdit = $request->input('adminEdit');
        

        if($studentFeedBack)
        {
            $keyId = $request->keyId;
            $rowId = $request->studentRowId;
            $request -> validate (['studentFeedBack' => 'required']);

            // Update Data
            $form_data = array('FeedBack' => $request->studentFeedBack);
            // update
            
            // DivesModel::where ('Student',$keyId)->update($form_data);
            DivesModel::whereId ($rowId)->update($form_data);

            $data =DivesModel::where ('Student',$keyId)->get ();
            $total = DivesModel::count();
            $instructors = InstructorsModel::get(['id']);
            $equipments = EquipmentsModel::get(['id']);
            return view('components.dives', compact('data','total','instructors','equipments'))
                ->with('success','Your Feed Back Was Successfully Received');
        }

        if($instructorRemark)
        {
            $status = 'Replied';
            $rowId = $request->instructorRowId;
            $remarkkeyId = $request->remarkkeyId;
            $instructorId = $request->instructorId;

            $request -> validate (['instructorRemark' => 'required']);

            // Update Data
            $form_data = array(
                'Remarks' => $request->instructorRemark,
                'FeedBackStatus' => $status,
            );
            // update
            DivesModel::whereId ($rowId)->update($form_data);

            $data =DivesModel::where ('Student',$instructorId)->get ();
            $total = DivesModel::where ('Instructor',$instructorId)->count();
            $instructors = InstructorsModel::get(['id']);
            $equipments = EquipmentsModel::get(['id']);
            return view('components.dives', compact('data','total','instructors','equipments'))
                ->with('success','Your Remark Was Successfully Received');
        }

        if($adminEdit)
        {
        
            $rowId = $request->editId;

            $request -> validate ([
                'Student' => 'required',
                'Date' => 'required',
                'DiveNo' => 'required',
                'Location' => 'required',
                'Site' => 'required',
                'TimeIn' => 'required',
                'TimeOut' => 'required',
                'Instructor' => 'required',
                'Depth' => 'required',
                'Equipments' => 'required',
    
            ]);
            // Update Data
            $form_data = array(
                'Student' => $request->Student,
                'Date' => $request->Date,
                'DiveNo' => $request->DiveNo,
                'Location' => $request->Location,
                'Site' => $request->Site,
                'TimeIn' => $request->TimeIn,
                'TimeOut' => $request->TimeOut,
                'Instructor' => $request->Instructor,
                'Depth' => $request->Depth,
                'Equipments' => $request->Equipments,
            );
            // update
            DivesModel::whereId ($rowId)->update($form_data);
            return redirect('DivesResource')
                ->with('success','Data Is Successfully Updated');
        }

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
        $data =DivesModel::findOrFail($rowId);
        $data ->delete();
        return redirect('DivesResource')
            ->with('success','Data Is Successfully Deleted');
    }
}
