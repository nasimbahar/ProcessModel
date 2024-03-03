<aside class="main-sidebar">

 
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo e(Admin::user()->avatar); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo e(Admin::user()->name); ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> <?php echo e(trans('admin.online')); ?></a>
            </div>
        </div>

        <?php if(config('admin.enable_menu_search')): ?>
        <form class="sidebar-form" style="overflow: initial;" onsubmit="return false;">
            <div class="input-group">
                <input type="text" autocomplete="off" class="form-control autocomplete" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                <ul class="dropdown-menu" role="menu" style="min-width: 210px;max-height: 300px;overflow: auto;">
                    <?php $__currentLoopData = Admin::menuLinks(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(admin_url($link['uri'])); ?>"><i class="fa <?php echo e($link['icon']); ?>"></i><?php echo e(admin_trans($link['title'])); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </form>
        <!-- /.search form -->
        <?php endif; ?>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header"><?php echo e(trans('admin.menu')); ?></li>
            <?php if(Admin::user()->is_first_login==1){?>
           <li>
               <a href="<?php echo e(admin_url('/')); ?>">
                <i class="fa fa-info"></i>
                 <span><?php echo e(__('admin.aboutus')); ?></span>
                </a>
           </li>
             <li>
               <a href="<?php echo e(admin_url('school/class')); ?>">
                <i class="fa fa-home"></i>
                 <span><?php echo e(__('admin.classes')); ?></span>
                </a>
           </li>
            <li>
               <a href="<?php echo e(admin_url('school/year')); ?>">
                <i class="fa fa-calendar"></i>
                 <span><?php echo e(__('admin.years')); ?></span>
                </a>
           </li>
            <li>
                <a href="<?php echo e(admin_url('school/shift')); ?>">
                    <i class="fa fa-clone"></i>
                    <span><?php echo e(__('admin.shift')); ?></span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(admin_url('school/section')); ?>">
                    <i class="fa fa-gg"></i>
                    <span><?php echo e(__('admin.section')); ?></span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(admin_url('school/classsection')); ?>">
                    <i class="fa  fa-gg-circle"></i>
                    <span><?php echo e(__('admin.classsection')); ?></span>
                </a>
            </li>

            <li>
               <a href="" onclick='loadstart()'>
                <i class="fa fa-hourglass-start"></i>
                 <span><?php echo e(__('admin.start')); ?></span>
                </a>
           </li>


         <?php }else{?>
            <?php echo $__env->renderEach('admin::partials.menu', Admin::menu(), 'item'); ?>
         <?php }?>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>