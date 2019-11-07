@extends('layouts.app')

@section('css')
<style type="text/css">
	fieldset.scheduler-border {
	    border: 1px solid #ddd !important;
	    padding: 0 1.4em 1.4em 1.4em !important;
	    margin: 0 0 1.5em 0 !important;
	    -webkit-box-shadow:  0px 0px 0px 0px #000;
	            box-shadow:  0px 0px 0px 0px #000;
	}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }

	.scheduler-border{
		background-color: #fff;
		border-radius:5px;
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
	}

    .form-input-div, .form-nonhidden-input-div {
    	border: 1px solid #ced4da;
    	background: #F7F7FB ;
    	padding: .375rem 0.75rem;
    	margin-left: 1rem;
    	margin-right: 1rem;
    }

    .padding-top-calc {
    	padding-top: calc(.375rem + 1px);
    }

    .ketuaRumah_title {
    	color: blue;
    }
</style>
@endsection

@section('content')

<div class="container">
	<div class="mt-5 family_member_form_div">
		<div class="text-right">
		@if ( isset($villager) && empty($villager->death_date) )
		<button type="button" class="btn btn-sm btn-dark mr-1 deadBtn" id="markDeadBtn" data-toggle="modal" data-target="#markDeadModal">Mark Dead</button>
		@else
		<button type="button" class="btn btn-sm btn-success mr-1 deadBtn" id="markLiveBtn" data-toggle="modal" data-target="#markLiveModal">Mark Alive</button>
		@endif
		<button type="button" class="btn btn-sm btn-primary mr-1" id="editBtn">Edit</button>
		<button type="button" class="btn btn-sm btn-success d-none mr-1" id="saveBtn">Save</button>
		<button type="button" class="btn btn-sm btn-secondary mr-1 d-none" id="cancelBtn">Cancel</button>
		<button type="button" class="btn btn-sm btn-danger" id="deleteBtn" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
		</div>
		<form id="villagerDetail_form" name="villagerDetail_form">
			{{ csrf_field() }}
		<input type="hidden" name="villager_id" id="villager_id" value="<?php echo isset($villager->id) ? $villager->id : '' ?>">
		<fieldset class="scheduler-border">
			@if ( isset($villager) && ($villager->poc))
			<legend class="family_member_legend scheduler-border">Villager Detail<span class="ketuaRumah_title"> (Ketua Rumah)</span></legend>
			@else
			<legend class="family_member_legend scheduler-border">Villager Detail</legend>
			@endif

			@if ( isset($villager) && !empty($villager->death_date) )
			<div class="form-group row pl-2 mt-3">
				<label for="occupation" class="col-form-label col-2 form_occupation_label font-weight-bold">Death Date</label>
				<div class="col form-nonhidden-input-div font-weight-bold">
					{{ $villager->death_date }}
				</div>
			</div>
			@endif

			<div class="form-group row pl-2 mt-3">
				<label for="name" class="col-form-label col-2 form_name_label">Name</label>
				<div class="col form-input-col d-none">
					<input type="text" name="name" id="name" class="form-control form_name" value="<?php echo isset($villager->name) ? $villager->name : ''  ?>" required>
				</div>
				<div class="col form-input-div text-left col-form-label">
					<?php echo isset($villager->name) ? $villager->name : ''  ?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="ic" class="col-form-label col-2 form_ic_label">IC</label>
				<div class="col form-input-col d-none">
					<input type="text" name="ic" id="ic" class="form-control form_ic" value="<?php echo isset($villager->ic) ? $villager->ic : ''  ?>" required>
				</div>
				<div class="col form-input-div text-left col-form-label">
					<?php echo isset($villager->ic) ? $villager->ic : ''  ?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				@if ( isset($villager->poc) )
				<label for="ic" class="col-form-label col-2 form_ic_label">Phone</label>
				<div class="col form-input-col d-none">
					<input type="text" name="phone" id="phone" class="form-control form_phone" value="<?php echo isset($villager->phone) ? $villager->phone : ''  ?>" required>
				</div>
				@else
				<label for="ic" class="col-form-label col-2 form_ic_label">Phone (Optional)</label>
				<div class="col form-input-col d-none">
					<input type="text" name="phone" id="phone" class="form-control form_phone" value="<?php echo isset($villager->phone) ? $villager->phone : ''  ?>">
				</div>
				@endif
				
				<div class="col form-input-div text-left col-form-label">
					<?php echo isset($villager->phone) ? $villager->phone : ''  ?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="gender" class="col-form-label col-2 form_gender_label">Gender</label>
				<div class="col form-input-col d-none">
					<select name="gender" id="gender" class="form-control form_gender" required>
						@if (isset($villager->gender) && ($villager->gender == 'm'))
						<option value="male" selected>Male</option>
						@else
						<option value="male">Male</option>
						@endif

						@if (isset($villager->gender) && ($villager->gender == 'f'))
						<option value="female" selected>Female</option>
						@else
						<option value="female">Female</option>
						@endif
					</select>
				</div>
				<div class="col form-input-div text-left col-form-label">
					<?php 
						if (isset($villager->gender))
						{
							if ($villager->gender == 'm') {
								echo 'Male';
							}
							else if ($villager->gender == 'f') {
								echo 'Female';
							}
						}
					?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="dob" class="col-form-label col-2 form_dob_label">Date of Birth</label>
				<div class="col form-input-col d-none">
					<input type="date" name="dob" id="dob" class="form-control form_dob" value="<?php echo isset($villager->dob) ? $villager->dob : ''  ?>" required>
				</div>
				<div class="col form-input-div text-left col-form-label">
					<?php
						if (isset($villager->dob)) {
							$dob = date_format(date_create_from_format('Y-m-d', $villager->dob), 'd/m/Y');
							echo $dob;
						}
					?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="race" class="col-form-label col-2 form_race_label">Race</label>
				<div class="col form-input-col d-none">
					<!-- <select name="race" id="race" class="form-control form_race" required>
						<option value="malay">Malay</option>
						<option value="cina">Cina</option>
						<option value="india">India</option>
						<option value="bumiputera">Bumiputera</option>
						<option value="other">Lain-lain</option>
					</select> -->
					{!! Form::select('race', ['malay' => 'Malay', 'cina' => 'Cina', 'india' =>  'India', 'bumiputera' => 'Bumiputera', 'other' => 'Lain-lain'], isset($villager->race) ? $villager->race : null, ['class'=>'form-control form_race', 'id'=>'race', 'required']) !!}
				</div>
				<div class="col form-input-div text-left col-form-label">
					<?php echo isset($villager->race) ? ucfirst($villager->race) : ''  ?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="marital" class="col-form-label col-2 form_marital_label">Marital Status</label>
				<div class="col form-input-col d-none">
					{!! Form::select('marital', ['bujang'=>'Bujang', 'kahwin'=>'Kahwin', 'duda'=>'Duda', 'janda'=>'Janda'], isset($villager->marital_status) ? $villager->marital_status : null, ['class'=>'form-control form_marital', 'id'=>'marital', 'required']) !!}
				</div>
				<div class="col form-input-div text-left col-form-label">
					<?php 
						if (isset($villager->marital_status))
						{
							echo ucfirst($villager->marital_status);
						}
					?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="education" class="col-form-label col-2 form_education_label">Education Level</label>
				<div class="col form-input-col d-none">
					{!! Form::select('education', ['Non-educated'=>'Non-educated', 'Primary School'=>'Primary School', 'Secondary School'=>'Secondary School', 'Form 6'=>'Form 6', 'Diploma'=>'Diploma', 'Degree'=>'Degree', 'Master'=>'Master', 'PhD'=>'PhD', 'N/A'=>'N/A'], isset($villager->education_level) ? $villager->education_level : null, ['class'=>'form-control form_education', 'id'=>'education', 'required']) !!}
				</div>
				<div class="col form-input-div">
					<?php echo isset($villager->education_level) ? $villager->education_level : ''  ?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="occupation" class="col-form-label col-2 form_occupation_label">Occupation</label>
				<div class="col form-input-col d-none">
					<input type="text" name="occupation" id="occupation" class="form-control form_occupation" value="<?php echo isset($villager->occupation) ? $villager->occupation : ''  ?>">
				</div>
				<div class="col form-input-div">
					<?php echo isset($villager->occupation) ? ucfirst($villager->occupation) : ''  ?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label class="pl-3 padding-top-calc form-radio-label">Adakah anda bermaustatin tetap di alamat ini?</label>
				<div class="ml-3">
					<div class="custom-control custom-radio custom-control-inline d-none">
						@if (isset($villager->is_active) && ($villager->is_active == '1'))
						<input type="radio" id="active_yes" name="active" class="custom-control-input active_yes" value="1" checked required>
						@else
						<input type="radio" id="active_yes" name="active" class="custom-control-input active_yes" value="1" required>
						@endif

						<label class="custom-control-label active_yes_label" for="active_yes">Yes</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline d-none">
						@if (isset($villager->is_active) && ($villager->is_active == '0'))
						<input type="radio" id="active_no" name="active" class="custom-control-input active_no" checked value="0">
						@else
						<input type="radio" id="active_no" name="active" class="custom-control-input active_no" value="0">
						@endif
						
						<label class="custom-control-label active_no_label" for="active_no">No</label>
					</div>
					<div class="col form-input-div">
						<?php 
							if (isset($villager->is_active))
							{
								if ($villager->is_active == '1') {
									echo 'Yes';
								}
								else {
									echo 'No';
								}
							}
						?>
					</div>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label class="pl-3 form-radio-label padding-top-calc">Adakah anda mempunyai tanah yang bergeran?</label>
				<div class="ml-3">
					<div class="custom-control custom-radio custom-control-inline d-none">
						@if (isset($villager->is_property_owner) && ($villager->is_property_owner == '1'))
						<input type="radio" id="propertyOwner_yes" name="propertyOwner" class="custom-control-input propertyOwner_yes" value="1" checked required>
						@else
						<input type="radio" id="propertyOwner_yes" name="propertyOwner" class="custom-control-input propertyOwner_yes" value="1" required>
						@endif

						<label class="custom-control-label propertyOwner_yes_label" for="propertyOwner_yes">Yes</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline d-none">
						@if (isset($villager->is_property_owner) && ($villager->is_property_owner == '0'))
						<input type="radio" id="propertyOwner_no" name="propertyOwner" class="custom-control-input propertyOwner_no" checked value="0">
						@else
						<input type="radio" id="propertyOwner_no" name="propertyOwner" class="custom-control-input propertyOwner_no" value="0">
						@endif

						<label class="custom-control-label propertyOwner_no_label" for="propertyOwner_no">No</label>
					</div>
					<div class="col form-input-div">
						<?php 
							if (isset($villager->is_property_owner))
							{
								if ($villager->is_property_owner == '1') {
									echo 'Yes';
								}
								else {
									echo 'No';
								}
							}
						?>
					</div>
				</div>
			</div>

		</fieldset>
		</form>
	</div>

</div>

<!-- Mark Dead Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="markDeadModal">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		  	<div class="modal-header">
		        <h5 class="modal-title font-weight-bold">Mark Dead</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		    	</button>
		  	</div>
		  	<div class="modal-body">
		    	<form id="markDeadForm">
		    		<label for="mark_death_date" class="font-weight-bold">Death Date:</label>
		    		<input type="date" name="mark_death_date" id="mark_death_date" class="form-control" required>
		    	</form>
		  	</div>
		  	<div class="modal-footer">
		        <button type="button" class="btn btn-success" id="confirmMarkDeadBtn">Confirm</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		  	</div>
	    </div>
	</div>
</div>

<!-- Mark Live Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="markLiveModal">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		  	<div class="modal-header">
		        <h5 class="modal-title font-weight-bold">Mark Alive</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		    	</button>
		  	</div>
		  	<div class="modal-body">
		    	<p class="font-weight-bold">Confirm to Mark Alive?</p>
		  	</div>
		  	<div class="modal-footer">
		        <button type="button" class="btn btn-success" id="confirmMarkLiveBtn">Confirm</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		  	</div>
	    </div>
	</div>
</div>

<!-- Confirm Delete Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="confirmDeleteModal">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		  	<div class="modal-header">
		        <h5 class="modal-title font-weight-bold">Confirm Delete?</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		    	</button>
		  	</div>
		  	<div class="modal-body">
		    	<p class="font-weight-bold">Confirm to Delete? This cannot be undone.</p>
		  	</div>
		  	<div class="modal-footer">
		        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Confirm</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		  	</div>
	    </div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		var form = document.getElementById("villagerDetail_form");
		$(form).find(".form-control").addClass("d-none");
		$(form).find(".form-input-col").addClass("d-none");
		$(form).find(".custom-control").addClass("d-none");
	});

	$(document).on("click", "#editBtn", function() {
		var form = document.getElementById("villagerDetail_form");
		$(form).find(".form-control").removeClass("d-none");
		$(form).find(".form-input-col").removeClass("d-none");
		$(form).find(".custom-control").removeClass("d-none");

		$(form).find(".form-input-div").addClass("d-none");
		$(form).find(".form-radio-label").removeClass("padding-top-calc");

		$(".deadBtn").addClass("d-none");
		$("#deleteBtn").addClass("d-none");
		$("#editBtn").addClass("d-none");
		$("#cancelBtn").removeClass("d-none");
		$("#saveBtn").removeClass("d-none");
	});

	function ucfirst(string) {
	    return string.charAt(0).toUpperCase() + string.slice(1);
	}

	$(document).on("click", "#cancelBtn", function() {
		var confirm = window.confirm("Confirm to cancel? Changes will be discarded.");

		if (!confirm)
			return;

		var villager_id = document.getElementById("villager_id").getAttribute("value");
		$.ajax({
			type: "GET",
			url: '/getVillagerDetail',
			data: {
				id: villager_id,
			},
			beforeSend: function() {
				$("#loadingModal").modal('show');
			},
			complete: function() {
				$("#loadingModal").modal('hide');
			},
			success: function(data) {
				console.log(data);
				if (typeof data.name !== 'undefined') {
					$("#name").val(data.name);
				}
				if (typeof data.ic !== 'undefined') {
					$("#ic").val(data.ic);
				}
				if (typeof data.phone !== 'undefined') {
					$("#phone").val(data.phone);
				}
				if (typeof data.gender !== 'undefined') {
					if (data.gender == 'm') {
						$("#gender").val('male');
					}
					else if (data.gender == 'f') {
						$("#gender").val('female');
					}
				}
				if (typeof data.dob !== 'undefined') {
					$("#dob").val(data.dob);
				}
				if (typeof data.race !== 'undefined') {
					$("#race").val(data.race);
				}
				if (typeof data.marital_status !== 'undefined') {
					$("#marital").val(data.marital_status);
				}
				if (typeof data.education_level !== 'undefined') {
					$("#education").val(data.education_level);
				}
				if (typeof data.occupation !== 'undefined') {
					$("#occupation").val(data.occupation);
				}
				if (typeof data.is_active !== 'undefined') {
					if (data.is_active == 1) {
						$("input[name='active'][value='1']")[0].checked = true;
					}
					else if (data.is_active == 0) {
						$("input[name='active'][value='0']")[0].checked = true;
					}
				}
				if (typeof data.is_property_owner !== 'undefined') {
					if (data.is_property_owner == 1) {
						$("input[name='propertyOwner'][value='1']")[0].checked = true;
					}
					else if (data.is_property_owner == 0) {
						$("input[name='propertyOwner'][value='0']")[0].checked = true;
					}
				}


				var form = document.getElementById("villagerDetail_form");
				$(form).find(".form-control").addClass("d-none");
				$(form).find(".form-input-col").addClass("d-none");
				$(form).find(".custom-control").addClass("d-none");

				$(form).find(".form-input-div").removeClass("d-none");
				$(form).find(".form-radio-label").addClass("padding-top-calc");

				$(".deadBtn").removeClass("d-none");
				$("#deleteBtn").removeClass("d-none");
				$("#editBtn").removeClass("d-none");
				$("#cancelBtn").addClass("d-none");
				$("#saveBtn").addClass("d-none");
			},
			error: function (jqXHR, exception) {
		        showAjaxErrorMessage(jqXHR, exception, "Failed to retrieve record. Please refresh:<br>");
		    }
		});
	});

	$(document).on("click", "#saveBtn", function(){
		var confirm = window.confirm("Are you sure to save the changes?");

		if (!confirm)
			return;

		var form = document.getElementById("villagerDetail_form");

		if (!form.checkValidity())
		{
			form.reportValidity();
			return;
		}

		$.ajax({
			type: "POST",
			url: "/setVillagerDetail",
			data: $("#villagerDetail_form").serialize(),
			beforeSend: function() {
				$("#loading_div").attr("data-text", "Saving Changes...");
				$("#loading_div").addClass("is-active");
			},
			success: function(data) {
				location.reload();
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Unable to save changes:<br>");
		    }
		});
	});

	$(document).on("click", "#confirmMarkLiveBtn", function(){
		var _token = $('input[name="_token"]').val();
		var id = $("#villager_id").val();

		$.ajax({
			type: "POST",
			url: "/markLive",
			data: {
				id: id,
				_token: _token
			},
			beforeSend: function() {
				$("#markLiveModal").modal('hide');
				$("#loading_div").attr("data-text", "Marking as Alive...");
				$("#loading_div").addClass("is-active");
			},
			success: function(data) {
				location.reload();
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Unable to mark alive:<br>");
		    }
		});
	});

	$(document).on("click", "#confirmMarkDeadBtn", function(){
		var form = document.getElementById("markDeadForm");

		if (!form.checkValidity())
		{
			form.reportValidity();
			return;
		}

		var _token = $('input[name="_token"]').val();
		var id = $("#villager_id").val();
		var deathDate = $("#mark_death_date").val();

		$.ajax({
			type: "POST",
			url: "/markDead",
			data: {
				id: id,
				deathDate: deathDate,
				_token: _token
			},
			beforeSend: function() {
				$("#markDeadModal").modal('hide');
				$("#loading_div").attr("data-text", "Marking as Dead...");
				$("#loading_div").addClass("is-active");
			},
			success: function(data) {
				location.reload();
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Unable to mark dead:<br>");
		    }
		});
	});

	$(document).on("click", "#confirmDeleteBtn", function(){
		var _token = $('input[name="_token"]').val();
		var id = $("#villager_id").val();

		$.ajax({
			type: "POST",
			url: "/deleteVillager",
			data: {
				id: id,
				_token: _token
			},
			beforeSend: function() {
				$("#confirmDeleteModal").modal('hide');
				$("#loading_div").attr("data-text", "Deleting Villager Record...");
				$("#loading_div").addClass("is-active");
			},
			success: function(data) {
				location.href = '/villagerRecords';
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Unable to delete villager record:<br>");
		    }
		});
	});
</script>
@endsection