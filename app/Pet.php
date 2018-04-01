<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = "pets";

    protected $fillable = ['name', 'rase', 'type', 'user_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function imagesPets(){
    	return $this->hasMany('App\ImagesPet');
    }

    public function scopeSearch($query, $name) {
        return $query->where('name', 'LIKE', "%$name%");
    }
}
