<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'body'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    //add ----
   
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    
    }
    // add shandy for link in index
    public function getUrlAttribute()
    {
        return route("questions.show", $this->id); //route to User.php
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    //end here for index link
}
