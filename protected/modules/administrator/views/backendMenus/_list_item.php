<?php if(!empty($details)){ ?>
    <?php $c = 1;
        foreach($details as $p){
          ?>
            <tr>
				<td><?php echo $c;?></td>
				<td class="text-center"><?php echo $p['action_name']?></td>
				<td class="text-center"><?php echo $p['action_aksi']?></td>
				<td class="text-center"><a class="update-items" href="javascript:void(0)" data-values='<?php echo CJSON::encode($p);?>'><i class="fa fa-pencil"></i></a></td>
				<td><a class="removes-items" href="javascript:void(0)" data-url='<?php echo Yii::app()->createAbsoluteUrl('admin/applicationRegister/deleteitems/id/'.$p['id']); ?>'><i class="fa fa-remove"></i></a></td>
			</tr>
        <?php $c++;
    }
    ?>
<?php } ?>