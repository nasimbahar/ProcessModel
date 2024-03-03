<?php $__env->startSection("main"); ?>
    <section class="content" style="min-height: 600px">

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(__("front.subheaderphasetwo")); ?></h3>
            </div>
            <div class="box-body">
             <form action="<?php echo e(admin_url('processmodel/phasetwo')); ?>" method="post" >
                 <?php echo e(csrf_field()); ?>

                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title"><?php echo e(__("front.requiredconsenses")); ?></h3>
                     </div>
                     <div class="box-body">
                              <div class="form-group">
                             <?php $name="consensusmechanisms" ;foreach(\App\Models\ConsensusMechanisms::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="<?php echo e($name.$item->id); ?>" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="<?php echo e($name.$item->id); ?>" onmouseover="details('consensusmechanisms',<?php echo e($item->id); ?>)" data-toggle="tooltip" data-placement="top" >
                                   <?php echo e($item->name); ?>

                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>

                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title"><?php echo e(__("front.requiredlanguage")); ?></h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="programminglanguages" ;foreach(\App\Models\Programminglanguages::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="<?php echo e($name.$item->id); ?>" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                               <span style="cursor: pointer" id="<?php echo e($name.$item->id); ?>" onmouseover="details('programminglanguages',<?php echo e($item->id); ?>)" data-toggle="tooltip" data-placement="top" >
                                   <?php echo e($item->name); ?>

                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>

                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title"><?php echo e(__("front.requiredscalibilty")); ?></h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="scalabilitytypes" ;foreach(\App\Models\Scalabilitytypes::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="<?php echo e($name.$item->id); ?>" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="<?php echo e($name.$item->id); ?>" onmouseover="details('scalabilitytypes',<?php echo e($item->id); ?>)" data-toggle="tooltip" data-placement="top" >
                                   <?php echo e($item->name); ?>

                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>

                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title"><?php echo e(__("front.requiredprivacy")); ?></h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="privacytypes" ;foreach(\App\Models\PrivacyTypes::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="<?php echo e($name.$item->id); ?>" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="<?php echo e($name.$item->id); ?>" onmouseover="details('privacytypes',<?php echo e($item->id); ?>)" data-toggle="tooltip" data-placement="top" >
                                   <?php echo e($item->name); ?>

                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>


                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title"><?php echo e(__("front.requiredinteropability")); ?></h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="interoperabilitytypes" ;foreach(\App\Models\Interoperabilitytypes::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="<?php echo e($name.$item->id); ?>" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="<?php echo e($name.$item->id); ?>" onmouseover="details('interoperabilitytypes',<?php echo e($item->id); ?>)" data-toggle="tooltip" data-placement="top" >
                                   <?php echo e($item->name); ?>

                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>


                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title"><?php echo e(__("front.requiredreslince")); ?></h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="resiliencetypes" ;foreach(\App\Models\Resiliencetypes::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="<?php echo e($name.$item->id); ?>" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="<?php echo e($name.$item->id); ?>" onmouseover="details('resiliencetypes',<?php echo e($item->id); ?>)" data-toggle="tooltip" data-placement="top" >
                                   <?php echo e($item->name); ?>

                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>


                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title"><?php echo e(__("front.requiredlayers")); ?></h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="layersupports" ;foreach(\App\Models\Layersuppors::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="<?php echo e($name.$item->id); ?>" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="<?php echo e($name.$item->id); ?>" onmouseover="details('layersupports',<?php echo e($item->id); ?>)" data-toggle="tooltip" data-placement="top" >
                                   <?php echo e($item->name); ?>

                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>
                 <div class="box box-success">
                     <div class="box-header">
                         <h3 class="box-title"><?php echo e(__("front.requiredcontract")); ?></h3>
                     </div>
                     <div class="box-body">
                         <div class="form-group">
                             <?php $name="contractsupports" ;foreach(\App\Models\Contractsupports::all() as $item):?>
                             <label class="">
                                 <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;">
                                     <input name="<?php echo e($name.$item->id); ?>" type="checkbox" class="flat-red" unchecked style="position: absolute; opacity: 0;">
                                     <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                     </ins>
                                 </div>
                                 <span style="cursor: pointer" id="<?php echo e($name.$item->id); ?>" onmouseover="details('contractsupports',<?php echo e($item->id); ?>)" data-toggle="tooltip" data-placement="top" >
                                   <?php echo e($item->name); ?>

                               </span>
                             </label>
                             <?php endforeach;?>
                         </div>

                     </div>
                 </div>
                 <div class="form-group">
                     <div class="row">
                     <div class="col-md-3">
                         <span>Transaction speed</span>
                     <select class="form-control">
                         <option>High Transaction speed</option>
                         <option>Medium Transaction speed</option>
                         <option>Low Transaction speed</option>
                     </select>
                     </div>
                     <div class="col-md-3">
                         <span>Community</span>
                         <select class="form-control">
                             <option>Big Community</option>
                             <option>Medium Community</option>
                             <option>Small Community</option>
                         </select>
                     </div>
                     <div class="col-md-3">
                         <span>popularity in the market</span>
                         <select class="form-control">
                             <option>popular</option>
                             <option>average</option>
                             <option> neglected</option>
                             <option> controversial</option>
                             <option> rejected</option>

                         </select>
                     </div>
                     <div class="col-md-3">
                         <span>Maturity of the platform</span>
                         <select class="form-control">
                             <option>High </option>
                             <option>Medium</option>
                             <option>Low</option>
                         </select>
                     </div>
                     </div>


                 </div>
                 <?php if(isset($ispost)){?>
                 <div class="form-group">
                     <?php echo $__env->make("front.includes.phasetwoplatform", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                 </div>
                 <?php }?>
                 <div class="form-group">
                <?php if(!isset($ispost)){?>
                    <button  class="btn btn-info btn-lg" type="post">Submit</button>
                     <?php }else{;?>


               <a href="<?php echo e(admin_url("processmodel/phasethree")); ?>" class="btn btn-warning btn-lg" >  Go to Phase Three</a>
                    <?php }?>
                 </div>

             </form>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>
    <script>


        function  details(table,id) {
            var $this = $(this);
            $.ajax({
                url: "<?php echo e(admin_url("front/ajax")); ?>",
                type: "get", //send it through get method
                data: {
                    table: table,
                    id: id,
                },
                success: function(response) {

                    $("#"+table+id).attr('title', response);
                },
                error: function(xhr) {
                  console.log("error happend");
                }
            });
        }

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("front.layout", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>