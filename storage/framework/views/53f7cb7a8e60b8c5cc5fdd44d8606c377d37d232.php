<div class="form-group">
    <label><?php echo e($label); ?></label>
    <textarea name="<?php echo e($name); ?>" class="form-control <?php echo e($class); ?>" rows="<?php echo e($rows); ?>" placeholder="<?php echo e($placeholder); ?>" <?php echo $attributes; ?> ><?php echo e(old($column, $value)); ?></textarea>
    <?php echo $__env->make('admin::actions.form.help-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>