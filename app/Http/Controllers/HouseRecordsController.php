<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\House;
use Yajra\Datatables\Datatables;

class HouseRecordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('houseRecords');
    }

    public function getHouseRecords()
    {
        return Datatables::of(House::withCount('aliveVillagers')->get())->make(true);
    }
}
