@extends('layouts.app')
@section('css')
<style type="text/css">
	.card {
	 	padding: 1em;
	}

	div.dataTables_processing {
		z-index: 1
	}

	/*.mfp-zoom-out-cur {
		cursor: default !important;
	}*/

	.mfp-zoom-out-cur .mfp-image-holder .mfp-close {
		cursor: pointer !important;
	}

	.mfp-fade.mfp-bg {
	  opacity: 0;

	  -webkit-transition: all 0.15s ease-out;
	  -moz-transition: all 0.15s ease-out;
	  transition: all 0.15s ease-out;
	}
	/* overlay animate in */
	.mfp-fade.mfp-bg.mfp-ready {
	  opacity: 0.8;
	}
	/* overlay animate out */
	.mfp-fade.mfp-bg.mfp-removing {
	  opacity: 0;
	}

	/* content at start */
	.mfp-fade.mfp-wrap .mfp-content {
	  opacity: 0;

	  -webkit-transition: all 0.15s ease-out;
	  -moz-transition: all 0.15s ease-out;
	  transition: all 0.15s ease-out;
	}
	/* content animate it */
	.mfp-fade.mfp-wrap.mfp-ready .mfp-content {
	  opacity: 1;
	}
	/* content animate out */
	.mfp-fade.mfp-wrap.mfp-removing .mfp-content {
	  opacity: 0;
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

<link rel="stylesheet" href="{{ asset('welcome_assets/css/magnific-popup.css') }}">
<script src="{{ asset('welcome_assets/js/jquery.magnific-popup.min.js') }}"></script>

<div class="container">
	<div class="mt-3">
		<h5>Senarai Harta Tanah</h5>
	</div>
	<div class="card">
	<table class="mt-4 table table-bordered table-sm" id="propertyTable">
		<thead class="thead-dark">
			<tr class="text-center">
				<th class="th-sm">No.</th>
				<th class="th-sm">Pemilik</th>
				<th class="th-sm">Type</th>
				<th class="th-sm">Kawasan</th>
				<th class="th-sm">Keluasan</th>
				<th class="th-sm">Tindakan</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	</div>
</div>

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      	<div class="modal-header">
	        <h5 class="modal-title">Photo Tanah</h5>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>        
	    </div>
      	<div class="modal-body" id="imagemodal_modal_body">
        	<img src="" id="image_modal_image" style="width: 100%; height: auto;">
      	</div>
      	<!-- <div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      	</div> -->
    </div>
  </div>
</div>

<!--====== Isotope js ======-->
<script src="{{ asset('welcome_assets/js/isotope.pkgd.min.js') }}"></script>

<!--====== Images Loaded js ======-->
<script src="{{ asset('welcome_assets/js/imagesloaded.pkgd.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#viewRecordsDropdown").addClass("active");

		var propertyTable = $('#propertyTable').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{!! route('propertyRecords.getPropertyRecords') !!}',
	        dom: 'Bf<"col mt-2 pl-0 pr-0 d-flex justify-content-start"l>rtip',
	        buttons: [
	            {
	                extend: 'excelHtml5',
	                title: 'Senarai Harta Tanah',
	                exportOptions: {
	                    columns: 'th:not(:last-child)'
	                }
	            },
	            {
	                extend: 'pdfHtml5',
	                title: 'Senarai Harta Tanah',
	                customize: function (doc) {
						//doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
						doc.content[1].table.widths = [ '5%', '30%', '15%', '40%', '10%'];
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
	                title: 'Senarai Harta Tanah',
	                exportOptions: {
	                    columns: 'th:not(:last-child)'
	                }
	            },
	        ],
	        columns: [
	        	{ data: "id", "defaultContent": '', "orderable": false, "searchable": false},
	        	{ data: 'villager.name'},
	        	{ data: 'type' },
	        	{ data: 'kawasan' },
	        	{ data: 'keluasan', "searchable":false },
	        	{ data: 'image_path', "orderable": false, "searchable": false, "render": function(data, type, row) { 
	        			var button;
	        			if (data)
	        			{
	        				button = `	<div class="d-flex justify-content-center">
		            						<div class="text-center mr-1">
		            							<button class="btn btn-outline-secondary btn-sm viewVillagerDetailBtn" data-id="` + row['villager_id'] + `" data-toggle="tooltip" data-placement="right" title="View Pemilik Detail">Lihat Butiran Pemilik</button>
		            						</div>
		            						<div class="text-center">
		            							<a class="btn btn-outline-primary btn-sm viewPhotoBtn" href="` + data + `" data-id="` + data + `" data-toggle="tooltip" data-placement="right" title="View House Photo">Lihat Photo Tanah</a>
		            						</div>
	            						</div>
	            					`;
	        			}
	        			else
	        			{
	        				button = `	<div class="d-flex justify-content-center">
		            						<div class="text-center">
		            							<button class="btn btn-outline-secondary btn-sm viewVillagerDetailBtn" data-id="` + row['villager_id'] + `" data-toggle="tooltip" data-placement="right" title="View Pemilik Detail">Lihat Butiran Pemilik</button>
		            						</div>
	            						</div>
	            					`;
	        			}
	            		return button;
	            	}
	            }
	        ],
	        "order": [[ 1, 'asc' ]],
	    });

	    propertyTable.on( 'draw.dt', function () {
	    	$('[data-toggle="tooltip"]').tooltip({trigger : 'hover'})
	    	var info = propertyTable.page.info();
	    	var iterator = info.start;
	        propertyTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	            cell.innerHTML = iterator+1;
	            propertyTable.cell(cell).invalidate('dom');
	            iterator++;
	        } );
	        $('.viewPhotoBtn').magnificPopup({
			  type: 'image',
			  tLoading: 'Loading...',
			  image: {
			  	tError: '<a href="%url%">The image</a> could not be loaded: 404 Not Found'
			  },
			  mainClass: 'mfp-fade',
			  removalDelay: 300,
			});
	    } );
	});

	/*$(document).on("click", ".viewPhotoBtn", function() {
		$("#image_modal_image").attr("src", $(this).attr("data-id"));
		$("#loadingModal").modal('show');

		$('#imagemodal_modal_body').imagesLoaded()
		  .done( function( instance ) {
		    $("#loadingModal").modal('hide');
		    $("#imagemodal").modal('show');
		  })
		  .fail( function() {
		    $("#loadingModal").modal('hide');
		    showErrorMessage("Unable to show photo:<br>404 Not Found");
		  })
	});*/

	$(document).on("click", ".viewVillagerDetailBtn", function() {
		window.location.href = "villager/"+ $(this).attr("data-id");
	});
</script>

@endsection