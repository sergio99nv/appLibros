<?php

namespace appLibros\Http\Controllers\Admins;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;
use appLibros\Models\AdminMdl; 
use Illuminate\Support\Facades\Validator;
use Session;


class LoginCtrl extends Controller
{
    //
    public function index()
    {

        if(Session::get("userType") == "admin"){  
            return redirect('/admins/main'); 
        } 


        return view('admins/login/index');

       
    }


    /**
     * valdar login
     *
     * @param  Request  $request
     * @return Response
     */
    public function validateLogin(Request $request)
    {
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

        $usuario = AdminMdl::select('adminId',
                                    'userName',
                                    'fullName')
        ->where('username', $username)
        ->where('password', $password)
        ->first();


        if($usuario === null){
            return response()->json([
                'error' =>  true,
                "invalidData" => true,
                "msg" => "username o password incorrecto"
            ]);

            return;
         }


        $this->createUserSession($usuario->adminId, "admin", $usuario->fullName);
        
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
    private function createUserSession(int $userId,
                                        string $userType,
                                        string  $userName){
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
        return redirect('admins/login');
        
    }




}
