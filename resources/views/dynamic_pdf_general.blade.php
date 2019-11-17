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
		<a href="{{ url('dynamic_pdf/pdf') }}" class="btn btn-primary" target="_blank">
            <span class="mr-2">Simpan PDF</span>
            <i class="fas fa-file-pdf"></i>
        </a>
	</div> 
    <div class="card p-3 mt-2" style="background: white;">  
	<h1 align="center">Senarai Penduduk Kampung Buntal</h1>
    <br />
	@php
		$count = 1;
	@endphp
	<h5 class="font-weight-bold my-3">Jumlah Penduduk: {{ $villager_count }} orang</h5>
    <div class="table-responsive">
            <table class="table table-striped table-bordered">
            <thead>
                <tr>
					<th>#</th>
                    <th>Nama</th>
                    <th>No. K/P</th>
                    <th>Jantina</th>
                    <th>Kaum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($villager_data as $villager)
				@php
					if ($villager->gender == 'm')
						$gender = 'Lelaki';
					else
						$gender = 'Perempuan';					
					$ethinicity = ucwords($villager->race);
				@endphp
                <tr>
					<td>{{ $count }}</td>
                    <td>{{ $villager->name }}</td>
                    <td>{{ $villager->ic }}</td>
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
