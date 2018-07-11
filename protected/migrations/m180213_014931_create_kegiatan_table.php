<?php

class m180213_014931_create_kegiatan_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_table_kegiatan', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
                'nama_kegiatan'=>'varchar(255)',
                'keterangan_kegiatan'=>'text(500)',
				'tanggal_kegiatan'=>'date',
				'cover_image'=>'bigint(20)',
				'dibuat_oleh'=>'bigint(20)',
				'tanggal_upload'=>'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP'
        ));
		$this->createTable('t_file_lokasi', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
                'nama_file'=>'varchar(255)',
				'tanggal_upload'=>'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP'
        ));
		$this->createTable('t_table_kegiatan_detail', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
                'kegiatan_id'=>'bigint(20)',
                'gambar'=>'bigint(20)',
				'no_urut'=>'int(5)',
				'tanggal_upload'=>'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP'
        ));
	}

	public function down()
	{
		echo "m180213_014931_create_kegiatan_table does not support migration down.\n";
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