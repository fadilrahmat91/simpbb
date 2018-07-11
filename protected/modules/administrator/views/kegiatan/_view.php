<?php
/* @var $this TableKegiatanController */
/* @var $model TableKegiatan */
?>
<table class="table table-hover">
	<tr>
	  <th>NO</th>
	  <th>Attribute</th>
	  <th>Keterangan</th>
	</tr>
	<tr>
	  <th>1</th>
	  <th><?php echo CHtml::encode($model->getAttributeLabel('id')); ?></th>
	  <td><?php echo CHtml::encode($model->id); ?></td>
	</tr>
	<tr>
	  <th>2</th>
	  <th><?php echo CHtml::encode($model->getAttributeLabel('nama_kegiatan')); ?></th>
	  <td><?php echo CHtml::encode($model->nama_kegiatan); ?></td>
	</tr>
	<tr>
	  <th>3</th>
	  <th><?php echo CHtml::encode($model->getAttributeLabel('dropcaps')); ?></th>
	  <td><?php echo CHtml::encode($model->dropcaps); ?></td>
	</tr>
	<tr>
	  <th>3</th>
	  <th><?php echo CHtml::encode($model->getAttributeLabel('keterangan_kegiatan')); ?></th>
	  <td><?php echo CHtml::encode($model->keterangan_kegiatan); ?></td>
	</tr>
	<tr>
	  <th>4</th>
	  <th><?php echo CHtml::encode($model->getAttributeLabel('tanggal_kegiatan')); ?></th>
	  <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd MMM yyyy',$model->tanggal_kegiatan)); ?></td>
	</tr>
	<tr>
	  <th>5</th>
	  <th><?php echo CHtml::encode($model->getAttributeLabel('dibuat_oleh')); ?></th>
	  <td><?php echo CHtml::encode(User::get_user_by_id($model["dibuat_oleh"],"nama_lengkap")); ?></td>
	  
	</tr>
	<tr>
	  <th>6</th>
	  <th><?php echo CHtml::encode($model->getAttributeLabel('tanggal_upload')); ?></th>
	  <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd MMM yyyy, HH:ss',$model->tanggal_upload)); ?></td>
	</tr>
	<tr>
	  <th>7</th>
	  <th><?php echo CHtml::encode($model->getAttributeLabel('cover_image')); 
	  		$imageUrl = Yii::app()->request->baseUrl.'/upload/kegiatan/'.$model->id.'/';
	  	?>
	  </th>
	  <td>
	  	<a href="<?php echo Yii::app()->baseUrl; ?>/kegiatan/ImageDetail/?file=<?php echo CHtml::encode(FileLokasi::model()->findByAttributes(array("id"=>$model->cover_image))->nama_file);?>&id=<?php echo $model->id; ?>" target="_blank">
	  		<img src="<?php echo $imageUrl.CHtml::encode(FileLokasi::model()->findByAttributes(array("id"=>$model->cover_image))->nama_file);?>" alt="<?=$model->nama_kegiatan;?>" style="width:100px; height: 70px;"></td>
	  	</a>
	  </td>
	</tr>
</table>