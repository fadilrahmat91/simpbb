<?php 
  $this->widget('ext.dropzone.EDropzone', array(
      'model' => $model,
      'attribute' => 'file',
      'url' => $this->createUrl('kegiatan/upload/id/'.$model->id),
      'mimeTypes' => array('image/jpeg', 'image/png', 'image/gif'),
      //'onSuccess' => 'someJsFunction();',
      'options' => array('addRemoveLinks' =>true,),
  ));
?>