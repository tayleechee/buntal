<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\Chartjs;
use App\Charts\Highcharts;
use App\Villager;

class StatisticsController extends Controller
{
    public function index()
    {
		return view('statisticsIndex');
	}
	
	public function populationByGender()
	{
		$data_male = Villager::wheregender('m')->count();
        $data_female = Villager::wheregender('f')->count();

		$chart = new Chartjs;
        $chart->title("Gender");
        $chart->labels(['Lelaki', 'Perempuan']);
        $chart->displayAxes(false);
        $chart->dataset('Gender', 'pie', [$data_male,$data_female])->options([
            'backgroundColor' => ['#33A1FF', '#ff6384'],
        ]);
		
        return view('statisticsGraph', compact('chart'));
	}
	
	public function populationByAgeRange()
	{
		$villagers = Villager::all();
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
        $chart->title("Age Range");
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
		
        return view('statisticsGraph', compact('chart'));
	}
	
	public function populationByEducationLevel()
	{
		$data_nonEducated = Villager::whereeducation_level('non-educated')->count();
        $data_primary = Villager::whereeducation_level('primary')->count();
		$data_secondary = Villager::whereeducation_level('secondary')->count();
		$data_form6 = Villager::whereeducation_level('form6')->count();
		$data_diploma = Villager::whereeducation_level('diploma')->count();
		$data_degree = Villager::whereeducation_level('degree')->count();
		$data_master = Villager::whereeducation_level('master')->count();
		$data_phd = Villager::whereeducation_level('phd')->count();

		$chart = new Chartjs;
        $chart->title("Education Level");
        $chart->labels(['Non-Educated','Primary','Secondary','Form 6','Diploma','Degree','Master','PhD']);
        $chart->dataset('Education Level', 'bar', [$data_nonEducated,$data_primary,$data_secondary,$data_form6,$data_diploma,$data_degree,$data_master,$data_phd])->options([
            'backgroundColor' => ['#9B59B6', 
				'#2ECC71', 
				'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 206, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)']
        ]);
		
        return view('statisticsGraph', compact('chart'));
	}
	
	public function populationByMaritalStatus()
	{
		$data_single = Villager::wheremarital_status('single')->count();
        $data_kahwin = Villager::wheremarital_status('kahwin')->count();
        $data_duda = Villager::wheremarital_status('duda')->count();

		$chart = new Chartjs;
        $chart->title("Marital Status");
        $chart->labels(['bujang', 'kahwin','duda']);
        $chart->dataset('Marital Status', 'bar', [$data_single,$data_kahwin,$data_duda])->options([
            'backgroundColor' => ['#9B59B6', '#2ECC71', '#FFB74D']
        ]);
		
        return view('statisticsGraph', compact('chart'));
	}
}
