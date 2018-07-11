<div class="table-div-content">
	<table class="table">
		<?php $listmenu = BackendMenus::model()->findAllByAttributes(array('status'=>1)); ?>
		<tbody>
			<?php if( !empty($listmenu)) {?>
				<?php foreach( $listmenu as $p ){ ?>
					<?php $parent = $p->parent_menu;?>
					<?php if( $parent > 0 ) { ?>
						<tr>
							<td><?=$p->nama_menu?></td>
							<?php $menuaction = BackendMenus::get_menu_action($p->id)?>
							<td>
								<?php if( !empty($menuaction)) { ?>
									<?php foreach( $menuaction as $px => $v){ ?>
										<?php $ischecked = "";?>
										<?php if($access != false ){ ?>
											<?php if(isset($access[$p->id][$v])){?>
												<?php $ischecked = 'checked';?>
											<?php } ?>
										<?php } ?>
										<label class="checkbox-inline">
											<input type="checkbox" <?php echo $ischecked?> name="c_nama_datas[]" value="<?php echo $p->id?>-<?php echo $v?>">
											<?php echo $v?>
										</label>
									<?php } ?>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</tbody>
	</table>
</div>