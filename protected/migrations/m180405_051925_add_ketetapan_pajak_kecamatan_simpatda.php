<?php

class m180405_051925_add_ketetapan_pajak_kecamatan_simpatda extends CDbMigration
{
	public function up()
	{
		$this->insert('t_crontab', array(
			'code' => 'runKetetapanKecamatanSimalungun',
			'nama_crontab'=>'DATA KETETAPAN KECAMATAN SIMALUNGUN',
			'url'=>'/autolaporan/RunKetetapanKecamatanSimalungun'
		));
		$this->insert('t_crontab', array(
			'code' => 'runKetetapanRetribusiKecamatanSimalungun',
			'nama_crontab'=>'DATA KETETAPAN KECAMATAN SIMALUNGUN',
			'url'=>'/autolaporan/RunKetetapanRetribusiKecamatanSimalungun'
		));
		$this->createTable('t_ketetapan_kecamatan_simpatda', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
				'kd_kecamatan' => 'int(10)',
                'kodejenispajak'=>'int(10)',
				'jumlah_objek' => 'int(10)',
                'tahun'=>'varchar(4)',
				'ketetapan' => 'decimal(50,2)',
				'sanksi_adm'=>'decimal(50,2)',
				'type_pajak'=>'varchar(10)'
        ));
	}

	public function down()
	{
		echo "m180405_051925_add_ketetapan_pajak_kecamatan_simpatda does not support migration down.\n";
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