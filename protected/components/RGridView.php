<?php
Yii::import('zii.widgets.grid.CGridView');

class RGridView extends CGridView
{
	public $template ="{buttonExport}\n{summary}\n{items}\n{pager}";
	public $buttonExport;
	public function renderButtonExport(){
		echo $this->buttonExport;
	}
}