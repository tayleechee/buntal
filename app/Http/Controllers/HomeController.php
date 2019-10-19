<?php

namespace App\Http\Controllers;
//use App\Charts\MaritalChart;
//use App\Charts\GenderChart;
//use App\Charts\PropertyChart;
use App\Charts\Chartjs;
use Illuminate\Http\Request;
use App\Villager;
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
        $data_single = Villager::wheremarital_status('single')->count();
        $data_kahwin = Villager::wheremarital_status('kahwin')->count();
        $data_duda = Villager::wheremarital_status('duda')->count();

        $data_male = Villager::wheregender('m')->count();
        $data_female = Villager::wheregender('f')->count();

        $data_noProperty = Villager::whereis_property_owner('0')->count();
        $data_haveProperty = Villager::whereis_property_owner('1')->count();

        $chart = new Chartjs;
        $chart->title("Marital Status");
        $chart->labels(['bujang', 'kahwin','duda']);
        $chart->dataset('Marital Status', 'bar', [$data_single,$data_kahwin,$data_duda]);

        $chart2 = new Chartjs;
        $chart2->title("Gender");
        $chart2->labels(['Lelaki', 'Perempuan']);
        $chart2->displayAxes(false);
        $chart2->dataset('Gender', 'pie', [$data_male,$data_female])->options([
                'backgroundColor' => ['#33A1FF', '#FF333B'],
            ]);

        $chart3 = new Chartjs;
        $chart3->title("Property Owner");
        $chart3->labels(['Yes', 'No']);
        $chart3->dataset('Property Owner','bar', [$data_noProperty,$data_haveProperty]);

        return view('home', compact('chart','chart2','chart3'));
    }

    
}
