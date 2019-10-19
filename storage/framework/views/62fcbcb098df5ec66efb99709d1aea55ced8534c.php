<?php $__env->startSection('content'); ?>
<div class="container">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    You are logged in!
                </div>
            </div>
        </div>
    </div> -->
    <?php if( isset($chart) && isset($chart2) && isset($chart3) ): ?>    
    <div class="row">
        <div class="col-4" >
          <?php echo $chart->container(); ?>


        </div>
        <div class="col-4" >
          <?php echo $chart2->container(); ?>

        </div>
        <div class="col-4">
          <?php echo $chart3->container(); ?>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <?php echo $chart->script(); ?>

    <?php echo $chart2->script(); ?>

    <?php echo $chart3->script(); ?>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Elvin\Desktop\buntal\resources\views/home.blade.php ENDPATH**/ ?>