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
var data = @json($data);
var label = @json($label);
var dps = [];
var chart = new CanvasJS.Chart("chartContainer", {
	colorSet: "greenShades",
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: "{!! $graph_title !!}"
	},
	axisY: {
		title: "Bilangan Penduduk",
		includeZero: true
	},
	axisX: {
		title: "{!! $x_axis !!}",	
		labelAngle: 0,		
        interval: 1
	},
	data: [{
		type: "{!! $graph_type !!}",
		toolTipContent: "<b>{label}</b>: {y}",
		indexLabelFontSize: 16,
		indexLabelFontColor: "#424885",
		indexLabelPlacement: "outside",
		indexLabelFormatter: function(e) {
		  if (e.dataPoint.y === 0 || e.dataPoint.y === null)
			return "";
		  else 
			return e.dataPoint.y + " orang";		  
		},
		dataPoints: dps
	}]
});
function parseDataPoints () {
	for (var i = 0; i < data.length; i++)
	{	
		dps.push({"label":label[i], "y":data[i]});    
	} 
};

parseDataPoints();
chart.options.data[0].dataPoints = dps;
chart.render();
}
</script>
<div class="container">
    <div class="row d-flex justify-content-center">	
		<h3 class="font-weight-bold">{!! $total_of !!} : {!! $total !!}</h1>
        <div id="chartContainer" style="height:370px;width:90%;margin-top:25px;"></div>
    </div>
</div>
@endsection
