<?php

namespace appLibros\Http\Controllers\Students;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;

use appLibros\Models\StudentMdl; 
use Illuminate\Support\Facades\Validator;
use Session;

class LoginCtrl extends Controller
{
   //ESTUDIANTE

   private static $redirecTo = "books";

   public function index()
   {

        $redirecTo = self::$redirecTo;
       if(Session::get("userType") == "student"){  
           return redirect("/{$redirecTo}"); 
       } 


       return view('students/login');
   }


   /**
    * valdar login
    *
    * @param  Request  $request
    * @return Response
    */
   public function validateLogin(Request $request)
   {
       //username puede ser el correo o el telefono

       $rules = [
           "username" => "required",
           "password" => "required",
          ];

       $validation= Validator::make($request->all(),$rules);
       if($validation->fails()){
           return response()->json([
              'error' =>  true,
              "dataError" => $validation->errors()
          ]);
       }


       $username  = $request->username;
       $password  = $request->password;

       $usuario = StudentMdl::select('studentId',
                                    'email',
                                    'firstName',
                                    'lastName',
                                    'phoneNumber')
       ->where('email', $username)
       ->where('password', $password)
       ->first();


       if($usuario === null){
           return response()->json([
               'error' =>  true,
               "invalidData" => true,
               "msg" => "correo|telefono o password incorrecto"
           ]);

           return;
        }


       $userName  = $usuario->firstName." ".$usuario->lastName;

       $this->createUserSession($usuario->studentId, "student", $userName);
       
       return response()->json([
           'error' =>  false,
           "redirectTo" =>  self::$redirecTo
       ]);
   }



   /**
    * crear la session de usuario
    * 
    * @param Int $userId
    * @param String $userType el tipo de usuario
    */
   private function createUserSession(int $userId,
                                    string $userType, 
                                    string  $userName ) {
      Session::flush(); 
      Session(['userId' => $userId]);
      Session(['userType' => $userType]);
      Session(['userName' => $userName]);
   }

   

    /**
     * cerrar la session de usuario
     */
   public function closeSession(){
       Session::flush();
       return redirect('/login');
       
   }
}
