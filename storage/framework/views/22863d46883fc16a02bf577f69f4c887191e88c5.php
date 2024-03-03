<div class="form-group">
    <label><?php echo e($label); ?></label>
    <input <?php echo $attributes; ?>>
    <?php echo $__env->make('admin::actions.form.help-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>