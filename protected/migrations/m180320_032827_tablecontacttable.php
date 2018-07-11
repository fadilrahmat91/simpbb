<?php

class m180320_032827_tablecontacttable extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_hubungikami', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
                'nama'=>'varchar(255)',
                'email'=>'varchar(200)',
				'no_telp'=>'varchar(20)',
				'pertanyaan'=>'text(500)',
				'jawaban'=>'text(500)',
				'status_jawab' => 'char(1)',
				'tanggal_jawab'=>'date',
				'dijawab_oleh'=>'bigint(20)',
				'tanggal_kirim'=>'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP'
        ));
	}

	public function down()
	{
		echo "m180320_032827_tablecontacttable does not support migration down.\n";
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