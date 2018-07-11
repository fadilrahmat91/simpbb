<?php

class m180328_110526_add_total_pembayaran_date_bayar_dan_jatuh_tempo extends CDbMigration
{
	public function up()
	{
		$this->addColumn('t_total_pembayaran_piutang','status','varchar(10)');
	}

	public function down()
	{
		echo "m180328_110526_add_total_pembayaran_date_bayar_dan_jatuh_tempo does not support migration down.\n";
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