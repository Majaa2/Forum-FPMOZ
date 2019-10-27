<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = [
        'subject', 'name', 'text','user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
