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
    
    private  static   $bookFields = [
                    'bookId as id',
                    'name',
                    'description', 
                    'author', 
                    'bookYear', 
                    'file',
                    'cover'
                ];


    /**
     * obtener los datos de una categoria
     *
     * @param  Int  $categoryId
     * @return Response
     */
    public function getBooks($categoryId = null)  
    {

        $categories  =  BookCategoryMdl::all('bookCategoryId as id','name');
        $categoryIdName = "Todos";

    
        //si es nulo obtenemos todos los libros
        //si no obtenmos los libros por categoria
        $bookFields  = self::$bookFields;

        if(is_null($categoryId )){
            $books  = BookMdl::all($bookFields); 
        }else{     
            $books  = BookMdl::where("bookCategoryId",  $categoryId)->get($bookFields);
            $categoryIdName =  BookCategoryMdl::find($categoryId, ["name"])->name;
        }
   
        $fileUlrs = self::getUrlBookCover();
        $dataView = array(
                        "categories"=>$categories,
                        "books"=>$books,
                        "fileUlrs" =>  $fileUlrs,
                        "categoryName" => $categoryIdName,
                        "isSearch" => false
                    );


        return view('students/books/cagoryWithbooks', $dataView);
    
    }




   /**
     * buscar por libro o autor
     *
     * @param  Request   
     * @return Response
     */
    public function search(Request $request)
    {
        
        $rules = [
            "bookName" => "required",
            "categoryId" => "required|int|min:-1"  
           ];
 
        $validation= Validator::make($request->all(),$rules);
        if($validation->fails()){
           // return redirect('books');
            return response()->json([
                'error' =>  true,
                "dataError" => $validation->errors()
            ]);
           
        }

       
        $bookName = $request->bookName;
        $categoryId = $request->categoryId;

        $bookFields  = self::$bookFields;

        if($categoryId >=1){
            $dataBook  = BookMdl::where( "bookCategoryId" , $categoryId)
                        ->where(function($query) use($bookName) {
                            $query->where("name", "LIKE", "{$bookName}%")
                            ->orWhere("author", "LIKE", "{$bookName}%");
                        })->get($bookFields);

        }else{
            $dataBook  = BookMdl::where("name", "LIKE", "{$bookName}%")
                                ->orWhere("author", "LIKE", "{$bookName}%")
                                ->get($bookFields);
               
        }

       

        $categories  =  BookCategoryMdl::all('bookCategoryId as id','name');
        $fileUlrs = self::getUrlBookCover();


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
     * obtener el path donde estas almacenadas las portadas de los
     * libros
     * @return Array
     */
    private static function getUrlBookCover() :  Array
    {
        $fileConfig =  HelperCtrl::getFileConfig();
        $data = array("image"=> $fileConfig["image"]["urlPath"],
                       "file"=> $fileConfig["file"]["urlPath"]);
        return   $data ;
    }

 


    /**
     * obtener informacion de un libro
     *
     * @param  Int  $bookId
     * @return Response
     */
    public function getBookInfo($bookId)
    {
        $bookFields  = self::$bookFields;    
        $bookInfo =  BookMdl::find($bookId, $bookFields);

        $categories  =  BookCategoryMdl::all('bookCategoryId as id','name');
        $fileUlrs = self::getUrlBookCover();

        $dataView = array(
            "bookInfo"=>$bookInfo,
            "fileUlrs" =>  $fileUlrs,
            "bookId"=> $bookId,
            "categories" =>  $categories
        );

        return view('students/books/bookInfo', $dataView);

    }

   






}
