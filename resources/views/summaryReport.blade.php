@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

<div class="container">
	<div align="right">
		<a href="{{ url('dynamic_pdf/summaryReportPdf') }}" class="btn btn-danger" target="_blank">Simpan PDF</a>
	</div> 	
	<br>
	<h1 align="center">Ringkasan Laporan Terkini</h1>
	<h1 align="center">Demografi Kampung Buntal Tahun {!! $year !!}</h1>
	<br>
	<h5 class="font-weight-bold">Jumlah Penduduk: {!! $sum !!} orang</h5>
	
	<br />
	<h5 class="font-weight-bold">Penduduk Tetap</h5>
	<div class="table-responsive">
		<table class="table table-striped table-bordered col-6">
            <thead>
                <tr>
					<th style="width:50%">Status</th>
                    <th style="width:50%">Bilangan Penduduk</th>
                </tr>
            </thead>
            <tbody>
                <tr>
					<td>Ya</td>
                    <td>{!! $permanent['y'] !!}</td>
                </tr>
				<tr>
					<td>Tidak</td>
                    <td>{!! $permanent['n'] !!}</td>
                </tr>
            </tbody>
		</table>
    </div>
	
    <br />
	<h5 class="font-weight-bold">Jantina</h5>
	<div class="table-responsive">
		<table class="table table-striped table-bordered col-6">
            <thead>
                <tr>
					<th style="width:50%">Jantina</th>
                    <th style="width:50%">Bilangan Penduduk</th>
                </tr>
            </thead>
            <tbody>
                <tr>
					<td>Lekaki</td>
                    <td>{!! $gender['m'] !!}</td>
                </tr>
				<tr>
					<td>Perempuan</td>
                    <td>{!! $gender['f'] !!}</td>
                </tr>
            </tbody>
		</table>
    </div>
	
	<br />
	<h5 class="font-weight-bold">Kaum</h5>
	<div class="table-responsive">
		<table class="table table-striped table-bordered col-6">
            <thead>
                <tr>
					<th style="width:50%">Kaum</th>
                    <th style="width:50%">Bilangan Penduduk</th>
                </tr>
            </thead>
            <tbody>
                <tr>
					<td>Melayu</td>
                    <td>{!! $race['melayu'] !!}</td>
                </tr>
				<tr>
					<td>Bumiputera</td>
                    <td>{!! $race['bumiputera'] !!}</td>
                </tr>
				<tr>
					<td>Cina</td>
                    <td>{!! $race['cina'] !!}</td>
                </tr>
				<tr>
					<td>India</td>
                    <td>{!! $race['india'] !!}</td>
                </tr>
				<tr>
					<td>Lain-lain</td>
                    <td>{!! $race['lain'] !!}</td>
                </tr>
            </tbody>
		</table>
    </div>
	
	<br />
	<h5 class="font-weight-bold">Status Perkahwinan</h5>
	<div class="table-responsive">
		<table class="table table-striped table-bordered col-6">
            <thead>
                <tr>
					<th style="width:50%">Status Perkahwinan</th>
                    <th style="width:50%">Bilangan Penduduk</th>
                </tr>
            </thead>
            <tbody>
                <tr>
					<td>Bujang</td>
                    <td>{!! $marital['bujang'] !!}</td>
                </tr>
				<tr>
					<td>Kahwin</td>
                    <td>{!! $marital['kahwin'] !!}</td>
                </tr>
				<tr>
					<td>Duda</td>
                    <td>{!! $marital['duda'] !!}</td>
                </tr>
				<tr>
					<td>Janda</td>
                    <td>{!! $marital['janda'] !!}</td>
                </tr>
            </tbody>
		</table>
    </div>

    <br />
    <h5 class="font-weight-bold">Tahap Pendidikan</h5>
    <div class="table-responsive">
        <table class="table table-striped table-bordered col-6">
            <thead>
                <tr>
                    <th style="width:50%">Tahap Pendidikan</th>
                    <th style="width:50%">Bilangan Penduduk</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tidak Berpendidikan Formal</td>
                    <td>{!! $education['non-educated'] !!}</td>
                </tr>
                <tr>
                    <td>Pendidikan Rendah</td>
                    <td>{!! $education['primary'] !!}</td>
                </tr>
                <tr>
                    <td>Pendidikan Menengah</td>
                    <td>{!! $education['secondary'] !!}</td>
                </tr>
                <tr>
                    <td>Tingkatan 6</td>
                    <td>{!! $education['form6'] !!}</td>
                </tr>
                <tr>
                    <td>Diploma</td>
                    <td>{!! $education['diploma'] !!}</td>
                </tr>
                <tr>
                    <td>Ijazah Sarjana Muda</td>
                    <td>{!! $education['degree'] !!}</td>
                </tr>
                <tr>
                    <td>Ijazah Sarjana</td>
                    <td>{!!$education['master'] !!}</td>
                </tr>
                <tr>
                    <td>Doktor Falsafah</td>
                    <td>{!! $education['phd'] !!}</td>
                </tr>
                <tr>
                    <td>Tiada Kaitan</td>
                    <td>{!! $education['n/a'] !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
	
	<br />
	<h5 class="font-weight-bold">Memiliki Tanah</h5>
	<div class="table-responsive">
		<table class="table table-striped table-bordered col-6">
            <thead>
                <tr>
					<th style="width:50%">Status</th>
                    <th style="width:50%">Bilangan Penduduk</th>
                </tr>
            </thead>
            <tbody>
                <tr>
					<td>Ya</td>
                    <td>{!! $property['y'] !!}</td>
                </tr>
				<tr>
					<td>Tidak</td>
                    <td>{!! $property['n'] !!}</td>
                </tr>
            </tbody>
		</table>
    </div>	
	<h6 class="font-weight-bold">Jumlah Harta Tanah: {!! array_sum($property_type) !!}</h6>
	<div class="table-responsive">
		<table class="table table-striped table-bordered col-6">
            <thead>
                <tr>
					<th style="width:50%">Jenis Tanah</th>
                    <th style="width:50%">Bilangan Harta</th>
                </tr>
            </thead>
            <tbody>
                <tr>
					<td>NCR</td>
                    <td>{!! $property_type['ncr'] !!}</td>
                </tr>
				<tr>
					<td>Geran</td>
                    <td>{!! $property_type['geran'] !!}</td>
                </tr>
				<tr>
					<td>FL</td>
                    <td>{!! $property_type['fl'] !!}</td>
                </tr>
				<tr>
					<td>Mix Zone</td>
                    <td>{!! $property_type['mix'] !!}</td>
                </tr>
            </tbody>
		</table>
    </div>	
	
	<br />
	<h5 class="font-weight-bold">Kelahiran & Kematian</h5>
	<div class="table-responsive">
		<table class="table table-striped table-bordered col-8">
            <thead>
                <tr>
					<th style="width:30%">Bulan</th>
                    <th style="width:35%">Kelahiran (Bilangan Orang)</th>
					<th style="width:35%">Kematian (Bilangan Orang)</th>
                </tr>
            </thead>
            <tbody>
				@for($i=0;$i<12;$i++)
				<tr>
					<td>{!! $label[$i] !!}</td>
                    <td>{!! $count_newborn[$i] !!}</td>
					<td>{!! $count_death[$i] !!}</td>
                </tr>
				@endfor
				<tr class="font-weight-bold">
					<td>Jumlah</td>
                    <td>{!! $sum_newborn !!}</td>
					<td>{!! $sum_death !!}</td>
                </tr>
            </tbody>
		</table>
    </div>	
</div>
@endsection
