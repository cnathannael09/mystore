<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    public $timestamps = false;
    //bisa melihat kategori sesuai dengan kolom category_id
    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }
    
    public function transactions()
    {
        return $this->belongsToMany('App\Medicine','medicine_transaction','medicine_id','transaction_id')->withPivot('quantity','price');
    }
}
