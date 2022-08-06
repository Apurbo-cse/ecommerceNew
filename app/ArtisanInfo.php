<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtisanInfo extends Model
{
    protected $fillable = [ 'desc','image', 'sub_desc'];
}
