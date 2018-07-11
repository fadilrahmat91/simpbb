<?php

class m180201_135955_add_field_data_laporan extends CDbMigration
{
	public function up()
	{
		$this->addColumn('t_total_target_pajak_kabupaten','kd_kecamatan','varchar(5)');
		//$this->addColumn('t_total_target_pajak_kabupaten','kd_kelurahan','varchar(5)');
		$this->addColumn('t_total_realisasi_pajak_kabupaten','kd_kecamatan','varchar(5)');
		//$this->addColumn('t_total_realisasi_pajak_kabupaten','kd_kelurahan','varchar(5)');
	}

	public function down()
	{
		echo "m180201_135955_add_field_data_laporan does not support migration down.\n";
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
