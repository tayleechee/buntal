@extends('layouts.app')
@section('css')
<style type="text/css">
  .card {
	 	padding: 1em;
  }

  .deadIndicatorRow {
  		background-color: #e8e8e8;
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
		<h5>Ketelitian Rekod Rumah</h5>
	</div>
	<div class="card">
	<table class="mt-4 table table-bordered table-sm" id="housesTable">
		<thead class="thead-dark">
			<tr class="text-center">
				<th class="th-sm">Bil.</th>
				<th class="th-sm">Alamat</th>
				<th class="th-sm">Bil. Keluarga</th>
				<th class="th-sm">Bil. Ahli Keluarga</th>
				<th class="th-sm">Pendapatan Isi Rumah (RM) </th>
				<th class="th-sm">Tindakan</th>
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

		var housesTable = $('#housesTable').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{!! route('houseRecords.getHouseRecords') !!}',
	        columns: [
	        	{ data: null, "orderable": false, "searchable": false},
	            { data: 'address' },
	            { data: 'family_number' , "searchable": false},
	            { data: 'alive_villagers_count', "searchable": false},
	            { data: 'household_income', "searchable": false, "render": function(data, type, row){
	            		return "RM " + data;
		            }
		        },
	            { data: 'id', "orderable": false, "searchable": false, "render": function(data, type, row) { 
	            		var button = `<div class="text-center">
	            						<button class="btn btn-primary btn-sm viewHouseDetailBtn" data-id="` + data + `" data-toggle="tooltip" data-placement="right" title="View Detail"><i class="far fa-eye"></i></button>
	            					</div>
	            					`;
	            		return button;
	            	}
	            }
	        ],
	        "order": [[ 1, 'asc' ]],
	    });

	    housesTable.on( 'draw.dt', function () {
	    	$('[data-toggle="tooltip"]').tooltip({trigger : 'hover'})
	    	var info = housesTable.page.info();
	    	var iterator = info.start;
	    	console.log(iterator);
	        housesTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	            cell.innerHTML = iterator+1;
	            iterator++;
	        } );
	    } );
	});

	$(document).on("click", ".viewHouseDetailBtn", function() {
		window.location.href = "/house/"+ $(this).attr("data-id");
	});
</script>

@endsection
