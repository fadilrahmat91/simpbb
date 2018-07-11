<?php

class m180403_081536_add_user_role_pelayanan extends CDbMigration
{
	public function up()
	{
		$this->insert('t_user_role', array(
                'kode'=>'P0003',
                'nama_akses'=>'Pelayanan',
                'alamat_utama'=>'/administrator/pembayaran/index'
            ));
	}

	public function down()
	{
		echo "m180403_081536_add_user_role_pelayanan does not support migration down.\n";
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