<?php

namespace App\Http\Controllers;
//use App\Charts\MaritalChart;
//use App\Charts\GenderChart;
//use App\Charts\PropertyChart;
use App\Charts\Chartjs;
use App\Charts\Highcharts;
use Illuminate\Http\Request;
use App\Villager;
use App\House;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $villagerCount = Villager::get()->count();
        $houseCount = House::get()->count();

        $data_single = Villager::wheremarital_status('bujang')->count();
        $data_kahwin = Villager::wheremarital_status('kahwin')->count();
        $data_duda = Villager::wheremarital_status('duda')->count();

        $data_male = Villager::wheregender('m')->count();
        $data_female = Villager::wheregender('f')->count();

        $data_noProperty = Villager::whereis_property_owner('0')->count();
        $data_haveProperty = Villager::whereis_property_owner('1')->count();

        $maritalChart = new Chartjs;
        $maritalChart->title("Marital Status");
        $maritalChart->labels(['bujang', 'kahwin','duda']);
        $maritalChart->dataset('Marital Status', 'bar', [$data_single,$data_kahwin,$data_duda])->options([
            'backgroundColor' => ['#9B59B6', '#2ECC71', '#FFB74D']
        ]);

        $genderChart = new Chartjs;
        $genderChart->title("Gender");
        $genderChart->labels(['Lelaki', 'Perempuan']);
        $genderChart->displayAxes(false);
        $genderChart->dataset('Gender', 'pie', [$data_male,$data_female])->options([
            'backgroundColor' => ['#33A1FF', '#FF333B'],
        ]);

        $propertyOwnerChart = new Chartjs;
        $propertyOwnerChart->title("Property Owner");
        $propertyOwnerChart->labels(['No', 'Yes']);
        $propertyOwnerChart->dataset('Property Owner','bar', [$data_noProperty,$data_haveProperty])->options([
            'backgroundColor' => ['#333399', '#FF0066']
        ]);

        return view('home', compact('maritalChart','genderChart','propertyOwnerChart', 'villagerCount', 'houseCount'));
    }

    
}
