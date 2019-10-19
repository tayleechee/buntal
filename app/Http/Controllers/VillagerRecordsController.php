<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Villager;
use Yajra\Datatables\Datatables;

class VillagerRecordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('villagerRecords');
    }

    public function getVillagerRecords()
    {
        return Datatables::of(Villager::with(['house'=>function($query){
            $query->select('id', 'address');
        }])->get())->make(true);
    }
}
