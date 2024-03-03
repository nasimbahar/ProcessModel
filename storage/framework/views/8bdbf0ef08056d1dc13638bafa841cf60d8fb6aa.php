<?php $__env->startSection("main"); ?>
    <section class="content" style="min-height: 600px">

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Cost Estimation</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <i class="fa fa-text-width"></i>
                                <h3 class="box-title">Cost Estimation  </h3>
                            </div>

                            <div class="box-body">
                                <p class="text-green">This part is still under literature review. The initial idea is to combine the Algorithmic( Number of nodes, number of smart contracts, and so on) and Non-Algorithmic( Stored similar projects in the database) and calculate the approximate cost of the project. </p>


                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("front.layout", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>