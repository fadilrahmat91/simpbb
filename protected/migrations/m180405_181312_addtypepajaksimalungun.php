<?php

class m180405_181312_addtypepajaksimalungun extends CDbMigration
{
	public function up()
	{
		$this->addColumn('t_jenis_objek_pajak_simpatda','type_pajak','varchar(10)');
	}

	public function down()
	{
		echo "m180405_181312_addtypepajaksimalungun does not support migration down.\n";
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