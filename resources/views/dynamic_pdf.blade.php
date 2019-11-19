@extends('layouts.app')

@section('content')
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
   }
  </style>

<div class="container">
	<div class="row">
		<div class="col-md-5">
			<select class="form-control" name="column_select" id="column_select">
				<option value="jantina">Mengikut Jantina</option>
				<option value="kaum">Mengikut Kaum</option>
                <option value="kahwin">Mengikut Status Perkahwinan</option>
			</select>
		</div>
		<div class="col-md" align="right">
			<div>
				<a href="{{ url('dynamic_pdf/pdf_gender') }}" class="btn btn-primary jantina kotak" target="_blank">
                    <span class="mr-2">Simpan PDF</span>
                    <i class="fas fa-file-pdf"></i>
                </a>
				<a href="{{ url('dynamic_pdf/pdf_race') }}" class="btn btn-primary kaum kotak" target="_blank" style="display:none;">
                    <span class="mr-2">Simpan PDF</span>
                    <i class="fas fa-file-pdf"></i>            
                </a>
                <a href="{{ url('dynamic_pdf/pdf_marital') }}" class="btn btn-primary kahwin kotak" target="_blank" style="display:none;">
                    <span class="mr-2">Simpan PDF</span>
                    <i class="fas fa-file-pdf"></i>            
                </a>
			</div>
		</div>
    </div>
    <br>

    <!-- Jantina -->
    <div class="Table-responsive jantina kotak card p-3" style="background: white">
    <h1 align='center'>Penduduk Kampung Buntal mengikut Jantina</h1>
    <br>
    <h5 class="font-weight-bold">Jumlah Penduduk: {{ $villager_count }} orang</h5>
    <br>
            <table class="table table-striped table-bordered col-6">
                <thead>
                    <tr>
                        <th>Jantina</th>
                        <th>Bilangan Penduduk</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> Lelaki </td>
                        <td>{{ $m_villager_count }}</td>
                    </tr>
                    <tr>
                        <td> Perempuan </td>
                        <td>{{ $f_villager_count }}</td>
                    </tr>
                </tbody>
            </table>

            <br>

            @if (count($m_villager_data) > 0)
            @php
            $count = 1;
            @endphp
            <table class="table table-striped table-bordered">
            <h5>Jantina Lelaki</h5>
            <thead>
                <tr>
                    <th style="width:10%">#</th>
                    <th style="width:35%">Nama</th>
                    <th style="width:35%">No K/P</th>
                    <th style="width:20%">Kaum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($m_villager_data as $villager)
				@php $race = ucwords($villager->race); @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td><a href="{{url('villager/'.$villager->id)}}">{{ $villager->name }}</a></td>
                        <td>{{ $villager->ic }}</td>
                        <td>{{ $race }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach
            </tbody>
            </table>
            @endif

            @if (count($f_villager_data) > 0)
            <br>
            @php
		    $count = 1;
	        @endphp
            <table class="table table-striped table-bordered">
            <h5>Jantina Perempuan</h5>
            <thead>
                <tr>
                    <th style="width:10%">#</th>
                    <th style="width:35%">Nama</th>
                    <th style="width:35%">No K/P</th>
                    <th style="width:20%">Kaum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($f_villager_data as $villager)
				@php $race = ucwords($villager->race); @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td><a href="{{url('villager/'.$villager->id)}}">{{ $villager->name }}</a></td>
                        <td>{{ $villager->ic }}</td>
                        <td>{{ $race }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach
            </tbody>
            </table>
            @endif
    </div>

    <!-- Kaum -->
    <div class="Table-responsive kaum kotak card p-3" style="background: white">
    <h1 align='center'>Penduduk Kampung Buntal mengikut Kaum</h1>
    <br>
    <h5 class="font-weight-bold">Jumlah Penduduk: {{ $villager_count }} orang</h5>
    <br>
    <table class="table table-striped table-bordered col-6">
                <thead>
                    <tr>
                        <th>Kaum</th>
                        <th>Bilangan Penduduk</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> Melayu </td>
                        <td>{{ $malay_villager_count }}</td>
                    </tr>
                    <tr>
                        <td> Bumiputera </td>
                        <td>{{ $bumi_villager_count }}</td>
                    </tr>
                    <tr>
                        <td> Cina </td>
                        <td>{{ $cina_villager_count }}</td>
                    </tr>
                    <tr>
                        <td> India </td>
                        <td>{{ $india_villager_count }}</td>
                    </tr>
                    <tr>
                        <td> Lain - lain </td>
                        <td>{{ $lain_villager_count }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
			
            @php
		    $count = 1;
	        @endphp
			@if(count($malay_villager_data) != 0)
            <table class="table table-striped table-bordered">
            <h5>Kaum Melayu</h5>
            <thead>
                <tr>
                    <th style="width:10%">#</th>
                    <th style="width:35%">Nama</th>
                    <th style="width:35%">No K/P</th>
                    <th style="width:20%">Jantina</th>
                </tr>
            </thead>
            <tbody>
                @foreach($malay_villager_data as $villager)
                @php
                if ($villager->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td><a href="{{url('villager/'.$villager->id)}}">{{ $villager->name }}</a></td>
                        <td>{{ $villager->ic }}</td>
                        <td>{{ $gender }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach

            </tbody>
            </table>
            <br>
			@endif
			
            @php
		    $count = 1;
	        @endphp
			@if(count($bumi_villager_data) != 0)
            <table class="table table-striped table-bordered">
            <h5>Kaum Bumiputera</h5>
            <thead>
                <tr>
                    <th style="width:10%"th>
                    <th style="width:35%">Nama</th>
                    <th style="width:35%">No K/P</th>
                    <th style="width:20%">Jantina</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bumi_villager_data as $villager)
                @php
                if ($villager->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td><a href="{{url('villager/'.$villager->id)}}">{{ $villager->name }}</a></td>
                        <td>{{ $villager->ic }}</td>
                        <td>{{ $gender }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach
            </tbody>
            </table>
            <br>
			@endif
			
            @php
		    $count = 1;
	        @endphp
			@if(count($cina_villager_data) != 0)
            <table class="table table-striped table-bordered">
            <h5>Kaum Cina</h5>
            <thead>
                <tr>
                    <th style="width:10%">#</th>
                    <th style="width:35%">Nama</th>
                    <th style="width:35%">No K/P</th>
                    <th style="width:20%">Jantina</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cina_villager_data as $villager)
                @php
                if ($villager->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td><a href="{{url('villager/'.$villager->id)}}">{{ $villager->name }}</a></td>
                        <td>{{ $villager->ic }}</td>
                        <td>{{ $gender }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach

            </tbody>
            </table>
            <br>
			@endif
			
            @php
		    $count = 1;
	        @endphp
			@if(count($india_villager_data) != 0)
            <table class="table table-striped table-bordered">
            <h5>Kaum India</h5>
            <thead>
                <tr>
                    <th style="width:10%">#</th>
                    <th style="width:35%">Nama</th>
                    <th style="width:35%">No K/P</th>
                    <th style="width:20%">Jantina</th>
                </tr>
            </thead>
            <tbody>
                @foreach($india_villager_data as $villager)
                @php
                if ($india_villager->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td><a href="{{url('villager/'.$villager->id)}}">{{ $villager->name }}</a></td>
                        <td>{{ $villager->ic }}</td>
                        <td>{{ $gender }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach
            </tbody>
            </table>
            <br>
			@endif
			
            @php
		    $count = 1;
	        @endphp
			@if(count($lain_villager_data) != 0)
            <table class="table table-striped table-bordered">
            <h5>Kaum Lain</h5>
            <thead>
                <tr>
                    <th style="width:10%">#</th>
                    <th style="width:35%">Nama</th>
                    <th style="width:35%">No K/P</th>
                    <th style="width:20%">Jantina</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lain_villager_data as $villager)
                @php
                if ($villager->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td><a href="{{url('villager/'.$villager->id)}}">{{ $villager->name }}</a></td>
                        <td>{{ $villager->ic }}</td>
                        <td>{{ $gender }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach
            </tbody>
            </table>
			@endif
    </div>

    <!-- Status Perkahwinan -->
    <div class="Table-responsive kahwin kotak card p-3" style="background: white">
    <h1 align='center'>Penduduk Kampung Buntal mengikut Status Perkahwinan</h1>
    <br>
    <h5 class="font-weight-bold">Jumlah Penduduk: {{ $villager_count }} orang</h5>
    <br>
    <table class="table table-striped table-bordered col-6">
                <thead>
                    <tr>
                        <th>Status Perkahwinan</th>
                        <th>Bilangan Penduduk</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> Bujang </td>
                        <td>{{ $bujang_count }}</td>
                    </tr>
                    <tr>
                        <td> Kahwin </td>
                        <td>{{ $kahwin_count }}</td>
                    </tr>
                    <tr>
                        <td> Duda </td>
                        <td>{{ $duda_count }}</td>
                    </tr>
                    <tr>
                        <td> Janda </td>
                        <td>{{ $janda_count }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            
            @php
            $count = 1;
            @endphp
            @if(count($bujang_villager) != 0)
            <table class="table table-striped table-bordered">
            <h5>Bujang</h5>
            <thead>
                <tr>
                    <th style="width:10%">#</th>
                    <th style="width:35%">Nama</th>
                    <th style="width:25%">No K/P</th>
                    <th style="width:15%">Jantina</th>
                    <th style="width:15%">Kaum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bujang_villager as $villager)
                @php
                if ($villager->gender == 'm')
                        $gender = 'Lelaki';
                    else
                        $gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td><a href="{{url('villager/'.$villager->id)}}">{{ $villager->name }}</a></td>
                        <td>{{ $villager->ic }}</td>
                        <td>{{ $gender }}</td>
                        <td> {{ ucfirst($villager->race) }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach

            </tbody>
            </table>
            <br>
            @endif
            
            @php
            $count = 1;
            @endphp
            @if(count($kahwin_villager) != 0)
            <table class="table table-striped table-bordered">
            <h5>Kahwin</h5>
            <thead>
                <tr>
                    <th style="width:10%">#</th>
                    <th style="width:35%">Nama</th>
                    <th style="width:25%">No K/P</th>
                    <th style="width:15%">Jantina</th>
                    <th style="width:15%">Kaum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kahwin_villager as $villager)
                @php
                if ($villager->gender == 'm')
                        $gender = 'Lelaki';
                    else
                        $gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td><a href="{{url('villager/'.$villager->id)}}">{{ $villager->name }}</a></td>
                        <td>{{ $villager->ic }}</td>
                        <td>{{ $gender }}</td>
                        <td> {{ ucfirst($villager->race) }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach
            </tbody>
            </table>
            <br>
            @endif
            
            @php
            $count = 1;
            @endphp
            @if(count($duda_villager) != 0)
            <table class="table table-striped table-bordered">
            <h5>Duda</h5>
            <thead>
                <tr>
                    <th style="width:10%">#</th>
                    <th style="width:35%">Nama</th>
                    <th style="width:25%">No K/P</th>
                    <th style="width:15%">Jantina</th>
                    <th style="width:15%">Kaum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($duda_villager as $villager)
                @php
                if ($villager->gender == 'm')
                        $gender = 'Lelaki';
                    else
                        $gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td><a href="{{url('villager/'.$villager->id)}}">{{ $villager->name }}</a></td>
                        <td>{{ $villager->ic }}</td>
                        <td>{{ $gender }}</td>
                        <td> {{ ucfirst($villager->race) }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach

            </tbody>
            </table>
            <br>
            @endif
            
            @php
            $count = 1;
            @endphp
            @if(count($janda_villager) != 0)
            <table class="table table-striped table-bordered">
            <h5>Janda</h5>
            <thead>
                <tr>
                    <th style="width:10%">#</th>
                    <th style="width:35%">Nama</th>
                    <th style="width:25%">No K/P</th>
                    <th style="width:15%">Jantina</th>
                    <th style="width:15%">Kaum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($janda_villager as $villager)
                @php
                if ($villager->gender == 'm')
                        $gender = 'Lelaki';
                    else
                        $gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td><a href="{{url('villager/'.$villager->id)}}">{{ $villager->name }}</a></td>
                        <td>{{ $villager->ic }}</td>
                        <td>{{ $gender }}</td>
                        <td> {{ ucfirst($villager->race) }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach
            </tbody>
            </table>
            <br>
            @endif
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        /*var optarray = $("#layout_select").children('option').map(function() {
            return {
                "value": this.value,
                "option": "<option value='" + this.value + "'>" + this.text + "</option>"
            }
        })

        $("#column_select").change(function() {
            $("#layout_select").children('option').remove();
            var addoptarr = [];
            for (i = 0; i < optarray.length; i++) {
                if (optarray[i].value.indexOf($(this).val()) > -1) {
                    addoptarr.push(optarray[i].option);
                }
            }
            $("#layout_select").html(addoptarr.join(''))
        }).change();*/

        $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".kotak").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".kotak").hide();
            }
        });
    }).change();
    });
</script>

@endsection
