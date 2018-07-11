<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>ADMINISTRATOR</b> PBB</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login untuk Akses Aplikasi</p>

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user_form',
	'enableAjaxValidation'=>false,
)); ?>
      <div class="form-group has-feedback">
		<?php echo $form->textField($model,'nik',array('class'=>'form-control','placeholder'=>'NIK')); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
		<?php echo $form->passwordField($model,'kata_sandi',array('class'=>'form-control','placeholder'=>'Kata Sandi')); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="LoginForm['rememberMe']"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    <?php $this->endWidget(); ?>
    <a href="#">Saya lupa kata sandi</a><br>
    <a href="register.html" class="text-center">Daftarkan akses baru</a>
  </div>
  <!-- /.login-box-body -->
</div>
<script>
	$("document").ready(function(){
		$("form#user_form").submit(function(){
			var _form = $(this);
			Ajax.run(_form.attr('action'),'POST',_form.serialize(),function(response){
				if(response.status == 'ok' ){
					// run to default home;
					window.location.href = response.homeurl;
				}else{
					// show eror login;
					//Ajax.run_error();
					alert(response.msg);
				}
			});
			return false;
		})
	});
</script>