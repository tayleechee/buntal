@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('statistics.populationByGender')}}" class="btn btn-primary">Population By Gender</a>
	
    <a href="{{route('statistics.populationByAgeRange')}}" class="btn btn-primary">Population By Age Range</a>
	
    <a href="{{route('statistics.populationByEducationLevel')}}" class="btn btn-primary">Population By Education Level</a>
	
    <a href="{{route('statistics.populationByMaritalStatus')}}" class="btn btn-primary">Population By Marital Status</a>
</div>
@endsection
