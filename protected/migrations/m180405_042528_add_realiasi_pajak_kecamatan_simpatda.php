<?php

class m180405_042528_add_realiasi_pajak_kecamatan_simpatda extends CDbMigration
{
	public function up()
	{
		$this->insert('t_crontab', array(
			'code' => 'GetDataPajakKecamatan',
			'nama_crontab'=>'DATA REALISASI KECAMATAN SIMPATDA',
			'url'=>'/autolaporan/GetDataPajakKecamatan'
		));
		$this->createTable('t_realisasi_kecamatan_simpatda', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
				'kd_kecamatan' => 'int(10)',
                'kodejenispajak'=>'int(10)',
				'jumlah_objek' => 'int(10)',
                'tahun'=>'varchar(4)',
				'ketetapan' => 'decimal(50,2)',
				'jumlah_bayar'=>'decimal(50,2)',
				'jumlah_denda'=>'decimal(50,2)',
				'jumlah_sanksi_adm'=>'decimal(50,2)'
        ));
	}

	public function down()
	{
		echo "m180405_042528_add_realiasi_pajak_kecamatan_simpatda does not support migration down.\n";
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