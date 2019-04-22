<?php

namespace appLibros\Models;

use Illuminate\Database\Eloquent\Model;

class BookMdl extends Model
{
 
    protected $table = 'books';
    protected $primaryKey = "bookId";

    public $timestamps = false;


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



}
