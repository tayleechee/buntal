<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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

    public function getVillagerDetail(Request $request)
    {
    	$id = $request->id;
    	$villager = Villager::find($id);

    	if (!$villager) {
    		return Response::json("Record Not Found.", 404);
    	}

    	return $villager;
    }

    public function setVillagerDetail(Request $request)
    {
    	$rules = [
    		'villager_id' => 'required',
		    'name' => 'required',
		    'ic' => 'required',
		    'dob' => 'required',
		    'gender' => 'required',
		    'marital' => 'required',
		    'education' => 'required',
		    'occupation' => 'required',
		    'race' => 'required',
		    'active' => 'required',
		    'propertyOwner' => 'required',
		];

		$validator = Validator::make($request->all(), $rules);
		$validator->validate();

		$villager = Villager::find($request->villager_id);
		if (!$villager) {
			return Response::json("Villager Record Not Found.", 455);
		}

		$villager->name = $request->name;
		$villager->ic = $request->ic;
		$villager->dob = $request->dob;
		//$villager->gender = $request->gender;
		if ($request->gender == 'male') {
			$villager->gender = 'm';
		}
		else if ($request->gender == 'female') {
			$villager->gender = 'f';
		}

		$villager->marital_status = $request->marital;
		$villager->education_level = $request->education;
		$villager->occupation = $request->occupation;
		$villager->race = $request->race;
		$villager->is_active = $request->active;
		$villager->is_property_owner = $request->propertyOwner;

		$villager->save();

		flash('Changes Saved!')->success();
    }

    public function markLive(Request $request)
    {
    	$id = $request->id;

    	$villager = Villager::find($request->id);
		if (!$villager) {
			return Response::json("Villager Record Not Found.", 455);
		}

		$villager->death_date = null;
		$villager->save();

		flash('Marked as Live!')->success();
    }

    public function markDead(Request $request)
    {
    	$rules = [
    		'id' => 'required',
		    'deathDate' => 'required',
		];

		$validator = Validator::make($request->all(), $rules);
		$validator->validate();

		$villager = Villager::find($request->id);
		if (!$villager) {
			return Response::json("Villager Record Not Found.", 455);
		}

		$villager->death_date = $request->deathDate;
		$villager->save();

		flash('Marked as Dead!')->success();
    }
}
