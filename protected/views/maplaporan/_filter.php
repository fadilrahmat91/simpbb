<div style="padding-top:<?=($_from =='laporan_tahunan'?'100':'20')?>px;">
  <div class="container">
	<div class="row pull-right">
		<div class="col-md-12" >
			<a class="btn btn-primary" data-toggle="dropdown" href="#"> Tahun <?php echo $tahun?> <span class="caret"></span></a>
			<ul class="dropdown-menu scrollable">
				<?php for( $xn = Yii::app()->report->tahun_akhir(); $xn >= Yii::app()->report->tahun_mulai(); $xn-- ){ ?>
					<li><a href="<?php echo Yii::app()->createAbsoluteUrl('maplaporan/laporantahunan/tahun/'.$xn)?>">Tahun <?=$xn?></a></li>
				<?php } ?>
			</ul>
		
		</div>
	</div>
  </div>
</div>
