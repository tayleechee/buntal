<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Carbon\Carbon;
use App\Villager;
use App\House;
use App\Property;

class DynamicPDFController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
      
	function general()
    {
		$villager_data = $this->get_villager_data();
		$villager_count = $villager_data->count();
		return view('dynamic_pdf_general', compact('villager_data','villager_count'));
    }
	
	function summary_report()
	{
		$data = $this->get_summary_data();
		
		$year = $data[0];
		$sum = $data[1];
		$permanent = $data[2];
		$gender = $data[3];
		$race = $data[4];
		$marital = $data[5];
		$property = $data[6];
		$property_type = $data[7];
		$label = $data[8];
		$sum_newborn = $data[9];
		$count_newborn = $data[10];
		$sum_death = $data[11];
		$count_death = $data[12];
		$education = $data[13];
		
		return view('summaryReport', compact('year','sum','permanent','gender','race','marital','property','property_type','label','sum_newborn','count_newborn','sum_death','count_death', 'education'));
	}
	
	function get_summary_data()
	{
		$sum = Villager::where('death_date', null)->count();
		
		$permanent = [];
		$permanent['y'] = Villager::whereis_active('1')->where('death_date', null)->count();
		$permanent['n'] = Villager::whereis_active('0')->where('death_date', null)->count();
		
		$gender = [];
		$gender['m'] = Villager::wheregender('m')->where('death_date', null)->count();
		$gender['f'] = Villager::wheregender('f')->where('death_date', null)->count();
		
		$race = [];
		$race['melayu'] = Villager::whererace('melayu')->where('death_date', null)->count();
		$race['cina'] = Villager::whererace('cina')->where('death_date', null)->count();
		$race['india'] = Villager::whererace('india')->where('death_date', null)->count();
		$race['bumiputera'] = Villager::whererace('bumiputera')->where('death_date', null)->count();
		$race['lain'] = Villager::whererace('lain-lain')->where('death_date', null)->count();

		$marital = [];
		$marital['bujang'] = Villager::wheremarital_status('bujang')->where('death_date', null)->count();
		$marital['kahwin'] = Villager::wheremarital_status('kahwin')->where('death_date', null)->count();
		$marital['duda'] = Villager::wheremarital_status('duda')->where('death_date', null)->count();	
		$marital['janda'] = Villager::wheremarital_status('janda')->where('death_date', null)->count();
		
		$property = [];		
        $property['y'] = Villager::whereis_property_owner('1')->where('death_date', null)->count();
		$property['n'] = Villager::whereis_property_owner('0')->where('death_date', null)->count();
		
		$property_type = [];
		$property_type['ncr'] = Property::wheretype('NCR')->count();
        $property_type['geran'] = Property::wheretype('Geran')->count();
		$property_type['fl'] = Property::wheretype('FL')->count();
		$property_type['mix'] = Property::wheretype('Mix Zone')->count();

		$education = [];
		$education['non-educated'] = Villager::whereeducation_level('Non-educated')->where('death_date', null)->count();
		$education['primary'] = Villager::whereeducation_level('Primary School')->where('death_date', null)->count();
		$education['secondary'] = Villager::whereeducation_level('Secondary School')->where('death_date', null)->count();
		$education['form6'] = Villager::whereeducation_level('Form 6')->where('death_date', null)->count();
		$education['diploma'] = Villager::whereeducation_level('Diploma')->where('death_date', null)->count();
		$education['degree'] = Villager::whereeducation_level('Degree')->where('death_date', null)->count();
		$education['master'] = Villager::whereeducation_level('Master')->where('death_date', null)->count();
		$education['phd'] = Villager::whereeducation_level('PhD')->where('death_date', null)->count();
		$education['n/a'] = Villager::whereeducation_level('N/A')->where('death_date', null)->count();
		
		$label = ['Januari','Februari','Mac','April','Mei','Jun','Julai','Ogos','September','Oktober','November','Disember'];
		$year = date("Y");
		
		$newborn = Villager::whereYear('dob', $year)
			->orderBy('dob', 'asc')
			->get();	
		$data = $this->get_data_by_months($newborn, 'dob');	
		$sum_newborn = $data[1];
		$count_newborn = $data[2];
		
		$death = Villager::whereYear('death_date', $year)
			->orderBy('dob', 'asc')
			->get();	
		$data = $this->get_data_by_months($death, 'death_date');	
		$sum_death = $data[1];
		$count_death = $data[2];
		
		return [$year,$sum,$permanent,$gender,$race,$marital,$property,$property_type,$label,$sum_newborn,$count_newborn,$sum_death,$count_death,$education];	
	}
	
	function summary_report_pdf()
	{
		$data = $this->get_summary_data();
		
		$year = $data[0];
		$sum = $data[1];
		$permanent = $data[2];
		$gender = $data[3];
		$race = $data[4];
		$marital = $data[5];
		$property = $data[6];
		$property_type = $data[7];
		$label = $data[8];
		$sum_newborn = $data[9];
		$count_newborn = $data[10];
		$sum_death = $data[11];
		$count_death = $data[12];
		$education = $data[13];
		
		$output = '
			<h3 align="center">Ringkasan Laporan Terkini Demografi Kampung Buntal '.$year.'</h3>
			<h4 style="font-weight:bold;">Jumlah Penduduk: '.$sum.' orang</h4>
			<h5 class="font-weight-bold">Penduduk Tetap</h5>
			<table width="50%" style="border-collapse:collapse;border:0px;">
				<tr>
					<th style="border:1px solid;padding:8px;width:50%">Status</th>
                    <th style="border:1px solid;padding:8px;width:50%">Bilangan Penduduk</th>
				</tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Ya</td>
					<td style="border:1px solid;padding:8px;">'.$permanent['y'].'</td>
				</tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Tidak</td>
					<td style="border:1px solid;padding:8px;">'.$permanent['n'].'</td>
				</tr>
			</table>
			<h5 class="font-weight-bold">Jantina</h5>
			<table width="50%" style="border-collapse:collapse;border:0px;">
				<tr>
					<th style="border:1px solid;padding:8px;width:50%">Jantina</th>
                    <th style="border:1px solid;padding:8px;width:50%">Bilangan Penduduk</th>
				</tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Lelaki</td>
					<td style="border:1px solid;padding:8px;">'.$gender['m'].'</td>
				</tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Perempuan</td>
					<td style="border:1px solid;padding:8px;">'.$gender['f'].'</td>
				</tr>
			</table>
			<h5 class="font-weight-bold">Kaum</h5>
			<table width="50%" style="border-collapse:collapse;border:0px;">
				<tr>
					<th style="border:1px solid;padding:8px;width:50%">Kaum</th>
                    <th style="border:1px solid;padding:8px;width:50%">Bilangan Penduduk</th>
				</tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Melayu</td>
                    <td style="border:1px solid;padding:8px;">'.$race['melayu'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Bumiputera</td>
                    <td style="border:1px solid;padding:8px;">'.$race['bumiputera'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Cina</td>
                    <td style="border:1px solid;padding:8px;">'.$race['cina'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">India</td>
                    <td style="border:1px solid;padding:8px;">'.$race['india'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Lain-lain</td>
                    <td style="border:1px solid;padding:8px;">'.$race['lain'].'</td>
                </tr>
			</table>
			<h5 class="font-weight-bold">Status Perkahwinan</h5>
			<table width="50%" style="border-collapse:collapse;border:0px;">
				<tr>
					<th style="border:1px solid;padding:8px;width:50%">Status Perkahwinan</th>
                    <th style="border:1px solid;padding:8px;width:50%">Bilangan Penduduk</th>
				</tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Bujang</td>
                    <td style="border:1px solid;padding:8px;">'.$marital['bujang'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Kahwin</td>
                    <td style="border:1px solid;padding:8px;">'.$marital['kahwin'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Duda</td>
                    <td style="border:1px solid;padding:8px;">'.$marital['duda'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Janda</td>
                    <td style="border:1px solid;padding:8px;">'.$marital['janda'].'</td>
                </tr>
			</table>	
			<br>
			<h5 class="font-weight-bold">Tahap Pendidikan</h5>
			<table width="60%" style="border-collapse:collapse;border:0px;">
				<tr>
					<th style="border:1px solid;padding:8px;width:60%">Status Perkahwinan</th>
                    <th style="border:1px solid;padding:8px;width:40%">Bilangan Penduduk</th>
				</tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Tidak Berpendidikan Formal</td>
                    <td style="border:1px solid;padding:8px;">'.$education['non-educated'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Pendidikan Rendah</td>
                    <td style="border:1px solid;padding:8px;">'.$education['primary'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Pendidikan Menengah</td>
                    <td style="border:1px solid;padding:8px;">'.$education['secondary'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Tingkatan 6</td>
                    <td style="border:1px solid;padding:8px;">'.$education['form6'].'</td>
                </tr>
                <tr>
					<td style="border:1px solid;padding:8px;">Diploma</td>
                    <td style="border:1px solid;padding:8px;">'.$education['diploma'].'</td>
                </tr>
                <tr>
					<td style="border:1px solid;padding:8px;">Ijazah Sarjana Muda</td>
                    <td style="border:1px solid;padding:8px;">'.$education['degree'].'</td>
                </tr>
                <tr>
					<td style="border:1px solid;padding:8px;">Ijazah Sarjana</td>
                    <td style="border:1px solid;padding:8px;">'.$education['master'].'</td>
                </tr>
                <tr>
					<td style="border:1px solid;padding:8px;">Doktor Falsafah</td>
                    <td style="border:1px solid;padding:8px;">'.$education['phd'].'</td>
                </tr>
                <tr>
					<td style="border:1px solid;padding:8px;">Tiada Katian</td>
                    <td style="border:1px solid;padding:8px;">'.$education['n/a'].'</td>
                </tr>
			</table>			
			<h5 class="font-weight-bold">Memiliki Tanah</h5>
			<table width="50%" style="border-collapse:collapse;border:0px;">
				<tr>
					<th style="border:1px solid;padding:8px;width:50%">Status</th>
                    <th style="border:1px solid;padding:8px;width:50%">Bilangan Penduduk</th>
				</tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Ya</td>
                    <td style="border:1px solid;padding:8px;">'.$property['y'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Tidak</td>
                    <td style="border:1px solid;padding:8px;">'.$property['n'].'</td>
                </tr>
			</table>
			<h5 class="font-weight-bold">Jumlah Harta Tanah: '.array_sum($property_type).'</h5>
			<table width="50%" style="border-collapse:collapse;border:0px;">
				<tr>
					<th style="border:1px solid;padding:8px;width:50%">Jenis Tanah</th>
                    <th style="border:1px solid;padding:8px;width:50%">Bilangan Harta</th>
				</tr>
				<tr>
					<td style="border:1px solid;padding:8px;">NCR</td>
                    <td style="border:1px solid;padding:8px;">'.$property_type['ncr'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Geran</td>
                    <td style="border:1px solid;padding:8px;">'.$property_type['geran'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">FL</td>
                    <td style="border:1px solid;padding:8px;">'.$property_type['fl'].'</td>
                </tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Mix Zone</td>
                    <td style="border:1px solid;padding:8px;">'.$property_type['mix'].'</td>
                </tr>
			</table>
			<h5 class="font-weight-bold">Kelahiran & Kematian</h5>
			<table width="100%" style="border-collapse:collapse;border:0px;">
				<tr>
					<th style="border:1px solid;padding:8px;width:30%">Bulan</th>
                    <th style="border:1px solid;padding:8px;width:35%">Kelahiran (Bilangan Orang)</th>
					<th style="border:1px solid;padding:8px;width:35%">Kematian (Bilangan Orang)</th>
				</tr>
		';
		
		for($i=0; $i<12; $i++)
		{	
			$output .= '
				<tr>				
					<td style="border:1px solid;padding:8px;">'.$label[$i].'</td>
					<td style="border:1px solid;padding:8px;">'.$count_newborn[$i].'</td>
					<td style="border:1px solid;padding:8px;">'.$count_death[$i].'</td>
				</tr>
			';
		}
		$output .= '
				<tr style="font-weight:bold">
					<td style="border:1px solid;padding:8px;">Jumlah</td>
					<td style="border:1px solid;padding:8px;">'.$sum_newborn.'</td>
					<td style="border:1px solid;padding:8px;">'.$sum_death.'</td>
				</tr>
			</table>
		';
		
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($output);
		return $pdf->stream();
	}
	
	function voter_report()
    {
		$villagers = Villager::where('death_date', null)->get();
		$voter = [];
		$non_voter = [];
		
		foreach($villagers as $villager)
		{
			$birthday = Carbon::parse($villager->dob);
			$age = $birthday->diffInYears(Carbon::now());
			
			if ($age >= 18)
			{
				if ($villager->is_voter == 1)
					array_push($voter, $villager);
				else
					array_push($non_voter, $villager);
			}
		}
		
		$count_voter = count($voter);
		$count_non_voter = count($non_voter);
		$sum = $count_voter + $count_non_voter;
		
		return view('dynamic_pdf_voter', compact('sum','count_voter','count_non_voter','voter','non_voter'));
    }
	
	function voter_report_pdf()
	{
		$villagers = Villager::where('death_date', null)->get();
		$voter = [];
		$non_voter = [];
		
		foreach($villagers as $villager)
		{
			$birthday = Carbon::parse($villager->dob);
			$age = $birthday->diffInYears(Carbon::now());
			
			if ($age >= 18)
			{
				if ($villager->is_voter == 1)
					array_push($voter, $villager);
				else
					array_push($non_voter, $villager);
			}
		}
		
		$count_voter = count($voter);
		$count_non_voter = count($non_voter);
		$sum = $count_voter + $count_non_voter;
		
		$output = '
			<h3 align="center">Pendaftaran sebagai Pengundi</h3>
			<h4 style="font-weight:bold;">Jumlah Penduduk yang Layak untuk Daftar sebagai Pengundi: '.$sum.' orang</h4>
			<table width="50%" style="border-collapse:collapse;border:0px;">
				<tr>
					<th style="border:1px solid;padding:8px;width:50%">Status</th>
                    <th style="border:1px solid;padding:8px;width:50%">Bilangan Penduduk</th>
				</tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Sudah Daftar</td>
					<td style="border:1px solid;padding:8px;">'.$count_voter.'</td>
				</tr>
				<tr>
					<td style="border:1px solid;padding:8px;">Belum Daftar</td>
					<td style="border:1px solid;padding:8px;">'.$count_non_voter.'</td>
				</tr>
			</table>
		';
		
		if ($count_non_voter != 0)
		{
			$output .= '
			<h4>Senarai Penduduk yang Belum Daftar sebagai Pengundi</h4>
			<table width="100%" style="border-collapse: collapse; border: 1px;">
				<tr>
					<th style="border: 1px solid; padding:12px;" width="5%">#</th>
					<th style="border: 1px solid; padding:12px;" width="25%">Nama</th>
					<th style="border: 1px solid; padding:12px;" width="20%">No. K/P</th>
					<th style="border: 1px solid; padding:12px;" width="20%">No. Telefon</th>
					<th style="border: 1px solid; padding:12px;" width="15%">Jantina</th>
					<th style="border: 1px solid; padding:12px;" width="15%">Kaum</th>
				</tr>
			';
			 
			$count = 1;
			foreach($non_voter as $villager)
			{
				if ($villager->gender == 'm')
					$gender = 'Lelaki';
				else
					$gender = 'Perempuan';
				$output .= '
					<tr>
						<td style="border: 1px solid; padding:12px;">'.$count.'</td>
						<td style="border: 1px solid; padding:12px;">'.$villager->name.'</td>
						<td style="border: 1px solid; padding:12px;">'.$villager->ic.'</td>
						<td style="border: 1px solid; padding:12px;">';
				if ($villager->phone != null)
					$output .= $villager->phone;
				else
					$output .= '-';
				
				$output .= '
						</td>
						<td style="border: 1px solid; padding:12px;">'.$gender.'</td>
						<td style="border: 1px solid; padding:12px;">'.ucwords($villager->race).'</td>
					</tr>
				  ';
				$count++;
			}
			$output .= '</table>';
		}
		
		if ($count_voter != 0)
		{
			$output .= '
			<h4>Senarai Penduduk yang Sudah Daftar sebagai Pengundi</h4>
			<table width="100%" style="border-collapse: collapse; border: 1px;">
				<tr>
					<th style="border: 1px solid; padding:12px;" width="5%">#</th>
					<th style="border: 1px solid; padding:12px;" width="25%">Nama</th>
					<th style="border: 1px solid; padding:12px;" width="20%">No. K/P</th>
					<th style="border: 1px solid; padding:12px;" width="20%">No. Telefon</th>
					<th style="border: 1px solid; padding:12px;" width="15%">Jantina</th>
					<th style="border: 1px solid; padding:12px;" width="15%">Kaum</th>
				</tr>
			';
			 
			$count = 1;
			foreach($voter as $villager)
			{
				if ($villager->gender == 'm')
					$gender = 'Lelaki';
				else
					$gender = 'Perempuan';
				$output .= '
					<tr>
						<td style="border: 1px solid; padding:12px;">'.$count.'</td>
						<td style="border: 1px solid; padding:12px;">'.$villager->name.'</td>
						<td style="border: 1px solid; padding:12px;">'.$villager->ic.'</td>
						<td style="border: 1px solid; padding:12px;">';
				if ($villager->phone != null)
					$output .= $villager->phone;
				else
					$output .= '-';
				
				$output .= '
						</td>
						<td style="border: 1px solid; padding:12px;">'.$gender.'</td>
						<td style="border: 1px solid; padding:12px;">'.ucwords($villager->race).'</td>
					</tr>
				  ';
				$count++;
			}
			$output .= '</table>';
		}
		
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($output);
		return $pdf->stream();
	}
	
	function population_report()
    {
		$villager_data = $this->get_villager_data();
		$m_villager_data = $this->get_m_villager_data();
		$f_villager_data = $this->get_f_villager_data();
		$malay_villager_data = $this->get_malay_data();
		$bumi_villager_data = $this->get_bumi_data();
		$cina_villager_data = $this->get_cina_data();
		$india_villager_data = $this->get_india_data();
		$lain_villager_data = $this->get_lain_data();
		$villager_count = $villager_data->count();
		return view('dynamic_pdf', compact('villager_data',
											'villager_count',
											'm_villager_data',
											'f_villager_data',
											'malay_villager_data',
											'bumi_villager_data',
											'cina_villager_data',
											'india_villager_data',
											'lain_villager_data'
											));
    }

    function get_villager_data()
    {
		$villager_data = Villager::where('death_date', null)->orderBy('dob', 'asc')->get();
		return $villager_data;
    }

    function get_m_villager_data()
    {
		$villager_data = Villager::where('death_date', null)
			->where('gender','=','m')
			->orderBy('dob', 'asc')
			->get();
		return $villager_data;
    }

    function get_f_villager_data()
    {
		$villager_data = Villager::where('death_date', null)
			->where('gender','=','f')
			->orderBy('dob', 'asc')
			->get();
		return $villager_data;
    }

    function get_malay_data()
    {
		$villager_data = Villager::where('death_date', null)
			->where('race','=','melayu')
			->orderBy('dob', 'asc')
			->get();
		return $villager_data;
    }

    function get_bumi_data()
    {
		$villager_data = Villager::where('death_date', null)
			->where('race','=','bumiputera')
			->orderBy('dob', 'asc')
			->get();
		return $villager_data;
    }

    function get_cina_data()
    {
		$villager_data = Villager::where('death_date', null)
			->where('race','=','cina')
			->orderBy('dob', 'asc')
			->get();
		return $villager_data;
    }

    function get_india_data()
    {
		$villager_data = Villager::where('death_date', null)
			->where('race','=','india')
			->orderBy('dob', 'asc')
			->get();
		return $villager_data;
    }

    function get_lain_data()
    {
		$villager_data = Villager::where('death_date', null)
			->where('race','=','lain-lain')
			->orderBy('dob', 'asc')
			->get();
		return $villager_data;
    }

    function pdf_gender()
    {
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->convert_villager_gender_data_to_html());
		return $pdf->stream();
    }

    function pdf_race()
    {
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->convert_villager_race_data_to_html());
		return $pdf->stream();
    }

    function convert_villager_gender_data_to_html()
    {
     $villager_data = $this->get_villager_data();
     $m_villager_data = $this->get_m_villager_data();
     $f_villager_data = $this->get_f_villager_data();

     $output = '
     <h3 align="center">Penduduk Kampung Buntal mengikut Jantina</h3>
     <h4 style="font-weight:bold;">Jumlah Penduduk: '.$villager_data->count().' orang</h4>
     <table width="100%" style="border-collapse: collapse; border: 1px;">
        <tr>
            <th style="border: 1px solid; padding:12px;" width="10%">Jantina</th>
            <th style="border: 1px solid; padding:12px;" width="20%">Bilangan Penduduk</th>
        </tr>
     ';
     $count = 1;
     $num_male=0;
     $num_female=0;
     foreach($villager_data as $villager)
     {
        if($villager->gender == 'm')
            $num_male ++;
        else
            $num_female++;
     }
     $output .= '
        <tr>
            <td style="border: 1px solid; padding:12px;">Lelaki</td>
            <td style="border: 1px solid; padding:12px;">'.$num_male.'</td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:12px;">Perempuan</td>
            <td style="border: 1px solid; padding:12px;">'.$num_female.'</td>
        </tr>
      ';
     $output .= '</table>';
     $output .= '
     <h4 align="left">Jantina Lelaki</h3>
     <table width="100%" style="border-collapse: collapse; border: 1px;">
        <tr>
            <th style="border: 1px solid; padding:12px;" width="5%">#</th>
            <th style="border: 1px solid; padding:12px;" width="20%">Nama</th>
            <th style="border: 1px solid; padding:12px;" width="30%">No K/P</th>
            <th style="border: 1px solid; padding:12px;" width="15%">Kaum</th>
        </tr>
     ';
     $count = 1;
     foreach($m_villager_data as $male_villager)
     {
      $output .= '
        <tr>
            <td style="border: 1px solid; padding:12px;">'.$count.'</td>
            <td style="border: 1px solid; padding:12px;">'.$male_villager->name.'</td>
            <td style="border: 1px solid; padding:12px;">'.$male_villager->ic.'</td>
            <td style="border: 1px solid; padding:12px;">'.ucwords($male_villager->race).'</td>
        </tr>
      ';
      $count++;
     }
     $output .= '</table>';

     $output .= '
     <h4 align="left">Jantina Perempuan</h3>
     <table width="100%" style="border-collapse: collapse; border: 1px;">
        <tr>
            <th style="border: 1px solid; padding:12px;" width="5%">#</th>
            <th style="border: 1px solid; padding:12px;" width="20%">Nama</th>
            <th style="border: 1px solid; padding:12px;" width="30%">No K/P</th>
            <th style="border: 1px solid; padding:12px;" width="15%">Kaum</th>
        </tr>
     ';
     $count = 1;
     foreach($f_villager_data as $female_villager)
     {
      $output .= '
        <tr>
            <td style="border: 1px solid; padding:12px;">'.$count.'</td>
            <td style="border: 1px solid; padding:12px;">'.$female_villager->name.'</td>
            <td style="border: 1px solid; padding:12px;">'.$female_villager->ic.'</td>
            <td style="border: 1px solid; padding:12px;">'.ucwords($female_villager->race).'</td>
        </tr>
      ';
      $count++;
     }
     $output .= '</table>';

     return $output;
    }

    function convert_villager_race_data_to_html()
    {
     $villager_data = $this->get_villager_data();
     $malay_villager_data = $this->get_malay_data();
     $bumi_villager_data = $this->get_bumi_data();
     $cina_villager_data = $this->get_cina_data();
     $india_villager_data = $this->get_india_data();
     $lain_villager_data = $this->get_lain_data();

     $output = '
     <h3 align="center">Penduduk Kampung Buntal mengikut Kaum</h3>
     <h4 style="font-weight:bold;">Jumlah Penduduk: '.$villager_data->count().' orang</h4>
     <table width="100%" style="border-collapse: collapse; border: 1px;">
        <tr>
            <th style="border: 1px solid; padding:12px;" width="10%">Kaum</th>
            <th style="border: 1px solid; padding:12px;" width="20%">Bilangan</th>
        </tr>
     ';
     $count = 1;
     $num_melayu=0;
     $num_bumi=0;
     $num_cina=0;
     $num_india=0;
     $num_lain=0;
     foreach($villager_data as $villager)
     {
        if($villager->race == 'melayu')
            $num_melayu ++;
        else if($villager->race == 'bumiputera')
            $num_bumi ++;
        else if($villager->race == 'cina')
            $num_cina ++;
        else if($villager->race == 'india')
            $num_india ++;
        else if($villager->race == 'lain-lain')
            $num_lain ++;
     }
     $output .= '
        <tr>
            <td style="border: 1px solid; padding:12px;">Melayu</td>
            <td style="border: 1px solid; padding:12px;">'.$num_melayu.'</td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:12px;">Bumiputera</td>
            <td style="border: 1px solid; padding:12px;">'.$num_bumi.'</td>
        </tr>
        <tr>
        <td style="border: 1px solid; padding:12px;">Cina</td>
        <td style="border: 1px solid; padding:12px;">'.$num_cina.'</td>
        </tr>
        <tr>
        <td style="border: 1px solid; padding:12px;">India</td>
        <td style="border: 1px solid; padding:12px;">'.$num_india.'</td>
        </tr>
        <tr>
        <td style="border: 1px solid; padding:12px;">Lain</td>
        <td style="border: 1px solid; padding:12px;">'.$num_lain.'</td>
        </tr>
      ';
     $output .= '</table>';

	 if (count($malay_villager_data) != 0)
	 {
		 $output .= '
		 <h4 align="left">Kaum Melayu</h4>
		 <table width="100%" style="border-collapse: collapse; border: 1px;">
			<tr>
				<th style="border: 1px solid; padding:12px;" width="5%">#</th>
				<th style="border: 1px solid; padding:12px;" width="20%">Nama</th>
				<th style="border: 1px solid; padding:12px;" width="30%">No K/P</th>
				<th style="border: 1px solid; padding:12px;" width="15%">Jantina</th>
			</tr>
		 ';	 
	 
		 $count = 1;
		 foreach($malay_villager_data as $malay_villager)
		 {
		  if ($malay_villager->gender == 'm')
			  $gender = 'Lelaki';
		  else
			  $gender = 'Perempuan';
		  $output .= '
			<tr>
				<td style="border: 1px solid; padding:12px;">'.$count.'</td>
				<td style="border: 1px solid; padding:12px;">'.$malay_villager->name.'</td>
				<td style="border: 1px solid; padding:12px;">'.$malay_villager->ic.'</td>
				<td style="border: 1px solid; padding:12px;">'.$gender.'</td>
			</tr>
		  ';
		  $count++;
		 }
		 $output .= '</table>';
	 }
	 
	 if (count($bumi_villager_data) != 0)
	 {
		 $output .= '
		 <h4 align="left">Kaum Bumiputera</h4>
		 <table width="100%" style="border-collapse: collapse; border: 1px;">
			<tr>
				<th style="border: 1px solid; padding:12px;" width="5%">#</th>
				<th style="border: 1px solid; padding:12px;" width="20%">Nama</th>
				<th style="border: 1px solid; padding:12px;" width="30%">No K/P</th>
				<th style="border: 1px solid; padding:12px;" width="15%">Jantina</th>
			</tr>
		 ';	 
	 
		 $count = 1;
		 foreach($bumi_villager_data as $bumi_villager)
		 {
		  if ($bumi_villager->gender == 'm')
			  $gender = 'Lelaki';
		  else
			  $gender = 'Perempuan';
		  $output .= '
			<tr>
				<td style="border: 1px solid; padding:12px;">'.$count.'</td>
				<td style="border: 1px solid; padding:12px;">'.$bumi_villager->name.'</td>
				<td style="border: 1px solid; padding:12px;">'.$bumi_villager->ic.'</td>
				<td style="border: 1px solid; padding:12px;">'.$gender.'</td>
			</tr>
		  ';
		  $count++;
		 }
		 $output .= '</table>';
	 }
	 
	 if (count($cina_villager_data) != 0)
	 {
		 $output .= '
		 <h4 align="left">Kaum Cina</h4>
		 <table width="100%" style="border-collapse: collapse; border: 1px;">
			<tr>
				<th style="border: 1px solid; padding:12px;" width="5%">#</th>
				<th style="border: 1px solid; padding:12px;" width="20%">Nama</th>
				<th style="border: 1px solid; padding:12px;" width="30%">No K/P</th>
				<th style="border: 1px solid; padding:12px;" width="15%">Jantina</th>
			</tr>
		 ';
	 
		 $count = 1;
		 foreach($cina_villager_data as $cina_villager)
		 {
		  if ($cina_villager->gender == 'm')
			  $gender = 'Lelaki';
		  else
			  $gender = 'Perempuan';
		  $output .= '
			<tr>
				<td style="border: 1px solid; padding:12px;">'.$count.'</td>
				<td style="border: 1px solid; padding:12px;">'.$cina_villager->name.'</td>
				<td style="border: 1px solid; padding:12px;">'.$cina_villager->ic.'</td>
				<td style="border: 1px solid; padding:12px;">'.$gender.'</td>
			</tr>
		  ';
		  $count++;
		 }
		 $output .= '</table>';
	 }
	 
	 if (count($india_villager_data) != 0)
	 {
		 $output .= '
		 <h4 align="left">Kaum India</h4>
		 <table width="100%" style="border-collapse: collapse; border: 1px;">
			<tr>
				<th style="border: 1px solid; padding:12px;" width="5%">#</th>
				<th style="border: 1px solid; padding:12px;" width="20%">Nama</th>
				<th style="border: 1px solid; padding:12px;" width="30%">No K/P</th>
				<th style="border: 1px solid; padding:12px;" width="15%">Jantina</th>
			</tr>
		 ';
		 
		 $count = 1;
		 foreach($india_villager_data as $india_villager)
		 {
		  if ($india_villager->gender == 'm')
			  $gender = 'Lelaki';
		  else
			  $gender = 'Perempuan';
		  $output .= '
			<tr>
				<td style="border: 1px solid; padding:12px;">'.$count.'</td>
				<td style="border: 1px solid; padding:12px;">'.$india_villager->name.'</td>
				<td style="border: 1px solid; padding:12px;">'.$india_villager->ic.'</td>
				<td style="border: 1px solid; padding:12px;">'.$gender.'</td>
			</tr>
		  ';
		  $count++;
		 }
		 $output .= '</table>';
	 }
	 
	 if (count($lain_villager_data) != 0)
	 {
		 $output .= '
		 <h4 align="left">Kaum Lain</h4>
		 <table width="100%" style="border-collapse: collapse; border: 1px;">
			<tr>
				<th style="border: 1px solid; padding:12px;" width="5%">#</th>
				<th style="border: 1px solid; padding:12px;" width="20%">Nama</th>
				<th style="border: 1px solid; padding:12px;" width="30%">No K/P</th>
				<th style="border: 1px solid; padding:12px;" width="15%">Jantina</th>
			</tr>
		 ';
		 
		 $count = 1;
		 foreach($lain_villager_data as $lain_villager)
		 {
		  if ($lain_villager->gender == 'm')
			  $gender = 'Lelaki';
		  else
			  $gender = 'Perempuan';
		  $output .= '
			<tr>
				<td style="border: 1px solid; padding:12px;">'.$count.'</td>
				<td style="border: 1px solid; padding:12px;">'.$lain_villager->name.'</td>
				<td style="border: 1px solid; padding:12px;">'.$lain_villager->ic.'</td>
				<td style="border: 1px solid; padding:12px;">'.$gender.'</td>
			</tr>
		  ';
		  $count++;
		 }
		 $output .= '</table>';
	 }
     return $output;
    }

    function pdf()
    {
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->convert_villager_data_to_html());
		return $pdf->stream();
    }

    function convert_villager_data_to_html()
    {
		$villager_data = $this->get_villager_data();
		$output = '
			<h3 align="center">Penduduk Kampung Buntal</h3>
			<h4 style="font-weight:bold;">Jumlah Penduduk: '.$villager_data->count().' orang</h4>
			<table width="100%" style="border-collapse:collapse;border:0px;">
				<tr>
					<th style="border:1px solid; padding:8px;width:5%">#</th>
					<th style="border:1px solid; padding:8px;width:20%">Nama</th>
					<th style="border:1px solid; padding:8px;width:25%">No. K/P</th>
					<th style="border:1px solid; padding:8px;width:15%">Jantina</th>
					<th style="border:1px solid; padding:8px;width:15%">Kaum</th>
				</tr>
		';
		
		$count = 1;
		foreach($villager_data as $villager)
		{			
			if ($villager->gender == 'm')
				$gender = 'Lelaki';
			else
				$gender = 'Perempuan';
			
			$ethinicity = ucwords($villager->race);
			
			$output .= '
				<tr>				
					<td style="border:1px solid;padding:8px;">'.$count.'</td>
					<td style="border:1px solid;padding:8px;">'.$villager->name.'</td>
					<td style="border:1px solid;padding:8px;">'.$villager->ic.'</td>
					<td style="border:1px solid;padding:8px;">'.$gender.'</td>
					<td style="border:1px solid;padding:8px;">'.$ethinicity.'</td>
				</tr>
			';
			$count++;
		}
		$output .= '</table>';
		return $output;
    }

	function newborn() 
	{
		$year = date("Y");
		$newborn = Villager::whereYear('dob', $year)
			->orderBy('dob', 'asc')
			->get();
		
		$data = $this->get_data_by_months($newborn, 'dob');	
		$label = $data[0];
		$sum = $data[1];
		$count = $data[2];
		$villager_data = $data[3];
		
		$title = 'Kelahiran bayi pada Tahun '.$year;
		$type = 'kelahiran';
		
		return view('dynamic_pdf_month', compact('title','type','label','sum','count','villager_data'));		
	}
	
	function death() 
	{
		$year = date("Y");
		$death = Villager::whereYear('death_date',$year)
			->orderBy('dob', 'asc')
			->get();
		
		$data = $this->get_data_by_months($death, 'death_date');			
		$label = $data[0];
		$sum = $data[1];
		$count = $data[2];
		$villager_data = $data[3];
		
		$title = 'Kematian berlaku pada Tahun '.$year;
		$type ='kematian';
		
		return view('dynamic_pdf_month', compact('title','type','label','sum','count','villager_data'));		
	}
	
	function get_data_by_months($unfiltered_data, $filter)
    {
		$count = [0,0,0,0,0,0,0,0,0,0,0,0];
		$jan_data =[];
		$feb_data =[];
		$mar_data =[];
		$apr_data =[];
		$may_data =[];
		$jun_data =[];
		$jul_data =[];
		$aug_data =[];
		$sep_data =[];
		$oct_data =[];
		$nov_data =[];
		$dec_data =[];
		foreach($unfiltered_data as $data)
		{
			$birthday = Carbon::parse($data->$filter);
			$month = $birthday->month;
			if ($month == 1) {
				$count[0]++;
				array_push($jan_data, $data);
			}
			else if ($month == 2) {
				$count[1]++;
				array_push($feb_data, $data);
			}
			else if ($month == 3) {
				$count[2]++;
				array_push($mar_data, $data);
			}
			else if ($month == 4) {
				$count[3]++;
				array_push($apr_data, $data);
			}
			else if ($month == 5) {
				$count[4]++;
				array_push($may_data, $data);
			}
			else if ($month == 6) {
				$count[5]++;
				array_push($jun_data, $data);
			}
			else if ($month == 7) {
				$count[6]++;
				array_push($jul_data, $data);
			}
			else if ($month == 8) {
				$count[7]++;
				array_push($aug_data, $data);
			}
			else if ($month == 9) {
				$count[8]++;
				array_push($sep_data, $data);
			}
			else if ($month == 10) {
				$count[9]++;
				array_push($oct_data, $data);
			}
			else if ($month == 11) {
				$count[10]++;
				array_push($nov_data, $data);
			}
			else {
				$count[11]++;
				array_push($dec_data, $data);
			}
		}
		$villager_data = [$jan_data,$feb_data,$mar_data,$apr_data,$may_data,$jun_data,$jul_data,$aug_data,$sep_data,$oct_data,$nov_data,$dec_data];
		$sum = array_sum($count);
		$label = ['Januari','Februari','Mac','April','Mei','Jun','Julai','Ogos','September','Oktober','November','Disember'];
		
		return [$label,$sum,$count,$villager_data];
    }
	
	function pdf_month($type)
    {
		if ($type != 'kelahiran' && $type != 'kematian')
			abort(404);	
		
		$year = date("Y");
		if ($type == 'kelahiran')
		{			
			$newborn = Villager::whereYear('dob', $year)
				->orderBy('dob', 'asc')
				->get();
			
			$data = $this->get_data_by_months($newborn, 'dob');	
			$title = 'Kelahiran bayi pada Tahun '.$year;
		}
		else
		{
			$death = Villager::whereYear('death_date',$year)
			->orderBy('dob', 'asc')
			->get();
		
			$data = $this->get_data_by_months($death, 'death_date');	
			$title = 'Kematian berlaku pada Tahun '.$year;
		}
		
		$label = $data[0];
		$sum = $data[1];
		$count = $data[2];
		$villager_data = $data[3];		
		
		$pdf = \App::make('dompdf.wrapper');
		$pdf->setPaper('A4', 'Landscape');
		$pdf->loadHTML($this->convert_villager_data_month_to_html($title,$type,$label,$sum,$count,$villager_data));
		return $pdf->stream();
    }
	
    function convert_villager_data_month_to_html($title,$type,$label,$sum,$count,$villager_data)
    {
		$output = '
			<h3 align="center">'.$title.'</h3>
			<h4 style="font-weight:bold;">Jumlah '.$type.': '.$sum.' orang</h4>
			<table width="50%" style="border-collapse:collapse;border:0px;">			
				<tr>
					<th style="border:1px solid;padding:8px;width:50%">Bulan</th>
                    <th style="border:1px solid;padding:8px;width:50%">Bilangan Orang</th>
                </tr>';
			
		for($i=0; $i<12; $i++)
		{	
			$output .= '
				<tr>				
					<td style="border:1px solid;padding:8px;">'.$label[$i].'</td>
					<td style="border:1px solid;padding:8px;">'.$count[$i].'</td>
				</tr>
			';
		}
		
		$output .= '</table><br><br><br>';
		
		$index=0;
		foreach($villager_data as $data)
		{
			if(isset($data) && count($data) != 0)
			{
				$output .= '
					<hr><h4 style="font-weight:bold;">Bulan: '.$label[$index].'</h4>
					<table style="border-collapse:collapse;border:0px;width:100%;table-layout:fixed;">	
						<tr>
							<th style="border:1px solid;padding:8px;width:5%">#</th>
							<th style="border:1px solid;padding:8px;width:25%">Nama</th>
							<th style="border:1px solid;padding:8px;width:20%">No. K/P</th>
				';
				
				if($type == 'kelahiran')
					$output .= '<th style="border:1px solid;padding:8px;width:15%">Tarikh Lahir</th>';
				else
					$output .= '<th style="border:1px solid;padding:8px;width:15%">Tarikh Meninggal</th>';
				
				$output .= '
							<th style="border:1px solid;padding:8px;width:10%">Jantina</th>
							<th style="border:1px solid;padding:8px;width:10%">Kaum</th>
						</tr>
				';
				
				$count = 1;
				foreach($data as $d)
				{			
					if ($d->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';
					
					$ethinicity = ucwords($d->race);
					
					$output .= '
						<tr>				
							<td style="border:1px solid;padding:8px;">'.$count.'</td>
							<td style="border:1px solid;padding:8px;">'.$d->name.'</td>
							<td style="border:1px solid;padding:8px;">'.$d->ic.'</td>';
					
					if($type == 'kelahiran')
						$output .= '<td style="border:1px solid;padding:8px;">'.$d->dob.'</td>';
					else
						$output .= '<td style="border:1px solid;padding:8px;">'.$d->death_date.'</td>';
					
					$output .= '
							<td style="border:1px solid;padding:8px;">'.$gender.'</td>
							<td style="border:1px solid;padding:8px;">'.$ethinicity.'</td>
						</tr>
					';
					$count++;
				}
				$output .= '</table><br>';
			}
			$index++;
		}
		return $output;
    }
}
