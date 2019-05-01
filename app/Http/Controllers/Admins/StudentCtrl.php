<?php

namespace appLibros\Http\Controllers\Admins;

use Illuminate\Http\Request;
use appLibros\Http\Controllers\Controller;

use appLibros\Models\StudentMdl; 

class StudentCtrl extends Controller
{
    public function index()
    {
        return view('admins/students');
    }


    public function getAll()
    {
        $data  =  StudentMdl::all('studentId as id', 'firstName', 'lastName', 'phoneNumber', 'email');
        return response()->json([
            "data" => $data,
            'error' =>  false
        ]);
    }


}
