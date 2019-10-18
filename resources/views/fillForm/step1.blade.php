@extends('layouts.app')

@section('content')
<div class="text-center">
	<h2>Step 1</h2>
</div>

<div class="container mt-5">
	<form action="{{ action('FillFormController@processStep1') }}" method="POST">
		{{ csrf_field() }}
		<div class="form-group row">
			<label for="step1_address" class="col-form-label font-weight-bold">Address</label>
			<input name="step1_address" id="step1_address" class="form-control @error('step1_address') is-invalid @enderror" value="{{ old('step1_address') }}" required>

			@error('step1_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
		</div>

		<div class="form-group row">
			<label for="step1_householdIncome" class="col-sm-2 col-form-label font-weight-bold pl-0">Household Income (RM)</label>
			<div class="col pr-0 pl-0">
				<input type="number" name="step1_householdIncome" id="step1_householdIncome" class="form-control @error('step1_householdIncome') is-invalid @enderror" value="{{ old('step1_householdIncome') }}" required>

				@error('step1_householdIncome')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
        	</div>
		</div>

		<div class="form-group row">
			<label for="step1_numberOfFamily" class="col-sm-2 col-form-label font-weight-bold pl-0">Number of Family</label>
			<div class="col pr-0 pl-0">
				<input type="number" name="step1_numberOfFamily" id="step1_numberOfFamily" class="form-control @error('step1_numberOfFamily') is-invalid @enderror" value="{{ old('step1_numberOfFamily') }}" required>

				@error('step1_numberOfFamily')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
        	</div>
		</div>

		<div class="form-group row">
			<label for="step1_numberOfFamilyMember" class="col-sm-2 col-form-label font-weight-bold pl-0">Number of Family member</label>
			<div class="col pr-0 pl-0">
				<input type="number" name="step1_numberOfFamilyMember" id="step1_numberOfFamilyMember" class="form-control @error('step1_numberOfFamilyMember') is-invalid @enderror" value="{{ old('step1_numberOfFamilyMember') }}" required>

				@error('step1_numberOfFamilyMember')
	                <span class="invalid-feedback" role="alert">
	                    <strong>{{ $message }}</strong>
	                </span>
	            @enderror
        	</div>
		</div>

		<div class="text-center mt-5">
			<button type="submit" class="btn btn-primary">Next</button>
		</div>
	</form>
</div>

@endsection('content')