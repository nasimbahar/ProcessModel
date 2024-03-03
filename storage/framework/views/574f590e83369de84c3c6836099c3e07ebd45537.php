<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo e(config('admin.title')); ?> | <?php echo e(trans('admin.login')); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <?php if(!is_null($favicon = Admin::favicon())): ?>
  <link rel="shortcut icon" href="<?php echo e($favicon); ?>">
  <?php endif; ?>

  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo e(admin_asset("vendor/laravel-admin/AdminLTE/bootstrap/css/bootstrap.min.css")); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(admin_asset("vendor/laravel-admin/font-awesome/css/font-awesome.min.css")); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(admin_asset("vendor/laravel-admin/AdminLTE/dist/css/AdminLTE.min.css")); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(admin_asset("vendor/laravel-admin/AdminLTE/plugins/iCheck/square/blue.css")); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page" <?php if(config('admin.login_background_image')): ?>style="background: url(<?php echo e(config('admin.login_background_image')); ?>) no-repeat;background-size: cover;"<?php endif; ?>>
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo e(admin_url('/')); ?>"><b><?php echo e(config('admin.name')); ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Register</p>

    <form action="<?php echo e(admin_url('auth/register')); ?>" method="post">
      <div class="form-group has-feedback <?php echo !$errors->has('username') ?: 'has-error'; ?>">

        <?php if($errors->has('username')): ?>
          <?php $__currentLoopData = $errors->get('username'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i><?php echo e($message); ?></label><br>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <input type="text" class="form-control" placeholder="<?php echo e(trans('admin.username')); ?>" name="username" value="<?php echo e(old('username')); ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
        <div class="form-group has-feedback <?php echo !$errors->has('email') ?: 'has-error'; ?>">

        <?php if($errors->has('email')): ?>
          <?php $__currentLoopData = $errors->get('email'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i><?php echo e($message); ?></label><br>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo e(old('email')); ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback <?php echo !$errors->has('school_name') ?: 'has-error'; ?>">

        <?php if($errors->has('school_name')): ?>
          <?php $__currentLoopData = $errors->get('school_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i><?php echo e($message); ?></label><br>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <input type="text" class="form-control" placeholder="School Name" name="school_name" value="<?php echo e(old('school_name')); ?>">
        <span class="glyphicon glyphicon-bishop form-control-feedback"></span>
      </div>
       <div class="form-group has-feedback <?php echo !$errors->has('contactnumber') ?: 'has-error'; ?>">

        <?php if($errors->has('contactnumber')): ?>
          <?php $__currentLoopData = $errors->get('contactnumber'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i><?php echo e($message); ?></label><br>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <input type="text" class="form-control" placeholder="Contact Number" name="contactnumber" value="<?php echo e(old('contactnumber')); ?>">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
        
      <div class="form-group has-feedback <?php echo !$errors->has('password') ?: 'has-error'; ?>">

        <?php if($errors->has('password')): ?>
          <?php $__currentLoopData = $errors->get('password'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i><?php echo e($message); ?></label><br>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <input type="password" class="form-control" placeholder="<?php echo e(trans('admin.password')); ?>" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
        
      <div class="form-group has-feedback <?php echo !$errors->has('password_confirmation') ?: 'has-error'; ?>">

        <?php if($errors->has('password_confirmation')): ?>
          <?php $__currentLoopData = $errors->get('password_confirmation'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i><?php echo e($message); ?></label><br>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
        
      <div class="row">
       
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
      
        <div class="col-xs-6">
              
        </div>
        <div class="col-xs-2">
               <a href="<?php echo e(admin_url('auth/login')); ?>">Login</a>
        </div>
      </div>
       
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="<?php echo e(admin_asset("vendor/laravel-admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js")); ?> "></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo e(admin_asset("vendor/laravel-admin/AdminLTE/bootstrap/js/bootstrap.min.js")); ?>"></script>
<!-- iCheck -->
<script src="<?php echo e(admin_asset("vendor/laravel-admin/AdminLTE/plugins/iCheck/icheck.min.js")); ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
