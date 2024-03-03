<?php $__currentLoopData = $css; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <link rel="stylesheet" href="<?php echo e(admin_asset("$c")); ?>">
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<link href="<?php echo e(admin_asset('css/print.css')); ?>" rel="stylesheet" type="text/css" media="print"/>
<style type="text/css">
    
    .printOnly {
   display : none;
}
    
   @media  print {
  a[href]:after {
    content: none !important;
  }
  footer{
      display: none !important;
  }
    body {
    margin: 0;
    color: #000;
    background-color: #fff;
  }
 button,a {
    visibility: hidden;
  }
  li.active >a{
       visibility: visible;
  }
  div.box-footer{
      visibility:hidden;
  }



    .printOnly {
       display : block;
    }

}
 
 
 </style>