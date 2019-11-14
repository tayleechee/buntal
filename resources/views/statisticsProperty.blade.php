@extends('layouts.app')

@section('css')
<style type="text/css">
body {
	background-color: white !important;
}	
</style>
@endsection('css')

@section('content')
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function() {
var data = @json($data_propertyPossession);
var label = @json($label_propertyPossession);
var dps = [];
var chart1 = new CanvasJS.Chart("pieChartContainer", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: ""
	},
	data: [{
		type: "pie",
		startAngle: 50,
		toolTipContent: "<b>{label}</b>: {y} – #percent% ",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabelFormatter: function(e) {
		  if (e.dataPoint.y === 0 || e.dataPoint.y === null)
			return "";
		  else {
			var percent = e.percent.toFixed(2);
			return e.dataPoint.label + " - " + percent + "%";
		  }
		},
		dataPoints: dps
	}]
});
function parseDataPoints_1 () {
	for (var i = 0; i < data.length; i++)
	{	
		dps.push({"label":label[i], "y":data[i]});    
	} 
};

parseDataPoints_1();
chart1.options.data[0].dataPoints = dps;
chart1.render();

CanvasJS.addColorSet("greenShades",
[
	"#2f304f",	
	"#08aabf",
	"#2F4F4F",
	"#008080",
	"#2E8B57",
	"#3CB371",
	"#90EE90" 
]);

var data_2 = @json($data_land);
var label_2 = @json($label_land);
var dps_2 = [];
var chart2 = new CanvasJS.Chart("barGraphContainer", {
	colorSet: "greenShades",
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: ""
	},
	axisY: {
		title: "Bilangan Harta",
		includeZero: true
	},
	axisX: {
		title: "Jenis Tanah",	
		labelAngle: 0,		
        interval: 1
	},
	data: [{
		type: "column",
		toolTipContent: "<b>{label}</b>: {y}",
		indexLabelFontSize: 16,
		indexLabelFontColor: "#424885",
		indexLabelPlacement: "outside",
		indexLabelFormatter: function(e) {
		  if (e.dataPoint.y === 0 || e.dataPoint.y === null)
			return "";
		  else 
			return e.dataPoint.y + " buah";		  
		},
		dataPoints: dps_2
	}]
});
function parseDataPoints_2 () {
	for (var i = 0; i < data_2.length; i++)
	{	
		dps_2.push({"label":label_2[i], "y":data_2[i]});    
	} 
};

parseDataPoints_2();
chart2.options.data[0].dataPoints = dps_2;
chart2.render();
}
</script>
<div class="container">
	<h1 class="font-weight-bold text-center" style="margin-bottom:50px;">Pemilikan Harta Tanah</h1>
    <div class="row justify-content-center">	
		<h3 class="font-weight-bold">Jumlah Penduduk: {!! array_sum($data_propertyPossession) !!}</h3>
        <div id="pieChartContainer" style="height:370px;width:90%;margin:25px 0 100px;"></div>
		<h3 class="font-weight-bold">Jumlah Harta Tanah: {!! array_sum($data_land) !!}</h3>
        <div id="barGraphContainer" style="height:370px;width:90%;margin-top:25px;"></div>
    </div>
</div>
@endsection
