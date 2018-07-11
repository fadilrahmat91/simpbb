<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login Administrato - SIMPBB</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl; ?>/vendors/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl; ?>/vendors/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl; ?>/vendors/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl; ?>/vendors/dist/css/AdminLTE.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl; ?>/vendors/plugins/iCheck/square/blue.css">
	<script src="<?= Yii::app()->theme->baseUrl; ?>/vendors/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?= Yii::app()->theme->baseUrl; ?>/vendors/assets/jquery/ajax.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
	<?php echo $content; ?>
<!-- /.login-box -->

<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<script src="<?= Yii::app()->theme->baseUrl; ?>/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= Yii::app()->theme->baseUrl; ?>/vendors/plugins/iCheck/icheck.min.js"></script>
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