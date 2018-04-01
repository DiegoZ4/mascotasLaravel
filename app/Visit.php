<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = "visits";

    protected $fillable = ['clinica','fecha', 'doctor', 'diganostico', 'receta', 'pet_id'];

    public function pet(){
    	return $this->belongsTo('App\Pet');
    }
}
