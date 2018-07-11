<?php
class ProsesAbsen extends CFormModel {
 	public $jurusan;

 	 public function SiswabyJurusan()
    {
         $jurusan= $this->jurusan;
        $sql = "SELECT * FROM mahasiswa WHERE jurusan='$jurusan'";
        $command= Yii::app()->db->createCommand($sql);
        return $dataReader = $command->queryAll();

    }


    public function status($hasil)
    {
    	$status="";
    	if($hasil <= 0){
    		$status='Kurang Bayar';
    	}else{
    		$status='Lebih Bayar';
    	}
    	return $status;
    }
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function attributeLabels()
    {
        return array(

            'jurusan' => 'Jurusan',
        

    
        );
    }


	

}
