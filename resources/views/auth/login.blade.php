<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>e-Buntal</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-image: url('image/login.jpg');
            background-size: 100% 100%;
            color: black;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
            background-color: rgb(0, 0, 0, 0.7);
            padding: 2em;
            border-radius: 15px;
        }

        .title {
            font-size: 65px;
            padding-left: 4em;
            padding-right: 4em;
            color: #fff;
            position: relative;
            margin: 0 auto 1em;
            text-align: center;
            text-transform: uppercase;
        }

        .title:after {
            position: absolute;
            top: 100%;
            left: 50%;
            width: 240px;
            height: 4px;
            margin-left: -120px;
            content: '';
            background-color: #fff;
        }

        :after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        /*.links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }*/

        .m-b-md {
            margin-bottom: 30px;
        }

        .card-header {
            background-color:rgb(45, 89, 134);
            font-size: 2em;
            color: #fff;
        }

        a {
            color: cyan;
        }

        a:hover {
            color: cyan;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <!--  @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif -->

        <div class="content">
            <div class="title m-b-md">e-Buntal</div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                Admin Login
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                        <div class="col-md-6">
                                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Kata Laluan') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4 text-left">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Log Masuk') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Lupa Kata Laluan?') }}
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="links">
                    <a href="" class="btn btn-secondary">Form Insertion</a>
                </div> -->
            <div class="mt-4" style="color:white">
                Bukan admin? Sila isi borang. <a href="{{route('fillForm.step1')}}">Klik sini!</a> 
                <p>Atau kembali ke halaman
                <a href="/welcome">Buntal.</a></p>
            </div>
           
        </div>
    </div>
</body>

</html>