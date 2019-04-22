<?php

namespace appLibros\Http\Controllers\Admins;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;
use appLibros\Models\AdminMdl;

class  AdminCtrl extends Controller
{
    public function index()
    {
        return view('admins/users');
    }


    public function getAll()
    {
        $data  =  AdminMdl::all('adminId as id', 'userName', 'state');
        return response()->json([
            "data" => $data,
            'error' =>  false
        ]);
    }


   
}
