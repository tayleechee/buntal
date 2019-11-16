@extends('layouts.app')

@section('css')

<style type="text/css">
	body {
		height: 100vh;
	}

	#app {
		height: 100%;
	}

	.py-4 {
		height: 80%;
	    display: flex;
	    justify-content: center;
	    align-items: center;
	}
</style>

@endsection

@section('content')

<div class="container">
	<div class="text-center" style="color:green">
		<h3>Tindak Balas anda telah berjaya direkodkan!</h3>
		<h3>Terima Kasih.</h3>
	</div>

	<div class="text-center mt-4">
		<h5>Anda akan kembali ke halaman login selepas <span id="redirect_counter">10</span> saat.</h5>
		<h5>Atau klik butang di bawah untuk dialihkan semula.</h5>
	</div>

	<div class="text-center mt-4">
		<?php $base_url = url('/'); ?>
		<button class="btn btn-primary" onclick="location.href='{{$base_url}}'">Redirect</button>
	</div>
</div>

<script type="text/javascript">

	redirect_handler = function () {
		var redirect_counter_span = document.getElementById("redirect_counter");
		var countdown_counter = 10;
		redirect_counter_span.innerText = countdown_counter;

		function updateCounter() {
			countdown_counter--;
			redirect_counter_span.innerText = countdown_counter;

			if (countdown_counter > 0) {
				setTimeout(function () { updateCounter() }, 1000);
			}
			else {
				location.href = "/";
			}
		};
		setTimeout(function () { updateCounter() }, 1000);
	};

	$(document).ready(function() {
		redirect_handler();
	});
</script>

@endsection
