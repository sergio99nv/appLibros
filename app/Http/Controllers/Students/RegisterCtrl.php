<?php

namespace appLibros\Http\Controllers\Students;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;
use appLibros\Models\StudentMdl;

use Illuminate\Support\Facades\Validator;


class RegisterCtrl extends Controller
{
    public function index()
    {
       return view('students/register');
    }

    /**
     * comprobar si el telefono o correo ya existe
     *
     * @param  Request  $request
     * @return Response
     */
    public function checkField(Request $request)
    {

        $rules = [
            "field" => "required|in:phoneNumber,email",
            "value" => "required",
        ];

        $validation= Validator::make($request->all(),$rules);

        if($validation->fails()){
            return response()->json([
            "dataError" => $validation->errors(),
            'error' =>  true
             ]);
        }


        $field =  $request->field;  
        $value =  $request->value;  

        $result = (int) StudentMdl::where($field, $value)->count();  
        
        return response()->json([
            "exist" =>  $result <=0  ?  false : true,
            'error' =>  false
        ]);
    }




 
    /**
     * guardar una nueva categoria
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        
        $rules = [
                    "firstName" => "required|max:10000",
                    "lastName" => "required|max:10000",
                    "phoneNumber" => "required|numeric",
                    "email" => "required|email",
                    "password" => "required"
                ];



        $validation= Validator::make($request->all(),$rules);

		if($validation->fails()){
			return response()->json([
               "dataError" => $validation->errors(),
               'error' =>  true
           ]);
        }

        //validar que el correo no exista
        $resultEmail = (int) StudentMdl::where("email", $request->email)->count();  

        if($resultEmail > 0){
            return response()->json([
                "dataError" => ["email" => ["el correo ya esta en uso"]],
                'error' =>  true
            ]);
        }


        $resulPhone = (int) StudentMdl::where("phoneNumber", $request->phoneNumber)->count(); 
        if($resulPhone > 0){
            return response()->json([
                "dataError" => ["phoneNumber" => ["el teléfono ya esta en uso"]],
                'error' =>  true
            ]);
        }



        try {
            $studentMdl = new StudentMdl;
            $studentMdl->firstName = $request->firstName;
            $studentMdl->lastName = $request->lastName;
            $studentMdl->phoneNumber = $request->phoneNumber;
            $studentMdl->email = $request->email;
            $studentMdl->password = $request->password;
            $studentMdl->state = 1;
            $studentMdl->save();
    
          
            return response()->json([
                "redirecTo" =>  "register/success",
                'error' =>  false
            ]);

        } catch (\Exception  $e) {
            return response()->json([
               'msg' => "erro al intentar guardar los datos",
               'error' =>  true,
               "x" => $e->getMessage()
           ]);
        }    
    }




    public function success(){
       
       return view('students/success');
    }




}
