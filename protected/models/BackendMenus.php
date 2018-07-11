<?php

/**
 * This is the model class for table "{{backend_menus}}".
 *
 * The followings are the available columns in table '{{backend_menus}}':
 * @property integer $id
 * @property integer $parent_menu
 * @property string $nama_menu
 * @property string $link_url
 * @property string $status
 */
class BackendMenus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{backend_menus}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_menu,nama_menu,kontroller,link_url', 'required'),
			array('parent_menu', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>1),
			array('nama_menu, link_url', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_menu, nama_menu, link_url, status,kontroller', 'safe', 'on'=>'search'),
		);
	}
	public function getAllowAction(){
		return  array(
			'view' => 'view',
			'delete' =>'delete',
			'insert' => 'create',
			'update' => 'update',
		);
	}
	public function getAllowName(){
		return  array(
			'view' => 'view',
			'admin' => 'view',
			'index' => 'view',
			'delete' =>'delete',
			'create' => 'insert',
			'update' => 'update',
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
			'parent_menu' => 'Menu Utama',
			'nama_menu' => 'Nama Menu',
			'link_url' => 'Alamat Url',
			'status' => 'Status',
			'kontroller' => 'Kontroller'
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
		$criteria->compare('parent_menu',$this->parent_menu);
		$criteria->compare('nama_menu',$this->nama_menu,true);
		$criteria->compare('link_url',$this->link_url,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('kontroller',$this->kontroller,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BackendMenus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function get_menu_action($menu_id){
		$action = MenusAction::model()->findAllByAttributes(array('menu_id'=>$menu_id));
		$return_array = [];
		if( !empty($action)){
			foreach( $action as $p ){
				$return_array[$p->action_aksi] =$p->action_aksi;
			}
		}
		return $return_array;
	}
	public function status( $status = "" )
	{
		$_status = [];
		$_status[0] = 'Tidak Aktif';
		$_status[1] = 'Aktif';
		if( $status != "" ){
			return $_status[$status];
		}
		return $_status;
	}
}
