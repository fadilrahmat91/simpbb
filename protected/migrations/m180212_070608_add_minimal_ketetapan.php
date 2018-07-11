<?php

class m180212_070608_add_minimal_ketetapan extends CDbMigration
{
	public function up()
	{
		$this->addColumn('t_total_target_pajak_kabupaten','minimal_ketetapan','decimal(50,2)');
		//$this->addColumn('t_total_realisasi_pajak_kabupaten','minimal_ketetapan','decimal(50,2)');
		$this->addColumn('t_total_target_pajak_kelurahan','minimal_ketetapan','decimal(50,2)');
		//$this->addColumn('t_total_realisasi_pajak_kelurahan','minimal_ketetapan','decimal(50,2)');
		$this->createTable('t_minimal_ketetapan', array(
                'id' => 'bigint(20) AUTO_INCREMENT PRIMARY KEY',
                'tahun'=>'varchar(5)',
                'minimal_ketetapan'=>'decimal(50,2)'
        ));
		$this->insert('t_minimal_ketetapan', array(
                'tahun'=>'2013',
                'minimal_ketetapan'=>'5000'
            ));
		$this->insert('t_minimal_ketetapan', array(
                'tahun'=>'2014',
                'minimal_ketetapan'=>'5000'
            ));
		$this->insert('t_minimal_ketetapan', array(
                'tahun'=>'2015',
                'minimal_ketetapan'=>'5000'
            ));
		$this->insert('t_minimal_ketetapan', array(
                'tahun'=>'2016',
                'minimal_ketetapan'=>'5000'
            ));
		$this->insert('t_minimal_ketetapan', array(
                'tahun'=>'2017',
                'minimal_ketetapan'=>'5000'
            ));
		$this->insert('t_minimal_ketetapan', array(
                'tahun'=>'2018',
                'minimal_ketetapan'=>'5000'
            ));
		$this->insert('t_minimal_ketetapan', array(
                'tahun'=>'2019',
                'minimal_ketetapan'=>'5000'
            ));
	}

	public function down()
	{
		echo "m180212_070608_add_minimal_ketetapan does not support migration down.\n";
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