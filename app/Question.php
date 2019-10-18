<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\User;

class Question extends Model
{
    protected $fillable = ['title', 'body'];
    // questions belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        // Function to convert the string into slug format
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getUrlAttribute(){
        return route("questions.show", $this->id);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }
}
