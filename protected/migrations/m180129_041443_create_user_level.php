<?php

class m180129_041443_create_user_level extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_user_role', array(
                'id' => 'int(11) AUTO_INCREMENT PRIMARY KEY',
                'kode'=>'varchar(5)',
                'nama_akses'=>'text',
				'alamat_utama'=>'text'
        ));
		$this->insert('t_user_role', array(
                'kode'=>'admin',
                'nama_akses'=>'Administrator',
                'alamat_utama'=>'/administrator/admin'
            ));
		$this->insert('t_user_role', array(
                'kode'=>'itprog',
                'nama_akses'=>'Programer',
                'alamat_utama'=>'/administrator/admin'
            ));	
		$this->createTable('t_user', array(
                'id' => 'int(11) AUTO_INCREMENT PRIMARY KEY',
                'username'=>'varchar(255)',
				'userlevel'=>'varchar(5)',
				'nik'=>'varchar(255)',
				'password'=>'varchar(255)',
				'status'=>'varchar(1)',
				'nama_lengkap'=>'varchar(255)',
                'tanggal_daftar'=>'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
				'tanggal_ubah'=>'datetime',
        ));
		$this->createTable('t_logs', array(
				'user_id'=>'int(11)',
				'ipaddress'=>'varchar(50)',
				'logtime'=>'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
				'controller'=>'varchar(255) NOT NULL DEFAULT 0',
				'action'=>'varchar(255) NOT NULL DEFAULT 0',
				'details' => 'text'
		));
	}

	public function down()
	{
		echo "m180129_041443_create_user_level does not support migration down.\n";
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