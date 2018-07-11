<?php $this->renderPartial('_slider'); ?>
<?php $this->renderPartial('_filter',['tahun'=>$tahun,'_from'=>'laporan_utama']); ?>
<?php $this->renderPartial('_infochartahunini',['tahun'=>$tahun]); ?>
<?php $this->renderPartial('_chartketetapan',['tahun'=>$tahun]); ?>
<?php $this->renderPartial('_chartrealisasi',['tahun'=>$tahun]); ?>
<?php $this->renderPartial('_chartketetapanKecamatan',['tahun'=>$tahun]); ?>
<?php $this->renderPartial('_chartrealisasiKecamatan',['tahun'=>$tahun]); ?>
