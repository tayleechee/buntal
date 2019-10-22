@extends('layouts.app')

@section('content')
<script type="text/javascript">
	$(document).ready(function () {
		$("#birthRateByYearBtn").click(function () {
			$("#population").hide();		
			$("#income").hide();
			$("#deathRate").hide();
			$(this).parent().hide();
			$("#birthRateByYear").show();
		});
		$("#birthRateByRangeOfYearsBtn").click(function () {
			$("#population").hide();		
			$("#income").hide();			
			$("#deathRate").hide();
			$(this).parent().hide();
			$("#birthRateByRangeOfYears").show();
		});
		$("#deathRateByYearBtn").click(function () {
			$("#population").hide();		
			$("#income").hide();			
			$("#birthRate").hide();
			$(this).parent().hide();
			$("#deathRateByYear").show();
		});
		$("#deathRateByRangeOfYearsBtn").click(function () {
			$("#population").hide();		
			$("#income").hide();
			$("#birthRate").hide();
			$(this).parent().hide();
			$("#deathRateByRangeOfYears").show();
		});
		$(".cancelBtn").click(function (e) {
			e.preventDefault();
			$("#population").show();		
			$("#income").show();	
			$(this).parent().parent().parent().next().show();	
			$(this).parent().parent().parent().prev().show();				
			$(this).parent().parent().siblings(':first-child').show();
			$(this).parent().parent().hide();
		});
	});
</script>

<div class="container">
	<div class="mt-3">
		<h5>View Village Statistics</h5><br>
	</div>
	<div id="population">
		Population <br>
		<a href="{{route('statistics.populationByGender')}}" class="btn btn-primary">By Gender</a>
		
		<a href="{{route('statistics.populationByAgeRange')}}" class="btn btn-primary">By Age Range</a>
		
		<a href="{{route('statistics.populationByEducationLevel')}}" class="btn btn-primary">By Education Level</a>
		
		<a href="{{route('statistics.populationByMaritalStatus')}}" class="btn btn-primary">By Marital Status</a>
		<br><br>
	</div>

    <div id="income">
		Monthly Household Income <br>		
		<a href="{{route('statistics.monthlyHouseholdIncome')}}" class="btn btn-primary">Monthly Household Income</a>		
		<br><br>
	</div>
	
	<div id="birthRate">
		<div>
			Birth Rate <br>		
			<button id="birthRateByYearBtn" class="btn btn-primary">By Year</button>		
			<button id="birthRateByRangeOfYearsBtn" class="btn btn-primary">By Range of Years</button>
		</div>
		<div id="birthRateByYear" style="display:none;">	
			Birth Rate <br>	View by Year <br>
			<form method="POST" action="{{url('/statistics/birthRateByYear')}}">
				@csrf 
				<div style="margin:10px 0 20px;">
					Select Year:
					<input name="year" class="form-control col-1" style="display:inline;margin:0 20px;" required />		
				</div>
				<input type="submit" class="btn btn-primary" value="Submit" />			
				<button class="btn btn-secondary cancelBtn">Cancel</button>
			</form>
		</div>	
		<div id="birthRateByRangeOfYears" style="display:none;">	
			Birth Rate <br>	View by Range of Years <br>
			<form method="POST" action="{{url('/statistics/birthRateByRangeOfYears')}}">
				@csrf 
				<div style="margin:10px 0 20px;">
					From
					<input name="startYear" class="form-control col-1" style="display:inline;margin:0 20px;" />		
					To
					<input name="endYear" class="form-control col-1" style="display:inline;margin-left:20px;" />
				</div>
				<input type="submit" class="btn btn-primary" value="Submit" />			
				<button class="btn btn-secondary cancelBtn">Cancel</button>
			</form>
		</div>
		<br>		
	</div>	
	<div id="deathRate">
		<div>
			Death Rate <br>		
			<button id="deathRateByYearBtn" class="btn btn-primary">By Year</button>		
			<button id="deathRateByRangeOfYearsBtn" class="btn btn-primary">By Range of Years</button>
		</div>
		<div id="deathRateByYear" style="display:none;">	
			Death Rate <br>	View by Year <br>
			<form method="POST" action="{{url('/statistics/deathRateByYear')}}">
				@csrf 
				<div style="margin:10px 0 20px;">
					Select Year:
					<input name="year" class="form-control col-1" style="display:inline;margin:0 20px;" required />		
				</div>
				<input type="submit" class="btn btn-primary" value="Submit" />			
				<button class="btn btn-secondary cancelBtn">Cancel</button>
			</form>
		</div>	
		<div id="deathRateByRangeOfYears" style="display:none;">	
			Death Rate <br>	View by Range of Years <br>
			<form method="POST" action="{{url('/statistics/deathRateByRangeOfYears')}}">
				@csrf 
				<div style="margin:10px 0 20px;">
					From
					<input name="startYear" class="form-control col-1" style="display:inline;margin:0 20px;" />		
					To
					<input name="endYear" class="form-control col-1" style="display:inline;margin-left:20px;" />
				</div>
				<input type="submit" class="btn btn-primary" value="Submit" />			
				<button class="btn btn-secondary cancelBtn">Cancel</button>
			</form>
		</div>	
	</div>		
</div>
@endsection
