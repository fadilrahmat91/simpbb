<?php

class m180213_034642_add_data_pendataan extends CDbMigration
{
	public function up()
	{
		$this->insert('t_user_role', array(
                'kode'=>'P0001',
                'nama_akses'=>'Pendataan',
                'alamat_utama'=>'/administrator/dataRingkas/admin'
            ));	
	}

	public function down()
	{
		echo "m180213_034642_add_data_pendataan does not support migration down.\n";
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