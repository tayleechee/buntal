<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HousePOC;
use Yajra\Datatables\Datatables;

class KetuaRumahRecordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('ketuaRumahRecords');
    }

    public function getKetuaRumahRecords()
    {
        return Datatables::of(HousePOC::with('house', 'villager')->get())->make(true);
    }
}
