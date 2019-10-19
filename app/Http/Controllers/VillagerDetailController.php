<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Villager;

class VillagerDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	$id = $request->id;
    	$villager = Villager::find($id);

    	if (!$villager) {
    		//return redirect()->route('home');
    		abort(404);
    	}

    	return view('villager', ['villager' => $villager]);
    	//dd($villager->name);
    }
}
