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
    <a href="<?php echo e(admin_url('/')); ?>"><b><?php echo e(trans(config('admin.name'))); ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?php echo e(trans('admin.login')); ?></p>

    <form action="<?php echo e(admin_url('auth/login')); ?>" method="post">
      <div class="form-group has-feedback <?php echo !$errors->has('username') ?: 'has-error'; ?>">

        <?php if($errors->has('username')): ?>
          <?php $__currentLoopData = $errors->get('username'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i><?php echo e($message); ?></label><br>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <input type="text" class="form-control" placeholder="<?php echo e(trans('admin.username')); ?>" name="username" value="<?php echo e(old('username')); ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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
      <div class="row">
        <div class="col-xs-8">
          <?php if(config('admin.auth.remember')): ?>
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" value="1" <?php echo e((!old('username') || old('remember')) ? 'checked' : ''); ?>>
              <?php echo e(trans('admin.remember_me')); ?>

            </label>
          </div>
          <?php endif; ?>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo e(trans('admin.login')); ?></button>
        </div>
        <!-- /.col -->
      </div>

      <div class="form-group">
        <select class="form-control" id="locale">
          <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($key); ?>" <?php echo $key != $current ?: 'selected'; ?>><?php echo e($language); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
          <a href="<?php echo e(admin_url('auth/register')); ?>">Sign Up</a>
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
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')}});

    $("#locale").change(function () {
      let locale = $('#locale option:selected').val();
      $.post("<?php echo e(admin_url('/locale')); ?>",{locale: locale}, function () {
        location.reload();
      })
    });
  });
</script>
</body>
</html>
