<?php

namespace appLibros\Http\Controllers\Admins;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;
use appLibros\Models\AdminMdl;

class  AdminCtrl extends Controller
{
    public function index()
    {
       // var_dump($data);
        return view('admins/users/index');
    }


    public function getAll()
    {
        $data  =  AdminMdl::all('adminId as id', 'descripcion' ,'fullName', 'userName', 'state');
        return response()->json($data);
    }


    public function store(Request $request)
    {
        # code...
        echo   $request->name;
    }
}
