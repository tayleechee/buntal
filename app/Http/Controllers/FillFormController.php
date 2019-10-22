<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use App\House;
use App\Villager;

class FillFormController extends Controller
{
    public function processStep1(Request $request)
    {
		$rules = [
		    'step1_address' => 'required|unique:houses,address',
		    'step1_householdIncome' => 'required',
		    'step1_numberOfFamily' => 'required',
		    'step1_numberOfFamilyMember' => 'required',
		];

		$messages = [
			'step1_address.unique' => 'This address is already used! Try another one.',
			'step1_householdIncome.required' => 'This field is required.',
			'step1_numberOfFamily.required' => 'This field is required.',
			'step1_numberOfFamilyMember.required' => 'This field is required.',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		$validator->validate();

    	return view('fillForm.step2', ['step1_address' => $request->step1_address, 'step1_householdIncome' => $request->step1_householdIncome, 'step1_numberOfFamily' => $request->step1_numberOfFamily, 'step1_numberOfFamilyMember' => $request->step1_numberOfFamilyMember]);
    }

    public function processStep2(Request $request)
    {
    	//test
    	$rules = [
		    'step2_address' => 'required',
		    'step2_householdIncome' => 'required',
		    'step2_numberOfFamily' => 'required',
		    'step2_numberOfFamilyMember' => 'required',
		    'member.*.name' => 'required',
		    'member.*.ic' => 'required',
		    'member.*.dob' => 'required',
		    'member.*.gender' => 'required',
		    'member.*.marital' => 'required',
		    'member.*.education' => 'required',
		    'member.*.occupation' => 'required',
		    'member.*.race' => 'required',
		    'member.*.active' => 'required',
		    'member.*.propertyOwner' => 'required',
		];

		$messages = [
			'step2_householdIncome.required' => 'This field is required.',
			'step2_numberOfFamily.required' => 'This field is required.',
			'step2_numberOfFamilyMember.required' => 'This field is required.',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		$validator->validate();

		$address = $request->step2_address;
		if (House::where('address', $address)->count() > 0)
		{
			return Response::json("Address already used.", 412);
		}

		$house = new House;
		$house->address = $request->step2_address;
		$house->household_income = $request->step2_householdIncome;
		$house->family_number = $request->step2_numberOfFamily;
		$house->family_member_number = $request->step2_numberOfFamilyMember;
		$house->save();

		$members = $request->member;
		$house_id = $house->id;
		try {
			foreach($members as $member)
			{
				$member = (object)$member;

				$villager = new Villager;
				$villager->house_id = $house_id;
				$villager->name = $member->name;
				$villager->ic = $member->ic;

				if ($member->gender == 'male') {
					$villager->gender = 'm';
				}
				else {
					$villager->gender = 'f';
				}

				$villager->dob = $member->dob;
				$villager->race = $member->race;
				$villager->marital_status = $member->marital;
				$villager->education_level = $member->education;
				$villager->occupation = $member->occupation;
				$villager->is_property_owner = $member->propertyOwner;
				$villager->is_active = $member->active;
				$villager->save();
			}
		}
		catch (\Exception $e) {
			$house->delete();
			return Response::json($e->getMessage(), 500);
		}
    }
}
