<?php

class m180131_062046_create_table_total_realisasi_kabupaten extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_total_realisasi_pajak_kabupaten', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
                'kabupaten_id'=>'varchar(5)',
                'tahun_pajak_sppt'=>'varchar(4)',
				'total_objek'=>'int(10)',
				'denda'=>'decimal(50,2)',
				'jumlah_bayar'=>'decimal(50,2)'
        ));
	}

	public function down()
	{
		echo "m180131_062046_create_table_total_realisasi_kabupaten does not support migration down.\n";
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