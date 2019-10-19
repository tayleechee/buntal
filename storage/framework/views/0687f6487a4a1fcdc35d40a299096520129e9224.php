<?php $__env->startSection('content'); ?>
<div class="text-center">
	<h2>Step 1</h2>
</div>

<div class="container mt-5">
	<form action="<?php echo e(action('FillFormController@processStep1')); ?>" method="POST">
		<?php echo e(csrf_field()); ?>

		<div class="form-group row">
			<label for="step1_address" class="col-form-label font-weight-bold">Address</label>
			<input name="step1_address" id="step1_address" class="form-control <?php if ($errors->has('step1_address')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('step1_address'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old('step1_address')); ?>" required>

			<?php if ($errors->has('step1_address')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('step1_address'); ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
		</div>

		<div class="form-group row">
			<label for="step1_householdIncome" class="col-sm-2 col-form-label font-weight-bold pl-0">Household Income (RM)</label>
			<div class="col pr-0 pl-0">
				<input type="number" name="step1_householdIncome" id="step1_householdIncome" class="form-control <?php if ($errors->has('step1_householdIncome')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('step1_householdIncome'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old('step1_householdIncome')); ?>" required>

				<?php if ($errors->has('step1_householdIncome')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('step1_householdIncome'); ?>
	                <span class="invalid-feedback" role="alert">
	                    <strong><?php echo e($message); ?></strong>
	                </span>
	            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        	</div>
		</div>

		<div class="form-group row">
			<label for="step1_numberOfFamily" class="col-sm-2 col-form-label font-weight-bold pl-0">Number of Family</label>
			<div class="col pr-0 pl-0">
				<input type="number" name="step1_numberOfFamily" id="step1_numberOfFamily" class="form-control <?php if ($errors->has('step1_numberOfFamily')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('step1_numberOfFamily'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old('step1_numberOfFamily')); ?>" required>

				<?php if ($errors->has('step1_numberOfFamily')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('step1_numberOfFamily'); ?>
	                <span class="invalid-feedback" role="alert">
	                    <strong><?php echo e($message); ?></strong>
	                </span>
	            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        	</div>
		</div>

		<div class="form-group row">
			<label for="step1_numberOfFamilyMember" class="col-sm-2 col-form-label font-weight-bold pl-0">Number of Family member</label>
			<div class="col pr-0 pl-0">
				<input type="number" name="step1_numberOfFamilyMember" id="step1_numberOfFamilyMember" class="form-control <?php if ($errors->has('step1_numberOfFamilyMember')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('step1_numberOfFamilyMember'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" value="<?php echo e(old('step1_numberOfFamilyMember')); ?>" required>

				<?php if ($errors->has('step1_numberOfFamilyMember')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('step1_numberOfFamilyMember'); ?>
	                <span class="invalid-feedback" role="alert">
	                    <strong><?php echo e($message); ?></strong>
	                </span>
	            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        	</div>
		</div>

		<div class="text-center mt-5">
			<button type="submit" class="btn btn-primary">Next</button>
		</div>
	</form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Elvin\Desktop\buntal\resources\views/fillForm/step1.blade.php ENDPATH**/ ?>