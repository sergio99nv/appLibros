<?php

namespace appLibros\Http\Controllers\Admins;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;
use appLibros\Http\Controllers\HelperCtrl;

use appLibros\Models\BookMdl;
use Illuminate\Support\Facades\Validator;
use Storage;
use DB;


class BookCtrl extends Controller
{
    private static  $fileConfig = "";

    public function __construct(){
          self::$fileConfig = HelperCtrl::getFileConfig();
    }
    
    


    public function index()
    {
       // var_dump($data);
        return view('admins/bookCategories/books');
    }



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


        $dataBook  = BookMdl::where("bookCategoryId", $request->bookCategoryId)
                ->get([
                        'bookId as id',
                        'name',
                        'description', 
                        'author', 
                        'bookYear', 
                        'file',
                        'cover',
                        'userCreateId',
                        'state'
                    ]);

       //$data = self::addFilePath($dataBook);

        return response()->json([
            "data" => $dataBook,
            'error' =>  false
        ]); 
    }


    /**
     * adicionamos las rutas donde se encuentran almacenados los 
     * archivos de los campos  **file** y **cover**
     *
     * @param  Object  $data
     * @return Object
     */
    private static function addFilePath(object $data) :object
    {
        foreach($data as &$item){
            
                if(strlen($item->file) > 0){
                    $item->file = self::$adminBooksPath."/".$item->file;
                }

                if(strlen($item->cover) > 0){
                    $item->cover = self::$adminBooksPath."/".$item->cover;
                }
        }

        return $data;
    }


     /**
     * guardar un nuevo libro
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //  "bookYear" => "required|integer"
        $rules = [
                 "bookCategoryId" => "required|integer",
                 "name" => "required|max:10000",
                 "description" => "required|max:10000",
                 "author" => "required|max:10000",
                 "file" =>  "required",
                 "cover" =>  "nullable",
                ];

        $validation= Validator::make($request->all(),$rules);

		if($validation->fails()){
			return response()->json([
               "dataError" => $validation->errors(),
               'error' =>  true
           ]);;
        }
       
        try {
           // $currenPath = self::$fileConfig["file"]["folder"];
            //$newPath =  $currenPath;
            //$newFileName =  self::moveFile( $request->file, $currenPath , $bookId, $newPath);

           
            $newBookMdl = new BookMdl();
            $bookId =$newBookMdl->saveNewBook($request);
            
    
            $dataEmit = array(
               "id" => $bookId,
              "name" =>  $request->name,
              "description" => $request->description,
              "author" => $request->author,
              "file" => $request->file,
              "cover" => $request->cover,
              "bookCategoryId"=> $request->bookCategoryId,
              "bookYear" => $request->bookYear,
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
                 "name" => "required|max:10000",
                 "description" => "required|max:10000",
                 "author" => "required|max:10000",
                 "file" =>  "required",
                 "cover" =>  "nullable",
                ];

        $validation= Validator::make($request->all(),$rules);

		if($validation->fails()){
			return response()->json([
               "dataError" => $validation->errors(),
               'error' =>  true
           ]);;
        }
       
        try {
        
            $newBookMdl = new BookMdl();
            $bookId =$newBookMdl->updateBook($request->id, $request);
            
    
            $dataEmit = array(
              "name" =>  $request->name,
              "description" => $request->description,
              "author" => $request->author,
              "file" => $request->file,
              "cover" => $request->cover
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



    //pendiente de revision
    private static function moveFile($file, $currenPath, $newName, $newPath)
    {
        $extension     = pathinfo($file, PATHINFO_EXTENSION);
        $newFileName = $newName.".".$extension;

        Storage::move($currenPath."/".$file, 
                        $newPath."/".$newFileName);

        return $newFileName;

    }




     /**
     * guardar el archivo pdf de un libro
     *
     * @param  Request  $request
     * @return Response
     */
    public function storeFile(Request $request)
    {
        $rules = [
            "file" =>  "required|file".self::getFileValidation("file")
           ];

     
        $validation= Validator::make($request->all(),$rules);
        if($validation->fails()){
            return response()->json([
                "dataError" => $validation->errors(),
                'error' =>  true
            ]);;
        }

      try {
          
        $extension =  $request->file('file')->extension();

        $userId = "PEPE";
        $fileName =  self::getTempFileName( $userId ). "." .$extension;
       
        $folderPath = self::$fileConfig["file"]["folder"];
        $request->file('file')->storeAs( $folderPath, $fileName);

        return response()->json([
            'error' =>  false,
            "file" =>  $fileName
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
     * guardar  la portda de un archivo
     *
     * @param  Request  $request
     * @return Response
     */
    public function storeCover(Request $request)
    {
        $rules = [
            "file" =>  "required|image".self::getFileValidation("image")
           ];

     
        $validation= Validator::make($request->all(),$rules);
        if($validation->fails()){
            return response()->json([
                "dataError" => $validation->errors(),
                'error' =>  true
            ]);;
        }

      try {
          
        $extension =  $request->file('file')->extension();

        $userId = "PEPE";
        $fileName =  self::getTempFileName( $userId ). "." .$extension;

        $folderPath = self::$fileConfig["image"]["folder"];
        $request->file('file')->storeAs( $folderPath, $fileName);

        return response()->json([
            'error' =>  false,
            "file" =>  $fileName
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
     * metodo para aginar un nombre temporal a los archivos
     * que se suban
     * @param String $userId el id de el usuario q sube el archivo
     * @return String el nombre temporal 
     */
   private static function getTempFileName(string $userId) : string
   {
     $tempFileName = self::$fileConfig["tempFileName"];

     $ramdonN = mt_rand(1,50000);
     $date = date('Y_m_d__H_i_s');

     $tempName = $tempFileName."__".$userId."__".$ramdonN."__".$date;

     return $tempName;
   }

  

    /**
     *  obtener la validacion de  un archivo segun su configuraciom
     * 
     * @param String $type el tipo de archivo
     * @param String  $validation retornamos la validacion
     */
    private static function getFileValidation(string $type) : string
    {
        
        $validation = ""; 
        $config = self::$fileConfig[$type];
        $extensions = $config["extensions"];
        $maxSize = $config["maxSize"];

        $validation.= "|mimes:".implode(",", $extensions);
        $validation .= "|max:".$maxSize;
   
    
        return $validation;
        
    }


    
    public function test()
    {
        var_dump(
            HelperCtrl::getFileConfig()
        );
    }
     

}
