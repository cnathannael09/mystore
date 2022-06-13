<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // use SoftDeletes;
    public $timestamps = false;
    public function medicines(){
        return $this->hasMany('App\Medicine','category_id','id');
    }
}
