   <?php if($istable=="true"){?>
  <label class=" control-label "><?php echo e($label); ?></label>
  <label class="control-label" style="margin:10px"><?php if($escape): ?>
                    <?php echo e($content); ?>&nbsp;
                <?php else: ?>
                    <?php echo $content; ?>&nbsp;
                <?php endif; ?></label>
   <?php } else{?>

<div class="form-group ">
      <?php if($label!=="Image"): ?>
        <label class="col-md-3 control-label"><?php echo e($label); ?></label>
    <?php endif; ?>

    <div class="col-md-6">

        <?php if($wrapped): ?>
        <div class="box box-solid  no-margin box-show">
            <!-- /.box-header -->
            <div class="box-body">
                <?php if($escape): ?>
                    <?php echo e($content); ?>&nbsp;
                <?php else: ?>
                    <?php echo $content; ?>&nbsp;
                <?php endif; ?>
            </div><!-- /.box-body -->
        </div>
        <?php else: ?>
            <?php if($escape): ?>
                <?php echo e($content); ?>

            <?php else: ?>
                <?php echo $content; ?>

            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
   <?php }?>