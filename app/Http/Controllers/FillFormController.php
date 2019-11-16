<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use App\House;
use App\Villager;
use App\HousePOC;
use App\Property;
use Image;

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
			'step1_address.unique' => 'Alamat Rumah ini telah didaftar.',
			'step1_householdIncome.required' => 'Wajib!.',
			'step1_numberOfFamily.required' => 'Wajib!',
			'step1_numberOfFamilyMember.required' => 'Wajib!',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		$validator->validate();

    	return view('fillForm.step2', ['step1_address' => $request->step1_address, 'step1_householdIncome' => $request->step1_householdIncome, 'step1_numberOfFamily' => $request->step1_numberOfFamily, 'step1_numberOfFamilyMember' => $request->step1_numberOfFamilyMember]);
    }

    public function processStep2(Request $request)
    {
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
		    'member.*.race' => 'required',
		    'member.*.active' => 'required',
		    'member.*.propertyOwner' => 'required',
		    'member.*.is_voter' => 'required',
		];

		$messages = [
			'step2_householdIncome.required' => 'Wajib!',
			'step2_numberOfFamily.required' => 'Wajib!',
			'step2_numberOfFamilyMember.required' => 'Wajib!',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		$validator->validate();

		$first_member = (object)$request->member[1];
		if (empty($first_member->phone))
		{
			return Response::json("Telefon nombor Ketua Rumah perlu diisi.", 412);
		}

		$address = $request->step2_address;
		if (House::where('address', $address)->count() > 0)
		{
			return Response::json("Alamat Rumah ini sudah wujud.", 412);
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
			foreach($members as $index => $member)
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
				$villager->is_property_owner = $member->propertyOwner;
				$villager->is_active = $member->active;
				$villager->is_voter = $member->is_voter;

				if (isset($member->occupation))
					$villager->occupation = $member->occupation;
				if (isset($member->phone))
					$villager->phone = $member->phone;

				$villager->save();
				$villager_id = $villager->id;

				if ($index == 1) 
				{
					$first_member_id = $villager_id;
				}

				if (isset($member->tanah))
				{
					$tanahs = $member->tanah;
					foreach ($tanahs as $tanah_index => $tanah)
					{
						$tanah = (object)$tanah;
						$property = new Property;
						$property->kawasan = $tanah->kawasan;
						$property->keluasan = $tanah->keluasan;
						$property->type = $tanah->type;
						$property->villager_id = $villager_id;
						$property->save();

						$property_id = $property->id;

						if($request->hasFile('member.'.($index).'.tanah.'.($tanah_index).'.photo')){
				            $photo = $request->file('member.'.($index).'.tanah.'.($tanah_index).'.photo');
				            $filename = time()."_".$villager_id."_".$property_id.".".$photo->getClientOriginalExtension();
				            $filepath = 'image/upload/'.$filename;
				            Image::make($photo)->save(public_path($filepath));

				            $property->image_path = $filepath;
				            $property->save();
			        	}
					}
				}
				
			}
			
			$house_poc = new HousePOC;
			$house_poc->house_id = $house_id;
			$house_poc->villager_id = $first_member_id;
			$house_poc->save();
		}
		catch (\Exception $e) {
			$house->delete();
			return Response::json($e->getMessage(), 500);
		}

		return 200;
    }
}
