<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class DynamicPDFController extends Controller
{
    function index()
    {
     $villager_data = $this->get_villager_data();
     return view('dynamic_pdf')->with('villager_data', $villager_data);
    }

    function get_villager_data()
    {
     $villager_data = DB::table('villagers')
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
     <h3 align="center">Ketelitian Penduduk</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">Nama</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Ic</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Jantina</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Bangsa</th>
   </tr>
     ';
     foreach($villager_data as $villager)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$villager->name.'</td>
       <td style="border: 1px solid; padding:12px;">'.$villager->ic.'</td>
       <td style="border: 1px solid; padding:12px;">'.$villager->gender.'</td>
       <td style="border: 1px solid; padding:12px;">'.$villager->race.'</td>
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }
}
