<?php

class m180130_020616_create_backend_menus extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_backend_menus', array(
                'id' => 'int(11) AUTO_INCREMENT PRIMARY KEY',
                'parent_menu'=>'int(11)', //default 0 as parent menus
                'nama_menu'=>'text',
				'kontroller'=>'varchar(255)',
				'link_url'=>'text',
				'status'=>'char(1)' // 1 = aktif 0 tidak aktif
        ));
		$this->createTable('t_menus_action', array(
                'id' => 'int(11) AUTO_INCREMENT PRIMARY KEY',
                'menu_id'=>'int(11)', //ambil dari table t_backend_menus
                'action_aksi'=>'varchar(255)', // isian action
				'action_name'=>'varchar(255)', // isian nama action
        ));
	}

	public function down()
	{
		echo "m180130_020616_create_backend_menus does not support migration down.\n";
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