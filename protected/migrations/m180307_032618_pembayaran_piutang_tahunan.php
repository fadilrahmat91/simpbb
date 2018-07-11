<?php

class m180307_032618_pembayaran_piutang_tahunan extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_total_pembayaran_piutang', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
                'kabupaten_id'=>'varchar(5)',
				'kecamatan_id'=>'varchar(5)',
				'kelurahan_id'=>'varchar(5)',
                'tahun_bayar'=>'varchar(4)',
				'pembayaran_denda'=>'decimal(50,2)',
				'pembayaran_pokok'=>'decimal(50,2)'
        ));
	}

	public function down()
	{
		echo "m180307_032618_pembayaran_piutang_tahunan does not support migration down.\n";
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