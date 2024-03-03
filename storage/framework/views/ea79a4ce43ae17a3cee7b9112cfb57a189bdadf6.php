<?php $__env->startSection("main"); ?>
    <section class="content" style="min-height: 600px">

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(__("front.subheaderphasefour")); ?></h3>
            </div>
            <div class="box-body">
               <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <i class="fa fa-text-width"></i>
                            <h3 class="box-title">Best Practices </h3>
                        </div>

                        <div class="box-body">
                            <p class="text-green"><b>Agile methodologies: </b>For the Better management of the development team and project </p>

                            <p class="text-aqua"><b>BTT (Blockchain Transaction Testing): </b> In order to ensure  the status integrity and testing the double-spending</p>
                            <p class="text-light-blue"><b>SMT( Smart Contract Testing): </b>To satisfy the contractor's specifications, comply with the laws of the legal system involved, and not include unfair contract terms</p>

                        </div>

                    </div>
                </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <i class="fa fa-text-width"></i>
                                <h3 class="box-title">Design Principles  </h3>
                            </div>

                            <div class="box-body">

                                <p class="text-green"><b>Modularity:</b>Systems should be built from cohesive, loosely coupled components (modules) which means s system should be made up of different components that are united and work together in an efficient way and such components have a well-defined function</p>
                                <p class="text-aqua"><b>Data Parsimony:</b> the simplest explanation that can explain the data is to be preferred.In the analysis of phylogeny, parsimony means that a hypothesis of relationships that requires the smallest number of character changes is most likely to be correct.</p>
                                <p class="text-light-blue"><b>Availability :</b></p>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("front.layout", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>