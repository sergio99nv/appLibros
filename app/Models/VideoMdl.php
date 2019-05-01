<?php

namespace appLibros\Models;

use Illuminate\Database\Eloquent\Model;

class VideoMdl extends Model
{
    protected $table = 'videos';
    protected $primaryKey = "videoId";

    public $timestamps = false;

     

}
