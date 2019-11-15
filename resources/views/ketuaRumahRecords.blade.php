@extends('layouts.app')
@section('css')
<style type="text/css">
	.card {
	 	padding: 1em;
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
		<h5>Senarai Ketua Rumah</h5>
	</div>
	<div class="card">
	<table class="mt-4 table table-bordered table-sm" id="ketuaRumahTable">
		<thead class="thead-dark">
			<tr class="text-center">
				<th class="th-sm">No.</th>
				<th class="th-sm">Nama</th>
				<th class="th-sm">Alamat Rumah</th>
				<th class="th-sm">No. K/P</th>
				<th class="th-sm">Telefon</th>
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

		var ketuaRumahTable = $('#ketuaRumahTable').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{!! route('ketuaRumahRecords.getKetuaRumahRecords') !!}',
	        dom: 'Bf<"col mt-2 pl-0 pr-0 d-flex justify-content-start"l>rtip',
	        buttons: [
	            {
	                extend: 'excelHtml5',
	                title: 'Senarai Ketua Rumah',
	                exportOptions: {
	                    columns: 'th:not(:last-child, :first-child)'
	                }
	            },
	            {
	                extend: 'pdfHtml5',
	                title: 'Senarai Ketua Rumah',
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
	                title: 'Senarai Ketua Rumah',
	                exportOptions: {
	                    columns: 'th:not(:last-child, :first-child)'
	                }
	            },
	        ],
	        columns: [
	        	{ data: null, "orderable": false, "searchable": false},
	        	{ data: 'villager.name'},
	        	{ data: 'house.address' },
	        	{ data: 'villager.ic' },
	        	{ data: 'villager.phone'},
	        	{ data: 'house_id', "orderable": false, "searchable": false, "render": function(data, type, row) {
	            		var button = `	<div class="d-flex justify-content-center">
	            						<div class="text-center mr-1">
	            							<button class="btn btn-outline-primary btn-sm viewHouseDetailBtn" data-id="` + data + `" data-toggle="tooltip" data-placement="right" title="Lihat Butiran Rumah">Lihat Butiran Rumah</button>
	            						</div>
	            						<div class="text-center">
	            							<button class="btn btn-outline-secondary btn-sm viewVillagerDetailBtn" data-id="` + row['villager_id'] + `" data-toggle="tooltip" data-placement="right" title="Lihat Butiran Individual">Lihat Butiran Individual</button>
	            						</div>
	            						</div>
	            					`;
	            		return button;
	            	}
	            }
	        ],
	        "order": [[ 1, 'asc' ]],
	    });

	    ketuaRumahTable.on( 'draw.dt', function () {
	    	$('[data-toggle="tooltip"]').tooltip({trigger : 'hover'})
	    	var info = ketuaRumahTable.page.info();
	    	var iterator = info.start;
	        ketuaRumahTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	            cell.innerHTML = iterator+1;
	            iterator++;
	        } );
	    } );
	});

	$(document).on("click", ".viewHouseDetailBtn", function() {
		window.location.href = "/house/"+ $(this).attr("data-id");
	});

	$(document).on("click", ".viewVillagerDetailBtn", function() {
		window.location.href = "/villager/"+ $(this).attr("data-id");
	});
</script>

@endsection
