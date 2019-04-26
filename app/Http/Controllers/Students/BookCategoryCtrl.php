<?php

namespace appLibros\Http\Controllers\Students;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;

use appLibros\Models\BookCategoryMdl;
use appLibros\Models\BookMdl;
use Illuminate\Support\Facades\Validator;
use appLibros\Http\Controllers\HelperCtrl;


class BookCategoryCtrl extends Controller
{
    public function index(){
         
        return view('students/bookCategories');
    }

        /**
     * obtener los datos de una categoria
     *
     * @param  Request  $request
     * @return Response
     */
    public function getCategories()
    {
        $categories  =  BookCategoryMdl::all('bookCategoryId as id','name');

        $categoryId= 1;
        
        $books  = BookMdl::all([
            'bookId as id',
            'name',
            'description', 
            'author', 
            'bookYear', 
            'file',
            'cover'
        ]); 


        $fileConfig =  HelperCtrl::getFileConfig();
        $fileUlrs = array("image"=> $fileConfig["image"]["urlPath"]); 

        return view('students/books/cagoryWithbooks', 
                                                array(
                                                     "categories"=>$categories,
                                                     "books"=>$books,
                                                     "fileUlrs" =>  $fileUlrs,
                                                     "isSearch" => false
                                                     )
                                            );
        
       
    }


    public function searchBookAuthor(Request $request)
    {

        $rules = [
            "bookName" => "required" 
           ];
 
        $validation= Validator::make($request->all(),$rules);
        if($validation->fails()){
            return response()->json([
               'error' =>  true,
               "dataError" => $validation->errors()
           ]);
        }

        $bookName = $request->bookName;
        $dataBook  = BookMdl::where("name", "LIKE", "{$bookName}%")
                      ->orWhere("author", "LIKE", "{$bookName}%")
                    ->get([
                    'bookId as id',
                    'name',
                    'description', 
                    'author', 
                    'bookYear', 
                    'file',
                    'cover'
                ]);

        $categories  =  BookCategoryMdl::all('bookCategoryId as id','name');
        $fileConfig =  HelperCtrl::getFileConfig();
        $fileUlrs = array("image"=> $fileConfig["image"]["urlPath"]); 

        return view('students/books/cagoryWithbooks', 
                                                array(
                                                        "categories"=>$categories,
                                                        "books"=>$dataBook,
                                                        "fileUlrs" =>  $fileUlrs,
                                                        "isSearch" => true
                                                        )
                                            );
    }


     /**
     *  
     *
     * @param  Request  $request
     * @return Response
     */
    public function getBookByCategory($categoryId)
    {
       
        $dataBook  = BookMdl::where("bookCategoryId",  $categoryId)
                     
                    ->get([
                        'bookId as id',
                        'name',
                        'description', 
                        'author', 
                        'bookYear', 
                        'file',
                        'cover'
                    ]);

       //$data = self::addFilePath($dataBook);

      
            var_dump(
                $dataBook
            );
          
     
    }


      /**
     *  
     *
     * @param  Request  $request
     * @return Response
     */
    public function getBook($bookId)
    {
       
        $dataBook  = BookMdl::find($bookId)
                    ->get([
                        'bookId as id',
                        'name',
                        'description', 
                        'author', 
                        'bookYear', 
                        'file',
                        'cover'
                    ]);

       //$data = self::addFilePath($dataBook);

      
            var_dump(
                $dataBook
            );
          
     
    }






}
