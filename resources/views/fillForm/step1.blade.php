@extends('layouts.app')

@section('content')
<!-- Styles -->
<style>
	.card {
		margin-left: 5%;
		margin-right: 5%;
		padding: 1em;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	}
	.step1 {
		margin-left: 1%;
	}
</style>

<div class="text-center">
	<h2>Langkah 1</h2>
</div>
<div class="card">
	<div class="container">
		<form action="{{ action('FillFormController@processStep1') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group row">
				<label for="step1_address" class="col-form-label font-weight-bold">Alamat Rumah</label>
				<input name="step1_address" id="step1_address" class="form-control @error('step1_address') is-invalid @enderror" value="{{ old('step1_address') }}" required>

				@error('step1_address')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="form-row">
				<div class="form-group row">
					<label for="step1_householdIncome" class="step1 col-sm-12 col-form-label font-weight-bold pl-0">Pendapatan Isi Rumah Bulanan RM)</label>
					<input type="number" name="step1_householdIncome" id="step1_householdIncome" class="step1 col-sm-8 form-control @error('step1_householdIncome') is-invalid @enderror" value="{{ old('step1_householdIncome') }}" required>

					@error('step1_householdIncome')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

				<div class="form-group row">
					<label for="step1_numberOfFamily" class="step1 col-sm-12 col-form-label font-weight-bold pl-0">Bilangan Keluarga</label>
					<div class="col pr-0 pl-0">
						<input type="number" name="step1_numberOfFamily" id="step1_numberOfFamily" class="step1 col-sm-8 form-control @error('step1_numberOfFamily') is-invalid @enderror" style="margin-right:-2em" value="{{ old('step1_numberOfFamily') }}" required>

						@error('step1_numberOfFamily')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="step1_numberOfFamilyMember" class="step1 col-sm-12 col-form-label font-weight-bold pl-0">Bilangan Ahli Keluarga</label>
					<div class="col pr-0 pl-0">
						<input type="number" name="step1_numberOfFamilyMember" id="step1_numberOfFamilyMember" class="step1 col-sm-8 form-control @error('step1_numberOfFamilyMember') is-invalid @enderror" value="{{ old('step1_numberOfFamilyMember') }}" required>

						@error('step1_numberOfFamilyMember')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
			</div>
			<div class="text-center float-sm-right">
				<button type="submit" class="btn btn-primary">Seterusnya</button>
			</div>
		</form>
	</div>
</div>
@endsection('content')
