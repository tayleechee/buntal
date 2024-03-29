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
<script src="{{ URL::asset('DataTables/Buttons-1.6.1/js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('DataTables/pdfmake/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('DataTables/pdfmake/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('DataTables/jszip.min.js')}}"></script>
<script src="{{ URL::asset('DataTables/Buttons-1.6.1/js/buttons.flash.min.js')}}"></script>
<script src="{{ URL::asset('DataTables/Buttons-1.6.1/js/buttons.html5.min.js')}}"></script>
<script src="{{ URL::asset('DataTables/Buttons-1.6.1/js/buttons.print.min.js')}}"></script>

<!-- DataTable CSS -->
<link href="{{ URL::asset('DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('DataTables/FixedHeader-3.1.4/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('DataTables/Buttons-1.6.1/css/buttons.dataTables.min.css')}}">

<div class="container">
	<div class="mt-3">
		<h5>Senarai Rekod Rumah</h5>
	</div>
	<div class="card">
	<table class="mt-4 table table-bordered table-sm" id="housesTable">
		<thead class="thead-dark">
			<tr class="text-center">
				<th class="th-sm">No.</th>
				<th class="th-sm">Alamat Rumah</th>
				<th class="th-sm">No. Keluarga</th>
				<th class="th-sm">No. Ahli Keluarga</th>
				<th class="th-sm">Pendapatan Isi Rumah Bulanan (RM)</th>
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
	        dom: 'Bf<"col mt-2 pl-0 pr-0 d-flex justify-content-start"l>rtip',
	        buttons: [
	            {
	                extend: 'excelHtml5',
	                title: 'Senarai Rekod Rumah',
	                exportOptions: {
	                    columns: 'th:not(:last-child)'
	                }
	            },
	            {
	                extend: 'pdfHtml5',
	                title: 'Senarai Rekod Rumah',
	                customize: function (doc) {
						//doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
						doc.content[1].table.widths = [ '5%', '50%', '10%', '10%', '25%'];
						var objLayout = {};
						objLayout['hLineWidth'] = function(i) { return .5; };
						objLayout['vLineWidth'] = function(i) { return .5; };
						objLayout['hLineColor'] = function(i) { return '#aaa'; };
						objLayout['vLineColor'] = function(i) { return '#aaa'; };
						objLayout['paddingLeft'] = function(i) { return 4; };
						objLayout['paddingRight'] = function(i) { return 4; };
						doc.content[1].layout = objLayout;
					},
	                exportOptions: {
			            columns: 'th:not(:last-child)'
			        }
	            },
	            {
	                extend: 'print',
	                title: 'Senarai Rekod Rumah',
	                exportOptions: {
	                    columns: 'th:not(:last-child)'
	                }
	            },
	        ],
	        columns: [
	        	{ data: 'id', "defaultContent":'', "orderable": false, "searchable": false},
	            { data: 'address' },
	            { data: 'family_number' , "searchable": false},
	            { data: 'alive_villagers_count', "searchable": false},
	            { data: 'household_income', "searchable": false, "render": function(data, type, row){
	            		return "RM " + data;
		            }
		        },
	            { data: 'id', "orderable": false, "searchable": false, "render": function(data, type, row) { 
	            		var button = `<div class="text-center">
	            						<button class="btn btn-primary btn-sm viewHouseDetailBtn" data-id="` + data + `" data-toggle="tooltip" data-placement="right" title="Papar Maklumat"><i class="far fa-eye"></i></button>
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
	            housesTable.cell(cell).invalidate('dom');
	            iterator++;
	        } );
	    } );
	});

	$(document).on("click", ".viewHouseDetailBtn", function() {
		window.location.href = "house/"+ $(this).attr("data-id");
	});
</script>

@endsection
