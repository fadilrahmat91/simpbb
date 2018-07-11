<?php

class m180130_045117_create_role_akses extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_roles_menu', array(
                'id' => 'int(11) AUTO_INCREMENT PRIMARY KEY',
                'role_kode'=>'varchar(5)', //default 0 as parent menus
                'menu_id'=>'varchar(5)',
				'action_type'=>'varchar(20)'
        ));
	}

	public function down()
	{
		echo "m180130_045117_create_role_akses does not support migration down.\n";
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