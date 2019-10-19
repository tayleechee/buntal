@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div> -->
    @if ( isset($chart) && isset($chart2) && isset($chart3) )    
    <div class="row">
        <div class="col-4" >
          {!! $chart->container() !!}

        </div>
        <div class="col-4" >
          {!! $chart2->container() !!}
        </div>
        <div class="col-4">
          {!! $chart3->container() !!}
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $chart->script() !!}
    {!! $chart2->script() !!}
    {!! $chart3->script() !!}
    @endif

</div>
@endsection
