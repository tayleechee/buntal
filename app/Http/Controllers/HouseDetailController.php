<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Response;
use App\House;
use App\Villager;

class HouseDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	$id = $request->id;
    	$house = House::find($id);

    	if (!$house) {
    		abort(404);
    	}

    	return view('house', ['house' => $house]);
    }

    public function getHouseDetail(Request $request)
    {
    	$id = $request->id;
    	$house = House::find($id);

    	if (!$house) {
    		return Response::json("Record Not Found.", 404);
    	}

    	return $house;
    }

    public function setHouseDetail(Request $request)
    {
    	$rules = [
    		'house_id' => 'required',
		    'address' => 'required',
		    'householdIncome' => 'required',
		    'numberOfFamily' => 'required',
		];

		$validator = Validator::make($request->all(), $rules);
		$validator->validate();

		if (House::where('address', $request->address)->where('id', '!=', $request->house_id)->count() > 0)
		{
			return Response::json("Address already used! No repeating address is allowed.", 412);
		}

		$house = House::find($request->house_id);
		if (!$house) {
			return Response::json("House Record Not Found.", 455);
		}

		$house->address = $request->address;
		$house->household_income = $request->householdIncome;
		$house->family_number = $request->numberOfFamily;
		
		$house->save();

		flash('Changes Saved!')->success();
    }

    public function deleteHouse(Request $request)
    {
    	$id = $request->id;

    	$house = House::find($request->id);
		if (!$house) {
			return Response::json("House Record Not Found.", 455);
		}

		$house->delete();

		flash("House Recorded Deleted!")->success();
    }

    public function addMember(Request $request)
    {
    	$rules = [
    		'house_id' => 'required',
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

		$house_id = $request->house_id;
		$house = House::find($house_id);

		if (!$house) {
			return Response::json("House Record Not Found.", 455);
		}

		$villager = new Villager;
		$villager->house_id = $house_id;
		$villager->name = $request->name;
		$villager->ic = $request->ic;

		if ($request->gender == 'male') {
			$villager->gender = 'm';
		}
		else {
			$villager->gender = 'f';
		}

		$villager->dob = $request->dob;
		$villager->race = $request->race;
		$villager->marital_status = $request->marital;
		$villager->education_level = $request->education;
		$villager->occupation = $request->occupation;
		$villager->is_property_owner = $request->propertyOwner;
		$villager->is_active = $request->active;
		$villager->save();

		flash('Member Added Successfully!')->success();		

		return Response::json("Success", 200);
    }
}
