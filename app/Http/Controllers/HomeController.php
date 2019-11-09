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
        $villagerCount = Villager::where('death_date', null)->count();
        $houseCount = House::get()->count();

        $data_single = Villager::wheremarital_status('bujang')->where('death_date', null)->count();
        $data_kahwin = Villager::wheremarital_status('kahwin')->where('death_date', null)->count();
        $data_duda = Villager::wheremarital_status('duda')->where('death_date', null)->count();

        $data_male = Villager::wheregender('m')->where('death_date', null)->count();
        $data_female = Villager::wheregender('f')->where('death_date', null)->count();

        $data_noProperty = Villager::whereis_property_owner('0')->where('death_date', null)->count();
        $data_haveProperty = Villager::whereis_property_owner('1')->where('death_date', null)->count();

        $active_yes_count = Villager::whereis_active('1')->where('death_date', null)->count();
        $active_no_count = Villager::whereis_active('0')->where('death_date', null)->count();

        $activeChart = new Chartjs;
        $activeChart->title("Penduduk Tetap");
        $activeChart->labels(['Ada', 'Tidak']);
        $activeChart->dataset('Penduduk Tetap', 'bar', [$active_yes_count,$active_no_count])->options([
            'backgroundColor' => ['#F5BAFC', '#D2FF90'],
            'borderColor' => ['#C835D9','#9EF222']
        ]);

        $maritalChart = new Chartjs;
        $maritalChart->title("Marital Status");
        $maritalChart->labels(['bujang', 'kahwin','duda']);
        $maritalChart->dataset('Marital Status', 'bar', [$data_single,$data_kahwin,$data_duda])->options([
            'backgroundColor' => ['#9B59B6', '#2ECC71', '#FFB74D']
        ]);

        $genderChart = new Chartjs;
        $genderChart->title("Jantina");
        $genderChart->labels(['Lelaki', 'Perempuan']);
        $genderChart->displayAxes(false);
        $genderChart->dataset('Gender', 'pie', [$data_male,$data_female])->options([
            'backgroundColor' => ['#33A1FF', '#FF333B'],
        ]);

        $propertyOwnerChart = new Chartjs;
        $propertyOwnerChart->title("Pemilik Harta Tanah");
        $propertyOwnerChart->labels(['Ada', 'Tidak']);
        $propertyOwnerChart->dataset('Pemilik Harta Tanah','bar', [$data_noProperty,$data_haveProperty])->options([
            'backgroundColor' => ['#B9DBFA', '#FFABE7'],
            'borderColor' => ['#2D7AC1','#AA408C']
        ]);

        return view('home', compact('activeChart','maritalChart','genderChart','propertyOwnerChart', 'villagerCount', 'houseCount'));
    }


}
