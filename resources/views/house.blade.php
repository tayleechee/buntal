@extends('layouts.app')
@include('addMemberModal')
@include('editMemberModal')

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

	.form-nonhidden-input-div {
    	border: 1px solid #ced4da;
    	background: #F7F7FB ;
    	padding: .375rem 0.75rem;
    	margin-left: 1rem;
    	margin-right: 1rem;
    }

    .form-input-div {
    	border: 1px solid #ced4da;
    	background: #F7F7FB ;
    	padding: .375rem 0.75rem;
    }

    .house-basic-details {
    	border: 1px solid #ddd !important;
    	border-radius: 5px;
    	background-color: white;
    	padding-left: 2.5em !important;
		padding-right: 2.5em;
	    margin: 0.8em 0 1.5em 0 !important;
	    -webkit-box-shadow:  0px 0px 0px 0px #000;
	            box-shadow:  0px 0px 0px 0px #000;
    }

    .text-red {
    	color: red;
    }

    .highlighted {
		-webkit-transition: all 0.30s ease-in-out;
		-moz-transition: all 0.30s ease-in-out;
		-ms-transition: all 0.30s ease-in-out;
		-o-transition: all 0.30s ease-in-out;
		outline: none;
		box-shadow: 0 0 5px #AED6F1;
		margin: 5px 1px 3px -0.6em;
		border: 1px solid #AED6F1;
	}

	.highlighted-without-ml {
		-webkit-transition: all 0.30s ease-in-out;
		-moz-transition: all 0.30s ease-in-out;
		-ms-transition: all 0.30s ease-in-out;
		-o-transition: all 0.30s ease-in-out;
		outline: none;
		box-shadow: 0 0 5px #AED6F1;
		margin: 5px 1px 3px 0px;
		border: 1px solid #AED6F1;
	}

	.highlighted-bold {
		-webkit-transition: all 0.30s ease-in-out;
		-moz-transition: all 0.30s ease-in-out;
		-ms-transition: all 0.30s ease-in-out;
		-o-transition: all 0.30s ease-in-out;
		outline: none;
		box-shadow: 2px 2px 5px #AED6F1;
		border: 2px solid #AED6F1 !important;
	}
	 
	input[type=text]:focus, textarea:focus {
	  
	}

	.poc_legend_label {
		color: blue;
	}
</style>
@endsection

@section('content')

<div class="text-center">
	<h2>Maklumat Rumah</h2> <!--House Detail-->
</div>

<div class="container">
	<div class="text-right mt-5">
		<div>
			<button type="button" id="add_member_btn" class="btn btn-outline-success" data-toggle="modal" data-target="#addMemberModal">Tambah Ahli Keluarga</button> <!--Add member-->
			<button type="button" id="edit_house_btn" class="btn btn-outline-primary">Edit Butiran Rumah</button> <!--Edit House Detail-->
			<button type="button" id="save_house_btn" class="btn btn-success d-none">Simpan</button> <!--Save-->
			<button type="button" id="cancel_house_btn" class="btn btn-secondary d-none">Batal</button> <!--Cancel-->
			<button type="button" id="delete_house_btn" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirmDeleteHouseModal">Batal Rumah</button>
		</div>
	</div>
	<form id="house_form">
		{{ csrf_field() }}
		<input type="hidden" name="house_id" id="house_id" value="{{ $house->id }}">
		<div class="house-basic-details">
			<div class="form-group row">
				<label for="address" class="col-form-label font-weight-bold">Alamat Rumah</label> <!--House Address-->
				<input type="text" id="address" name="address" value="<?php echo isset($house->address) ? $house->address : ''  ?>" class="form-control form-address-edit d-none" required>
				<div class="col-12 form-input-div">
					<?php echo isset($house->address) ? $house->address : ''  ?>
				</div>
			</div>
			<div class="form-row">
					<div class="form-group row">
						<label for="ketuaRumah" class="label1 col-form-label col-sm-12 pl-0 font-weight-bold">Ketua Rumah</label>
						<div class="col pr-0">
							@php

							$aliveVillagers_assoarray = array();
							$aliveVillagers_assoarray[null] = "Please Select";
							if ($house->aliveVillagers)
							{
								foreach ($house->aliveVillagers as $villager)
								{
									$aliveVillagers_assoarray[$villager->id] = $villager->name;
								}
							}

							@endphp

							{!! Form::select('poc', $aliveVillagers_assoarray, isset($house->poc) ? $house->poc->villager_id : null, ['class'=>'step1 col-sm-8 form-control form-edit d-none', 'id'=>'poc', 'required']) !!}
							<div class="form-input-div col-sm-8 step1">
								<?php echo isset($house->poc) ? $house->poc->villager->name : 'None'  ?>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="householdIncome" class="label1 col-form-label col-sm-12 pl-0 font-weight-bold">Pendapatan Rumah (RM)</label> <!--Household Income-->
						<div class="col pr-0">
							<input type="number" id="householdIncome" name="householdIncome" value="<?php echo isset($house->household_income) ? $house->household_income : ''  ?>" class="step1 col-sm-8 form-control form-edit d-none" required>
							<div class="form-input-div col-sm-8 step1">
								<?php echo isset($house->household_income) ? $house->household_income : ''  ?>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="numberOfFamily" class="label1 col-form-label col-sm-12 pl-0 font-weight-bold" >Bilangan Keluarga</label> <!--number of family-->
						<div class="col pr-0">
							<input type="number" id="numberOfFamily" name="numberOfFamily" value="<?php echo isset($house->family_number) ? $house->family_number : ''  ?>" class="step1 col-sm-8 form-control form-edit d-none" required>
							<div class="form-input-div col-sm-8 step1">
								<?php echo isset($house->family_number) ? $house->family_number : ''  ?>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="numberOfFamilyMember" class="label1 col-form-label col-sm-12 pl-0 font-weight-bold">Bilangan Ahli Keluarga</label>
						<div class="col pr-0">
							<div class="form-nonhidden-input-div col-sm-8" style="margin-left: -0.6em !important">
								<?php echo isset($house->aliveVillagers) ? count($house->aliveVillagers) : 0  ?>						
							</div>
						</div>
					</div>
			</div>
		</div>

		@if (isset($house->villagers))
		<div id="member_forms_area">
			@foreach ($house->villagers as $index => $villager)
			<div class="mt-5 family_member_form_div">
				<fieldset class="scheduler-border">
					<!-- @if ( isset($villager) && !empty($villager->death_date) )
					<legend class="family_member_legend scheduler-border">Family Member <span class="legend_count">{{ ($index+1) }}</span></legend>
					@else
					<legend class="family_member_legend scheduler-border">Family Member <span class="legend_count">{{ ($index+1) }}</span></legend>
					@endif -->

					@if ( isset($villager) && $index == 0 && $house->poc)
					<legend class="family_member_legend scheduler-border">Ahli Keluarga <span class="legend_count">{{ ($index+1) }}</span><span class="poc_legend_label"> (Ketua Rumah)</span></legend>
					@elseif (!empty($villager->death_date))
					<legend class="family_member_legend scheduler-border">Ahli Keluarga <span class="legend_count">{{ ($index+1) }}</span><span style="color:grey"> (Meninggal)</span></legend>					
					@else
					<legend class="family_member_legend scheduler-border">Ahli Keluarga <span class="legend_count">{{ ($index+1) }}</span></legend> <!--Family Member-->
					@endif
					<div class="text-right">
						<button type="button" class="btn btn-sm btn-primary viewMemberDetailBtn mr-1" data-id="{{ $villager->id }}">View Detail</button>
						<button type="button" class="btn btn-sm btn-success editMemberBtn mr-1" data-id="{{ $villager->id }}">Edit</button>
						<button type="button" class="btn btn-sm btn-danger deleteMemberBtn" data-id="{{ $villager->id }}">Delete</button>
					</div>

					@if ( isset($villager) && !empty($villager->death_date) )
					<div class="form-group row pl-2 mt-3">
						<label for="occupation" class="col-form-label col-2 form_occupation_label font-weight-bold">Tarikh Kematian</label> <!--Death date-->
						<div class="col form-nonhidden-input-div font-weight-bold">
							{{ $villager->death_date }}
						</div>
					</div>
					@endif

					<div class="form-group row pl-2 mt-3">
						<label class="col-form-label col-2 form_name_label">Nama</label>
						<div class="col form-nonhidden-input-div col-form-label">
							{{ $villager->name }}
						</div>
					</div>

					<div class="form-group row pl-2 mt-3">
						<label class="col-form-label col-2 form_ic_label">IC</label>
						<div class="col form-nonhidden-input-div col-form-label">
							{{ $villager->ic }}
						</div>
					</div>

					<div class="form-group row pl-2 mt-3">
						<label class="col-form-label col-2 form_phone_label">Phone</label>
						<div class="col form-nonhidden-input-div col-form-label">
							{{ $villager->phone }}
						</div>
					</div>

					<div class="form-group row pl-2 mt-3">
						<label class="col-form-label col-2 form_gender_label">Jantina</label>
						<div class="col form-nonhidden-input-div col-form-label">
							{{ $villager->gender=='m' ? 'Lelaki' : 'Perempuan' }}
						</div>
					</div>

					<div class="form-group row pl-2 mt-3">
						<label class="col-form-label col-2 form_dob_label">Tarikh Lahir</label>
						<div class="col form-nonhidden-input-div col-form-label">
							{{ $villager->dob }}
						</div>
					</div>

					<div class="form-group row pl-2 mt-3">
						<label for="race" class="col-form-label col-2 form_race_label">Bangsa</label>
						<div class="col form-nonhidden-input-div col-form-label">
							{{ ucfirst($villager->race) }}
						</div>
					</div>

					<div class="form-group row pl-2 mt-3">
						<label class="col-form-label col-2 form_marital_label">Status Perkahwinan</label> <!--Marital Status-->
						<div class="col form-nonhidden-input-div col-form-label">
							{{ ucfirst($villager->marital_status) }}
						</div>
					</div>

					<div class="form-group row pl-2 mt-3">
						<label class="col-form-label col-2 form_education_label">Peringkat Pendidikan</label> <!--Education Level-->
						<div class="col form-nonhidden-input-div col-form-label">
							{{ $villager->education_level }}
						</div>
					</div>

					<div class="form-group row pl-2 mt-3">
						<label class="col-form-label col-2 form_occupation_label">Pekerjaan</label>
						<div class="col form-nonhidden-input-div col-form-label">
							{{ $villager->occupation }}
						</div>
					</div>

					<div class="form-group row pl-2 mt-3">
						<label class="pl-3">Adakah anda bermaustatin tetap di alamat ini?</label>
						<div class="col form-nonhidden-input-div col-form-label">
							{{ $villager->is_active==1 ? 'Ya' : 'Tidak' }}
						</div>
					</div>

					<div class="form-group row pl-2 mt-3">
						<label class="pl-3">Sudahkah anda daftar sebagai pengundi?</label>
						<div class="col form-nonhidden-input-div col-form-label">
							{{ $villager->is_voter==1 ? 'Ya' : 'Tidak' }}
						</div>
					</div>

					<div class="form-group row pl-2 mt-3">
						<label class="pl-3">Adakah anda mempunyai tanah yang bergeran?</label>
						<div class="col form-nonhidden-input-div col-form-label">
							{{ $villager->is_property_owner==1 ? 'Ya' : 'Tidak' }}
						</div>
					</div>
				</fieldset>
			</div>
			@endforeach
		</div>
		@endif
	</form>
</div>

<!-- Confirm Delete House Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="confirmDeleteHouseModal">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		  	<div class="modal-header">
		        <h5 class="modal-title font-weight-bold">Sahkan Padam?</h5> <!--Confirm Delete-->
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		    	</button>
		  	</div>
		  	<div class="modal-body">
		    	<p class="font-weight-bold">Anda hendak memadamkan rumah ini. Semua penduduk akan dipadamkan juga.</p> <!--You are about to delete this house. All residents will be deleted too.-->
		  	</div>
		  	<div class="modal-footer">
		        <button type="button" class="btn btn-danger" id="confirmDeleteHouseBtn">Ya</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
		  	</div>
	    </div>
	</div>
</div>

<!-- Confirm Delete Member Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="confirmDeleteMemberModal">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		  	<div class="modal-header">
		        <h5 class="modal-title font-weight-bold">Sahkan Padam?</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		    	</button>
		  	</div>
		  	<div class="modal-body">
		    	<p class="font-weight-bold">Anda akan memadamkan ahli ini. Perkara ini Tidak boleh diubah.</p>
		  	</div>
		  	<div class="modal-footer">
		        <button type="button" class="btn btn-danger" id="confirmDeleteMemberBtn">Ya</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
		  	</div>
	    </div>
	</div>
</div>

<script type="text/javascript">
	$(document).on("click", ".viewMemberDetailBtn", function(){
		location.href = "/villager/"+ $(this).attr("data-id");
	});

	$(document).on("click", "#edit_house_btn", function(){
		$(".form-input-div").addClass("d-none");
		$(".form-edit").removeClass("d-none");
		$(".form-address-edit").removeClass("d-none");
		$("#save_house_btn").removeClass("d-none");
		$("#cancel_house_btn").removeClass("d-none");
		$("#add_member_btn").addClass("d-none");
		$("#delete_house_btn").addClass("d-none");
		$("#edit_house_btn").addClass("d-none");

		$(".form-address-edit").addClass("highlighted-without-ml");
		$(".form-edit").addClass("highlighted");
		$(".house-basic-details").addClass("highlighted-bold");
	});

	$(document).on("click", "#cancel_house_btn", function(){
		var confirm = window.confirm("Sah untuk membatal? Perubahan tidak akan disimpan.");

		if (!confirm)
			return;

		var villager_id = document.getElementById("house_id").getAttribute("value");
		$.ajax({
			type: "GET",
			url: '/getHouseDetail',
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
				if (typeof data.address !== 'undefined') {
					$("#address").val(data.address);
				}
				if (typeof data.household_income !== 'undefined') {
					$("#householdIncome").val(data.household_income);
				}
				if (typeof data.family_number !== 'undefined') {
					$("#numberOfFamily").val(data.family_number);
				}

				$(".form-input-div").removeClass("d-none");
				$(".form-edit").addClass("d-none");
				$(".form-address-edit").addClass("d-none");
				$("#save_house_btn").addClass("d-none");
				$("#cancel_house_btn").addClass("d-none");
				$("#add_member_btn").removeClass("d-none");
				$("#delete_house_btn").removeClass("d-none");
				$("#edit_house_btn").removeClass("d-none");

				$(".form-address-edit").removeClass("highlighted-without-ml")
				$(".form-edit").removeClass("highlighted");
				$(".house-basic-details").removeClass("highlighted-bold");
			},
			error: function (jqXHR, exception) {
		        showAjaxErrorMessage(jqXHR, exception, "Maklumat gagal diperolehi. Sila cuba lagi:<br>");
		    }
		});
	});

	$(document).on("click", "#save_house_btn", function(){
		var form = document.getElementById("house_form");
		if (!form.checkValidity())
		{
			form.reportValidity();
			return;
		}

		var confirm = window.confirm("Adakah anda pasti menyimpan perubahan?");

		if (!confirm)
			return;

		var form = document.getElementById("house_form");

		$.ajax({
			type: "POST",
			url: "/setHouseDetail",
			data: $("#house_form").serialize(),
			beforeSend: function() {
				$("#loading_div").attr("data-text", "Sila Tunggu...");
				$("#loading_div").addClass("is-active");
			},
			success: function(data) {
				location.reload();
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Tidak Berjaya:<br>");
		    }
		});
	});

	$(document).on("click", "#confirmDeleteHouseBtn", function(){
		var _token = $('input[name="_token"]').val();
		var id = $("#house_id").val();

		$.ajax({
			type: "POST",
			url: "/deleteHouse",
			data: {
				id: id,
				_token: _token
			},
			beforeSend: function() {
				$("#confirmDeleteModal").modal('hide');
				$("#loading_div").attr("data-text", "Sila Tunggu...");
				$("#loading_div").addClass("is-active");
			},
			success: function(data) {
				location.href = '/houseRecords';
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Tidak Berjaya:<br>");
		    }
		});
	});

	$(document).on("click", "#addMemberSaveBtn", function(){
		var form = document.getElementById("addMemberForm");
		if (!form.checkValidity())
		{
			form.reportValidity();
			return;
		}

		$.ajax({
			type: "POST",
			url: "/addMember",
			data: $("#addMemberForm").serialize(),
			beforeSend: function() {
				$("#loading_div").attr("data-text", "Sila Tunggu...");
				$("#loading_div").addClass("is-active");
			},
			success: function(data) {
				location.reload();
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Tidak Berjaya:<br>");
		    }
		});
	});

	$(document).on("click", ".deleteMemberBtn", function(){
		var member_id = $(this).attr("data-id");
		$("#confirmDeleteMemberBtn").attr("data-id", member_id);

		$("#confirmDeleteMemberModal").modal('show');
	});

	$(document).on("click", "#confirmDeleteMemberBtn", function(){
		var member_id = $(this).attr("data-id");
		var _token = $('input[name="_token"]').val();

		$.ajax({
			type: "POST",
			url: "/deleteVillager",
			data: {
				id: member_id,
				_token: _token
			},
			beforeSend: function() {
				$("#confirmDeleteModal").modal('hide');
				$("#loading_div").attr("data-text", "Sila Tunggu...");
				$("#loading_div").addClass("is-active");
			},
			success: function(data) {
				location.reload();
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Tidak Berjaya:<br>");
		    }
		});
	});

	$(document).on("click", ".editMemberBtn", function(){
		var villager_id = $(this).attr("data-id");

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
				$("#editMemberForm input[name=villager_id]").val(data.id);

				if (typeof data.name !== 'undefined') {
					$("#editMemberForm input[name=name]").val(data.name);
				}
				if (typeof data.ic !== 'undefined') {
					$("#editMemberForm input[name=ic]").val(data.ic);
				}
				if (typeof data.phone !== 'undefined') {
					$("#editMemberForm input[name=phone]").val(data.phone);
				}
				if (typeof data.gender !== 'undefined') {
					if (data.gender == 'm') {
						$("#editMemberForm select[name=gender]").val('male');
					}
					else if (data.gender == 'f') {
						$("#editMemberForm select[name=gender]").val('female');
					}
				}
				if (typeof data.dob !== 'undefined') {
					$("#editMemberForm input[name=dob]").val(data.dob);
				}
				if (typeof data.race !== 'undefined') {
					$("#editMemberForm select[name=race]").val(data.race);
				}
				if (typeof data.marital_status !== 'undefined') {
					$("#editMemberForm select[name=marital]").val(data.marital_status);
				}
				if (typeof data.education_level !== 'undefined') {
					$("#editMemberForm select[name=education]").val(data.education_level);
				}
				if (typeof data.occupation !== 'undefined') {
					$("#editMemberForm input[name=occupation]").val(data.occupation);
				}
				if (typeof data.is_active !== 'undefined') {
					if (data.is_active == 1) {
						$("#editMemberForm input[name='active'][value='1']")[0].checked = true;
					}
					else if (data.is_active == 0) {
						$("#editMemberForm input[name='active'][value='0']")[0].checked = true;
					}
				}
				if (typeof data.is_voter !== 'undefined') {
					if (data.is_voter == 1) {
						$("#editMemberForm input[name='is_voter'][value='1']")[0].checked = true;
					}
					else if (data.is_voter == 0) {
						$("#editMemberForm input[name='is_voter'][value='0']")[0].checked = true;
					}
				}
				if (typeof data.is_property_owner !== 'undefined') {
					if (data.is_property_owner == 1) {
						$("#editMemberForm input[name='propertyOwner'][value='1']")[0].checked = true;
					}
					else if (data.is_property_owner == 0) {
						$("#editMemberForm input[name='propertyOwner'][value='0']")[0].checked = true;
					}
				}

				if (data.poc)
				{
					$(".form_phone_label").text("Phone");
					$("#edit_phone").prop("required", true);
				}
				else
				{
					$(".form_phone_label").text("Phone (Optional)");
					$("#edit_phone").prop("required", false);
				}

				$("#loadingModal").modal('hide');
				$("#editMemberModal").modal('show');
			},
			error: function (jqXHR, exception) {
		        showAjaxErrorMessage(jqXHR, exception, "Maklumat tidak dijumpai. Sila cuba lagi:<br>");
		    }
		});
	});

	$(document).on("click", "#editMemberSaveBtn", function(){
		var form = document.getElementById("editMemberForm");

		if (!form.checkValidity())
		{
			form.reportValidity();
			return;
		}

		$.ajax({
			type: "POST",
			url: "/setVillagerDetail",
			data: $("#editMemberForm").serialize(),
			beforeSend: function() {
				$("editMemberModal").modal('hide');
				$("#loading_div").attr("data-text", "Disimpan..."); //Saving changes
				$("#loading_div").addClass("is-active");
			},
			success: function(data) {
				location.reload();
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Gagal disimpan:<br>"); //Gagal disimpan
		    }
		});
	});
</script>

@yield('addMemberModal')
@yield('editMemberModal')
@endsection('content')