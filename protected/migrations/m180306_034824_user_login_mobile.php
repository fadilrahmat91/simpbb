<?php

class m180306_034824_user_login_mobile extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_login_activity', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
                'nip'=>'varchar(50)',
				'ipaddress'=>'varchar(255)',
				'kode_login'=>'varchar(255)',
				'from_pc_mobile'=>'varchar(1)',
				'status_login' => 'varchar(1)',
				'tanggal_login'=>'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP'
        ));
	}

	public function down()
	{
		echo "m180306_034824_user_login_mobile does not support migration down.\n";
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