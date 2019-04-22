<?php

namespace appLibros\Models;

use Illuminate\Database\Eloquent\Model;

class AdminMdl extends Model
{
   
    protected $table = 'admins';
    protected $primaryKey = "adminId";
    public $timestamps = false;

   // protected $guarded = ['password'];

}
