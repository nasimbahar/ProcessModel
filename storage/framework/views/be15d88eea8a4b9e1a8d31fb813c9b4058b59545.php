<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="<?php echo e(admin_url("processmodel/welcome")); ?>" class="navbar-brand"><b><?php echo e(config('admin.name')); ?></b></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li <?php if(isset($isphaseone)):?> class="active" <?php endif;?>><a href="<?php echo e(admin_url("processmodel/phaseone")); ?>"><?php echo e(__("front.phaseone")); ?> <span class="sr-only"></span></a></li>

                    <li <?php if(isset($isphasetwo)):?> class="active" <?php endif;?>><a href="<?php echo e(admin_url("processmodel/phasetwo")); ?>"><?php echo e(__("front.phasetwo")); ?> <span class="sr-only"></span></a></li>
                    <li <?php if(isset($isphasethree)):?> class="active" <?php endif;?>><a href="<?php echo e(admin_url("processmodel/phasethree")); ?>"><?php echo e(__("front.phasethree")); ?> <span class="sr-only"></span></a></li>
                    <li <?php if(isset($isphasefour)):?> class="active" <?php endif;?> ><a href="<?php echo e(admin_url("processmodel/phasefour")); ?>"><?php echo e(__("front.phasefour")); ?> <span class="sr-only"></span></a></li>

                    <li <?php if(isset($isphasefour)):?> class="active" <?php endif;?> ><a href="<?php echo e(admin_url("processmodel/phasefive")); ?>">Phase Five<span class="sr-only"></span></a></li>

                </ul>

            </div>

        </div>

    </nav>
</header>
