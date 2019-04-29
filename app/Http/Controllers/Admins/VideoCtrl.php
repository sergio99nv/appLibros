<?php

namespace appLibros\Http\Controllers\Admins;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;

use appLibros\Models\VideoMdl;
use Illuminate\Support\Facades\Validator;
use Storage;
use DB;



class VideoCtrl extends Controller
{
    //


    private static $yotubeUrlPrefix = "https://www.youtube.com/watch?v=";

     /**
     *  
     *
     * @param  Request  $request
     * @return Response
     */
    public function getAll(Request $request)
    {
       $rules = [
            "bookCategoryId" => "required|integer",
           ];

        $validation= Validator::make($request->all(),$rules);
        if($validation->fails()){
			return response()->json([
               'error' =>  true,
               "dataError" => $validation->errors()
           ]);
        }

 
        $yotubeUrlPrefix = self::$yotubeUrlPrefix;
        $dataBook = VideoMdl::select('videoId as id',  
                                    DB::raw("CONCAT('{$yotubeUrlPrefix}', url) as url")
                                  )->where("bookCategoryId", $request->bookCategoryId)
                                  ->get();
       //$data = self::addFilePath($dataBook);

        return response()->json([
            "data" => $dataBook,
            'error' =>  false
        ]); 
    }


    
     /**
     * guardar un nuevo video
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //  "bookYear" => "required|integer"
        $rules = [
                 "bookCategoryId" => "required|integer",
                 "url" => "required|max:10000",
                ];

        $validation= Validator::make($request->all(),$rules);

		if($validation->fails()){
			return response()->json([
               "dataError" => $validation->errors(),
               'error' =>  true
           ]);;
        }
       
        try {
         
            $url = self::getYoutubeId($request->url);
          
            if(strlen($url)<=0){
                
                return response()->json([
                    "dataError" =>  ["url" => ["url no valida"]],
                    'error' =>  true
                ]);;
              
                return;
           }

            $newVideoMdl = new VideoMdl();
            $newVideoMdl->url= $url;
            $newVideoMdl->bookCategoryId= $request->bookCategoryId;
            $newVideoMdl->save();
            
    
            $dataEmit = array(
               "id" => $newVideoMdl->videoId,
               "url" => self::$yotubeUrlPrefix.$url,

              "state" => 1
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
     * guardar un nuevo libro
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        //  "bookYear" => "required|integer"
        $rules = [
                 "id" => "required|integer",
                 "url" => "required|max:10000",
                 
                ];

        $validation= Validator::make($request->all(),$rules);

		if($validation->fails()){
			return response()->json([
               "dataError" => $validation->errors(),
               'error' =>  true
           ]);;
        }
       
        try {

            $url = self::getYoutubeId($request->url);
            if(strlen($url)<=0){
                return response()->json([
                    "dataError" =>  ["url" => ["url no valida"]],
                    'error' =>  true
                ]);;
              
                return;
           }


            
            $newVideoMdl =  VideoMdl::find($request->id);
            $newVideoMdl->url=  $url;
            $newVideoMdl->save();
        
            
    
            $dataEmit = array(
              "url" => self::$yotubeUrlPrefix.$url
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



    private static function  getYoutubeId(string $url) : string
    {
       $res =  preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
       return   $res ? $matches[0] : "";
    }
}
