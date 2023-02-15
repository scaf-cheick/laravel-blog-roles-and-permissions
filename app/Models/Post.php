<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'title','ref', 'category_id','initiator_id','validator_id','title','status','slug','content','banner',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function category(){

        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function initiator(){

        return $this->belongsTo('App\User', 'initiator_id');
    }

    public function validator(){

        return $this->belongsTo('App\User', 'validator');
    }
}
