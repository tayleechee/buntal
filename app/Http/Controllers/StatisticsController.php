<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\Chartjs;
use App\Charts\Highcharts;
use App\Villager;
use App\House;

class StatisticsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		return view('statisticsIndex');
	}
	
	public function populationByGender()
	{
		$data_male = Villager::wheregender('m')->where('death_date', null)->count();
        $data_female = Villager::wheregender('f')->where('death_date', null)->count();

		$chart = new Chartjs;		
        $chart->title("Population by Gender");
        $chart->labels(['Lelaki', 'Perempuan']);
        $chart->displayAxes(false);
        $chart->dataset('Gender', 'pie', [$data_male,$data_female])->options([
            'backgroundColor' => ['#33A1FF', '#ff6384']
        ]);

		$graph_title = "Population by Gender";
		
        return view('statisticsGraph', compact('chart','graph_title'));
	}
	
	public function populationByAgeRange()
	{
		$villagers = Villager::where('death_date', null)->get();
		$age_group_10 = 0;
		$age_group_20 = 0;
		$age_group_30 = 0;
		$age_group_40 = 0;
		$age_group_50 = 0;
		$age_group_60 = 0;
		$age_group_70 = 0;		
		$age_group_80 = 0;		
		$age_group_90 = 0;		
		$age_group_100 = 0;	
		$age_group_110 = 0;

		foreach($villagers as $villager)
		{
			$birthday = Carbon::parse($villager->dob);
			$age = $birthday->diffInYears(Carbon::now());
			if ($age <= 10)
				$age_group_10++;
			else if ($age <= 20)
				$age_group_20++;
			else if ($age <= 30)
				$age_group_30++;
			else if ($age <= 40)
				$age_group_40++;
			else if ($age <= 50)
				$age_group_50++;
			else if ($age <= 60)
				$age_group_60++;
			else if ($age <= 70)
				$age_group_70++;
			else if ($age <= 80)
				$age_group_80++;
			else if ($age <= 90)
				$age_group_90++;
			else if ($age <= 100)
				$age_group_100++;
			else
				$age_group_110++;
		};

		$chart = new Chartjs;
        $chart->title("Population by Age Range");
        $chart->labels(['0 - 10','11 - 20','21 - 30','31 - 40','41 - 50','51 - 60','61 - 70','71 - 80','81 - 90','91 - 100','101 - 110']);
		$chart->dataset('Age Range', 'bar', [$age_group_10,$age_group_20,$age_group_30,$age_group_40,$age_group_50,$age_group_60,
			$age_group_70,$age_group_80,$age_group_90,$age_group_100,$age_group_110])->options([
            'backgroundColor' => ['#9B59B6', 
				'#2ECC71', 
				'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 206, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)',
				'rgb(174, 255, 99)',
				'rgb(99, 255, 247)',
				'rgb(255, 125, 99)']
        ]);
		
        $graph_title = "Population by Age Range";
		
        return view('statisticsGraph', compact('chart','graph_title'));
	}
	
	public function populationByEducationLevel()
	{
		$data_nonEducated = Villager::whereeducation_level('Non-educated')->where('death_date', null)->count();
        $data_primary = Villager::whereeducation_level('Primary School')->where('death_date', null)->count();
		$data_secondary = Villager::whereeducation_level('Secondary School')->where('death_date', null)->count();
		$data_form6 = Villager::whereeducation_level('Form 6')->where('death_date', null)->count();
		$data_diploma = Villager::whereeducation_level('Diploma')->where('death_date', null)->count();
		$data_degree = Villager::whereeducation_level('Degree')->where('death_date', null)->count();
		$data_master = Villager::whereeducation_level('Master')->where('death_date', null)->count();
		$data_phd = Villager::whereeducation_level('PhD')->where('death_date', null)->count();
		$data_na = Villager::whereeducation_level('N/A')->where('death_date', null)->count();

		$chart = new Chartjs;
        $chart->title("Education Level");
        $chart->labels(['Non-Educated','Primary','Secondary','Form 6','Diploma','Degree','Master','PhD', 'N/A']);
        $chart->dataset('Education Level', 'bar', [$data_nonEducated,$data_primary,$data_secondary,$data_form6,$data_diploma,$data_degree,$data_master,$data_phd,$data_na])->options([
            'backgroundColor' => ['#9B59B6', 
				'#2ECC71', 
				'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 206, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)']
        ]);
		
        $graph_title = "Population by Education Level";
		
        return view('statisticsGraph', compact('chart','graph_title'));
	}
	
	public function populationByMaritalStatus()
	{
		$data_single = Villager::wheremarital_status('bujang')->where('death_date', null)->count();
        $data_kahwin = Villager::wheremarital_status('kahwin')->where('death_date', null)->count();
        $data_duda = Villager::wheremarital_status('duda')->where('death_date', null)->count();

		$chart = new Chartjs;
        $chart->title("Population by Marital Status");
        $chart->labels(['bujang', 'kahwin','duda']);
        $chart->dataset('Marital Status', 'bar', [$data_single,$data_kahwin,$data_duda])->options([
            'backgroundColor' => ['#9B59B6', '#2ECC71', '#FFB74D']
        ]);
		
        $graph_title = "Population by Marital Status";
		
        return view('statisticsGraph', compact('chart','graph_title'));
	}
	
	public function monthlyHouseholdIncome()
	{
		$houses = House::all();
		
		$income_group_1 = 0;  	//2000 and below
		$income_group_2 = 0;  	//2001 - 4000
		$income_group_3 = 0;	//4001 - 6000
		$income_group_4 = 0;	//6001 - 8000
		$income_group_5 = 0;	//8001 - 10000
		$income_group_6 = 0;	//10001 and above
		
		foreach($houses  as $house)
		{
			$income = $house->household_income;
			if ($income <= 2000)
				$income_group_1++;
			else if ($income <= 4000)
				$income_group_2++;
			else if ($income <= 6000)
				$income_group_3++;
			else if ($income <= 8000)
				$income_group_4++;
			else if ($income <= 10000)
				$income_group_5++;
			else
				$income_group_6++;
		}

		$chart = new Chartjs;
        $chart->title("Monthly Household Income");	
        $chart->labels(['2000 dan ke bawah','2001 - 4000','4001 - 6000','6001 - 8000','8001 - 10000','10001 dan ke atas']);			
        $chart->displayAxes(false);
        $chart->dataset('Household Monthly Income', 'pie', [$income_group_1,$income_group_2,$income_group_3,$income_group_4,$income_group_5,$income_group_6])->options([
            'backgroundColor' => ['rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 206, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)']
        ]);
		
        $graph_title = "Monthly Household Income";
		
        return view('statisticsGraph', compact('chart','graph_title'));
	}
	
	public function birthRateByYear(Request $request)
	{
		$year = $request->input('year');
		
		$villagers = Villager::whereYear('dob',$year)->where('death_date', null)->get();
		$jan = 0;
		$feb = 0;
		$mar = 0;
		$apr = 0;
		$may = 0;
		$jun = 0;
		$jul = 0;
		$aug = 0;
		$sep = 0;
		$oct = 0;
		$nov = 0;
		$dec = 0;
		
		foreach($villagers as $villager)
		{
			$birthday = Carbon::parse($villager->dob);
			$month = $birthday->month;
			if ($month == 1)
				$jan++;
			else if ($month == 2)
				$feb++;
			else if ($month == 3)
				$mar++;
			else if ($month == 4)
				$apr++;
			else if ($month == 5)
				$may++;
			else if ($month == 6)
				$jun++;
			else if ($month == 7)
				$jul++;
			else if ($month == 8)
				$aug++;
			else if ($month == 9)
				$sep++;
			else if ($month == 10)
				$oct++;
			else if ($month == 11)
				$nov++;
			else
				$dec++;
		}
		
		$chart = new Chartjs;
        $chart->title("Birth Rate by Year $year");
        $chart->labels(['Januari','Februari','Mac','April','Mei','Jun','Julai','Ogos','September','Oktober','November','December']);
        $chart->dataset('Birth Rate','line', [$jan,$feb,$mar,$apr,$may,$jun,$jul,$aug,$sep,$oct,$nov,$dec])->options([
			"fill" => [false],
			"borderColor"=>["rgb(75, 192, 192)"],
			"lineTension"=>[0.1]
		]);
		
        $graph_title = "Birth Rate by Year".$year;
		
        return view('statisticsGraph', compact('chart','graph_title'));
	}
	
	public function birthRateByRangeOfYears(Request $request)
	{
		$startYear = $request->input('startYear');
		$from = new Carbon($startYear.'-1-1');
		
		$endYear = $request->input('endYear');
		$to = new Carbon($endYear.'-12-31');
		
		$from    = Carbon::parse($from)
                 ->startOfDay()        
                 ->toDateTimeString(); 

		$to      = Carbon::parse($to)
                 ->endOfDay()          
                 ->toDateTimeString(); 

		$villagers  = Villager::whereBetween('dob', [$from, $to])->where('death_date', null)->get();

		$years = collect([]);
		
		for($i = $startYear; $i <= $endYear; $i++)
		{
			$years->push($i);
		}
		
		$count_villager = collect([]);
		for($i = $startYear; $i <= $endYear; $i++)
		{
			$count_villager->push(Villager::whereYear('dob',$i)->where('death_date', null)->count());
		}
		
		$chart = new Chartjs;
        $chart->title("Birth Rate From Year $startYear to Year $endYear");
        $chart->labels($years);
        $chart->dataset('Birth Rate','line', $count_villager)->options([
			"fill" => [false],
			"borderColor"=>["rgb(75, 192, 192)"],
			"lineTension"=>[0.1]
		]);
		
        $graph_title = "Birth Rate From Year ".$startYear." to Year ".$endYear;
		
        return view('statisticsGraph', compact('chart','graph_title'));
	}
	
	public function deathRateByYear(Request $request)
	{
		$year = $request->input('year');
		
		$villagers = Villager::whereYear('death_date',$year)->get();
		$jan = 0;
		$feb = 0;
		$mar = 0;
		$apr = 0;
		$may = 0;
		$jun = 0;
		$jul = 0;
		$aug = 0;
		$sep = 0;
		$oct = 0;
		$nov = 0;
		$dec = 0;
		
		foreach($villagers as $villager)
		{
			$deathday = Carbon::parse($villager->death_date);
			$month = $deathday->month;
			if ($month == 1)
				$jan++;
			else if ($month == 2)
				$feb++;
			else if ($month == 3)
				$mar++;
			else if ($month == 4)
				$apr++;
			else if ($month == 5)
				$may++;
			else if ($month == 6)
				$jun++;
			else if ($month == 7)
				$jul++;
			else if ($month == 8)
				$aug++;
			else if ($month == 9)
				$sep++;
			else if ($month == 10)
				$oct++;
			else if ($month == 11)
				$nov++;
			else
				$dec++;
		}
		
		$chart = new Chartjs;
        $chart->title("Death Rate by Year $year");
        $chart->labels(['Januari','Februari','Mac','April','Mei','Jun','Julai','Ogos','September','Oktober','November','December']);
        $chart->dataset('Death Rate','line', [$jan,$feb,$mar,$apr,$may,$jun,$jul,$aug,$sep,$oct,$nov,$dec])->options([
			"fill" => [false],
			"borderColor"=>["rgb(75, 192, 192)"],
			"lineTension"=>[0.1]
		]);
		
        $graph_title = "Death Rate by Year".$year;
		
        return view('statisticsGraph', compact('chart','graph_title'));
	}
	
	public function deathRateByRangeOfYears(Request $request)
	{
		$startYear = $request->input('startYear');
		$from = new Carbon($startYear.'-1-1');
		
		$endYear = $request->input('endYear');
		$to = new Carbon($endYear.'-12-31');
		
		$from    = Carbon::parse($from)
                 ->startOfDay()        
                 ->toDateTimeString(); 

		$to      = Carbon::parse($to)
                 ->endOfDay()          
                 ->toDateTimeString(); 

		$villagers  = Villager::whereBetween('death_date', [$from, $to])->get();

		$years = collect([]);
		
		for($i = $startYear; $i <= $endYear; $i++)
		{
			$years->push($i);
		}
		
		$count_villager = collect([]);
		for($i = $startYear; $i <= $endYear; $i++)
		{
			$count_villager->push(Villager::whereYear('death_date',$i)->count());
		}
		
		$chart = new Chartjs;
        $chart->title("Death Rate From Year $startYear to Year $endYear");
        $chart->labels($years);
        $chart->dataset('Death Rate','line', $count_villager)->options([
			"fill" => [false],
			"borderColor"=>["rgb(75, 192, 192)"],
			"lineTension"=>[0.1]
		]);
		
        $graph_title = "Death Rate From Year ".$startYear." to Year ".$endYear;
		
        return view('statisticsGraph', compact('chart','graph_title'));
	}
}
