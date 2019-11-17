@extends('layouts.app')

@section('content')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
				<option value="col11">Mengikut Jantina</option>
				<option value="col12">Mengikut Kaum</option>
			</select>
		</div>
		<div class="col-md" align="right">
			<div>
				<a href="{{ url('dynamic_pdf/pdf_gender') }}" class="btn btn-primary col11 kotak" target="_blank">
                    <span class="mr-2">Simpan PDF</span>
                    <i class="fas fa-file-pdf"></i>
                </a>
				<a href="{{ url('dynamic_pdf/pdf_race') }}" class="btn btn-primary col12 kotak" target="_blank" style="display:none;">
                    <span class="mr-2">Simpan PDF</span>
                    <i class="fas fa-file-pdf"></i>            
                </a>
			</div>
		</div>
    </div>
    <br>

    @php
		$count = 1;
	@endphp

    <div class="Table-responsive col11 kotak card p-3" style="background: white">
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
                    @php
                    $num_male=0;
                    $num_female=0;
                    @endphp
                    @foreach($villager_data as $villager)
                    @php
                        if($villager->gender == 'm')
                            $num_male ++;
                        else
                            $num_female++;
                    @endphp
                    @endforeach
                    <tr>
                        <td> Lelaki </td>
                        <td>{{ $num_male }}</td>
                    </tr>
                    <tr>
                        <td> Perempuan </td>
                        <td>{{ $num_female }}</td>
                    </tr>
                </tbody>
            </table>

            <br>

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
                @foreach($m_villager_data as $male_villager)
				@php $race = ucwords($male_villager->race); @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $male_villager->name }}</td>
                        <td>{{ $male_villager->ic }}</td>
                        <td>{{ $race }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach
            </tbody>
            </table>

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
                @foreach($f_villager_data as $female_villager)
				@php $race = ucwords($female_villager->race); @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $female_villager->name }}</td>
                        <td>{{ $female_villager->ic }}</td>
                        <td>{{ $race }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach
            </tbody>
            </table>
    </div>

    <div class="Table-responsive col12 kotak card p-3" style="background: white">
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
                    @php
                    $num_melayu=0;
                    $num_bumi=0;
                    $num_cina=0;
                    $num_india=0;
                    $num_lain=0;
                    @endphp
                    @foreach($villager_data as $villager)
                    @php
                        if($villager->race == 'malay')
                            $num_melayu ++;
                        else if($villager->race == 'bumiputera')
                            $num_bumi ++;
                        else if($villager->race == 'cina')
                            $num_cina ++;
                        else if($villager->race == 'india')
                            $num_india ++;
                        else if($villager->race == 'other')
                            $num_lain ++;
                    @endphp
                    @endforeach
                    <tr>
                        <td> Melayu </td>
                        <td>{{ $num_melayu }}</td>
                    </tr>
                    <tr>
                        <td> Bumiputera </td>
                        <td>{{ $num_bumi }}</td>
                    </tr>
                    <tr>
                        <td> Cina </td>
                        <td>{{ $num_cina }}</td>
                    </tr>
                    <tr>
                        <td> India </td>
                        <td>{{ $num_india }}</td>
                    </tr>
                    <tr>
                        <td> Lain - lain </td>
                        <td>{{ $num_lain }}</td>
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
                @foreach($malay_villager_data as $malay_villager)
                @php
                if ($malay_villager->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $malay_villager->name }}</td>
                        <td>{{ $malay_villager->ic }}</td>
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
                @foreach($bumi_villager_data as $bumi_villager)
                @php
                if ($bumi_villager->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $bumi_villager->name }}</td>
                        <td>{{ $bumi_villager->ic }}</td>
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
                @foreach($cina_villager_data as $cina_villager)
                @php
                if ($cina_villager->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $cina_villager->name }}</td>
                        <td>{{ $cina_villager->ic }}</td>
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
                @foreach($india_villager_data as $india_villager)
                @php
                if ($india_villager->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $india_villager->name }}</td>
                        <td>{{ $india_villager->ic }}</td>
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
                @foreach($lain_villager_data as $lain_villager)
                @php
                if ($lain_villager->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';
                @endphp
                     <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $lain_villager->name }}</td>
                        <td>{{ $lain_villager->ic }}</td>
                        <td>{{ $gender }}</td>
                     </tr>
                @php $count++; @endphp
                @endforeach
            </tbody>
            </table>
			@endif
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var optarray = $("#layout_select").children('option').map(function() {
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
        }).change();

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
