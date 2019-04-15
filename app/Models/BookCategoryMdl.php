<?php

namespace appLibros\Models;

use Illuminate\Database\Eloquent\Model;

class BookCategoryMdl extends Model
{
    //

    protected $primaryKey = "bookCategoryId";

    protected $table = 'bookCategories';
    public $timestamps = false;
}
