@extends('layouts.app')

@section('css')
<style type="text/css">
    .border-left-blue {
        border-left: .5rem solid #5C6BC0 !important;
    }

    .border-left-green {
        border-left: .5rem solid #1cc88a !important;
    }

    .dashboard-header-blue {
        font-size: 1.1rem;
        color: #5C6BC0;
    }

    .dashboard-header-green {
        font-size: 1.1rem;
        color: #1cc88a;
    }

    .box-shadow {
        box-shadow: 0 .15rem 1.75rem 0 rgba(58, 59, 69, .15) !important
    }

    .light-border {
        border: 1px solid white;
        border-radius: .35rem;
    }

    .grey-icon {
        color: grey;
    }
</style>
@endsection

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

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-left-blue box-shadow light-border">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold dashboard-header-blue">Jumlah Penduduk</div>
                            <div class="col mr-2 px-0" style="font-size: 1.75rem">{{$villagerCount}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-4x grey-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-left-green box-shadow light-border">
                <div class="card-body ">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold dashboard-header-green">Jumlah Rumah</div>
                            <div class="col mr-2 px-0" style="font-size: 1.75rem">{{$houseCount}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-home fa-4x grey-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if ( isset($maritalChart) && isset($genderChart) && isset($propertyOwnerChart) )
    <div class="container">
        <div class="card" style="padding: 1em; margin-top: -1em; margin-bottom: 1em;">
            <div class="row">
                <div class="col-4">
                    {!! $activeChart->container() !!}
                </div>
                <div class="col-4">
                    {!! $genderChart->container() !!}
                </div>
                <div class="col-4">
                    {!! $propertyOwnerChart->container() !!}
                </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
            {!! $activeChart->script() !!}
            {!! $genderChart->script() !!}
            {!! $propertyOwnerChart->script() !!}
            @endif

        </div>
    </div>
@endsection
