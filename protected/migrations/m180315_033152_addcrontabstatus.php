<?php

class m180315_033152_addcrontabstatus extends CDbMigration
{
	public function up()
	{
		$this->createTable('t_crontab', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
				'code' => 'varchar(255)',
                'nama_crontab'=>'varchar(255)',
                'url'=>'text(500)',
				'last_running'=>'datetime'
        ));
		$this->insert('t_crontab', array(
			'code' => 'runtargetkabupaten',
			'nama_crontab'=>'Run Target Kabupaten',
			'url'=>'/autolaporan/runtargetKabupaten'
		));
		$this->insert('t_crontab', array(
			'code' => 'runrealisasikabupaten',
			'nama_crontab'=>'Run Realisasi Kabupaten',
			'url'=>'/autolaporan/runRealisasiKabupaten'
		));
		$this->insert('t_crontab', array(
			'code' => 'runrealisasikelurahan',
			'nama_crontab'=>'Run Realisasi Kelurahan',
			'url'=>'/autolaporan/runRealisasiKelurahan'
		));
		$this->insert('t_crontab', array(
			'code' => 'runtargetkelurahan',
			'nama_crontab'=>'Run Target Kelurahan',
			'url'=>'/autolaporan/runTargetKelurahan'
		));
		$this->insert('t_crontab', array(
			'code' => 'runpembayaranpiutang',
			'nama_crontab'=>'Run Pembayaran Piutang',
			'url'=>'/autolaporan/runPembayaranPiutang'
		));
		$this->createTable('t_crontab_history', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
				'code' => 'varchar(255)',
				'tanggal_running'=>'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP'
        ));
	}

	public function down()
	{
		echo "m180315_033152_addcrontabstatus does not support migration down.\n";
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