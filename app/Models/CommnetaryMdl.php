<?php

namespace appLibros\Models;

use Illuminate\Database\Eloquent\Model;

class CommnetaryMdl extends Model
{
    protected $table = 'commentaries';
    protected $primaryKey = "commentaryId";
    public $timestamps = false;
}
