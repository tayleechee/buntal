<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Response;
use App\House;
use App\Villager;
use App\HousePOC;

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

    	if ($house->poc)
    		$house_poc_id = $house->poc->villager_id;

    	foreach ($house->villagers as $key => $villager)
    	{
    		if ($house->poc && $villager->id == $house_poc_id)
    		{
    			$house->villagers->pull($key);
    			$house->villagers->prepend($villager);
    		}
    	}

    	//dd($house->villagers);
    	return view('house', ['house' => $house]);
    }

    public function getHouseDetail(Request $request)
    {
    	$id = $request->id;
    	$house = House::find($id);

    	if (!$house) {
    		return Response::json("Rekod tidak dijumpai.", 404);
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
		    'poc' => 'required',
		];

		$validator = Validator::make($request->all(), $rules);
		$validator->validate();

		if (House::where('address', $request->address)->where('id', '!=', $request->house_id)->count() > 0)
		{
			return Response::json("Alamat Rumah ini sudah wujud! Pengulangan Alamat Rumah tidak dibenarkan.", 412);
		}

		$house = House::find($request->house_id);
		if (!$house) {
			return Response::json("Rekod rumah tidak dijumpai.", 455);
		}

		if (HousePOC::where('villager_id', $request->poc)->count() == 0)
		{
			$new_poc = Villager::find($request->poc);
			if (empty($new_poc->phone))
			{
				return Response::json("Nombor telefon ketua rumah mesti diisi. Sila isi nombor telefon ".$new_poc->name." dulu.", 455); //New Ketua Rumah must have phone number filled! Please fill in phone number for
			}

			HousePOC::where('house_id', $house->id)->delete();

			$new_housePoc = new HousePOC;
			$new_housePoc->house_id = $house->id;
			$new_housePoc->villager_id = $request->poc;
			$new_housePoc->save();
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
			return Response::json("Rekod maklumat rumah tidak dijumpai.", 455);
		}

		$house->delete();

		flash("Rekod maklumat rumah dipadam!")->success();
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
		    'race' => 'required',
		    'active' => 'required',
		    'propertyOwner' => 'required',
		];

		$validator = Validator::make($request->all(), $rules);
		$validator->validate();

		$house_id = $request->house_id;
		$house = House::find($house_id);

		if (!$house) {
			return Response::json("Rekod maklumat rumah tidak dijumpai.", 455);
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
		$villager->is_property_owner = $request->propertyOwner;
		$villager->is_active = $request->active;

		if (isset($request->occupation))
			$villager->occupation = $request->occupation;
		if (isset($request->phone))
			$villager->phone = $request->phone;

		$villager->save();

		flash('Telah Berjaya!')->success();		

		return Response::json("Success", 200);
    }
}
