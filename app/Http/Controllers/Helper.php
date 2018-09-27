<?php
namespace App\Http\Controllers;

class Helper 
{
    public static function result($success, $infoCode, $infoMsg, $params="")
    {
       return $result=[
            "success" => $success,
            "infoCode" => $infoCode,
            "infoMsg" => $infoMsg,
            "data" => $params,
       ];
    }   
}


?>  