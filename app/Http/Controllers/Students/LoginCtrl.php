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


   public function index()
   {

       if(Session::get("userType") == "student"){  
           return redirect('/main'); 
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


       $this->createUserSession($usuario->studentId, "student");
       
       return response()->json([
           'error' =>  false,
           "redirectTo" =>  "main"
       ]);
   }



   /**
    * crear la session de usuario
    * 
    * @param Int $userId
    * @param String $userType el tipo de usuario
    */
   private function createUserSession(int $userId, string $userType){
      Session::flush(); 
      Session(['userId' => $userId]);
      Session(['userType' => $userType]);
   }

   

    /**
     * cerrar la session de usuario
     */
   public function closeSession(){
       Session::flush();
       return redirect('/login');
       
   }
}