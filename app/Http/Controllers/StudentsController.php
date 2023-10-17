<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentsModel;
use App\Models\CoursesModel;

class StudentsController extends Controller
{
    public function index()
    {
        $data =StudentsModel::latest()->get ();
        $total = StudentsModel::count();
        $courses = CoursesModel::get(['Name']);
        return view('components/students', compact('data','total','courses'));
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
            'EntryYear' => 'required',
            'Course' => 'required',
            'StudentId' => 'required',
            'Address' => 'required',
            'Gender' => 'required',
            // 'image' =>  'required|mimes:jpeg,png,jpg,|max:2048'

        ]);

        // $image = $request->file('image');
        // $new_name = rand().'.'.$image->getClientOriginalExtension ();
        // $image ->move(public_path('images'),$new_name);

        // insert Data
        $form_data = array(
            'FName' => $request->FName,
            'LName' => $request->LName,
            'UserName'  => $request->UserName,
            'Contact'  => $request->Contact,
            'Password' => $request->Password,
            'EntryYear' => $request->EntryYear,
            'StudentId' => $request->StudentId,
            'Course' => $request->Course,
            'Address' => $request->Address,
            'Gender' => $request->Gender,
            'Image'  => 'null',
        );
        StudentsModel::create ($form_data);
        return redirect('StudentsResource')
            ->with('success','Data Added successfully.');
    }
    public function getCourseAmount ($name)
    {
        $data = CoursesModel::where('Name',$name)->get(['Cost']);
        return $data;
    }
    public function viewStudent (Request $request)
    {
        $viewType = $request->viewType;
        $keyId = $request->keyId;

        if($viewType == 'student')
        {
            $data =StudentsModel::where('id',$keyId)->get ();
            $total = StudentsModel::where('id',$keyId)->count();
            $courses = CoursesModel::get(['Name']);
            return view('components/students', compact('data','total','courses'));
        }
    }
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $data =StudentsModel::findOrFail($id);
        return view('components/doctor/show', compact('data'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $data =StudentsModel::findOrFail($id);
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
            'EntryYear' => 'required',
            'Course' => 'required',
            'StudentId' => 'required',
            'Address' => 'required',
            'Gender' => 'required',
        ]);

        // Update Data
        $form_data = array(
            'FName' => $request->FName,
            'LName' => $request->LName,
            'UserName'  => $request->UserName,
            'Contact'  => $request->Contact,
            'Password' => $request->Password,
            'EntryYear' => $request->EntryYear,
            'StudentId' => $request->StudentId,
            'Course' => $request->Course,
            'Address' => $request->Address,
            'Gender' => $request->Gender,
        );
        // update
        StudentsModel::whereId ($rowId)->update($form_data);
        return redirect('StudentsResource')
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
        $data =StudentsModel::findOrFail($rowId);
        $data ->delete();
        return redirect('StudentsResource')
            ->with('success','Data Is Successfully Deleted');
    }
}
