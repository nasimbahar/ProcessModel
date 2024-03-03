<?php $__env->startSection("main"); ?>

    <section class="content" style="min-height: 600px">

        <div class="callout callout-info">
          <center> <h1><?php echo e(config("admin.researchtitle")); ?></h1></center>
        </div>
        <div class="col-md-4" ></div>
        <div class="col-md-4" >
        <a href="<?php echo e(admin_url("processmodel/phaseone")); ?>"  >
            <button type="button" class="btn btn-block btn-success btn-lg"><?php echo e(__("front.start")); ?></button>
        </a>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("front.layout", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>