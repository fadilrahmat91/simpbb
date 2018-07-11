<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Selamat datang dipajak simalungun  </title>
	<link rel='shortcut icon' type='image/x-icon' href="<?php echo Yii::app()->request->baseUrl; ?>/asset/img/logos/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!--link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"-->

    <!-- Custom fonts for this template -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/asset/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/owl/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/owl/owlcarousel/assets/owl.theme.default.min.css">
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/vendor/jquery/jquery.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/asset/css/agency.min.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/asset/css/style.css" rel="stylesheet">
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/owl/owlcarousel/owl.carousel.js"></script>
  </head>
	<script> var base_url = "<?=Yii::app()->createAbsoluteUrl('')?>" </script>
  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?php echo Yii::app()->createAbsoluteUrl('maplaporan')?>">PBB SIMALUNGUN</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <!--li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#portfolio">Portofolio</a>
            </li-->
			<li class="nav-item dropdown">
				<a class="nav-link" id="dropdown-toggle" data-toggle="dropdown" href="#">PBB KEC & KELURAHAN<span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-bottom dropmenutop">
					<li><a href="<?php echo Yii::app()->createAbsoluteUrl('laporanKecamatan/laporan')?>">Kecamatan</a></li>
					<li><a href="<?php echo Yii::app()->createAbsoluteUrl('laporanKelurahan/laporan')?>">Kelurahan</a></li>
				</ul>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link" id="dropdown-toggle" data-toggle="dropdown" href="#">PAJAK LAINNYA<span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-bottom dropmenutop">
					<li><a href="<?php echo Yii::app()->createAbsoluteUrl('pajakLainnya/laporan')?>">Data Tahunan</a></li>
					<li><a href="<?php echo Yii::app()->createAbsoluteUrl('pajakLainnyaKecamatan/laporan')?>">Kecamatan</a></li>
				</ul>
			</li>
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">Tentang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo Yii::app()->createAbsoluteUrl('kegiatan')?>">Kegiatan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Hubungi Kami</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
      <?php echo $content;  ?>
    <!-- Contact -->
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">HUBUNGI KAMI</h2>
            <h3 class="section-subheading text-muted">Tinggalkan Pesan, seputar perpajakan Kab.Simalungun</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <form id="contactForm" name="sentMessage" novalidate>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Masukkan Nama *" required data-validation-required-message="Masukkan Nama.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Alamat E-mail *" required data-validation-required-message="Masukkan Alamat E-mail.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" placeholder="Nomor Telpon *" required data-validation-required-message="Masukkan Nomor Telpon.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Pesan/Pertanyaan *" required data-validation-required-message="Isi Pertanyaan Anda."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Kirimkan Pertanyaan</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright">Copyright &copy; kab.simalungun 2018</span>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-linkedin"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-inline quicklinks">
              <li class="list-inline-item">
                <a href="#">Privacy Policy</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Terms of Use</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
	<!--link href="<?php echo Yii::app()->request->baseUrl; ?>/asset/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">
    
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/datatables/js/dataTables.bootstrap.min.js"></script-->
    <!--script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/highcharts/code/modules/exporting.js"></script-->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/highcharts/code/highcharts.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/js/ajax.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/js/maps.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/js/jqBootstrapValidation.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/js/agency.min.js"></script>

  </body>

</html>
<script>
$(document).ready(function() {
	if( $('.owl-carousel').length ){
	  $('.owl-carousel').owlCarousel({
		loop: true,
		margin: 10,
		responsiveClass: true,
		responsive: {
		  0: {
			items: 1,
			nav: false,
			margin:20
		  },
		  650: {
			items: 1,
			nav: true
		  },
		  800: {
			items: 2,
			nav: false
		  },
		  1000: {
			items: 3,
			nav: true,
			loop: false,
			margin: 20
		  }
		}
	  })
	}
})
</script>