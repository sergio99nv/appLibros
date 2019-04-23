<?php

namespace appLibros\Http\Controllers\Students;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;

use appLibros\Models\BookCategoryMdl;
use appLibros\Models\BookMdl;


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

        var_dump(
            $categories
        );
       
    }



     /**
     * guardar un nuevo libro
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
     * guardar un nuevo libro
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
