<?php

class m180214_121630_add_pos_role extends CDbMigration
{
	public function up()
	{
		$this->insert('t_user_role', array(
                'kode'=>'P0002',
                'nama_akses'=>'Kantor Pos',
                'alamat_utama'=>'/administrator/pembayaran/index'
            ));	
	}

	public function down()
	{
		echo "m180214_121630_add_pos_role does not support migration down.\n";
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