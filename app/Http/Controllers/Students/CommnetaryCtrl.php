<?php

namespace appLibros\Http\Controllers\Students;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;

use appLibros\Models\CommnetaryMdl; 
use Illuminate\Support\Facades\Validator;
use Session;



class CommnetaryCtrl extends Controller
{
    
    
     /**
    * obtener los comnetarios de un libro
    *
    * @param  Request  $request
    * @return Response
    */
    public function getCommentaries(Request $request)
    {
        $rules = [
            "bookId" => "required|numeric",
            
        ];

        $validation= Validator::make($request->all(),$rules);
        if($validation->fails()){
            return response()->json([
               'error' =>  true,
               
           ]);
        }


        $commentaries  = CommnetaryMdl::where("bookId", $request->bookId)
                        ->get([
                                "commentaryId as id",
                                "text",
                                "bookId",
                                "userId"
                             ]);

        //$data = self::addFilePath($dataBook);
        $userId = Session::get("userId");
        foreach( $commentaries as &$commentary){
                if($commentary->userId == $userId ){
                    $commentary->allowEdit = true;
                }
        }



        return response()->json([
            "commentariesList" => $commentaries,
            'error' =>  false
        ]); 


    }




     /**
     * guardar un nuevo comnetario
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
      
        $rules = [
                 "text" => "required",
                 "bookId" => "required|integer"
                ];

        $validation= Validator::make($request->all(),$rules);

		if($validation->fails()){
			return response()->json([
                
               'error' =>  true
           ]);;
        }
       
        try {
            
           
           $commnetaryMdl = new CommnetaryMdl;
           $commnetaryMdl->text = $request->text;
           $commnetaryMdl->bookId = $request->bookId;
           $commnetaryMdl->userId = Session::get("userId");
            
           $commnetaryMdl->save();
 
            $dataEmit = array(
              
               "id" => $commnetaryMdl->commentaryId
            );



            return response()->json([
               "dataEmit" =>  $dataEmit,
                'msg' => "ok",
                'error' =>  false
            ]);

        } catch (\Exception  $e) {
             return response()->json([
               'msg' => "error al intentar guardar los datos",
               'error' =>  true,
               "x" => $e->getMessage()
           ]); 
        }    
    }




     /**
     * update un  comnetario
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
      
        $rules = [
                 "updateId" => "required|integer",
                 "text" => "required",
                 
                ];

        $validation= Validator::make($request->all(),$rules);

		if($validation->fails()){
			return response()->json([
                
               'error' =>  true
           ]);;
        }
       
        try {
            
           $updateId = $request->updateId;
           $commnetaryMdl =  CommnetaryMdl::find($updateId);
           $commnetaryMdl->text = $request->text;
           $commnetaryMdl->save();
  

            return response()->json([
               
                'msg' => "ok",
                'error' =>  false
            ]);

        } catch (\Exception  $e) {
             return response()->json([
               'msg' => "error al intentar guardar los datos",
               'error' =>  true,
               "x" => $e->getMessage()
           ]); 
        }    
    }





}
