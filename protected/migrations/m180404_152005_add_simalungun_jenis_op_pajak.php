<?php

class m180404_152005_add_simalungun_jenis_op_pajak extends CDbMigration
{
	public function up()
	{
		$this->insert('t_crontab', array(
			'code' => 'rungetjenisOpSimalungun',
			'nama_crontab'=>'Jenis Objek Pajak SIMPATDA',
			'url'=>'/autolaporan/rungetjenisOpSimalungun'
		));
		$this->insert('t_crontab', array(
			'code' => 'getdatapajak',
			'nama_crontab'=>'DATA REALISASI SIMPATDA',
			'url'=>'/autolaporan/getdatapajak'
		));
		$this->createTable('t_jenis_objek_pajak_simpatda', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
                'kodejenispajak'=>'int(10)',
                'jenispajak'=>'varchar(255)'
        ));
		$this->createTable('t_realisasi_tahunan_simpatda', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
                'kodejenispajak'=>'int(10)',
                'tahun'=>'varchar(4)',
				'pajakterutang'=>'decimal(50,2)',
				'denda'=>'decimal(50,2)',
				'sanksi_adm'=>'decimal(50,2)'
        ));
	}

	public function down()
	{
		echo "m180404_152005_add_simalungun_jenis_op_pajak does not support migration down.\n";
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