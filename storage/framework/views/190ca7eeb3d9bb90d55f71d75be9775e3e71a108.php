<?php if($help): ?>
<span class="help-block">
    <i class="fa <?php echo e(\Illuminate\Support\Arr::get($help, 'icon')); ?>"></i>&nbsp;<?php echo \Illuminate\Support\Arr::get($help, 'text'); ?>

</span>
<?php endif; ?>