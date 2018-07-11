<?php $this->renderPartial('_pilihankecamatan',['tahun'=>$tahun,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan,'keloption'=>$keloption]); ?>
<?php $this->renderPartial('_infochartahunini',['tahun'=>$tahun,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan]); ?>
<?php $this->renderPartial('_infopembayaranpiutangtahunan',['tahun'=>$tahun,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan]); ?>
<?php $this->renderPartial('_infochartrealisasitahunan',['tahun'=>$tahun,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan]); ?>
<?php $this->renderPartial('_infochartperubahanketetapan',['tahun'=>$tahun,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan]); ?>
<?php $this->renderPartial('_infochartbumidanbangunan',['tahun'=>$tahun,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan]); ?>
