<?php
    $parent = 0;
    $lasParent = null;
    foreach ($items as $item) { 
        if (in_array(Yii::app()->user->roles, $item['roles'])) {   
            if (isset($item['head'])) {
                $parent++; 
                if($lasParent !== null) { 
                    echo "</ul>";
                } ?>
                <!--li class="parent" data-toggle="collapse" data-target="<?php echo $parent; ?>" data-parent="#accordion2"-->
				<li class="treeview">
				<a href="#">
					<i class="fa fa-th"></i> <span><?php echo $item['head']; ?></span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-left pull-right"></i>
					</span>
				 </a>
            <?php   
            }else { 
                if($parent !== $lasParent){ 
                    $lasParent = $parent;
            ?>
                 <ul class="treeview-menu">
                    <li>
                        <?php echo CHtml::link("<i class='fa fa-circle-o'></i>". $item['text'], $item['route']);?>
                    </li>
			    <?php 
                }else{
                ?>
                    <li>
                        <?php echo CHtml::link("<i class='fa fa-circle-o'></i>". $item['text'], $item['route']);?>
                    </li>
				<?php } ?>
            <?php } ?>
        <?php } ?>
		<?php } ?>   
    </ul>
    </li>