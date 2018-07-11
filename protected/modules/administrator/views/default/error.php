<section class="content-header">
    <h1>
        ERROR APLIKASI
        <small>Error <?php echo $code; ?></small>
    </h1>
	<ol class="breadcrumb">
        <li class="active">ERROR</li>
    </ol>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">PESAN ERROR</h3>
				</div>
				 <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> <?=$code?></h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! ERROR FOUND.</h3>
          <p>
            <?php echo CHtml::encode($message); ?>
          </p>
		  <p>
            Silahkan Hubungi Administrator
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
			</div>
		</div>
	</div>
</section>
