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
	<div align="right">
		<a href="{{ url('dynamic_pdf/voterReportPdf') }}" class="btn btn-primary" target="_blank">
            <span class="mr-2">Simpan PDF</span>
            <i class="fas fa-file-pdf"></i>
        </a>
	</div>
    <div class="card p-3 mt-2" style="background: white;">   
	<h1 align="center">Pendaftaran sebagai Pengundi</h1>
    <br />
	<h5 class="font-weight-bold my-3">Bilangan Penduduk yang Layak untuk Daftar sebagai Pengundi: {{ $sum }} orang</h5>
	
	<div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
					<th>Status Pendaftaran</th>
                    <th>Bilangan Penduduk</th>
                </tr>
            </thead>
            <tbody>
                <tr>
					<td>Sudah Daftar</td>
                    <td>{{ $count_voter }}</td>
                </tr>
				<tr>
					<td>Belum Daftar</td>
                    <td>{{ $count_non_voter }}</td>
                </tr>
            </tbody>
        </table>
    </div>
	<br>
	
	<h5 class="my-3">Senarai Penduduk yang Belum Daftar sebagai Pengundi</h5>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
					<th style="width:5%">#</th>
                    <th style="width:25%">Nama</th>
                    <th style="width:20%">No. K/P</th>					
					<th style="width:20%">No. Telefon</th>
                    <th style="width:15%">Jantina</th>
                    <th style="width:15%">Kaum</th>
                </tr>
            </thead>
            <tbody>			
				@php
					$count = 1;
				@endphp
                @foreach($non_voter as $villager)
				@php
					if ($villager->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';					
					$ethinicity = ucwords($villager->race);
				@endphp
                <tr>
					<td>{{ $count }}</td>
                    <td><a href="{{url('villager/'.$villager->id)}}"> {{ $villager->name }}</a></td>
                    <td>{{ $villager->ic }}</td>
					@if ($villager->phone != null)
						<td>{{ $villager->phone }}</td>
					@else 
						<td>-</td>
					@endif	
                    <td>{{ $gender }}</td>
                    <td>{{ $ethinicity }}</td>
                </tr>
				@php $count++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
	<br>
	
	<h5 class="my-3">Senarai Penduduk yang Sudah Daftar sebagai Pengundi</h5>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
					<th style="width:5%">#</th>
                    <th style="width:25%">Nama</th>
                    <th style="width:20%">No. K/P</th>					
					<th style="width:20%">No. Telefon</th>
                    <th style="width:15%">Jantina</th>
                    <th style="width:15%">Kaum</th>
                </tr>
            </thead>
            <tbody>			
				@php
					$count = 1;
				@endphp
                @foreach($voter as $villager)
				@php
					if ($villager->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';					
					$ethinicity = ucwords($villager->race);
				@endphp
                <tr>
					<td>{{ $count }}</td>
                    <td><a href="{{url('villager/'.$villager->id)}}"> {{ $villager->name }}</a></td>
                    <td>{{ $villager->ic }}</td>
					@if ($villager->phone != null)
						<td>{{ $villager->phone }}</td>
					@else 
						<td>-</td>
					@endif		
                    <td>{{ $gender }}</td>
                    <td>{{ $ethinicity }}</td>
                </tr>
				@php $count++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
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


    });
</script>

@endsection
