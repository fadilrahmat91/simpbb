<?php

/**
 * This is the model class for table "{{table_kegiatan}}".
 *
 * The followings are the available columns in table '{{table_kegiatan}}':
 * @property string $id
 * @property string $nama_kegiatan
 * @property string $keterangan_kegiatan
 * @property string $tanggal_kegiatan
 * @property string $cover_image
 * @property string $dibuat_oleh
 * @property string $tanggal_upload
 */
class TableKegiatan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{table_kegiatan}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_kegiatan, dropcaps', 'required'),
			array('nama_kegiatan', 'length', 'max'=>255),
			array('cover_image, dibuat_oleh', 'length', 'max'=>20),
			array('keterangan_kegiatan, tanggal_kegiatan, dropcaps', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama_kegiatan, keterangan_kegiatan, tanggal_kegiatan, cover_image, dibuat_oleh, tanggal_upload, dropcaps', 'safe', 'on'=>'search'),
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
			'nama_kegiatan' => 'Nama Kegiatan',
			'keterangan_kegiatan' => 'Keterangan Kegiatan',
			'dropcaps' => 'Dropcaps',
			'tanggal_kegiatan' => 'Tanggal Kegiatan',
			'cover_image' => 'Cover Image',
			'dibuat_oleh' => 'Dibuat Oleh',
			'tanggal_upload' => 'Tanggal Upload',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('nama_kegiatan',$this->nama_kegiatan,true);
		$criteria->compare('keterangan_kegiatan',$this->keterangan_kegiatan,true);
		$criteria->compare('dropcaps',$this->dropcaps,true);
		$criteria->compare('tanggal_kegiatan',$this->tanggal_kegiatan,true);
		$criteria->compare('cover_image',$this->cover_image,true);
		$criteria->compare('dibuat_oleh',$this->dibuat_oleh,true);
		$criteria->compare('tanggal_upload',$this->tanggal_upload,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TableKegiatan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getKegiatan(){

		$sql = "SELECT A.id, A.tanggal_kegiatan, A.nama_kegiatan, A.keterangan_kegiatan, C.nama_file
				FROM t_table_kegiatan A, t_table_kegiatan_detail B, t_file_lokasi C
			    WHERE A.cover_image = C.id
			    AND B.gambar = C.id 
			    ORDER BY A.id DESC";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}

	public function getNameKegiatan($id){

		$sql = "SELECT A.id, A.nama_kegiatan, B.nama_file, A.dropcaps, A.keterangan_kegiatan, A.tanggal_kegiatan
				FROM t_table_kegiatan A, t_file_lokasi B
			    WHERE A.cover_image = B.id AND A.id=$id
				";
		$command = Yii::app()->db->createCommand($sql);
		//$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		return $dataReader = $command->queryAll();
	}

	public function getIdCover($id){

		$sql = "SELECT cover_image FROM t_table_kegiatan 
                WHERE cover_image = $id
				";
		$command = Yii::app()->db->createCommand($sql);
		//$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		return $dataReader = $command->queryAll();
	}

	public function updatePrimaryImage($id, $kegiatan_id, $params=array()){
		return Yii::app()->db->createCommand()->update(
		        't_table_kegiatan', 
		        array(
		            'cover_image'=>'$id',
		        ), 
		        'id=:id', 
		        array(':id'=>$kegiatan_id)
		    );
	}

	// public function behaviors($id, $kegiatan){
	//   return array(
	//     'sluggable' => array(
	//       'class'=>'ext.behaviors.SluggableBehavior.SluggableBehavior',
	//       'columns' => array($id, $kegiatan),
	//       'unique' => true,
	//       'update' => true,
	//     ),
	//   );
	// }

	public function slug($text)
	{
	    // replace non letter or digits by -
	    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	 
	    // trim
	    $text = trim($text, '-');
	 
	    // transliterate
	    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	 
	    // lowercase
	    $text = strtolower($text);
	 
	    // remove unwanted characters
	    $text = preg_replace('~[^-\w]+~', '', $text);
	 
	    if (empty($text))
	    {
	        return 'n-a';
	    }
	 
	    return $text;
	} 

	public function getKegiatanPage(){

		$sql = "SELECT A.id, A.nama_kegiatan, A.keterangan_kegiatan, A.tanggal_kegiatan, 
				B.kegiatan_id, B.gambar, B.no_urut, 
				C.tanggal_upload, C.nama_file 
				FROM t_table_kegiatan A, t_table_kegiatan_detail B, t_file_lokasi C 
				WHERE A.id = B.kegiatan_id 
				AND B.gambar = C.id 
				GROUP BY B.kegiatan_id DESC";
		return $sql;
	}

	public function getImageKegiatan($id){
		//$oci = Yii::app()->db;
		$sql = "SELECT A.cover_image, B.nama_file, B.id
				FROM t_table_kegiatan A, t_file_lokasi B
				WHERE B.id = $id 
				AND A.cover_image = B.id";
		$command = Yii::app()->db->createCommand($sql);
		//$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		return $dataReader = $command->queryAll();
	}
	public function getImageTimeLast($id){
		//$oci = Yii::app()->db;
		$sql = "SELECT tanggal_upload AS imagetime
				FROM t_table_kegiatan_detail 
				WHERE kegiatan_id = $id ORDER BY tanggal_upload DESC";
		$command = Yii::app()->db->createCommand($sql);
		//$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		return $dataReader = $command->queryRow();
	}
	public function getSumKegiatan(){
		$sql = "SELECT COUNT(*) AS kegiatan
				FROM t_table_kegiatan";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}
	// public function getDeleteImage($id){
	// 	//$oci = Yii::app()->db;
	// 	$sql = "DELETE FROM t_table_kegiatan_detail
	// 			WHERE gambar = $id";

	// 	$sql2 = "DELETE FROM t_file_lokasi
	// 			WHERE id = $id";
	// 	$command = Yii::app()->db->createCommand($sql, $sql2);
	// 	//$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
	// 	return $dataReader = $command->queryAll();
	// }
	public function time_elapsed_string($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}

	public function getXmax(){
		$sql='SELECT * FROM t_table_kegiatan';
 
		 $dataProvider=new CSqlDataProvider($sql,array(
		   'keyField' => 'id',
		   'totalItemCount'=>TableKegiatan::model()->count(),
		   'pagination'=>array(
		       'pageSize'=>8,
		    ),
		 ));
	}
}
