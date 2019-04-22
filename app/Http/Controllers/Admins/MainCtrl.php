<?php

namespace appLibros\Http\Controllers\Admins;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;

class MainCtrl extends Controller
{
    public function index()
    {
       // var_dump($data);
       return view('admins/main');
    }

}
