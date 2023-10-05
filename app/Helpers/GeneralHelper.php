<?php 

namespace App\Helpers;

use App\Models\EquipmentsModel;
use App\Models\InstructorsModel;
use App\Models\StudentsModel;

class GeneralHelper 
{

    public static function  getStudentName ($id)
    {
        $data = StudentsModel::where('id',$id)->get(['FName','LName']);
        $length = count ($data);
        if ($length == 0){return '';}
        else 
        {
            $FName =  $data[0]["FName"];
            $LName =  $data[0]["LName"];
            $name = $FName . " " . $LName;
            return $name;
        }
    }
    public static function  getInstructorName ($id)
    {
        $data = InstructorsModel::where('id',$id)->get(['FName','LName']);
        $length = count ($data);
        if ($length == 0){return '';}
        else 
        {
            $FName =  $data[0]["FName"];
            $LName =  $data[0]["LName"];
            $name = $FName . " " . $LName;
            return $name;
        }
    }

    public static function getEquipmentsName($id)
    {
        $data = EquipmentsModel::where('id',$id)->get(['Name']);
        $length = count ($data);
        if ($length == 0){return '';}
        else 
        {
            $name =  $data[0]["Name"];
            return $name;
        }
    }





}
