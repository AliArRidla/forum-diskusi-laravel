<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    //
    protected $fillable = ['title'];

    public function discussions(){
        return $this->hasMany('App\Discussion');
    }
}
