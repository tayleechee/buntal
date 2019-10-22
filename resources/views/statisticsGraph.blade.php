@extends('layouts.app')

@section('content')
<div class="container">

    @if (isset($chart))    
    <div class="row">
        <div class="col-12" >
          {!! $chart->container() !!}
        </div>
    </div>
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $chart->script() !!}
    @endif

</div>
@endsection
