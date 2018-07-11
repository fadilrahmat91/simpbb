<?php

class AdministratorModule extends CWebModule
{
	private $_assetsUrl;
	public function getAssetsUrl()
	{
		if ($this->_assetsUrl === null)
			$this->_assetsUrl = Yii::app()->getAssetManager()->publish(
				Yii::getPathOfAlias('admin.assets') );
		return $this->_assetsUrl;
	} 
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'administrator.models.*',
			'administrator.components.*',
		));
		Yii::app()->setComponents(
				array(
					'errorHandler'=>array('errorAction'=>'administrator/default/error'),                
					'user' => array(      
						'loginUrl' => Yii::app()->createUrl('administrator/login'),
						)                            
					)
				); 
		$this->layoutPath = Yii::getPathOfAlias('administrator.views.layouts');  
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			Yii::app()->errorHandler->errorAction='administrator/default/error';
			$this->layoutPath = Yii::getPathOfAlias('administrator.views.layouts');                    
			$controller->layout = 'main';   
			//$controller->layout = 'adminLayout';
			return true;
		}
		else
			return false;
	}
}
