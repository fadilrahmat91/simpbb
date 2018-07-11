<?php

class m180315_044128_add_pembayaran_piutang_tahun_pajak extends CDbMigration
{
	public function up()
	{
		$this->addColumn('t_total_pembayaran_piutang','tahun_pajak','varchar(4)');
		$this->addColumn('t_total_pembayaran_piutang','total_objek','int(20)');
	}

	public function down()
	{
		echo "m180315_044128_add_pembayaran_piutang_tahun_pajak does not support migration down.\n";
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