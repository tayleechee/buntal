<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Buntal IS</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

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
        <!--  <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/home')); ?>">Home</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>">Login</a>

                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>">Register</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?> -->

        <div class="content">
            <div class="title m-b-md">
                Buntal Information System
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                Admin Login
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?php echo e(route('login')); ?>">
                                    <?php echo csrf_field(); ?>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                                            <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" required autocomplete="current-password">

                                            <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4 text-left">
                                            <button type="submit" class="btn btn-primary">
                                                <?php echo e(__('Login')); ?>

                                            </button>

                                            <?php if(Route::has('password.request')): ?>
                                            <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                                <?php echo e(__('Forgot Your Password?')); ?>

                                            </a>
                                            <?php endif; ?>
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
                Not admin? Fill form intead? <a href="<?php echo e(route('fillForm.step1')); ?>">Click here!</a>
            </div>
        </div>
    </div>
</body>

</html><?php /**PATH C:\Users\Elvin\Desktop\buntal\resources\views/auth/login.blade.php ENDPATH**/ ?>