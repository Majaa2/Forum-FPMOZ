<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'text','user_id','thread_id'
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function thread(){
        return $this->belongsTo('App\Thread','thread_id');
    }
}
