<?php 
  $this->renderPartial('_listView',array('Jumkegiatan'=>$Jumkegiatan, 'Kegiatan'=>$Kegiatan));
  $this->renderPartial('_listModalView',array('Jumkegiatan'=>$Jumkegiatan, 'Kegiatan'=>$Kegiatan, 'page_kegiatan'=>$PageKegiatan)); 
?>
    