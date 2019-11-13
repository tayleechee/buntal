<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Villager;
use App\HousePOC;
use Response;

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
    	$villager = Villager::with('poc')->find($id);

    	if (!$villager) {
    		return Response::json("Maklumat penduduk tidak dijumpai.", 404); //Record Not Found
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
		    'race' => 'required',
		    'active' => 'required',
		    'propertyOwner' => 'required',
		    'is_voter' => 'required',
		];

		$validator = Validator::make($request->all(), $rules);
		$validator->validate();

		$villager = Villager::find($request->villager_id);
		if (!$villager) {
			return Response::json("Maklumat penduduk tidak dijumpai.", 455);
		}

		if ($villager->poc && empty($request->phone))
		{
			return Response::json("Ketua Rumah's phone number cannot be empty", 412);
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
		$villager->race = $request->race;
		$villager->is_active = $request->active;
		$villager->is_property_owner = $request->propertyOwner;
		$villager->is_voter = $request->is_voter;

		if (isset($request->phone))
			$villager->phone = $request->phone;
		else
			$villager->phone = null;

		if (isset($request->occupation))
			$villager->occupation = $request->occupation;
		else
			$villager->occupation = null;

		$villager->save();

		if (!empty($request->flash_by_overlay))
		{
			flash()->overlay('Berjaya Disimpan!');//'Changes Saved!', 'Edit Successful'
		}
		else
		{
			flash('Berjaya Disimpan!')->success();
		}

    }

    public function markLive(Request $request)
    {
    	$id = $request->id;

    	$villager = Villager::find($request->id);
		if (!$villager) {
			return Response::json("Maklumat penduduk tidak dijumpai.", 455);
		}

		$villager->death_date = null;
		$villager->save();

		flash('Berjaya Disimpan!')->success(); //Marked as Alive
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
			return Response::json("Maklumat penduduk tidak dijumpai.", 455); //Villager Record Not Found
		}

		if ($house_poc = HousePOC::where('villager_id', $villager->id))
		{
			$house_poc->delete();
		}

		$villager->death_date = $request->deathDate;
		$villager->save();

		flash('Berjaya Disimpan.')->success(); //Marked as Dead!
    }

    public function deleteVillager(Request $request)
    {
    	$id = $request->id;

    	$villager = Villager::find($request->id);
		if (!$villager) {
			return Response::json("Maklumat penduduk tidak dijumpai.", 455);
		}

		$name = $villager->name;
		$villager->delete();

		flash("Maklumat $name berjaya dikemaskini!")->success(); //Record Deleted
    }
}
