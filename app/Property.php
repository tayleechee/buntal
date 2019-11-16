<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public $timestamps = false;
    protected $table = 'property';

    public function villager()
    {
    	return $this->belongsTo('App\Villager');
    }
}
