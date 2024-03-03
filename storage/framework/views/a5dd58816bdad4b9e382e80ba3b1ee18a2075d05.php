<!DOCTYPE html>
<html>
<head>
<?php echo $__env->make("front.includes.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</head>
<body class="skin-blue layout-top-nav" style="height: auto; min-height: 100%;">
<div class="wrapper" style="height: auto; min-height: 100%;">
<?php echo $__env->make("front.includes.nav", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="content-wrapper" style="min-height: 308px;">
        <div class="container">
            <section class="content-header">
               <?php echo $__env->make("front.includes.contentheader", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </section>
         <?php echo $__env->yieldContent("main"); ?>

        </div>

    </div>

<?php echo $__env->make("front.includes.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>

<?php echo $__env->make("front.includes.scripts", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent("scripts"); ?>

</body>

</html>
