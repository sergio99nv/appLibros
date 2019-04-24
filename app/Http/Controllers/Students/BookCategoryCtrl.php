<?php

namespace appLibros\Http\Controllers\Students;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;

use appLibros\Models\BookCategoryMdl;
use appLibros\Models\BookMdl;
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
        
        $books  = BookMdl::where("bookCategoryId",  $categoryId)->get([
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
                                                     "fileUlrs" =>  $fileUlrs
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
