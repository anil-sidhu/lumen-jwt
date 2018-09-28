<?php
namespace App\Http\ApiHelpers;

class ResponseBuilder 
{
    public static function result($success="", $infoCode="", $infoMsg="", $params="")
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