<?php

/**
 * This is the model class for table "{{roles_menu}}".
 *
 * The followings are the available columns in table '{{roles_menu}}':
 * @property integer $id
 * @property integer $role_id
 * @property integer $menu_id
 * @property integer $action_id
 */
class RolesMenu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{roles_menu}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, role_kode, menu_id, action_type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role_kode' => 'Role',
			'menu_id' => 'Menu',
			'action_type' => 'Action Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('role_kode',$this->role_kode);
		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('action_type',$this->action_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RolesMenu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function actionRule($controller ){
		if( isset(Yii::app()->user->roles) ){
			//getroleid
			$app = BackendMenus::model()->find('kontroller = :kontroller', array(':kontroller' => $controller));
			if( !empty($app)){
				$access = self::model()->findAll( 'role_kode=:role_kode and menu_id=:menu_id ', array(':menu_id'=>$app->id,':role_kode'=>Yii::app()->user->roles) );
				
				if( !empty($access) ){
					if( !empty($app)){
						$arrays = array();
						foreach( $access as $p ){
							
							$check = MenusAction::model()->findAllByAttributes(array('menu_id'=>$app->id,'action_aksi'=>$p->action_type));
							if( !empty($check) ){
								foreach( $check as $ps3 ){
									$arrays[] = $ps3->action_name;
								}
							}
						}
						
						$arrays =   array( 
							array('allow', // allow admin user to perform 'admin' and 'delete' actions
								'actions'=> $arrays,
								'users'=>array('@'),
							),
							array('deny',  // deny all users
									'users'=>array('*'),
							),

						);
						return $arrays;
					}
				}
			}
		}
		return array( 
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
	}
	public function roles_menu_action($data){
		
		if( !empty($data)){
			foreach($data as $p){
				$array[$p->menu_id][$p->action_type] = $p->action_type;
			}
			return $array;
		}
		return false;
	}
	private function menusrole($rolekode){
		$sql = "select tbm.id,tbm.parent_menu,tbm.nama_menu,tbm.link_url,tbm.status from t_roles_menu trm join t_backend_menus tbm on tbm.id = trm.menu_id";
		$sql .= " where  trm.role_kode = '".$rolekode."' and tbm.status = '1' group by trm.menu_id";
		
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		
        if($rows){
            return $rows;
        }else{
            return false;
        }
	}
	
	public function get_menus($rolekode){
		$menus = self::menusrole($rolekode);
		
		if( $menus != false ){
			// ambil semua menu utama
			$data_menu = [];
			$menu_utamas = [];
			$data_menus = [];
			foreach( $menus as $p ){
				$parent_menu = $p['parent_menu'];
				
				$menu_utama = BackendMenus::model()->find(
					'status = 1 and id = :parent_menu',
					array(':parent_menu'=>$parent_menu)
				);
				
				if( !empty($menu_utama) ){
					
					$data_menu[$menu_utama['id']][] = ['nama_menu'=>$p['nama_menu'],'link_url'=>$p['link_url']];
					$menu_utamas[$menu_utama['id']] = $menu_utama['nama_menu'];
				}
			}
			if(count( $menu_utamas ) > 0 ){
				foreach( $menu_utamas as $id => $name ){
					
					if( isset( $data_menu[$id])){
						array_push($data_menus,array('head'=>$name,'roles'=>array($rolekode)));
						// ambil menu bawahnya
						foreach( $data_menu[$id] as $p2 ){
							array_push($data_menus,array('text'=>$p2['nama_menu'],'route'=> array($p2['link_url']),'roles'=>array($rolekode)));
						}
					}
				}
			}
			/*echo "<pre>";
			print_r($data_menus);
			echo "</pre>";
			/*echo "<pre>";
			print_r($data_menu);
			echo "</pre>";*/
			return $data_menus;
		}
	}
}
