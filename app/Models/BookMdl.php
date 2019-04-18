<?php

namespace appLibros\Models;

use Illuminate\Database\Eloquent\Model;

class BookMdl extends Model
{
 
    protected $table = 'books';
    protected $primaryKey = "bookId";

    public $timestamps = false;

}
