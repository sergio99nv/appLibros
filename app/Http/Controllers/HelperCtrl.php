<?php

namespace appLibros\Http\Controllers;

use Illuminate\Http\Request;
use Session;


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




  public function start()
  {

    if(Session::has("userType")){  
      
      if(Session::get("userType") == "admin"){  
          return redirect("/admins/main"); 
      }else if(Session::get("userType") == "student"){  
        return redirect("/books"); 
      
      } 
    }



  
    return view('welcome');

  }

  

}
