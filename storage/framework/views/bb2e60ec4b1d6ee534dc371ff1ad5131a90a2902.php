<div class="box box-<?php echo e($style); ?>">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo e($title); ?></h3>

        <div class="box-tools">
            <?php echo $tools; ?>

        </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="form-horizontal">

        <div class="box-body">

            <div class="fields-group">
               <?php $index=0; if($istwocolumns=='true'){ ?>

                <table style="width: 100%;">
                <?php foreach($fields as $field):?>


                   <?php if($index%2==0){?>
                    <tr >

                        <td style="width: 50%">

                    <?php echo $field->render();?>

                        <td>
                   <?php }else{?>
                        <td style="width: 50%">

                    <?php echo $field->render();?>

                        <td>
             <?php if($index%2==0){?>
                       </tr>


             <?php }}?>


               <?php $index++; endforeach;
               echo "</table>";} else{?>
                <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo html_entity_decode($field->render()); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php }?>
            </div>

        </div>
        <!-- /.box-body -->
    </div>

</div>
