<?php

namespace appLibros\Models;

use Illuminate\Database\Eloquent\Model;

class BookCategoryMdl extends Model
{
    
    protected $table = 'bookCategories';
    protected $primaryKey = "bookCategoryId";
    
    public $timestamps = false;
}
