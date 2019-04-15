<?php

namespace appLibros\Http\Controllers;

use Illuminate\Http\Request;

class SetDataCtrl extends Controller
{
    
    public function getData()
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
             "ramdomId"  => random_int(0, 50000)
        ]);
    }
}
