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

    fieldset.scheduler-border.highlighted-bold {
		-webkit-transition: all 0.30s ease-in-out;
		-moz-transition: all 0.30s ease-in-out;
		-ms-transition: all 0.30s ease-in-out;
		-o-transition: all 0.30s ease-in-out;
		outline: none;
		box-shadow: 2px 2px 5px #AED6F1 !important;
		border: 2px solid #AED6F1 !important;
	}
</style>
@endsection

@section('content')

<div class="container">
	<div class="mt-5 family_member_form_div">
		<div class="text-right">
		@if ( isset($villager) && empty($villager->death_date) )
		<button type="button" class="btn btn-sm btn-dark mr-1 deadBtn" id="markDeadBtn" data-toggle="modal" data-target="#markDeadModal">Sudah Meninggal</button>
		@else
		<button type="button" class="btn btn-sm btn-success mr-1 deadBtn" id="markLiveBtn" data-toggle="modal" data-target="#markLiveModal">Masih Hidup</button>
		@endif
		<button type="button" class="btn btn-sm btn-primary mr-1" id="editBtn">Ubah</button>
		<button type="button" class="btn btn-sm btn-success d-none mr-1" id="saveBtn">Simpan</button>
		<button type="button" class="btn btn-sm btn-secondary mr-1 d-none" id="cancelBtn">Batal</button>
		<button type="button" class="btn btn-sm btn-danger" id="deleteBtn" data-toggle="modal" data-target="#confirmDeleteModal">Padam</button>
		</div>
		<form id="villagerDetail_form" name="villagerDetail_form">
			{{ csrf_field() }}
		<input type="hidden" name="villager_id" id="villager_id" value="<?php echo isset($villager->id) ? $villager->id : '' ?>">
		<fieldset class="scheduler-border">
			@if ( isset($villager) && ($villager->poc))
			<legend class="family_member_legend scheduler-border">Maklumat Penduduk<span class="ketuaRumah_title"> (Ketua Rumah)</span></legend>
			@else
			<legend class="family_member_legend scheduler-border">Maklumat Penduduk</legend>
			@endif

			@if ( isset($villager) && !empty($villager->death_date) )
			<div class="form-group row pl-2 mt-3">
				<label for="occupation" class="col-form-label col-2 form_occupation_label font-weight-bold">Tarikh Meninggal</label>
				<div class="col form-nonhidden-input-div font-weight-bold">
					{{ $villager->death_date }}
				</div>
			</div>
			@endif

			<div class="form-group row pl-2 mt-3">
				<label for="name" class="col-form-label col-2 form_name_label">Nama</label>
				<div class="col form-input-col d-none">
					<input type="text" name="name" id="name" class="form-control form_name" value="<?php echo isset($villager->name) ? $villager->name : ''  ?>" required>
				</div>
				<div class="col form-input-div text-left col-form-label">
					<?php echo isset($villager->name) ? $villager->name : ''  ?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="ic" class="col-form-label col-2 form_ic_label">No. K/P</label>
				<div class="col form-input-col d-none">
					<input type="text" name="ic" id="ic" class="form-control form_ic" value="<?php echo isset($villager->ic) ? $villager->ic : ''  ?>" pattern="\d{12}" title="12 numbers without -" required>
				</div>
				<div class="col form-input-div text-left col-form-label">
					<?php echo isset($villager->ic) ? $villager->ic : ''  ?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				@if ( isset($villager->poc) )
				<label for="ic" class="col-form-label col-2 form_ic_label">Telefon</label>
				<div class="col form-input-col d-none">
					<input type="text" name="phone" id="phone" class="form-control form_phone" value="<?php echo isset($villager->phone) ? $villager->phone : ''  ?>" required>
				</div>
				@else
				<label for="ic" class="col-form-label col-2 form_ic_label">Telefon (Tidak Wajib)</label>
				<div class="col form-input-col d-none">
					<input type="text" name="phone" id="phone" class="form-control form_phone" value="<?php echo isset($villager->phone) ? $villager->phone : ''  ?>">
				</div>
				@endif
				
				<div class="col form-input-div text-left col-form-label">
					<?php echo isset($villager->phone) ? $villager->phone : ''  ?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="gender" class="col-form-label col-2 form_gender_label">Jantina</label>
				<div class="col form-input-col d-none">
					<select name="gender" id="gender" class="form-control form_gender" required>
						@if (isset($villager->gender) && ($villager->gender == 'm'))
						<option value="male" selected>Lelaki</option>
						@else
						<option value="male">Lelaki</option>
						@endif

						@if (isset($villager->gender) && ($villager->gender == 'f'))
						<option value="female" selected>Perempuan</option>
						@else
						<option value="female">Perempuan</option>
						@endif
					</select>
				</div>
				<div class="col form-input-div text-left col-form-label">
					<?php 
						if (isset($villager->gender))
						{
							if ($villager->gender == 'm') {
								echo 'Lelaki';
							}
							else if ($villager->gender == 'f') {
								echo 'Perempuan';
							}
						}
					?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="dob" class="col-form-label col-2 form_dob_label">Tarikh Lahir</label>
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
				<label for="race" class="col-form-label col-2 form_race_label">Kaum</label>
				<div class="col form-input-col d-none">
					{!! Form::select('race', ['melayu' => 'Melayu', 'cina' => 'Cina', 'india' =>  'India', 'bumiputera' => 'Bumiputera', 'lain-lain' => 'Lain-lain'], isset($villager->race) ? $villager->race : null, ['class'=>'form-control form_race', 'id'=>'race', 'required']) !!}
				</div>
				<div class="col form-input-div text-left col-form-label">
					<?php echo isset($villager->race) ? ucfirst($villager->race) : ''  ?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="marital" class="col-form-label col-2 form_marital_label">Status Perkahwinan</label>
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
				<label for="education" class="col-form-label col-2 form_education_label">Peringkat Pendidikan</label>
				<div class="col form-input-col d-none">
					{!! Form::select('education', ['Non-educated'=>'Tidak Berpendidikan Formal', 'Primary School'=>'Pendidikan Rendah', 'Secondary School'=>'Pendidikan Menengah', 'Form 6'=>'Tingkatan 6', 'Diploma'=>'Diploma', 'Degree'=>'Ijazah Sarjana Muda', 'Master'=>'Ijazah Sarjana', 'PhD'=>'Doktor Falsafah', 'N/A'=>'Tiada Kaitan'], isset($villager->education_level) ? $villager->education_level : null, ['class'=>'form-control form_education', 'id'=>'education', 'required']) !!}
				</div>
				<div class="col form-input-div">
					<?php 
						if ($villager->education_level)
						{
							switch($villager->education_level)
							{
								case 'Non-educated': 
									echo 'Tidak Berpendidikan Formal'; 
									break;
								case 'Primary School':
									echo 'Pendidikan Rendah';
									break;
								case 'Secondary School':
									echo 'Pendidikan Menengah';
									break;
								case 'Form 6':
									echo 'Tingkatan 6';
									break;
								case 'Diploma':
									echo 'Diploma';
									break;
								case 'Degree':
									echo 'Ijazah Sarjana Muda';
									break;
								case 'Master':
									echo 'Ijazah Sarjana';
									break;
								case 'PhD':
									echo 'Doktor Falsafah';
									break;
								case 'N/A':
									echo 'Tiada Kaitan';
									break;
							}
						}
					?>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label for="occupation" class="col-form-label col-2 form_occupation_label">Pekerjaan</label>
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

						<label class="custom-control-label active_yes_label" for="active_yes">Ya</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline d-none">
						@if (isset($villager->is_active) && ($villager->is_active == '0'))
						<input type="radio" id="active_no" name="active" class="custom-control-input active_no" checked value="0">
						@else
						<input type="radio" id="active_no" name="active" class="custom-control-input active_no" value="0">
						@endif
						
						<label class="custom-control-label active_no_label" for="active_no">Tidak</label>
					</div>
					<div class="col form-input-div">
						<?php 
							if (isset($villager->is_active))
							{
								if ($villager->is_active == '1') {
									echo 'Ya';
								}
								else {
									echo 'Tidak';
								}
							}
						?>
					</div>
				</div>
			</div>

			<div class="form-group row pl-2 mt-3">
				<label class="pl-3 padding-top-calc form-radio-label">Sudahkah anda daftar sebagai pengundi?</label>
				<div class="ml-3">
					<div class="custom-control custom-radio custom-control-inline d-none">
						@if (isset($villager->is_voter) && ($villager->is_voter == '1'))
						<input type="radio" id="is_voter_yes" name="is_voter" class="custom-control-input is_voter_yes" value="1" checked required>
						@else
						<input type="radio" id="is_voter_yes" name="is_voter" class="custom-control-input is_voter_yes" value="1" required>
						@endif

						<label class="custom-control-label is_voter_yes_label" for="is_voter_yes">Yes</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline d-none">
						@if (isset($villager->is_voter) && ($villager->is_voter == '0'))
						<input type="radio" id="is_voter_no" name="is_voter" class="custom-control-input is_voter_no" checked value="0">
						@else
						<input type="radio" id="is_voter_no" name="is_voter" class="custom-control-input is_voter_no" value="0">
						@endif
						
						<label class="custom-control-label is_voter_no_label" for="is_voter_no">No</label>
					</div>
					<div class="col form-input-div">
						<?php 
							if (isset($villager->is_voter))
							{
								if ($villager->is_voter == '1') {
									echo 'Ya';
								}
								else {
									echo 'Tidak';
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

						<label class="custom-control-label propertyOwner_yes_label" for="propertyOwner_yes">Ya</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline d-none">
						@if (isset($villager->is_property_owner) && ($villager->is_property_owner == '0'))
						<input type="radio" id="propertyOwner_no" name="propertyOwner" class="custom-control-input propertyOwner_no" checked value="0">
						@else
						<input type="radio" id="propertyOwner_no" name="propertyOwner" class="custom-control-input propertyOwner_no" value="0">
						@endif

						<label class="custom-control-label propertyOwner_no_label" for="propertyOwner_no">Tidak</label>
					</div>
					<div class="col form-input-div">
						<?php 
							if (isset($villager->is_property_owner))
							{
								if ($villager->is_property_owner == '1') {
									echo 'Ya';
								}
								else {
									echo 'Tidak';
								}
							}
						?>
					</div>
				</div>
			</div>
		</fieldset>
		</form>

		@if(count($villager->property) > 0) 
			<div>
				<div class="tanah_parent_div">
					@foreach ($villager->property as $property_index => $property)
					<div class="tanah_show_div mt-5">
						<div class="text-right">
							<button type="button" class="btn btn-sm btn-primary mr-1 editTanahBtn" data-id="{{$property->id}}">Ubah</button>
							<button type="button" class="btn btn-sm btn-success d-none mr-1 saveTanahBtn" data-id="{{$property->id}}">Simpan</button>
							<button type="button" class="btn btn-sm btn-secondary mr-1 d-none cancelTanahBtn" data-id="{{$property->id}}">Batal</button>
							@if ($property->image_path)
							<button type="button" class="btn btn-sm btn-warning deleteTanahPhotoBtn" data-id="{{$property->id}}">Padam Photo</button>
							@endif
							<button type="button" class="btn btn-sm btn-danger deleteTanahBtn" data-id="{{$property->id}}">Padam</button>
						</div>
					<form id="tanah_{{$property_index+1}}_form" class="tanah_form">
						{{ csrf_field() }}
						<input type="hidden" name="id" value="{{$property->id}}">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Tanah {{$property_index+1}}</legend>
						<div class="tanah_div">

							<div class="form-group row pl-2 mt-3">
								<label class="pr-2 pl-3 padding-top-calc col-2">Jenis Tanah</label>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="tanah[<?php echo $property_index+1;  ?>][ncr]" name="type" class="custom-control-input tanah" value="NCR" required <?php if($property->type == 'NCR') echo 'checked' ?> >
									<label for="tanah[<?php echo $property_index+1;  ?>][ncr]" class="custom-control-label">NCR</label>
								</div>

								<div class="custom-control custom-radio custom-control-inline">
									<input id="tanah[<?php echo $property_index+1;  ?>][geran]" name="type" type="radio" class="custom-control-input tanah" value="Geran" <?php if($property->type == 'Geran') echo 'checked' ?> >
									<label for="tanah[<?php echo $property_index+1;  ?>][geran]" class="custom-control-label">Geran</label>
								</div>

								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="tanah[<?php echo $property_index+1;  ?>][fl]" name="type" class="custom-control-input tanah" value="FL" <?php if($property->type == 'FL') echo 'checked' ?> >
									<label for="tanah[<?php echo $property_index+1;  ?>][fl]" class="custom-control-label">FL</label>
								</div>

								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="tanah[<?php echo $property_index+1;  ?>][mixzone]" name="type" class="custom-control-input tanah" value="Mix Zone" <?php if($property->type == 'Mix Zone') echo 'checked' ?> >
									<label for="tanah[<?php echo $property_index+1;  ?>][mixzone]" class="custom-control-label">Mix Zone</label>
								</div>
								<div class="col form-input-div">
									{{$property->type}}
								</div>
							</div>


							<div class="form-group row pl-2 mt-3">
								<label class="pr-2 pl-3 padding-top-calc col-2">Kawasan</label>
								<div class="col form-input-col d-none">
									<input type="text" name="kawasan" class="form-control tanah_kawasan" value="{{$property->kawasan}}" required>
								</div>
								<div class="col form-input-div">
									{{$property->kawasan}}
								</div>
							</div>

							<div class="form-group row pl-2 mt-3">
								<label class="pr-2 pl-3 padding-top-calc col-2">Keluasan (Ekar)</label>
								<div class="col form-input-col d-none">
									<input type="number" name="keluasan" class="form-control tanah_keluasan" value="{{$property->keluasan}}" step=".01" required>
								</div>
								<div class="col form-input-div">
									{{$property->keluasan}}
								</div>
							</div>

							<div class="form-group row pl-2 mt-3">
								<label class="pr-2 pl-3 padding-top-calc col-2">Photo</label>
								<div class="col form-input-col d-none">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="tanah[{{$property_index+1}}][photo]" name="photo">
									  	<label class="custom-file-label" for="tanah[{{$property_index+1}}][photo]">Choose Image (Upload only if wish to change)</label>
								  	</div>
								</div>
								<div class="col form-input-div">
									@if (!empty($property->image_path))
										<img height="350" src="{{$property->image_path}}">
									@else
										Not Available
									@endif
								</div>
							</div>
						</div>
					</fieldset>
					</form>
					</div>
					@endforeach
				</div>
			</div>
			@endif
	</div>

</div>

<!-- Mark Dead Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="markDeadModal">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		  	<div class="modal-header">
		        <h5 class="modal-title font-weight-bold">Sudah Meninggal</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		    	</button>
		  	</div>
		  	<div class="modal-body">
		    	<form id="markDeadForm">
		    		<label for="mark_death_date" class="font-weight-bold">Tarikh Meninggal:</label>
		    		<input type="date" name="mark_death_date" id="mark_death_date" class="form-control" required>
		    	</form>
		  	</div>
		  	<div class="modal-footer">
		        <button type="button" class="btn btn-success" id="confirmMarkDeadBtn">Simpan</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
		  	</div>
	    </div>
	</div>
</div>

<!-- Mark Live Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="markLiveModal">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		  	<div class="modal-header">
		        <h5 class="modal-title font-weight-bold">Masih Hidup</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		    	</button>
		  	</div>
		  	<div class="modal-body">
		    	<p class="font-weight-bold">Adakah anda pasti menyimpan rekod ini?</p><!--iniConfirm to Mark Alive-->
		  	</div>
		  	<div class="modal-footer">
		        <button type="button" class="btn btn-success" id="confirmMarkLiveBtn">Simpan</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
		  	</div>
	    </div>
	</div>
</div>

<!-- Confirm Delete Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="confirmDeleteModal">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		  	<div class="modal-header">
		        <h5 class="modal-title font-weight-bold">Memadam Maklumat Penduduk</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		    	</button>
		  	</div>
		  	<div class="modal-body">
		    	<p class="font-weight-bold">Adakah anda pasti untuk memadam maklumat penduduk ini? Tindakan ini tidak dapat diubah.</p> <!--Confirm to Delete? This cannot be undone.-->
		  	</div>
		  	<div class="modal-footer">
		        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Sah</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
		  	</div>
	    </div>
	</div>
</div>

<!-- Confirm Delete Tanah Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="confirmDeleteTanahModal">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		  	<div class="modal-header">
		        <h5 class="modal-title font-weight-bold">Memadam Maklumat Tanah</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		    	</button>
		  	</div>
		  	<div class="modal-body">
		    	<p class="font-weight-bold">Adakah anda pasti untuk memadam maklumat tanah ini? Tindakan ini tidak dapat diubah.</p> <!--Confirm to Delete? This cannot be undone.-->
		  	</div>
		  	<div class="modal-footer">
		        <button type="button" class="btn btn-danger" id="confirmDeleteTanahBtn" data-id="">Sah</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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

		var tanahForms = document.getElementsByClassName("tanah_form");
		for (var i = 0; i < tanahForms.length; i++)
		{
			$(tanahForms[i]).find(".form-control").addClass("d-none");
			$(tanahForms[i]).find(".form-input-col").addClass("d-none");
			$(tanahForms[i]).find(".custom-control").addClass("d-none");
		}
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

		$(form).find("fieldset").addClass("highlighted-bold");
		console.log($(form).find("fieldset"));
	});
	function ucfirst(string) {
	    return string.charAt(0).toUpperCase() + string.slice(1);
	}
	$(document).on("click", "#cancelBtn", function() {
		var confirm = window.confirm("Sah untuk membatal? Perubahan tidak akan disimpan.");
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
				if (typeof data.is_voter !== 'undefined') {
					if (data.is_voter == 1) {
						$("input[name='is_voter'][value='1']")[0].checked = true;
					}
					else if (data.is_voter == 0) {
						$("input[name='is_voter'][value='0']")[0].checked = true;
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

				$(form).find("fieldset").removeClass("highlighted-bold");
			},
			error: function (jqXHR, exception) {
		        showAjaxErrorMessage(jqXHR, exception, "Tidak berjaya, Sila cuba lagi:<br>"); //Failed to retrieve record. Please refresh
		    }
		});
	});
	$(document).on("click", "#saveBtn", function(){
		var confirm = window.confirm("Pasti untuk simpan perubahan?");
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
				$("#loading_div").attr("data-text", "Sila Tunggu...");
				$("#loading_div").addClass("is-active");
			},
			success: function(data) {
				location.href = '/villagerRecords';
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Tidak Berjaya:<br>");
		    }
		});
	});

	$(document).on("click", ".editTanahBtn", function() {
		var tanah_show_div = $(this).closest(".tanah_show_div");
		var form = $(tanah_show_div).find("form");

		$(form).find(".form-control").removeClass("d-none");
		$(form).find(".form-input-col").removeClass("d-none");
		$(form).find(".custom-control").removeClass("d-none");
		$(form).find(".form-input-div").addClass("d-none");
		$(form).find(".form-radio-label").removeClass("padding-top-calc");

		$(tanah_show_div).find(".deleteTanahBtn").addClass("d-none");
		$(tanah_show_div).find(".deleteTanahPhotoBtn").addClass("d-none");
		$(tanah_show_div).find(".editTanahBtn").addClass("d-none");
		$(tanah_show_div).find(".cancelTanahBtn").removeClass("d-none");
		$(tanah_show_div).find(".saveTanahBtn").removeClass("d-none");

		$(form).find("fieldset").addClass("highlighted-bold");
	});

	$(document).on("click", ".cancelTanahBtn", function(){
		var confirm = window.confirm("Confirm to cancel? Your changes will be discarded.");
		if (!confirm)
		{
			return;
		}

		var tanah_show_div = $(this).closest(".tanah_show_div");
		var form = $(tanah_show_div).find("form");

		var property_id = $(this).attr("data-id");

		$.ajax({
			type: "GET",
			url: '/getPropertyDetail',
			data: {
				id: property_id,
			},
			beforeSend: function() {
				$("#loadingModal").modal('show');
			},
			complete: function() {
				$("#loadingModal").modal('hide');
			},
			success: function(data) {
				if (typeof data.keluasan !== 'undefined') {
					$(form).find(".tanah_keluasan").val(data.keluasan);
				}
				if (typeof data.kawasan !== 'undefined') {
					$(form).find(".tanah_kawasan").val(data.kawasan);
				}
				if (typeof data.type !== 'undefined') {
					if (data.type == 'NCR') {
						$(form).find("input[name='type'][value='NCR']")[0].checked = true;
					}
					else if (data.type == 'Geran') {
						$(form).find("input[name='type'][value='Geran']")[0].checked = true;
					}
					else if (data.type == 'FL') {
						$(form).find("input[name='type'][value='FL']")[0].checked = true;
					}
					else if (data.type == 'Mix Zone') {
						$(form).find("input[name='type'][value='Mix Zone']")[0].checked = true;
					}
				}

				$(form).find(".form-control").addClass("d-none");
				$(form).find(".form-input-col").addClass("d-none");
				$(form).find(".custom-control").addClass("d-none");
				$(form).find(".form-input-div").removeClass("d-none");
				$(form).find(".form-radio-label").addClass("padding-top-calc");

				$(tanah_show_div).find(".deleteTanahBtn").removeClass("d-none");
				$(tanah_show_div).find(".deleteTanahPhotoBtn").removeClass("d-none");
				$(tanah_show_div).find(".editTanahBtn").removeClass("d-none");
				$(tanah_show_div).find(".cancelTanahBtn").addClass("d-none");
				$(tanah_show_div).find(".saveTanahBtn").addClass("d-none");

				$(form).find("fieldset").removeClass("highlighted-bold");
				
			},
			error: function (jqXHR, exception) {
		        showAjaxErrorMessage(jqXHR, exception, "Tidak berjaya, Sila cuba lagi:<br>"); //Failed to retrieve record. Please refresh
		    }
		});
	});

	$(document).on("click", ".saveTanahBtn", function(){
		var confirm = window.confirm("Confirm to save changes?");
		if (!confirm)
		{
			return;
		}

		var tanah_show_div = $(this).closest(".tanah_show_div");
		var form = $(tanah_show_div).find("form");
		var form_js = form[0];

		var property_id = $(this).attr("data-id");

		if (!form_js.checkValidity())
		{
			form_js.reportValidity();
			return;
		}

		var url = "/editPropertyDetail";

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
				window.location.reload();
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Tidak Berjaya:<br>");
		    }
		});
	});

	$(document).on("click", ".deleteTanahPhotoBtn", function(){
    	var confirm = window.confirm("Confirm to delete photo for this tanah? This cannot be undone.");
    	if (!confirm)
    	{
    		return;
    	}
    	
    	var property_id = $(this).attr("data-id");

    	$.ajax({
    		type: "GET",
    		url: "/deletePropertyPhoto",
    		data: {
    			id: property_id,
    		},
    		beforeSend: function() {
				$("#loading_div").attr("data-text", "Sila Tunggu...");
				$("#loading_div").addClass("is-active");
			},
			success: function(data) {
				window.location.reload();
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Tidak Berjaya:<br>");
		    }
    	});
    });

    $(document).on("click", ".deleteTanahBtn", function(){
    	var property_id = $(this).attr("data-id");
    	$("#confirmDeleteTanahBtn").attr("data-id", property_id);

    	$("#confirmDeleteTanahModal").modal('show');
    });

    $(document).on("click", "#confirmDeleteTanahBtn", function(){
    	var property_id = $(this).attr('data-id');

    	$.ajax({
    		type: "GET",
    		url: "/deleteProperty",
    		data: {
    			id: property_id,
    		},
    		beforeSend: function() {
				$("#loading_div").attr("data-text", "Sila Tunggu...");
				$("#loading_div").addClass("is-active");
			},
			success: function(data) {
				window.location.reload();
			},
			error: function (jqXHR, exception) {
				$("#loading_div").removeClass("is-active");
		        showAjaxErrorMessage(jqXHR, exception, "Tidak Berjaya:<br>");
		    }
    	});
    });

	$(document).on('change', '.custom-file-input', function(){
        //get the file name
        //var fileName = $(this).val();
        var fileName = $(this).val().replace('C:\\fakepath\\', "")
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
</script>
@endsection