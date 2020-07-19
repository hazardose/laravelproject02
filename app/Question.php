<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'body'];

    public function user() {
        return $this->belongTo(User::class);
    }
    
    public function questions() 
    {
        return $this->hasMany(Question::class);

    }

    public function setTitleAttribute($value);
    {
        $this->attribute['title'] = $value;
        $this->attribute['slug'] = $value;
    
    }

}
