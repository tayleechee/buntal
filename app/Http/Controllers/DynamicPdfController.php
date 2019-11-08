<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Carbon\Carbon;
use App\Villager;
use App\House;

class DynamicPDFController extends Controller
{
    function index()
    {
		$villager_data = $this->get_villager_data();
		$villager_count = $villager_data->count();
		return view('dynamic_pdf', compact('villager_data','villager_count'));
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
		$label = $data[7];
		$sum_newborn = $data[8];
		$count_newborn = $data[9];
		$sum_death = $data[10];
		$count_death = $data[11];		
		
		return view('summaryReport', compact('year','sum','permanent','gender','race','marital','property','label','sum_newborn','count_newborn','sum_death','count_death'));
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
		$race['melayu'] = Villager::whererace('malay')->where('death_date', null)->count();
		$race['cina'] = Villager::whererace('cina')->where('death_date', null)->count();
		$race['india'] = Villager::whererace('india')->where('death_date', null)->count();
		$race['bumiputera'] = Villager::whererace('bumiputera')->where('death_date', null)->count();
		$race['lain'] = Villager::whererace('other')->where('death_date', null)->count();

		$marital = [];
		$marital['bujang'] = Villager::wheremarital_status('bujang')->where('death_date', null)->count();
		$marital['kahwin'] = Villager::wheremarital_status('kahwin')->where('death_date', null)->count();
		$marital['duda'] = Villager::wheremarital_status('duda')->where('death_date', null)->count();	
		$marital['janda'] = Villager::wheremarital_status('janda')->where('death_date', null)->count();
		
		$property = [];		
        $property['y'] = Villager::whereis_property_owner('1')->where('death_date', null)->count();
		$property['n'] = Villager::whereis_property_owner('0')->where('death_date', null)->count();
		
		$label = ['Januari','Februari','Mac','April','Mei','Jun','Julai','Ogos','September','Oktober','November','December'];
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
		
		return [$year,$sum,$permanent,$gender,$race,$marital,$property,$label,$sum_newborn,$count_newborn,$sum_death,$count_death];	
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
		$label = $data[7];
		$sum_newborn = $data[8];
		$count_newborn = $data[9];
		$sum_death = $data[10];
		$count_death = $data[11];
		
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

    function get_villager_data()
    {
		$villager_data = DB::table('villagers')
			->where('death_date', null)
			->orderBy('dob', 'asc')
			->get();
		return $villager_data;
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
		$label = ['Januari','Februari','Mac','April','Mei','Jun','Julai','Ogos','September','Oktober','November','December'];
		
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
