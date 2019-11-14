<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class AdminRecordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superadmin');
    }

    public function index()
    {
    	return view('adminRecords');
    }

    public function getAdminRecords()
    {
        return Datatables::of(User::get())->make(true);
    }

    public function getAdminDetail(Request $request)
    {
    	$admin = User::find($request->id);

    	if (!$admin)
    	{
    		return Response::json("Not found", 412);
    	}

    	return $admin;
    }

    public function addAdmin(Request $request)
    {
    	$rules = [
		    'username' => 'required',
		    'password' => 'required',
		];

		$validator = Validator::make($request->all(), $rules);
		$validator->validate();

    	$redundant_count = User::where('username', $request->username)->count();

    	if ($redundant_count > 0)
    	{
    		return Response::json("Username already used!", 412);
    	}

    	$admin = new User;
    	$admin->name = $request->name;
    	$admin->username = $request->username;
    	$admin->password = Hash::make($request->password);
    	$admin->save();

    	flash('Admin Added Successfully!')->success();
    }

    public function editAdmin(Request $request)
    {
    	$rules = [
		    'username' => 'required',
		    'name' => 'required',
		];

		$validator = Validator::make($request->all(), $rules);
		$validator->validate();

    	$redundant_count = User::where('username', $request->username)->where('id', '!=', $request->id)->count();

    	if ($redundant_count > 0)
    	{
    		return Response::json("Username already used!", 412);
    	}

    	$admin = User::find($request->id);

    	if (!$admin)
    	{
    		return Response::json('Admin not found!', 412);
    	}
    	else
    	{
    		$admin->username = $request->username;
    		$admin->name = $request->name;
    		$admin->save();

    		flash('Changes Saved!')->success();
    	}
    }

    public function editAdminPassword(Request $request)
    {
    	$admin = User::find($request->id);

    	if (!$admin)
    	{
    		return Response::json('Admin not found!', 412);
    	}

    	$admin->password = Hash::make($request->password);
    	$admin->save();

    	flash('Password Changed!')->success();
    }

    public function deleteAdmin(Request $request)
    {
    	$admin = User::find($request->id);

    	if (!$admin)
    	{
    		return Response::json('Admin not found!', 412);
    	}

    	if ($admin->is_superadmin)
    	{
    		return Response::json('Superadmin cannot be deleted!', 412);
    	}

    	$admin->delete();

    	flash('Admin Deleted!')->success();
    }
}
