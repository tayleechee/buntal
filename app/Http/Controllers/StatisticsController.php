<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\Chartjs;
use App\Charts\Highcharts;
use App\Villager;
use App\House;
use App\Property;

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
	
	/***** Pie Chart *****/
	public function populationByGender()
	{
		$label = ['Lelaki','Perempuan'];
		$data = [
			Villager::wheregender('m')->where('death_date', null)->count(),
			Villager::wheregender('f')->where('death_date', null)->count()
		];
		
		$graph_title = 'Populasi Penduduk mengikut Jantina';
		$total_of = 'Jumlah Penduduk';
		$total = array_sum($data);
		
        return view('statisticsPieChart', compact('graph_title','label','data','total_of','total'));
	}
	
	public function populationByRace()
	{
		$label = ['Melayu','Cina','India','Bumiputera','Lain-lain'];
		$data = [
			Villager::whererace('melayu')->where('death_date', null)->count(),
			Villager::whererace('cina')->where('death_date', null)->count(),
			Villager::whererace('india')->where('death_date', null)->count(),
			Villager::whererace('bumiputera')->where('death_date', null)->count(),
			Villager::whererace('lain-lain')->where('death_date', null)->count()
		];
		
		$graph_title = 'Populasi Penduduk mengikut Kaum';
		$total_of = 'Jumlah Penduduk';
		$total = array_sum($data);
		
        return view('statisticsPieChart', compact('graph_title','label','data','total_of','total'));
	}	
	
	public function populationByMaritalStatus()
	{
		$data_bujang = Villager::wheremarital_status('bujang')->where('death_date', null)->count();
        $data_kahwin = Villager::wheremarital_status('kahwin')->where('death_date', null)->count();
        $data_duda = Villager::wheremarital_status('duda')->where('death_date', null)->count();		
        $data_janda = Villager::wheremarital_status('janda')->where('death_date', null)->count();

        $label = ['Bujang','Kahwin','Duda','Janda'];
        $data = [$data_bujang,$data_kahwin,$data_duda,$data_janda];
		
        $graph_title = 'Populasi Penduduk mengikut Status Perkahwinan';
		$total_of = 'Jumlah Penduduk';
		$total = array_sum($data);
		
        return view('statisticsPieChart', compact('graph_title','label','data','total_of','total'));
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

		$label = [ 'RM2000 dan ke bawah', 'RM2001 - RM4000', 'RM4001 - RM6000', 'RM6001 - RM8000', 'RM8001 - RM10000', 'RM10001 dan ke atas' ];
		$data = [ $income_group_1, $income_group_2, $income_group_3, $income_group_4, $income_group_5, $income_group_6 ];		
		
        $graph_title = 'Pendapatan Isi Rumah Bulanan';		
		$total_of = 'Jumlah Isi Rumah';
		$total = array_sum($data);
		
        return view('statisticsPieChart', compact('graph_title','label','data','total_of','total'));
	}	
	
	/***** Bar Graph *****/
	public function populationByVoter()
	{
		$villagers = Villager::where('death_date', null)->get();
		$is_voter = 0;
		$not_voter = 0;
		
		foreach($villagers as $villager)
		{
			$birthday = Carbon::parse($villager->dob);
			$age = $birthday->diffInYears(Carbon::now());
			
			if ($age >= 18)
			{
				if ($villager->is_voter == 1)
					$is_voter++;
				else
					$not_voter++;
			}
		}
		
		$label = ['Sudah Daftar','Belum Daftar'];
		$data = [$is_voter,$not_voter];
		
		$graph_type = 'column';
		$graph_title = 'Pendaftaran sebagai Pengundi';
		$x_axis = '';
		$total_of = 'Bilangan Penduduk yang Layak untuk Mendaftar sebagai Pengundi';
		$total = array_sum($data);
		
        return view('statisticsGraph', compact('graph_type','graph_title','label','data','x_axis','total_of','total'));
	}	
	
	public function populationByPropertyPossession()
	{
		$label_propertyPossession = ['Memiliki Harta Tanah','Tidak memiliki harta tanah'];
		$data_propertyPossession = [
			Villager::whereis_property_owner('1')->where('death_date', null)->count(),
			Villager::whereis_property_owner('0')->where('death_date', null)->count()
		];		
		
		$data_ncr = Property::wheretype('NCR')->count();
        $data_fl = Property::wheretype('Geran')->count();
		$data_geran = Property::wheretype('FL')->count();
		$data_mixzone = Property::wheretype('Mix Zone')->count();

		$label_land = ['NCR','Geran','FL','Mix Zone'];
		$data_land = [$data_ncr,$data_fl,$data_geran,$data_mixzone];		
		
		
        return view('statisticsProperty', compact('label_propertyPossession','data_propertyPossession','label_land','data_land'));
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
		
        $label = ['0 - 10','11 - 20','21 - 30','31 - 40','41 - 50','51 - 60','61 - 70','71 - 80','81 - 90','91 - 100','101 - 110'];
		$data = [$age_group_10,$age_group_20,$age_group_30,$age_group_40,$age_group_50,$age_group_60,$age_group_70,$age_group_80,$age_group_90,
				 $age_group_100,$age_group_110];		
		
		$graph_type = 'column';
        $graph_title = 'Bilangan Penduduk mengikut Kumpulan Umur';
		$x_axis = 'Umur (Tahun)';
		$total_of = 'Jumlah Penduduk';
		$total = array_sum($data);
		
        return view('statisticsGraph', compact('graph_type','graph_title','label','data','x_axis','total_of','total'));
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

		$label = ['Tidak Berpendidikan Formal','Pendidikan Rendah','Pendidikan Menengah','Tingkatan 6','Diploma','Ijazah Sarjana Muda','Ijazah Sarjana','Doktor Falsafah', 'Tiada Kaitan'];
		$data = [$data_nonEducated,$data_primary,$data_secondary,$data_form6,$data_diploma,$data_degree,$data_master,$data_phd,$data_na];		
		
		$graph_type = 'column';
        $graph_title = 'Bilangan Penduduk mengikut Tahap Pendidikan';
		$x_axis = 'Tahap Pendidikan';
		$total_of = 'Jumlah Penduduk';
		$total = array_sum($data);
		
        return view('statisticsGraph', compact('graph_type','graph_title','label','data','x_axis','total_of','total'));
	}	
	
	public function birthRateByYear(Request $request)
	{
		$year = $request->input('year');
		
		$villagers = Villager::whereYear('dob',$year)->get();
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
		
		$label = ['Januari','Februari','Mac','April','Mei','Jun','Julai','Ogos','September','Oktober','November','December'];
		$data = [$jan,$feb,$mar,$apr,$may,$jun,$jul,$aug,$sep,$oct,$nov,$dec];		
		
		$graph_type = 'line';
        $graph_title = 'Bilangan Kelahiran bagi Tahun '.$year;
		$x_axis = 'Bulan';
		$total_of = 'Jumlah Penduduk';
		$total = array_sum($data);
		
        return view('statisticsGraph', compact('graph_type','graph_title','label','data','x_axis','total_of','total'));
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

		$villagers  = Villager::whereBetween('dob', [$from, $to])->get();

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
		
        $label = $years->toArray();
		$data = $count_villager->toArray();		
		
		$graph_type = 'line';
        $graph_title = 'Bilangan Kelahiran dari Tahun '.$startYear.' hingga Tahun '.$endYear;
		$x_axis = 'Bulan';
		$total_of = 'Jumlah Penduduk';
		$total = array_sum($data);
		
        return view('statisticsGraph', compact('graph_type','graph_title','label','data','x_axis','total_of','total'));
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
		
		$label = ['Januari','Februari','Mac','April','Mei','Jun','Julai','Ogos','September','Oktober','November','December'];
		$data = [$jan,$feb,$mar,$apr,$may,$jun,$jul,$aug,$sep,$oct,$nov,$dec];		
		
		$graph_type = 'line';
        $graph_title = 'Bilangan Kematian bagi Tahun '.$year;
		$x_axis = 'Bulan';
		$total_of = 'Jumlah Penduduk';
		$total = array_sum($data);
		
        return view('statisticsGraph', compact('graph_type','graph_title','label','data','x_axis','total_of','total'));
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
		
		$label = $years->toArray();
		$data = $count_villager->toArray();		
		
		$graph_type = 'line';
        $graph_title = 'Bilangan Kematian dari Tahun '.$startYear.' hingga Tahun '.$endYear;
		$x_axis = 'Bulan';
		$total_of = 'Jumlah Penduduk';
		$total = array_sum($data);
		
        return view('statisticsGraph', compact('graph_type','graph_title','label','data','x_axis','total_of','total'));
	}
}
