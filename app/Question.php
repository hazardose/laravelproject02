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
    // add shandy for link in index [connect to index.blade.php]
    public function getUrlAttribute()
    {
        //modify routes $id to $slug url.
        #return route("questions.show", $id);
        return route("questions.show", $this->slug); //route to User.php
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    //end here for index link

    //add for css here for status
    public function getStatusAttribute()
    {
        if($this->answers > 0){
            if($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }return "unanswered";
    } //end status here!

    public function getBodyHtmlAttribute()
    {
        //to convert into html tags
        return \Parsedown::instance()->text($this->body);
    }
}
