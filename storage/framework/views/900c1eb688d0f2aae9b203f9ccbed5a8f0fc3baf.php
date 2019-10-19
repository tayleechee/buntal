<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <!-- <script src="<?php echo e(asset('js/app.js')); ?>" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    <!-- Jquery -->
    <script src="<?php echo e(asset('js/jquery-3.4.1.min.js')); ?>"></script>

    <!-- Popper JS -->
    <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>

    <!-- Bootstrap JS -->
    <script src="<?php echo e(asset('bootstrap-4.3.1-dist/js/bootstrap.min.js')); ?>"></script>

    <!-- FontAwesome CSS -->
    <link href="<?php echo e(asset('fontawesome-free-5.11.2-web/css/all.css')); ?>" rel="stylesheet">

    <!-- FontAwesome JS -->
    <script defer src="<?php echo e(asset('fontawesome-free-5.11.2-web/js/all.js')); ?>"></script>

    <!-- CSS Loader -->
    <link href="<?php echo e(asset('css-loader/css-loader.css')); ?>" rel="stylesheet">

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
    </style>

    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
    <div id="loading_div" class="loader loader-default" data-text="Loading"></div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <?php echo e(config('app.name', 'Laravel')); ?>

                </a>

                <?php if(auth()->guard()->check()): ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="ml-3 nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="viewRecordsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              View Records
                            </a>
                            <div class="dropdown-menu" aria-labelledby="viewRecordsDropdown">
                              <a class="dropdown-item" href="<?php echo e(route('villagerRecords.index')); ?>">Villagers</a>
                              <a class="dropdown-item" href="#">Houses</a>
                            </div>
                        </li>
                        <li class="ml-3 nav-item">
                            <a href="#" class="nav-link">Generate Report</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </nav>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
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

    <?php echo $__env->yieldContent('template'); ?>

    <script type="text/javascript">
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
          $('[data-toggle="tooltip"]').tooltip({trigger : 'hover'})
        })
    </script>
</body>
</html>
<?php /**PATH C:\Users\Elvin\Desktop\buntal\resources\views/layouts/app.blade.php ENDPATH**/ ?>