<?php

namespace appLibros\Http\Controllers;

use Illuminate\Http\Request;

class HelperCtrl extends Controller
{
    private static $fileConfig = array(
        "tempFileName" => "TEMP_FILE",
        "file" => array(
                "maxSize" => 8192,
                "extensions" => ["pdf"],
                "urlPath" =>"/storage/adminBooks",
                "folder" => "/public/adminBooks",
                 
        ),

        "image" => array(
             "maxSize" => 8192,
             "extensions" => ["jpg", "jpeg", "png"],
             "urlPath" =>"/storage/bookCovers",
             "folder" => "/public/bookCovers"
       )
  );

  
  public static function getFileConfig() : array
  {
     return self::$fileConfig;
  }

}
