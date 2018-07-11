<?php

class m180205_034435_table_ketetapan_realisasi_kelurahan extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_total_target_pajak_kelurahan', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
                'kabupaten_id'=>'varchar(5)',
                'tahun_pajak_sppt'=>'varchar(4)',
				'total_objek'=>'int(10)',
				'ketetapan'=>'decimal(50,2)',
				'luas_bumi'=>'decimal(50,2)',
				'luas_bangunan'=>'decimal(50,2)',
				'kd_kecamatan' => 'varchar(5)',
				'kd_kelurahan' => 'varchar(6)'
        ));
		$this->createTable('t_total_realisasi_pajak_kelurahan', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
                'kabupaten_id'=>'varchar(5)',
                'tahun_pajak_sppt'=>'varchar(4)',
				'total_objek'=>'int(10)',
				'denda'=>'decimal(50,2)',
				'jumlah_bayar'=>'decimal(50,2)',
				'kd_kecamatan' => 'varchar(5)',
				'kd_kelurahan' => 'varchar(6)'
        ));
	}

	public function down()
	{
		echo "m180205_034435_table_ketetapan_realisasi_kelurahan does not support migration down.\n";
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