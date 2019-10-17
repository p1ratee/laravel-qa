<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Question extends Model
{
    protected $fillable = ['title', 'body'];
    // questions belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
