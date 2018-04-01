<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagesPet extends Model
{
    protected $table = "imagesPets";
	
	protected $fillable = ['name', 'pet_id'];

	public function pet(){
    	return $this->belongsTo('App\Pet');
    }
}
