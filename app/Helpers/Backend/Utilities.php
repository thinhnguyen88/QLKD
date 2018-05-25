<?php
namespace App\Helpers\Backend;

class Utilities{

    public static function getPID ($id){
        $personnel_id = "VTL";
        if ($id < 9 ){
            $personnel_id = $personnel_id.'00'.$id;
        }elseif ($id < 99){
            $personnel_id = $personnel_id.'0'.$id;
        }else{
            $personnel_id = $personnel_id.$id;
        }
        return $personnel_id;
    }

    public static function getCompanyId($id){
        $company = "";
        if ($id < 9 ){
            $company = $company.'00'.$id;
        }elseif ($id < 99){
            $company = $company.'0'.$id;
        }else{
            $company = $company.$id;
        }
        return $company;
    }
}