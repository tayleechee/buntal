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

	.step1 {
		margin-left: -0.6em;
	}

	.label1 {
		margin-left: 0.4em;
	}

	.ketuaRumah_title {
		color: blue;
	}

	.photo_input_preview {
		max-width: auto;
		height: 350px;
		padding: 5px;
		border: 1px solid #a9c4df;
	}
</style>
@endsection

@section('content')

@if( empty($step1_address) || empty($step1_householdIncome) || empty($step1_numberOfFamily) || empty($step1_numberOfFamilyMember) )
	<script>window.location.href = "{{url('fillForm/step1')}}";</script>
@endif

@isset($step1_numberOfFamilyMember)
	<script type="text/javascript">
		var step1_numberOfFamilyMember = {{ $step1_numberOfFamilyMember }};
	</script>
@endif

<div class="text-center">
	<h2>Langkah 2</h2>
</div>

<div class="container">
	<form id="step2_form">
		{{ csrf_field() }}
		<div class="form-group row">
			<label for="step2_address" class="col-form-label font-weight-bold">Alamat Rumah</label>
			<input type="text" id="step2_address" name="step2_address" value="<?php echo isset($step1_address) ? $step1_address : ''  ?>" class="form-control" readonly>
		</div>
<div class="form-row">
		<div class="form-group row">
			<label for="step2_householdIncome" class="label1 col-form-label col-sm-12 pl-0 font-weight-bold">Pendapatan Isi Rumah (RM)</label>
			<div class="col pr-0">
				<input type="text" id="step2_householdIncome" name="step2_householdIncome" value="<?php echo isset($step1_householdIncome) ? $step1_householdIncome : ''  ?>" class="step1 col-sm-8 form-control" readonly>
			</div>
		</div>

		<div class="form-group row">
			<label for="step2_numberOfFamily" class="label1 col-form-label col-sm-12 pl-0 font-weight-bold">Bilangan Keluarga</label>
			<div class="col pr-0">
				<input type="text" id="step2_numberOfFamily" name="step2_numberOfFamily" value="<?php echo isset($step1_numberOfFamily) ? $step1_numberOfFamily : ''  ?>" class="step1 col-sm-8 form-control" readonly>
			</div>
		</div>

		<div class="form-group row">
			<label for="step2_numberOfFamilyMember" class="label1 col-form-label col-sm-12 pl-0 font-weight-bold">Bilangan Ahli Keluarga</label>
			<div class="col pr-0">
				<input type="text" id="step2_numberOfFamilyMember" name="step2_numberOfFamilyMember" value="<?php echo isset($step1_numberOfFamilyMember) ? $step1_numberOfFamilyMember : ''  ?>" class="step1 col-sm-8 form-control" readonly>
			</div>
		</div>
</div>

		<div id="step2_member_forms_area">
		</div>

		<div class="text-center">
			<button type="button" id="add_member_btn" class="btn btn-success" data-toggle="tooltip" title="Tambah Ahli Keluarga"><i class="fas fa-plus-circle"></i></button>
		</div>

		<div class="text-center mt-4">
			<button type="submit" id="submit_form_btn" class="btn btn-primary">Hantar</button>
		</div>
	</form>
</div>

<script type="text/javascript">
	var mem_num = 0;

	function addMember() {
		var mem_num_plus = mem_num+1;

		var template = document.querySelector("#family_member_form_template");
   		var clone = document.importNode(template.content, true);

   		clone.querySelector(".family_member_form_div").setAttribute("id", "family_member_form_div_"+mem_num_plus);
   		clone.querySelector(".legend_count").innerText = mem_num_plus;
   		
   		if (mem_num_plus == 1)
   		{
   			clone.querySelector(".ketuaRumah_title").innerText = " (Ketua Rumah)";
   			clone.querySelector(".deleteMemberBtn").style.display = "none";
   			clone.querySelector(".form_phone_label").innerText = "Telefon";
   		}

   		var form_name_label = clone.querySelector(".form_name_label");
   		form_name_label.setAttribute("for", "member["+mem_num_plus+"][name]");
   		var form_name = clone.querySelector(".form_name");
   		form_name.setAttribute("id", "member["+mem_num_plus+"][name]");
   		form_name.setAttribute("name", "member["+mem_num_plus+"][name]");

   		var form_ic_label = clone.querySelector(".form_ic_label");
   		form_ic_label.setAttribute("for", "member["+mem_num_plus+"][ic]");
   		var form_ic = clone.querySelector(".form_ic");
   		form_ic.setAttribute("id", "member["+mem_num_plus+"][ic]");
   		form_ic.setAttribute("name", "member["+mem_num_plus+"][ic]");

   		var form_phone_label = clone.querySelector(".form_phone_label");
   		form_phone_label.setAttribute("for", "member["+mem_num_plus+"][phone]");
   		var form_phone = clone.querySelector(".form_phone");
   		form_phone.setAttribute("id", "member["+mem_num_plus+"][phone]");
   		form_phone.setAttribute("name", "member["+mem_num_plus+"][phone]");

   		var form_gender_label = clone.querySelector(".form_gender_label");
   		form_gender_label.setAttribute("for", "member["+mem_num_plus+"][gender]");
   		var form_gender = clone.querySelector(".form_gender");
   		form_gender.setAttribute("id", "member["+mem_num_plus+"][gender]");
   		form_gender.setAttribute("name", "member["+mem_num_plus+"][gender]");

   		var form_dob_label = clone.querySelector(".form_dob_label");
   		form_dob_label.setAttribute("for", "member["+mem_num_plus+"][dob]");
   		var form_dob = clone.querySelector(".form_dob");
   		form_dob.setAttribute("id", "member["+mem_num_plus+"][dob]");
   		form_dob.setAttribute("name", "member["+mem_num_plus+"][dob]");

   		var form_race_label = clone.querySelector(".form_race_label");
   		form_race_label.setAttribute("for", "member["+mem_num_plus+"][race]");
   		var form_race = clone.querySelector(".form_race");
   		form_race.setAttribute("id", "member["+mem_num_plus+"][race]");
   		form_race.setAttribute("name", "member["+mem_num_plus+"][race]");

   		var form_marital_label = clone.querySelector(".form_marital_label");
   		form_marital_label.setAttribute("for", "member["+mem_num_plus+"][marital]");
   		var form_marital = clone.querySelector(".form_marital");
   		form_marital.setAttribute("id", "member["+mem_num_plus+"][marital]");
   		form_marital.setAttribute("name", "member["+mem_num_plus+"][marital]");

   		var form_education_label = clone.querySelector(".form_education_label");
   		form_education_label.setAttribute("for", "member["+mem_num_plus+"][education]");
   		var form_education = clone.querySelector(".form_education");
   		form_education.setAttribute("id", "member["+mem_num_plus+"][education]");
   		form_education.setAttribute("name", "member["+mem_num_plus+"][education]");

   		var form_occupation_label = clone.querySelector(".form_occupation_label");
   		form_occupation_label.setAttribute("for", "member["+mem_num_plus+"][occupation]");
   		var form_education = clone.querySelector(".form_occupation");
   		form_education.setAttribute("id", "member["+mem_num_plus+"][occupation]");
   		form_education.setAttribute("name", "member["+mem_num_plus+"][occupation]");

   		var active_yes_label = clone.querySelector(".active_yes_label");
   		active_yes_label.setAttribute("for", "active_yes_"+mem_num_plus);
   		var active_yes_input = clone.querySelector(".active_yes");
   		active_yes_input.setAttribute("id", "active_yes_"+mem_num_plus);
   		active_yes_input.setAttribute("name", "member["+mem_num_plus+"][active]");
   		var active_no_label = clone.querySelector(".active_no_label");
   		active_no_label.setAttribute("for", "active_no_"+mem_num_plus);
   		var active_no_input = clone.querySelector(".active_no");
   		active_no_input.setAttribute("id", "active_no_"+mem_num_plus);
   		active_no_input.setAttribute("name", "member["+mem_num_plus+"][active]");

   		var is_voter_yes_label = clone.querySelector(".is_voter_yes_label");
   		is_voter_yes_label.setAttribute("for", "is_voter_yes_"+mem_num_plus);
   		var is_voter_yes_input = clone.querySelector(".is_voter_yes");
   		is_voter_yes_input.setAttribute("id", "is_voter_yes_"+mem_num_plus);
   		is_voter_yes_input.setAttribute("name", "member["+mem_num_plus+"][is_voter]");
   		var is_voter_no_label = clone.querySelector(".is_voter_no_label");
   		is_voter_no_label.setAttribute("for", "is_voter_no_"+mem_num_plus);
   		var is_voter_no_input = clone.querySelector(".is_voter_no");
   		is_voter_no_input.setAttribute("id", "is_voter_no_"+mem_num_plus);
   		is_voter_no_input.setAttribute("name", "member["+mem_num_plus+"][is_voter]");

   		var propertyOwner_yes_label = clone.querySelector(".propertyOwner_yes_label");
   		propertyOwner_yes_label.setAttribute("for", "propertyOwner_yes_"+mem_num_plus);
   		var propertyOwner_yes_input = clone.querySelector(".propertyOwner_yes");
   		propertyOwner_yes_input.setAttribute("id", "propertyOwner_yes_"+mem_num_plus);
   		propertyOwner_yes_input.setAttribute("name", "member["+mem_num_plus+"][propertyOwner]");
   		var propertyOwner_no_label = clone.querySelector(".propertyOwner_no_label");
   		propertyOwner_no_label.setAttribute("for", "propertyOwner_no_"+mem_num_plus);
   		var propertyOwner_no_input = clone.querySelector(".propertyOwner_no");
   		propertyOwner_no_input.setAttribute("id", "propertyOwner_no_"+mem_num_plus);
   		propertyOwner_no_input.setAttribute("name", "member["+mem_num_plus+"][propertyOwner]");

   		propertyOwner_yes_input.setAttribute("data-family-index", mem_num_plus);
   		propertyOwner_no_input.setAttribute("data-family-index", mem_num_plus);

   		var tanahForm = clone.querySelector("#tanahForm");
   		tanahForm.setAttribute("id", "tanahForm_"+mem_num_plus);

   		var toShow_div = document.querySelector("#step2_member_forms_area");
   		toShow_div.appendChild(clone);

   		mem_num = mem_num+1;
   		var numberOfFamilyMember = document.querySelector("#step2_numberOfFamilyMember");
   		numberOfFamilyMember.setAttribute("value", mem_num);
	}

	function deleteMember(element) {
		var confirm = window.confirm("Adakah anda pasti memadamkan ahli ini?");
		if (!confirm)
			return;

		var form_div = $(this).closest(".family_member_form_div");

		var family_member_legend = $(form_div).find(".family_member_legend");
		var legend_count = $(family_member_legend[0]).find(".legend_count");
		var toDelete_mem_num = Number($(legend_count[0]).text());

		form_div.remove();

		for (var i = toDelete_mem_num+1; i <= mem_num; i++)
		{
			var mem_num_minus = i-1;

			var target_form_div = document.querySelector("#family_member_form_div_"+i);

	   		target_form_div.setAttribute("id", "family_member_form_div_"+mem_num_minus);
	   		target_form_div.querySelector(".legend_count").innerText = mem_num_minus;

	   		var form_name_label = target_form_div.querySelector(".form_name_label");
	   		form_name_label.setAttribute("for", "member["+mem_num_minus+"][name]");
	   		var form_name = target_form_div.querySelector(".form_name");
	   		form_name.setAttribute("id", "member["+mem_num_minus+"][name]");
	   		form_name.setAttribute("name", "member["+mem_num_minus+"][name]");

	   		var form_ic_label = target_form_div.querySelector(".form_ic_label");
	   		form_ic_label.setAttribute("for", "member["+mem_num_minus+"][ic]");
	   		var form_ic = target_form_div.querySelector(".form_ic");
	   		form_ic.setAttribute("id", "member["+mem_num_minus+"][ic]");
	   		form_ic.setAttribute("name", "member["+mem_num_minus+"][ic]");

	   		var form_phone_label = target_form_div.querySelector(".form_phone_label");
	   		form_phone_label.setAttribute("for", "member["+mem_num_minus+"][phone]");
	   		var form_phone = target_form_div.querySelector(".form_phone");
	   		form_phone.setAttribute("id", "member["+mem_num_minus+"][phone]");
	   		form_phone.setAttribute("name", "member["+mem_num_minus+"][phone]");

	   		var form_gender_label = target_form_div.querySelector(".form_gender_label");
	   		form_gender_label.setAttribute("for", "member["+mem_num_minus+"][gender]");
	   		var form_gender = target_form_div.querySelector(".form_gender");
	   		form_gender.setAttribute("id", "member["+mem_num_minus+"][gender]");
	   		form_gender.setAttribute("name", "member["+mem_num_minus+"][gender]");

	   		var form_dob_label = target_form_div.querySelector(".form_dob_label");
	   		form_dob_label.setAttribute("for", "member["+mem_num_minus+"][dob]");
	   		var form_dob = target_form_div.querySelector(".form_dob");
	   		form_dob.setAttribute("id", "member["+mem_num_minus+"][dob]");
	   		form_dob.setAttribute("name", "member["+mem_num_minus+"][dob]");

	   		var form_race_label = target_form_div.querySelector(".form_race_label");
	   		form_race_label.setAttribute("for", "member["+mem_num_minus+"][race]");
	   		var form_race = target_form_div.querySelector(".form_race");
	   		form_race.setAttribute("id", "member["+mem_num_minus+"][race]");
	   		form_race.setAttribute("name", "member["+mem_num_minus+"][race]");

	   		var form_marital_label = target_form_div.querySelector(".form_marital_label");
	   		form_marital_label.setAttribute("for", "member["+mem_num_minus+"][marital]");
	   		var form_marital = target_form_div.querySelector(".form_marital");
	   		form_marital.setAttribute("id", "member["+mem_num_minus+"][marital]");
	   		form_marital.setAttribute("name", "member["+mem_num_minus+"][marital]");

	   		var form_education_label = target_form_div.querySelector(".form_education_label");
	   		form_education_label.setAttribute("for", "member["+mem_num_minus+"][education]");
	   		var form_education = target_form_div.querySelector(".form_education");
	   		form_education.setAttribute("id", "member["+mem_num_minus+"][education]");
	   		form_education.setAttribute("name", "member["+mem_num_minus+"][education]");

	   		var form_occupation_label = target_form_div.querySelector(".form_occupation_label");
	   		form_occupation_label.setAttribute("for", "member["+mem_num_minus+"][occupation]");
	   		var form_education = target_form_div.querySelector(".form_occupation");
	   		form_education.setAttribute("id", "member["+mem_num_minus+"][occupation]");
	   		form_education.setAttribute("name", "member["+mem_num_minus+"][occupation]");

	   		var active_yes_label = target_form_div.querySelector(".active_yes_label");
	   		active_yes_label.setAttribute("for", "active_yes_"+mem_num_minus);
	   		var active_yes_input = target_form_div.querySelector(".active_yes");
	   		active_yes_input.setAttribute("id", "active_yes_"+mem_num_minus);
	   		active_yes_input.setAttribute("name", "member["+mem_num_minus+"][active]");
	   		var active_no_label = target_form_div.querySelector(".active_no_label");
	   		active_no_label.setAttribute("for", "active_no_"+mem_num_minus);
	   		var active_no_input = target_form_div.querySelector(".active_no");
	   		active_no_input.setAttribute("id", "active_no_"+mem_num_minus);
	   		active_no_input.setAttribute("name", "member["+mem_num_minus+"][active]");

	   		var is_voter_yes_label = target_form_div.querySelector(".is_voter_yes_label");
	   		is_voter_yes_label.setAttribute("for", "is_voter_yes_"+mem_num_minus);
	   		var is_voter_yes_input = target_form_div.querySelector(".is_voter_yes");
	   		is_voter_yes_input.setAttribute("id", "is_voter_yes_"+mem_num_minus);
	   		is_voter_yes_input.setAttribute("name", "member["+mem_num_minus+"][is_voter]");
	   		var is_voter_no_label = target_form_div.querySelector(".is_voter_no_label");
	   		is_voter_no_label.setAttribute("for", "is_voter_no_"+mem_num_minus);
	   		var is_voter_no_input = target_form_div.querySelector(".is_voter_no");
	   		is_voter_no_input.setAttribute("id", "is_voter_no_"+mem_num_minus);
	   		is_voter_no_input.setAttribute("name", "member["+mem_num_minus+"][is_voter]");

	   		var propertyOwner_yes_label = target_form_div.querySelector(".propertyOwner_yes_label");
	   		propertyOwner_yes_label.setAttribute("for", "propertyOwner_yes_"+mem_num_minus);
	   		var propertyOwner_yes_input = target_form_div.querySelector(".propertyOwner_yes");
	   		propertyOwner_yes_input.setAttribute("id", "propertyOwner_yes_"+mem_num_minus);
	   		propertyOwner_yes_input.setAttribute("name", "member["+mem_num_minus+"][propertyOwner]");
	   		var propertyOwner_no_label = target_form_div.querySelector(".propertyOwner_no_label");
	   		propertyOwner_no_label.setAttribute("for", "propertyOwner_no_"+mem_num_minus);
	   		var propertyOwner_no_input = target_form_div.querySelector(".propertyOwner_no");
	   		propertyOwner_no_input.setAttribute("id", "propertyOwner_no_"+mem_num_minus);
	   		propertyOwner_no_input.setAttribute("name", "member["+mem_num_minus+"][propertyOwner]");

	   		propertyOwner_yes_input.setAttribute("data-family-index", mem_num_minus);
   			propertyOwner_no_input.setAttribute("data-family-index", mem_num_minus);

   			var tanahParent = target_form_div.querySelector(".tanah_parent_div");
   			if (tanahParent)
   			{
   				tanahParent.setAttribute("id", "tanah_"+mem_num_minus+"_parent_div");
   				var tanah_show_div = target_form_div.querySelector(".tanah_show_div");
   				tanah_show_div.setAttribute("id", "tanah_"+mem_num_minus+"_show_div");
   				var tanahCount = target_form_div.querySelector(".tanah_count");
   				tanahCount.setAttribute("id", "tanah_"+mem_num_minus+"_count");
   				
   				var tanah_div = target_form_div.querySelectorAll(".tanah_div");
   				for (var i = 0; i < tanah_div.length; i++)
   				{
   					var old_id = tanah_div[i].getAttribute("id");
   					var new_id = old_id.replace(/tanah_\d{1,}_/, "tanah_"+mem_num_minus+"_");
   					tanah_div[i].setAttribute("id", new_id);
   				}

	   			var tanah_inputs = tanahParent.querySelectorAll("input:not([type='hidden'])");
	   			for (var i = 0; i < tanah_inputs.length; i++)
	   			{
	   				var old_name = tanah_inputs[i].getAttribute("name");
	   				var new_name = old_name.replace(/member\[\d{1,}\]/, "member["+mem_num_minus+"]");
	   				var old_id = tanah_inputs[i].getAttribute("id");
	   				var new_id = old_id.replace(/member\[\d{1,}\]/, "member["+mem_num_minus+"]");

	   				tanah_inputs[i].setAttribute("name", new_name);
	   				tanah_inputs[i].setAttribute("id", new_id);
	   			}

	   			var tanah_labels = tanahParent.querySelectorAll("label");
	   			for (var i = 0; i < tanah_labels.length; i++)
	   			{
	   				var old_for = tanah_labels[i].getAttribute("for");
	   				if (old_for) {
	   					var new_for = old_for.replace(/member\[\d{1,}\]/, "member["+mem_num_minus+"]");
	   					tanah_labels[i].setAttribute("for", new_for);
	   				}
	   				
	   			}
   			}
   			

	   		var tanahForm = target_form_div.querySelector(".tanahForm");
   			tanahForm.setAttribute("id", "tanahForm_"+mem_num_minus);
		}

		mem_num = mem_num-1;
   		var numberOfFamilyMember = document.querySelector("#step2_numberOfFamilyMember");
   		numberOfFamilyMember.setAttribute("value", mem_num);
	}

	$(document).on("click", "#add_member_btn", addMember);
	$(document).on("click", ".deleteMemberBtn", deleteMember);


	$("#step2_form").submit(function(e) {

	    e.preventDefault();

	    //var form = $(this);
	    var url = "{{url('/fillForm/processStep2')}}";

	    var form = $(this).closest("form");
		var formData = new FormData(form[0]);

	    $.ajax({
			type: "POST",
			url: url,
			data: formData,
			dataType: "json",
			processData: false,
    		contentType: false,
			beforeSend: function() {
				$("#loading_div").attr("data-text", "Sila Tunggu...");
				$("#loading_div").addClass("is-active");
			},
			success: function(data) {
				window.location.href = "{{url('fillForm/success')}}";
				//$("#loading_div").removeClass("is-active");
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Tidak Berjaya:<br>");
		    }
		});
	});

	$(document).ready(function (){
		function initializeMemberForms()
		{
			for (var i = 0; i < step1_numberOfFamilyMember; i++)
			{
				addMember();
			}
		}
		initializeMemberForms();
	});

	$(document).on("change", ".propertyOwner", function(){
		var value = $(this).val();
		var member_index = $(this).attr("data-family-index");

		var toAppend = 	`	
							<div id="tanah_`+member_index+`_parent_div" class="tanah_parent_div" data-member-index="`+member_index+`">
								<div id="tanah_`+member_index+`_show_div" class="tanah_show_div">
								<input type="hidden" class="tanah_count" id="tanah_`+member_index+`_count" value="1">
								<fieldset class="scheduler-border">
									<legend class="scheduler-border">Tanah 1</legend>
									<div id="tanah_`+member_index+`_1" class="tanah_div">
										<div class="form-group row mt-3">
											<label class="pr-2 col-2 mr-3">Jenis Tanah</label>
											<div class="custom-control custom-radio custom-control-inline">
												<input type="radio" id="member[`+member_index+`][tanah][1][ncr]" name="member[`+member_index+`][tanah][1][type]" class="custom-control-input tanah" value="NCR" required>
												<label for="member[`+member_index+`][tanah][1][ncr]" class="custom-control-label">NCR</label>
											</div>
											<div class="custom-control custom-radio custom-control-inline">
												<input type="radio" id="member[`+member_index+`][tanah][1][geran]" name="member[`+member_index+`][tanah][1][type]" class="custom-control-input tanah" value="Geran">
												<label for="member[`+member_index+`][tanah][1][geran]" class="custom-control-label">Geran</label>
											</div>
											<div class="custom-control custom-radio custom-control-inline">
												<input type="radio" id="member[`+member_index+`][tanah][1][fl]" name="member[`+member_index+`][tanah][1][type]" class="custom-control-input tanah" value="FL">
												<label for="member[`+member_index+`][tanah][1][fl]" class="custom-control-label">FL</label>
											</div>
											<div class="custom-control custom-radio custom-control-inline">
												<input type="radio" id="member[`+member_index+`][tanah][1][mixzone]" name="member[`+member_index+`][tanah][1][type]" class="custom-control-input tanah" value="Mix Zone">
												<label for="member[`+member_index+`][tanah][1][mixzone]" class="custom-control-label">Mix Zone</label>
											</div>
										</div>

										<div class="form-group row mt-3">
											<label for="member[`+member_index+`][tanah][1][kawasan]" class="col-form-label col-2 tanah_kawasan_label">Kawasan</label>
											<div class="col">
												<input type="text" name="member[`+member_index+`][tanah][1][kawasan]" id="member[`+member_index+`][tanah][1][kawasan]" class="form-control tanah_kawasan" required>
											</div>
										</div>

										<div class="form-group row mt-3">
											<label for="member[`+member_index+`][tanah][1][keluasan]" class="col-form-label col-2 tanah_keluasan_label">Keluasan (Ekar)</label>
											<div class="col">
												<input type="number" name="member[`+member_index+`][tanah][1][keluasan]" id="member[`+member_index+`][tanah][1][keluasan]" class="form-control tanah_keluasan" step=".01" required>
											</div>
										</div>

										<div class="form-group row mt-3 photo_input_row">
											<label class="col-form-label col-2">Upload Image (Tidak Wajib)</label>
											<div class="col">
												<div class="custom-file">
												  	<input type="file" accept="image/*" class="photo_input custom-file-input" id="member[`+member_index+`][tanah][1][photo]" name="member[`+member_index+`][tanah][1][photo]">
												  	<label class="custom-file-label" for="member[`+member_index+`][tanah][1][photo]">Choose Image to Upload</label>
												</div>
											</div>
										</div>
										<div class="photo_preview row">
										</div>

									</div>
								</fieldset>
								</div>
								<div>
									<div class="text-center buttons_div">
										<button type="button" class="btn btn-sm btn-success add_tanah_btn" data-toggle="tooltip" title="Tambah Tanah"><i class="fas fa-plus-circle"></i></button>
									</div>
								</div>
							</div>
						`;

		if (value == 1)
		{
			$("#tanahForm_"+member_index).html(toAppend);
			$('[data-toggle="tooltip"]').tooltip({trigger : 'hover'})
		}
		else
		{
			$("#tanahForm_"+member_index).html("");
		}
	});

	$(document).on("click", ".add_tanah_btn", function(){
		var parent_div = $(this).closest(".tanah_parent_div");
		var member_index = $(parent_div).attr("data-member-index");
		var show_div = $(parent_div).find(".tanah_show_div");
		var tanah_index = Number($("#tanah_"+member_index+"_count").val()) + 1;

		var toAppend = 	`
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Tanah `+tanah_index+`</legend>
							<div id="tanah_`+member_index+`_`+tanah_index+`" class="tanah_div">
								<div class="form-group row mt-3">
									<label class="pr-2 col-2 mr-3">Jenis Tanah</label>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="member[`+member_index+`][tanah][`+tanah_index+`][ncr]" name="member[`+member_index+`][tanah][`+tanah_index+`][type]" class="custom-control-input tanah" value="NCR" required>
										<label for="member[`+member_index+`][tanah][`+tanah_index+`][ncr]" class="custom-control-label">NCR</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="member[`+member_index+`][tanah][`+tanah_index+`][geran]" name="member[`+member_index+`][tanah][`+tanah_index+`][type]" class="custom-control-input tanah" value="Geran">
										<label for="member[`+member_index+`][tanah][`+tanah_index+`][geran]" class="custom-control-label">Geran</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="member[`+member_index+`][tanah][`+tanah_index+`][fl]" name="member[`+member_index+`][tanah][`+tanah_index+`][type]" class="custom-control-input tanah" value="FL">
										<label for="member[`+member_index+`][tanah][`+tanah_index+`][fl]" class="custom-control-label">FL</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="member[`+member_index+`][tanah][`+tanah_index+`][mixzone]" name="member[`+member_index+`][tanah][`+tanah_index+`][type]" class="custom-control-input tanah" value="Mix Zone">
										<label for="member[`+member_index+`][tanah][`+tanah_index+`][mixzone]" class="custom-control-label">Mix Zone</label>
									</div>
								</div>

								<div class="form-group row mt-3">
									<label for="member[`+member_index+`][tanah][`+tanah_index+`][kawasan]" class="col-form-label col-2 tanah_kawasan_label">Kawasan</label>
									<div class="col">
										<input type="text" name="member[`+member_index+`][tanah][`+tanah_index+`][kawasan]" id="member[`+member_index+`][tanah][`+tanah_index+`][kawasan]" class="form-control tanah_kawasan" required>
									</div>
								</div>

								<div class="form-group row mt-3">
									<label for="member[`+member_index+`][tanah][`+tanah_index+`][keluasan]" class="col-form-label col-2 tanah_keluasan_label">Keluasan (Ekar)</label>
									<div class="col">
										<input type="number" name="member[`+member_index+`][tanah][`+tanah_index+`][keluasan]" id="member[`+member_index+`][tanah][`+tanah_index+`][keluasan]" class="form-control tanah_keluasan" step=".01" required>
									</div>
								</div>

								<div class="form-group row mt-3 photo_input_row">
									<label class="col-form-label col-2">Upload Image (Tidak Wajib)</label>
									<div class="col">
										<div class="custom-file">
										  	<input type="file" accept="image/*" class="photo_input custom-file-input" id="member[`+member_index+`][tanah][`+tanah_index+`][photo]" name="member[`+member_index+`][tanah][`+tanah_index+`][photo]">
										  	<label class="custom-file-label" for="member[`+member_index+`][tanah][`+tanah_index+`][photo]">Choose Image to Upload</label>
										</div>
									</div>
								</div>
								<div class="photo_preview row">
								</div>

							</div>
						</fieldset>
						`;

		show_div.append(toAppend);

		var deleteButton = `
							<button type="button" class="btn btn-sm btn-danger delete_tanah_btn" data-toggle="tooltip" title="Padam Extra Tanah"><i class="fas fa-trash-alt"></i></button>
							`;
		var buttons_div = $(parent_div).find(".buttons_div");
		
		if ($(buttons_div).find(".delete_tanah_btn").length == 0) {
			buttons_div.append(deleteButton);
		}
		
		$("#tanah_"+member_index+"_count").val(tanah_index);
	});

	$(document).on("click", ".delete_tanah_btn", function(){
		var parent_div = $(this).closest(".tanah_parent_div");
		var member_index = $(parent_div).attr("data-member-index");
		var tanah_index = Number($("#tanah_"+member_index+"_count").val());
		var tanah_div = $("#tanah_"+member_index+"_"+tanah_index);
		var parent_fieldset = $(tanah_div).closest("fieldset");

		if ( (tanah_index-1) < 2)
		{
			var buttons_div = $(parent_div).find(".buttons_div");
			$(buttons_div).find(".delete_tanah_btn").remove();
		}
		
		$("#tanah_"+member_index+"_count").val(tanah_index-1);

		parent_fieldset.remove();
	});

	$(document).on('change', '.custom-file-input', function(){
        //get the file name
        //var fileName = $(this).val();
        var fileName = $(this).val().replace('C:\\fakepath\\', "")
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })

    $(document).on('change', '.photo_input', function(){
    	var input = $(this)[0];

    	if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                //$('#avatar-img').attr('src', e.target.result);
                var input_row = $(input).closest(".photo_input_row");
               	var photo_preview = $(input_row).next(".photo_preview");
			    var img = 	`
			    			<div class="col-2">
			    			</div>
			    			<div class="col-10">
			        			<img src="`+e.target.result+`" class="photo_input_preview">
			        		</div>
			        		`;
			    $(photo_preview).html(img);
            }
            
            reader.readAsDataURL(input.files[0]);
        }

        if (!$(this).val())
        {
        	var input_row = $(input).closest(".photo_input_row");
			var photo_preview = $(input_row).next(".photo_preview");
			    
			$(photo_preview).html("");
        }
    });

</script>

@endsection('content')

@section('template')

<template id="family_member_form_template">
	<div class="mt-5 family_member_form_div">
		<fieldset class="scheduler-border">
			<legend class="family_member_legend scheduler-border">Ahli Keluarga <span class="legend_count">1</span><span class="ketuaRumah_title"></span></legend>
			<div class="text-right"><button type="button" class="btn btn-sm btn-danger deleteMemberBtn">Padam</button></div>

			<div class="form-group row pl-2 mt-3">
				<label for="name_1" class="col-form-label col-2 form_name_label">Nama</label>
				<div class="col">
					<input type="text" name="name_1" id="name_1" class="form-control form_name" required>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="ic_1" class="col-form-label col-2 form_ic_label">IC</label>
				<div class="col">
					<input type="text" name="ic_1" id="ic_1" class="form-control form_ic" pattern="\d{12}" title="12 numbers without -" required>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="phone_1" class="col-form-label col-2 form_phone_label">Telefon (Tidak Wajib)</label>
				<div class="col">
					<input type="text" name="phone_1" id="phone_1" class="form-control form_phone">
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="gender_1" class="col-form-label col-2 form_gender_label">Jantina</label>
				<div class="col">
					<select name="gender_1" id="gender_1" class="form-control form_gender" required>
						<option value="male">Lelaki</option>
						<option value="female">Perempuan</option>
					</select>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="dob_1" class="col-form-label col-2 form_dob_label">Tarikh Lahir</label>
				<div class="col">
					<input type="date" name="dob_1" id="dob_1" class="form-control form_dob" required>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="race_1" class="col-form-label col-2 form_race_label">Kaum</label>
				<div class="col">
					<select name="race_1" id="race_1" class="form-control form_race" required>
						<option value="melayu">Melayu</option>
						<option value="cina">Cina</option>
						<option value="india">India</option>
						<option value="bumiputera">Bumiputera</option>
						<option value="lain-lain">Lain-lain</option>
					</select>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="marital_1" class="col-form-label col-2 form_marital_label">Status Perkahwinan</label>
				<div class="col">
					<select name="marital_1" id="marital_1" class="form-control form_marital" required>
						<option value="bujang">Bujang</option>
						<option value="kahwin">Kahwin</option>
						<option value="duda">Duda</option>
						<option value="janda">Janda</option>
					</select>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="education_1" class="col-form-label col-2 form_education_label">Tahap Pendidikan</label>
				<div class="col">
					<select name="education_1" id="education_1" class="form-control form_education" required>
						<option value="Non-educated"> Tidak Berpendidikan Formal</option>
						<option value="Primary School">Pendidikan Rendah</option>
						<option value="Secondary School">Pendidikan Menengah</option>
						<option value="Form 6">Tingkatan 6</option>
						<option value="Diploma">Diploma</option>
						<option value="Degree">Ijazah Sarjana Muda</option>
						<option value="Master">Ijazah Sarjana</option>
						<option value="PhD">Doktor Falsafah</option>
						<option value="N/A">Tiada Kaitan</option>
					</select>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="occupation_1" class="col-form-label col-2 form_occupation_label">Pekerjaan (Tidak Wajib)</label>
				<div class="col">
					<input type="text" name="occupation_1" id="occupation_1" class="form-control form_occupation">
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label class="pl-3">Adakah anda bermaustatin tetap di alamat ini?</label>
				<div class="ml-3">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="active_yes_1" name="active_1" class="custom-control-input active_yes" value="1" required>
						<label class="custom-control-label active_yes_label" for="active_yes_1">Ya</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="active_no_1" name="active_1" class="custom-control-input active_no" value="0">
						<label class="custom-control-label active_no_label" for="active_no_1">Tidak</label>
					</div>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label class="pl-3">Sudahkah anda daftar sebagai pengundi?</label>
				<div class="ml-3">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="is_voter_yes_1" name="is_voter_1" class="custom-control-input is_voter_yes" value="1" required>
						<label class="custom-control-label is_voter_yes_label" for="is_voter_yes_1">Ya</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="is_voter_no_1" name="is_voter_1" class="custom-control-input is_voter_no" value="0">
						<label class="custom-control-label is_voter_no_label" for="is_voter_no_1">Tidak</label>
					</div>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label class="pl-3">Adakah anda mempunyai tanah yang bergeran?</label>
				<div class="ml-3">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="propertyOwner_yes_1" name="propertyOwner_1" class="custom-control-input propertyOwner propertyOwner_yes" value="1" required>
						<label class="custom-control-label propertyOwner_yes_label" for="propertyOwner_yes_1">Ya</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="propertyOwner_no_1" name="propertyOwner_1" class="custom-control-input propertyOwner propertyOwner_no" value="0">
						<label class="custom-control-label propertyOwner_no_label" for="propertyOwner_no_1">Tidak</label>
					</div>
				</div>
			</div>

			<div id="tanahForm" class="tanahForm"></div>
		</fieldset>
	</div>
</template>
@endsection
