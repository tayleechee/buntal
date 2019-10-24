<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    public $timestamps = false;
    protected $table = 'houses';

    public function aliveVillagers()
    {
    	return $this->hasMany('App\Villager')->where('death_date', null);
    }
}
