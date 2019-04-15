<?php

namespace appLibros\Http\Controllers\Admins;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;
use appLibros\Models\BookCategoryMdl;
use Illuminate\Support\Facades\Validator;


class BookCategoryCtrl extends Controller
{
    
    public function index()
    {
       // var_dump($data);
        return view('admins/books/categories');
    }


    public function getAll()
    {
        $data  =  BookCategoryMdl::all('bookCategoryId as id','name', 'description', 'userCreateId', 'state');
        return response()->json($data);
    }

 
    /**
     * guardar una nueva categoria
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        
        $rules = ["name" => "required|max:10000"];
        $validation= Validator::make($request->all(),$rules);

		if($validation->fails()){
			return response()->json([
               "dataError" => $validation->errors(),
               'error' =>  true
           ]);;
        }
        

        try {
            $bookCategoryMdl = new BookCategoryMdl;
            $bookCategoryMdl->name = $request->name;
            $bookCategoryMdl->save();
    
            $dataEmit = array(
              "name" =>  $request->name,
              "id" =>$bookCategoryMdl->bookCategoryId,
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



    /**
     * actualizar una nueva categoria
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        
        $rules = ["name" => "required|max:10000", "id" => "required|integer"];

        $validation= Validator::make($request->all(),$rules);
		if($validation->fails()){
			 
			return response()->json([
               "dataError" => $validation->errors(),
               'error' =>  true
           ]);;
        }
        

        try {
            $updateId = $request->id;

            $bookCategoryMdl =  BookCategoryMdl::find($updateId);
            $bookCategoryMdl->name = $request->name;
            $bookCategoryMdl->save();
    
            $dataEmit = array(
              "name" =>  $request->name
            );

            return response()->json([
                "dataEmit" =>  $dataEmit,
                'msg' => "ok",
                'error' =>  false
            ]);

        } catch (\Exception  $e) {
            return response()->json([
               'msg' => "erro al intentar actualizar los datos",
               'error' =>  true
              
           ]);
        }    
    }




}
