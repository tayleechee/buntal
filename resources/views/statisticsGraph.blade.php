@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script>
	$(document).ready(function () {			
		$('#img-btn').click(function () {
			var canvas = $(".chartjs-render-monitor").get(0);
			var dataURL = canvas.toDataURL('image/png', 1.0);
			console.log(dataURL);

			$("#img-btn").attr("href", dataURL);
		});	
		$('#pdf-btn').click(function () {
			var canvas = $(".chartjs-render-monitor").get(0);
			
			//creates image
			var canvasImg = canvas.toDataURL("image/png", 1.0);
		  
			//creates PDF from img
			var doc = new jsPDF('landscape');
		    doc.setFontSize(20);
		    doc.text(15, 15, "{{ $graph_title }}");
		    doc.addImage(canvasImg, 'JPEG', 0, 40, 300, 120 );
		    doc.save('{{ $graph_title }}.pdf');	
		});	
	});
</script>
<div class="container">

    @if (isset($chart))    
    <div class="row">
        <div id ="graph" class="col-12" >
          {!! $chart->container() !!}
        </div>
    </div>
	<div class="text-center" style="margin-top:25px;">
		<a href="#" id="img-btn" class="btn btn-primary" download="{{ $graph_title }}.jpg" target="_blank" style="margin-right:20px;">Save as Image</a>
		<button id="pdf-btn" class="btn btn-primary">Save as PDF</button>
	</div>
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $chart->script() !!}
    @endif

</div>
@endsection
