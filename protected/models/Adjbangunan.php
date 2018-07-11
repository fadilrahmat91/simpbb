<?php
/**
 * The followings are the available columns in table 'tbl_post':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 */
class Adjbangunan extends CActiveRecord
{
    /**
     * Returns the Oracle database connection used by this active record.
     * @return OciDbConnection the Oracle database connection used by 
     * this active record.
     */
      public function getDbConnection()
      {
            /*if(self::$db!==null) {
                  return self::$db;
            } else {
                  self::$db = Yii::app()->dbOracle;
                  return self::$db;
            }*/
			self::$db = Yii::app()->dbOracle;
                  return self::$db;
      }
 
     /**
      * Returns the static model of the specified AR class.
      * @param string $className active record class name.
      * @return IvrModel the static model class
      */
      public static function model($className=__CLASS__)
      {
            return parent::model($className);
      }
 
     /**
      * @return string the associated database table name
      */
      public function tableName()
      {
            return 'ADJ_BANGUNAN';
      }
 
     /**
      * @return array validation rules for model attributes.
      */
      /*public function rules()
      {
            return array(
                  array('PKEY', 'default', 'value'=>new CDbExpression('(select max(PKEY)+1 from "CCQ"."MY_ANNOUNCEMENTS")'), 'setOnEmpty'=>false, 'on'=>'insert'),
                  array('MY_ANNOUNCEMENTS', 'default', 'value'=>new CDbExpression('SYSDATE'), 'setOnEmpty'=>false, 'on'=>'insert'),
                  array('MY_ANNOUNCEMENTS', 'default', 'value'=>new CDbExpression('SYSDATE'), 'setOnEmpty'=>false, 'on'=>'update'),
            );
      }*/
	  public function rules(){
		         return array(
                        array('KD_JPB, TIPE_BNG', 'required')
                );
        }

}