<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function posts(){
        //Many to Many
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
