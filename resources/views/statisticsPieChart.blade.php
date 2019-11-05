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
var data = @json($data);
var label = @json($label);
var dps = [];
var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: "{!! $graph_title !!}"
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
