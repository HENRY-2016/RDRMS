<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Models\InstructorsModel;
use App\Models\StudentsModel;

class UserAuthenticationController extends Controller
{
    function adminLogIn (Request $request)
    {
        $UserName = $request->UserName;
        $Password = $request->Password;

        $data = AdminModel::where('UserName',$UserName)
        ->where('Password',$Password)
        ->get(['FName','LName','Contact','UserName','Password','id']);

        $length = count ($data);
        if ($length == 0) 
        {
            return redirect('/admin/login')
            ->with('error','Sorry No User Records Found');
            }

        elseif ($length !== 0)
        {
            $UserType = "Admin";
            $DbFName =  $data[0]["FName"];
            $DbId =  $data[0]["id"];
            $DbLName =  $data[0]["LName"];
            $DbContact =  $data[0]["Contact"];
            $DbUserName =  $data[0]["UserName"];
            $DbPassword =  $data[0]["Password"];

            $UserFullName = $DbFName. " " . " ". $DbLName; 


            if (($DbUserName === $UserName) && ($DbPassword === $Password))
            {
                $request->session()->put('user',$UserFullName);
                $request->session()->put('id',$DbId);
                $request->session()->put('contact',$DbContact);
                $request->session()->put('userType',$UserType);
                return redirect('components/admin');
            }
        }
    }

    function studentsLogIn (Request $request)
    {
        $UserName = $request->UserName;
        $Password = $request->Password;

        $data = StudentsModel::where('UserName',$UserName)
        ->where('Password',$Password)
        ->get(['FName','LName','Contact','UserName','Password','id']);

        $length = count ($data);
        if ($length == 0) 
        {
            return redirect('students/login')
            ->with('error','Sorry No User Records Found');
            }

        elseif ($length !== 0)
        {
            $UserType = "Student";
            $DbFName =  $data[0]["FName"];
            $DbId =  $data[0]["id"];
            $DbLName =  $data[0]["LName"];
            $DbContact =  $data[0]["Contact"];
            $DbUserName =  $data[0]["UserName"];
            $DbPassword =  $data[0]["Password"];

            $UserFullName = $DbFName. " " . " ". $DbLName; 


            if (($DbUserName === $UserName) && ($DbPassword === $Password))
            {
                $request->session()->put('user',$UserFullName);
                $request->session()->put('id',$DbId);
                $request->session()->put('contact',$DbContact);
                $request->session()->put('userType',$UserType);
                return redirect('components/courses');
            }
        }
    }

    function instructorsLogIn (Request $request)
    {
        $UserName = $request->UserName;
        $Password = $request->Password;

        $data = InstructorsModel::where('UserName',$UserName)
        ->where('Password',$Password)
        ->get(['FName','LName','About','UserName','Password','id']);

        $length = count ($data);
        if ($length == 0) 
        {
            return redirect('instructors/login')
            ->with('error','Sorry No User Records Found');
            }

        elseif ($length !== 0)
        {
            $UserType = "Instructor";
            $DbFName =  $data[0]["FName"];
            $DbId =  $data[0]["id"];
            $DbLName =  $data[0]["LName"];
            $DbAbout =  $data[0]["About"];
            $DbUserName =  $data[0]["UserName"];
            $DbPassword =  $data[0]["Password"];

            $UserFullName = $DbFName. " " . " ". $DbLName; 


            if (($DbUserName === $UserName) && ($DbPassword === $Password))
            {
                $request->session()->put('user',$UserFullName);
                $request->session()->put('details',$DbAbout);
                $request->session()->put('id',$DbId);
                $request->session()->put('userType',$UserType);
                return redirect('components/courses');
            }
        }
    }
}
