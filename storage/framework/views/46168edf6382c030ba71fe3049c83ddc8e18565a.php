<?php $__env->startSection('content'); ?>
<div class="container">

    <?php if(isset($chart)): ?>    
    <div class="row">
        <div class="col-12" >
          <?php echo $chart->container(); ?>

        </div>
    </div>
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <?php echo $chart->script(); ?>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Elvin\Desktop\buntal\resources\views/statisticsGraph.blade.php ENDPATH**/ ?>