<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Property;
use Yajra\Datatables\Datatables;

class PropertyRecordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('propertyRecords');
    }

    public function getPropertyRecords()
    {
        return Datatables::of(Property::with('villager')->get())->make(true);
    }
}
