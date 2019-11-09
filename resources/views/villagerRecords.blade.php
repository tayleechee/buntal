@extends('layouts.app')
@section('css')
<style type="text/css">
	.card {
	 	padding: 1em;
	}

	.deadIndicatorRow {
			background-color: #e8e8e8;
	}

	div.dataTables_processing {
			z-index: 1
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
		<h5>Senarai Rekod Penduduk</h5>
	</div>
	<div class="card">
	<table class="mt-4 table table-bordered table-sm" id="villagersTable">
		<thead class="thead-dark">
			<tr class="text-center">
				<th class="th-sm">No.</th>
				<th class="th-sm">Nama</th>
				<th class="th-sm">IC</th>
				<th class="th-sm">Alamat Rumah</th>
				<th class="th-sm">Jantina</th>
				<th class="th-sm">Kaum</th>
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

		var villagersTable = $('#villagersTable').DataTable({
	        processing: true,
	        serverSide: true,
	        dom: 'Bf<"col mt-2 pl-0 pr-0 d-flex justify-content-start"l>rtip',
	        buttons: [
	            {
	                extend: 'excelHtml5',
	                title: 'Senarai Penduduk',
	                exportOptions: {
	                    columns: 'th:not(:last-child, :first-child)'
	                }
	            },
	            {
	                extend: 'pdfHtml5',
	                title: 'Senarai Penduduk',
	                customize: function (doc) {
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
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
			            columns: 'th:not(:last-child, :first-child)'
			        }
	            },
	            {
	                extend: 'print',
	                title: 'Senarai Penduduk',
	                exportOptions: {
	                    columns: 'th:not(:last-child, :first-child)'
	                }
	            },
	        ],
	        ajax: '{!! route('villagerRecords.getVillagerRecords') !!}',
	        columns: [
	        	{ data: null, "orderable": false, "searchable": false},
	            { data: 'name' },
	            { data: 'ic' },
	            { data: 'house.address' },
	            { data: 'gender', "render": function(data, type, row) {
		            	if (data == 'm')
		            		{return 'Lelaki';}
		            	else if (data == 'f')
		            		{return 'Perempuan';}
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
	            						<button class="btn btn-primary btn-sm viewVillagerDetailBtn" data-id="` + data + `" data-toggle="tooltip" data-placement="right" title="View Detail"><i class="far fa-eye"></i></button>
	            					</div>
	            					`;
	            		return button;
	            	}
	            }
	        ],
	        "order": [[ 1, 'asc' ]],
	        "createdRow": function( row, data, dataIndex){
                if( data['death_date'] !== undefined && data['death_date'] !== null){
                    $(row).addClass('table-warning');
                }
            }
	    });

	    villagersTable.on( 'draw.dt', function () {
	    	$('[data-toggle="tooltip"]').tooltip({trigger : 'hover'})
	    	var info = villagersTable.page.info();
	    	var iterator = info.start;
	    	console.log(iterator);
	        villagersTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	            cell.innerHTML = iterator+1;
	            iterator++;
	        } );
	    } );
	});

	$(document).on("click", ".viewVillagerDetailBtn", function() {
		window.location.href = "/villager/"+ $(this).attr("data-id");
	});
</script>

@endsection
