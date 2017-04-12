<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'summary', 'content', 'author', 'picurl'
    ];

    public function likes()
    {
        //One to Many
        return $this->hasMany('App\Like');
    }

    public function comments()
    {
        //One to Many
        return $this->hasMany('App\Comment');
    }

    public function tags()
    {
        //Many to Many
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'author');
    }
}
