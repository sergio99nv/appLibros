<?php

namespace appLibros\Http\Controllers\Admins;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;

use appLibros\Models\BookMdl;
use Illuminate\Support\Facades\Validator;

class BookCtrl extends Controller
{
    public function index()
    {
       // var_dump($data);
        return view('admins/bookCategories/books');
    }


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


        $data  = BookMdl::where("bookCategoryId" , $request->bookCategoryId)
                ->get([
                        'bookId as id',
                        'name',
                        'description', 
                        'author', 
                        'bookYear', 
                        'file',
                        'userCreateId',
                        'state'
                    ]);


        return response()->json([
            "data" => $data,
            'error' =>  false
        ]);

  
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
                 "file" =>  "required|mimes:pdf|max:10000",

                
                ];

        $validation= Validator::make($request->all(),$rules);

		if($validation->fails()){
			return response()->json([
               "dataError" => $validation->errors(),
               'error' =>  true
           ]);;
        }
        

        try {
            $path = $request->file('file')->store('adminBooks');

            $bookCategoryMdl = new BookMdl;
            $bookCategoryMdl->bookCategoryId = $request->bookCategoryId;
            $bookCategoryMdl->name = $request->name;
            $bookCategoryMdl->description = $request->description;
            $bookCategoryMdl->author = $request->author;
            $bookCategoryMdl->file = "file";
            $bookCategoryMdl->bookYear ="2019-01-01";

            $bookCategoryMdl->save();
    
            $dataEmit = array(
               "id" =>$bookCategoryMdl->bookId,
              "name" =>  $request->name,
              "description" => $request->description,
              "author" => $request->author,
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
               'msg' => "erro al intentar guardar los datos",
               'error' =>  true
           ]);
        }    
    }

 
     

}
