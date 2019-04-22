<?php

namespace appLibros\Models;

use Illuminate\Database\Eloquent\Model;

class StudentMdl extends Model
{
    protected $table = 'students';
    protected $primaryKey = "studentId";
    public $timestamps = false;
}
