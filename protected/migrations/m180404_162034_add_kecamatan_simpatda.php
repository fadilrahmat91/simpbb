<?php

class m180404_162034_add_kecamatan_simpatda extends CDbMigration
{
	public function up()
	{
		$this->insert('t_crontab', array(
			'code' => 'getdatakecamatan',
			'nama_crontab'=>'DATA KECAMATAN SIMPATDA',
			'url'=>'/autolaporan/getdatakecamatan'
		));
		$this->createTable('t_kecamatan_simpatda', array(
                'kdkecamatan'=>'int(10) PRIMARY KEY',
                'nama_kecamatan'=>'varchar(255)'
        ));
	}

	public function down()
	{
		echo "m180404_162034_add_kecamatan_simpatda does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}