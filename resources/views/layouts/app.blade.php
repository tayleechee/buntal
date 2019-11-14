<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Jquery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>

    <!-- Popper JS -->
    <script src="{{ asset('js/popper.min.js') }}"></script>

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-4.3.1-dist/css/bootstrap.min.css') }}"> -->

    <!-- Bootstrap JS -->
    <script src="{{ asset('bootstrap-4.3.1-dist/js/bootstrap.min.js') }}"></script>

    <!-- FontAwesome CSS -->
    <link href="{{ asset('fontawesome-free-5.11.2-web/css/all.css') }}" rel="stylesheet">

    <!-- FontAwesome JS -->
    <script defer src="{{ asset('fontawesome-free-5.11.2-web/js/all.js') }}"></script>

    <!-- CSS Loader -->
    <link href="{{ asset('css-loader/css-loader.css') }}" rel="stylesheet">

    <!-- loaders-css CSS -->
    <link href="{{ asset('loaders-css/loaders.min.css') }}" rel="stylesheet">

    <!-- loaders-css JS -->
    <script src="{{ asset('loaders-css/loaders.css.js') }}"></script>

    <!-- Google Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style type="text/css">

        #errorModal .modal-confirm .modal-content {
            padding: 20px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            text-align: center;
        }
        #errorModal .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
            text-align: center;
            margin: -20px -20px 0;
            border-radius: 5px 5px 0 0;
            padding: 35px;
        }
        #errorModal .modal-confirm h4 {
            text-align: center;
            font-size: 36px;
            margin: 10px 0;
        }
        #errorModal .modal-confirm .form-control, .modal-confirm .btn {
            min-height: 40px;
            border-radius: 3px;
        }
        #errorModal .modal-confirm .close {
            position: absolute;
            top: 15px;
            right: 15px;
            text-shadow: none;
            opacity: 0.5;
        }
        #errorModal .modal-confirm .close:hover {
            opacity: 0.8;
        }
        #errorModal .modal-confirm .icon-box {
            width: 95px;
            height: 95px;
            display: inline-block;
            border-radius: 50%;
            z-index: 9;
            color: #f15e5e;
            border: 5px solid #f15e5e;
            padding: 15px;
            text-align: center;
        }
        #errorModal .modal-confirm .icon-box i {
            font-size: 58px;
            margin: -2px 0 0 -2px;
        }
        #errorModal .modal-confirm.modal-dialog {
            margin-top: 80px;
        }
        #errorModal .modal-confirm .modal-footer {
            padding-bottom: 0px;
        }
        #errorModal_msg {
            font-size: 20px;
            color: #808080
        }

        @keyframes spinner-border {
          to {
            transform: rotate(360deg);
          }
        }

        .spinner-border {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            vertical-align: text-bottom;
            border: .25em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            -webkit-animation: spinner-border .75s linear infinite;
            animation: spinner-border .75s linear infinite;
        }

        /*.navbar-nav li:hover > ul.dropdown-menu {
            display:block;
        }*/

        .navbar-nav li.dropdown-submenu:hover > ul.dropdown-menu {
            display:block;
        }

        .dropdown-submenu{
            position:relative;
        }

        .dropdown-submenu>.dropdown-menu{
            top:0;
            left:100%;
            margin-top:-9px;
        }



    </style>

    @yield('css')
</head>
<body>
    <div id="loading_div" class="loader loader-default" data-text="Loading"></div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                @auth
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="ml-3 nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="viewRecordsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Paparan Rekod
                            </a>
                            <div class="dropdown-menu" aria-labelledby="viewRecordsDropdown">
                              <a class="dropdown-item" href="{{route('villagerRecords.index')}}">Penduduk</a>
                              <a class="dropdown-item" href="{{route('houseRecords.index')}}">Rumah</a>
                              <a class="dropdown-item" href="{{route('ketuaRumahRecords.index')}}">Ketua Rumah</a>

                              @if (Auth::user()->is_superadmin)
                              <a class="dropdown-item" href="{{route('adminRecords.index')}}">Admin</a>
                              @endif
                            </div>
                        </li>                        
						<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle ml-3" href="{{route('statistics.index')}}" id="viewStatisticsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Statistik</a>
                            <ul class="dropdown-menu" aria-labelledby="viewStatisticsDropdown">
                                <li class="dropdown-submenu">
                                    <div class="btn-group dropright">
                                        <a href="#" class="dropdown-item dropdown-toggle">Populasi</a>
                                    </div>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{route('statistics.populationByGender')}}">Mengikut Jantina</a></li>
                                        <li><a class="dropdown-item" href="{{route('statistics.populationByRace')}}">Mengikut Kaum</a></li>
                                        <li><a class="dropdown-item" href="{{route('statistics.populationByAgeRange')}}">Mengikut Kumpulan Umur</a></li>
                                        <li><a class="dropdown-item" href="{{route('statistics.populationByEducationLevel')}}">Mengikut Tahap Pendidikan</a></li>
                                        <li><a class="dropdown-item" href="{{route('statistics.populationByMaritalStatus')}}">Mengikut Status Perkahwinan</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <div class="btn-group dropright">
                                        <a href="#" class="dropdown-item dropdown-toggle" >Bilangan Kelahiran</a>
                                    </div>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#BirthRateByYear">Mengikut Tahun</a></li>
                                        <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#BirthRateByRangeOfYears">Mengikut Lingkungan Tahun</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <div class="btn-group dropright">
                                        <a href="#" class="dropdown-item dropdown-toggle">Bilangan Kematian</a>
                                    </div>
                                    <ul class="dropdown-menu">
										<li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#DeathRateByYear">Mengikut Tahun</a></li>
										<li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#DeathRateByRangeOfYears">Mengikut Lingkungan Tahun</a></li>
                                    </ul>
                                </li>								
								<li><a class="dropdown-item" href="{{route('statistics.propertyPossession')}}">Pemilikan Harta Tanah</a></li>
								<li><a class="dropdown-item" href="{{route('statistics.voter')}}">Pendaftaran sebagai Pengundi</a></li>
                                <li><a class="dropdown-item" href="{{route('statistics.monthlyHouseholdIncome')}}">Pendapatan Isi Rumah Bulanan</a></li>
                            </ul>
                        </li>
						<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle ml-3" href="{{route('dynamicpdf.summaryReport')}}" id="generateReportDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Laporan Terkini</a>
                            <ul class="dropdown-menu" aria-labelledby=generateReportDropdown">
								<li><a class="dropdown-item" href="{{route('dynamicpdf.summaryReport')}}">Ringkasan Laporan Demografi</a></li>
								<li><a class="dropdown-item" href="{{route('dynamicpdf.general')}}">Ringkasan Data Penduduk</a></li>
								<li><a class="dropdown-item" href="{{route('dynamicpdf.voterReport')}}">Pendaftaran sebagai Pengundi</a></li>
                                <li><a class="dropdown-item" href="{{route('dynamicpdf.populationReport')}}">Populasi</a></li>
                                <li><a class="dropdown-item" href="{{route('dynamicpdf.newborn')}}">Kelahiran Bayi</a></li>
								<li><a class="dropdown-item" href="{{route('dynamicpdf.death')}}">Kematian</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </nav>

        <main class="py-4">
            @include('flash::message')
            @yield('content')
        </main>
    </div>

    <!-- Birth Rate: By Year -->
    <div class="modal fade" id="BirthRateByYear" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><strong>Bilangan Kelahiran mengikut Tahun</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h6>Sila nyatakan tahun untuk carian.</h6>
            <form id="birthByYearForm" method="POST" action="{{url('/statistics/birthRateByYear')}}">
                @csrf
                <div style="margin:10px 0 20px;">
                    Tahun:
                    <input id="birthYear" name="year" class="form-control col-2" style="display:inline;margin:0 20px;" required />
                    <button type="submit" class="btn btn-primary">Hantar</button>
                </div>
            </form>
        </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
        </div>
    </div>
    </div>

    <!-- Birth Rate: By Range Of Year -->
    <div class="modal fade" id="BirthRateByRangeOfYears" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><strong>Bilangan Kelahiran mengikut Lingkungan Tahun</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Sila nyatakan lingkungan tahun untuk carian.</h6>
                <form method="POST" action="{{url('/statistics/birthRateByRangeOfYears')}}">
				@csrf
				<div style="margin:10px 0 20px;">
					Dari Tahun
					<input id="birthStartYear" name="startYear" class="form-control col-2" style="display:inline;margin:0 20px;" />
					Hingga Tahun
					<input id="birthEndYear" name="endYear" class="form-control col-2" style="display:inline;margin-left:20px;" />
				</div>
				<div class="text-right">
                    <button id="submitBirthRangeBtn" class="btn btn-primary">Hantar</button>
                </div>
			</form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
    </div>

    <!-- Death Rate: By Year -->
    <div class="modal fade" id="DeathRateByYear" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><strong>Bilangan Kematian mengikut Tahun</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Sila nyatakan tahun untuk carian.</h6>
                <form id="deathByYearForm" method="POST" action="{{url('/statistics/deathRateByYear')}}">
					@csrf
					<div style="margin:10px 0 20px;">
						Tahun:
						<input id="deathYear" name="year" class="form-control col-2" style="display:inline;margin:0 20px;" required />
						<button type="submit" class="btn btn-primary">Hantar</button>
					</div>
				</form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
    </div>

    <!-- Death Rate: By Range Of Year -->
    <div class="modal fade" id="DeathRateByRangeOfYears" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><strong>Bilangan Kematian mengikut Lingkungan Tahun</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Sila nyatakan lingkungan tahun untuk carian.</h6>
                <form method="POST" action="{{url('/statistics/deathRateByRangeOfYears')}}">
				@csrf
				<div style="margin:10px 0 20px;">
					Dari Tahun
					<input id="deathStartYear" name="startYear" class="form-control col-2" style="display:inline;margin:0 20px;" />
					Hingga Tahun
					<input id="deathEndYear" name="endYear" class="form-control col-2" style="display:inline;margin-left:20px;" />
				</div>
                <div class="text-right">
				    <button id="submitDeathRangeBtn" class="btn btn-primary">Hantar</button>
                </div>
			    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
                </div>
            </div>
        </div>

    <div id="errorModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <div class="icon-box">
                        <i class="material-icons">&#xe000;</i>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p id="errorModal_msg">Error</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body text-center">
            <div class="spinner-border my-2" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            <!-- <div class="loader-inner ball-pulse my-2"></div> -->
            <div clas="loader-txt">
              <p id="loadingModal_msg" style="font-weight: 600">Loading...</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    @yield('template')

    <script type="text/javascript">
		$('#submitBirthRangeBtn').click(function (e) {
			if ($('#birthStartYear').val() == $('#birthEndYear').val()) {
				e.preventDefault();
				$('#birthYear').val($('#birthStartYear').val());
				$('#birthByYearForm').submit();
			}
			else
				$(this).form.submit();
		});
		$('#submitDeathRangeBtn').click(function (e) {
			if ($('#deathStartYear').val() == $('#deathEndYear').val()) {
				e.preventDefault();
				$('#deathYear').val($('#deathStartYear').val());
				$('#deathByYearForm').submit();
			}
			else
				$(this).form.submit();
		});
        function showAjaxErrorMessage(jqXHR, exception, extra_msg) {
            if (extra_msg === undefined)
            {
                extra_msg = false;
            }

            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connected. Please verify your network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (jqXHR.status == 422) {
                msg = 'Invalid Form Data. Please make sure all fields are filled';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = $.parseJSON(jqXHR.responseText);
            }
            $('#errorModal_msg').html(extra_msg+msg);
            $('#errorModal').modal('show');
        }

        $(function () {
            $('#flash-overlay-modal').modal();
            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
            $('[data-toggle="tooltip"]').tooltip({trigger : 'hover'})
        })
    </script>
    <!-- <script>
        $(".dropdown-toggle").on("mouseenter", function () {
            // make sure it is not shown:
            if (!$(this).parent().hasClass("show")) {
                $(this).click();
            }
        });

        $(".btn-group, .dropdown").on("mouseleave", function () {
        // make sure it is shown:
          if ($(this).hasClass("show")){
            $(this).children('.dropdown-toggle').first().click();
        }
        });
    </script> -->

</body>
</html>
