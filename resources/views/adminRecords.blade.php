@extends('layouts.app')
@include('editAdminModal')
@include('addAdminModal')
@include('editAdminPasswordModal')
@section('css')
<style type="text/css">
	.card {
	 	padding: 1em;
	}

	.deadIndicatorRow {
		background-color: #e8e8e8;
	}

  	.form-input-div {
    	border: 1px solid #ced4da;
    	background: #F7F7FB ;
    	padding: .375rem 0.75rem;
    }
</style>
@endsection
@section('content')
<!-- DataTable JS -->
<script src="{{ URL::asset('DataTables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('DataTables/FixedHeader-3.1.4/js/dataTables.fixedHeader.min.js')}}"></script>

<!-- DataTable CSS -->
<link href="{{ URL::asset('DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('DataTables/FixedHeader-3.1.4/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">

<div class="container">
	<div class="mt-3">
		<h5>Senarai Rekod Admin</h5>
	</div>
	<div class="my-2 text-right">
		<button class="btn btn-outline-primary" id="addAdminBtn">Add Admin</button>
	</div>
	<div class="card">
	<table class="mt-4 table table-bordered table-sm" id="adminTable">
		<thead class="thead-dark">
			<tr class="text-center">
				<th class="th-sm">No.</th>
				<th class="th-sm">Nama</th>
				<th class="th-sm">Username</th>
				<th class="th-sm">Tindakan</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	</div>
</div>

<!-- Confirm Delete Admin Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="confirmDeleteAdminModal">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		  	<div class="modal-header">
		        <h5 class="modal-title font-weight-bold">Confirm Delete Admin?</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		    	</button>
		  	</div>
		  	<div class="modal-body">
		    	<p class="font-weight-bold">Adakah anda pasti untuk padamkan rekod admin ini?</p>
		  	</div>
		  	<div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-id="" id="confirmDeleteAdminBtn">Ya</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
		  	</div>
	    </div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#viewRecordsDropdown").addClass("active");

		var adminTable = $('#adminTable').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{!! route('adminRecords.getAdminRecords') !!}',
	        columns: [
	        	{ data: null, "orderable": false, "searchable": false},
	            { data: 'name' },
	            { data: 'username' },
	            { data: 'id', "orderable": false, "searchable": false, "render": function(data, type, row) { 
	            		var button = `<div class="text-center">
	            						<button class="btn btn-primary btn-sm editAdminDetail" data-id="` + data + `" data-toggle="tooltip" title="Edit">Edit General</button>
	            						<button class="btn btn-success btn-sm editAdminPassword" data-id="` + data + `" data-toggle="tooltip" title="Edit Password">Edit Password</button>
	            					`;
	            		if (row['is_superadmin'])
	            		{
	            			button += `</div>`;
	            		}
	            		else
	            		{
	            			button += 	`
            							<button class="btn btn-danger btn-sm deleteAdmin" data-id="` + data + `" data-toggle="tooltip" title="Delete Admin">Delete</button>
            							</div>
	            						`
	            		}
	            		return button;
	            	}
	            }
	        ],
	        "order": [[ 1, 'asc' ]],
	    });

	    adminTable.on( 'draw.dt', function () {
	    	$('[data-toggle="tooltip"]').tooltip({trigger : 'hover'})
	    	var info = adminTable.page.info();
	    	var iterator = info.start;
	        adminTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	            cell.innerHTML = iterator+1;
	            iterator++;
	        } );
	    } );
	});

	$(document).on("click", ".editAdminDetail", function(){
		var id = $(this).attr("data-id");

		$.ajax({
			type: "GET",
			url: "/getAdminDetail",
			data: {
				id: id,
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
				if (typeof data.username !== 'undefined') {
					$("#username").val(data.username);
				}
				$("#edit_id").val(data.id);
				$("#editAdminModal").modal('show');
			},
			error: function (jqXHR, exception) {
		        showAjaxErrorMessage(jqXHR, exception, "Tidak berjaya, Sila cuba lagi:<br>"); //Failed to retrieve record. Please refresh
		    }
		});
	});

	$(document).on("click", "#editAdminSaveBtn", function(){
		var form = document.getElementById("editAdminForm");

		if (!form.checkValidity())
		{
			form.reportValidity();
			return;
		}

		$.ajax({
			type: "POST",
			url: "/editAdmin",
			data: $("#editAdminForm").serialize(),
			beforeSend: function() {
				$("#loading_div").attr("data-text", "Sila Tunggu...");
				$("#loading_div").addClass("is-active");
			},
			complete: function() {
				$("#loading_div").removeClass("is-active");
			},
			success: function(data) {
				window.location.reload();
			},
			error: function (jqXHR, exception) {
		        showAjaxErrorMessage(jqXHR, exception, "Tidak berjaya, Sila cuba lagi:<br>");
		    }
		});
	});

	$(document).on("click", "#addAdminBtn", function(){
		$("#addAdminModal").modal('show');
	});

	$(document).on("click", "#addAdminSaveBtn", function(){
		var form = document.getElementById("addAdminForm");

		form.confirm_password.setCustomValidity("");

		if (!form.checkValidity())
		{
			form.reportValidity();
			return;
		}

		if (form.password.value !== form.confirm_password.value)
		{
			form.confirm_password.setCustomValidity("Password don't match!");
			form.reportValidity();
			return;
		}

		$.ajax({
			type: "POST",
			url: "/addAdmin",
			data: $("#addAdminForm").serialize(),
			beforeSend: function() {
				$("#loading_div").attr("data-text", "Sila Tunggu...");
				$("#loading_div").addClass("is-active");
			},
			complete: function() {
				$("#loading_div").removeClass("is-active");
			},
			success: function(data) {
				window.location.reload();
			},
			error: function (jqXHR, exception) {
		        showAjaxErrorMessage(jqXHR, exception, "Tidak berjaya, Sila cuba lagi:<br>");
		    }
		});
	});

	$(document).on('hidden.bs.modal', "#addAdminModal", function () {
	    $("#addAdminForm").trigger("reset");
	});

	$(document).on("click", ".deleteAdmin", function(){
		$("#confirmDeleteAdminBtn").attr("data-id", $(this).attr("data-id"));
		$("#confirmDeleteAdminModal").modal('show');
	});

	$(document).on("click", "#confirmDeleteAdminBtn", function(){
		var id = $(this).attr("data-id");

		$.ajax({
			type: "GET",
			url: "/deleteAdmin",
			data: {
				id: id,
			},
			beforeSend: function() {
				$("#loading_div").attr("data-text", "Sila Tunggu...");
				$("#loading_div").addClass("is-active");
			},
			complete: function() {
				$("#loading_div").removeClass("is-active");
			},
			success: function(data) {
				window.location.reload();
			},
			error: function (jqXHR, exception) {
		        showAjaxErrorMessage(jqXHR, exception, "Tidak berjaya, Sila cuba lagi:<br>");
		    }

		});
	});

	$(document).on("click", ".editAdminPassword", function(){
		var id = $(this).attr("data-id");

		$.ajax({
			type: "GET",
			url: "/getAdminDetail",
			data: {
				id: id,
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
					$("#edit_password_name").val(data.name);
				}
				if (typeof data.username !== 'undefined') {
					$("#edit_password_username").val(data.username);
				}
				$("#edit_password_id").val(data.id);
				$("#editAdminPasswordModal").modal('show');
			},
			error: function (jqXHR, exception) {
		        showAjaxErrorMessage(jqXHR, exception, "Tidak berjaya, Sila cuba lagi:<br>"); //Failed to retrieve record. Please refresh
		    }
		});
	});

	$(document).on("click", "#editAdminPasswordSaveBtn", function(){
		var form = document.getElementById("editAdminPasswordForm");

		form.confirm_password.setCustomValidity("");

		if (!form.checkValidity())
		{
			form.reportValidity();
			return;
		}

		if (form.password.value !== form.confirm_password.value)
		{
			form.confirm_password.setCustomValidity("Password do not match!");
			form.reportValidity();
			return;
		}

		$.ajax({
			type: "POST",
			url: "/editAdminPassword",
			data: $("#editAdminPasswordForm").serialize(),
			beforeSend: function() {
				$("#loading_div").attr("data-text", "Sila Tunggu...");
				$("#loading_div").addClass("is-active");
			},
			complete: function() {
				$("#loading_div").removeClass("is-active");
			},
			success: function(data) {
				window.location.reload();
			},
			error: function (jqXHR, exception) {
		        showAjaxErrorMessage(jqXHR, exception, "Tidak berjaya, Sila cuba lagi:<br>"); //Failed to retrieve record. Please refresh
		    }
		});
	});
</script>

@yield('editAdminModal')
@yield('addAdminModal')
@yield('editAdminPasswordModal')
@endsection
