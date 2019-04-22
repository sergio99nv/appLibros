<?php

namespace appLibros\Http\Controllers\Students;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;

class BookCategoryCtrl extends Controller
{
    public function index(){
         
        return view('students/bookCategories');
    }
}
