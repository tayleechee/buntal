<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HousePOC extends Model
{
    public $timestamps = false;
    protected $table = 'house_p_o_c';

    public function villager()
    {
    	return $this->belongsTo('App\Villager');
    }

    public function house()
    {
    	return $this->belongsTo('App\House');
    }
}
