@extends('layouts.app')

@section('content')
<!-- DataTable JS -->
<script src="{{ URL::asset('DataTables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('DataTables/FixedHeader-3.1.4/js/dataTables.fixedHeader.min.js')}}"></script>

<!-- DataTable CSS -->
<link href="{{ URL::asset('DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('DataTables/FixedHeader-3.1.4/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">

<div class="container">
	<div class="mt-3">
		<h5>View All Villager Records</h5>
	</div>

	<table class="mt-4 table table-hover table-bordered table-sm" id="villagersTable">
		<thead>
			<tr class="text-center">
				<th class="th-sm">No.</th>
				<th class="th-sm">Name</th>
				<th class="th-sm">Address</th>
				<th class="th-sm">Gender</th>
				<th class="th-sm">Race</th>
				<th class="th-sm">Action</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#viewRecordsDropdown").addClass("active");
	});
</script>

@endsection