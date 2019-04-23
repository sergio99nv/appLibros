<?php

namespace appLibros\Models;

use Illuminate\Database\Eloquent\Model;

class BookMdl extends Model
{
 
    protected $table = 'books';
    protected $primaryKey = "bookId";

    public $timestamps = false;



    /**
     * guardar una nuevo libro
     *
     * @param  Request  $request
     * @return Int  Retornamos el id del registro insetado
     */
    public function saveNewBook($request)  
    {
        $bookCategoryMdl = new BookMdl;
        $bookCategoryMdl->bookCategoryId = $request->bookCategoryId;
        $bookCategoryMdl->name = $request->name;
        $bookCategoryMdl->description = $request->description;
        $bookCategoryMdl->author = $request->author;

        $bookCategoryMdl->file = $request->file;
        $bookCategoryMdl->cover =  $request->cover;
        $bookCategoryMdl->bookYear = "2019-01-01";

        $bookCategoryMdl->save();

        return $bookCategoryMdl->bookId;
    }



    /**
     * actualizar  una   libro
     *
     * @param  Int  $updateId
     * @param  Request  $request 
     */
    public function updateBook($updateId, $request)
    {
      
        $bookCategoryMdl =  BookMdl::find($updateId);
      
    
        $bookCategoryMdl->name = $request->name;
        $bookCategoryMdl->description = $request->description;
        $bookCategoryMdl->author = $request->author;

        $bookCategoryMdl->file = $request->file;
        $bookCategoryMdl->cover =  $request->cover;
      
        $bookCategoryMdl->save();
    }



}
