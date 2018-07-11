<?php $this->renderPartial('_slider'); ?>
<?php $this->renderPartial('_filter',['tahun'=>$tahun,'_from'=>'laporan_utama']); ?>
<?php $this->renderPartial('_infochartahunini',['tahun'=>$tahun]); ?>
<?php $this->renderPartial('_infokecamatan',['tahun'=>$tahun]); ?>
<?php $this->renderPartial('_infopersentasirealisasi',['tahun'=>$tahun]); ?>
<?php /*$this->renderPartial('_infoketetapankelurahan',['tahun'=>$tahun]); */?>
<?php $this->renderPartial('_infopembayaranpiutangtahunan',['tahun'=>$tahun]); ?>
<?php $this->renderPartial('_infotahunan',['tahun'=>$tahun]); ?>