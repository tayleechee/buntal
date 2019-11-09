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
		<a href="{{ url('dynamic_pdf/pdf_month/'.$type) }}" class="btn btn-danger" target="_blank">Simpan PDF</a>
	</div> 	
	<h1 align="center">{!! $title !!}</h1>
    <br />
	<h5 class="font-weight-bold">Jumlah {!! $type !!}: {!! $sum !!} orang</h5>
	<div class="table-responsive">
		<table class="table table-striped table-bordered col-6">
            <thead>
                <tr>
					<th>Bulan</th>
                    <th>Bilangan Orang</th>
                </tr>
            </thead>
            <tbody>
                @for($i=0; $i<12; $i++)
                <tr>
					<td>{!! $label[$i] !!}</td>
                    <td>{!! $count[$i] !!}</td>
                </tr>
                @endfor
            </tbody>
		</table>
    </div>
	@php $index=0; @endphp
	@foreach($villager_data as $data)
		@if(isset($data) && count($data) != 0)
			<hr><h5 class="font-weight-bold">Bulan: {!! $label[$index] !!}</h5>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th style="width:5%">#</th>
							<th style="width:30%">Nama</th>
							<th style="width:30%">No. K/P</th>
							@if ($type == "kelahiran")
								<th style="width:15%">Tarikh Lahir</th>
							@else
								<th style="width:15%">Tarikh Meninggal</th>
							@endif
							<th style="width:10%">Jantina</th>
							<th style="width:10%">Kaum</th>
						</tr>
					</thead>
					<tbody>
					@foreach($data as $d)
						@php
							$count = 1;
							if ($d->gender == 'm')
								$gender = 'Lelaki';
							else
								$gender = 'Perempuan';					
							$ethinicity = ucwords($d->race);
						@endphp
						<tr>
							<td>{!! $count !!}</td>
							<td>{!! $d->name !!}</td>
							<td>{!! $d->ic !!}</td>
							@if ($type == "newborn")
								<td>{!! $d->dob !!}</td>
							@else
								<td>{!! $d->death_date !!}</td>
							@endif
							<td>{!! $gender !!}</td>
							<td>{!! $ethinicity !!}</td>
						</tr>
						@php $count++; @endphp
					@endforeach
					</tbody>
				</table>
			</div>
		@endif
		@php $index++; @endphp
	@endforeach
</div>
@endsection
