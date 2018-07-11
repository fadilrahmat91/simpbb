<?php

class m180201_044959_createdfile extends CDbMigration
{
	public function up()
	{

				$this->insert('t_user', array(
		                'username'=>'itprograming',
		                'userlevel'=>'itpro',
		                'nik'=>'itprograming',
										'password'=>'qwerty123456',
										'status'=>'1',
										'nama_lengkap'=>'Administrator'
		            ));
	}

	public function down()
	{
		echo "m180201_044959_createdfile does not support migration down.\n";
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
