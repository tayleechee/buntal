<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Villager extends Model
{
    public $timestamps = false;
    protected $table = 'villagers';

    public function house()
    {
    	return $this->belongsTo('App\House');
    }

    public function poc()
    {
    	return $this->hasOne('App\HousePOC');
    }
}
