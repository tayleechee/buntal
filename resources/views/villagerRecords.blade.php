@extends('layouts.app')
@section('css')
<style type="text/css">
  .card {
	  padding: 1em;
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
		<h5>View All Villager Records</h5>
	</div>
	<div class="card">
	<table class="mt-4 table table-hover table-bordered table-sm" id="villagersTable">
		<thead class="thead-dark">
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
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#viewRecordsDropdown").addClass("active");

		var villagersTable = $('#villagersTable').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{!! route('villagerRecords.getVillagerRecords') !!}',
	        columns: [
	        	{ data: null, "orderable": false, "searchable": false},
	            { data: 'name' },
	            { data: 'house.address' },
	            { data: 'gender', "render": function(data, type, row) {
		            	if (data == 'm') 
		            		{return 'Male';} 
		            	else if (data == 'f') 
		            		{return 'Female';}
		            	else
		            		{return data};
	            	} 
	            },
	            { data: 'race', "render": function(data, type, row) { 
	            		return data.charAt(0).toUpperCase() + data.slice(1); 
	            	} 
	            },
	            { data: 'id', "orderable": false, "searchable": false, "render": function(data, type, row) { 
	            		var button = `<div class="text-center">
	            						<button class="btn btn-outline-primary btn-sm viewVillagerDetailBtn" data-id="` + data + `">View Detail</button>
	            					</div>
	            					`;
	            		return button;
	            	}
	            }
	        ],
	        "order": [[ 1, 'asc' ]]
	    });

	    villagersTable.on( 'draw.dt', function () {
	    	var info = villagersTable.page.info();
	    	var iterator = info.start;
	    	console.log(iterator);
	        villagersTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	            cell.innerHTML = iterator+1;
	            iterator++;
	        } );
	    } ).draw();
	});

	$(document).on("click", ".viewVillagerDetailBtn", function() {
		window.location.href = "/villager/"+ $(this).attr("data-id");
	});
</script>

@endsection