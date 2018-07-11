<?php

/**
 * This is the model class for table "{{minimal_ketetapan}}".
 *
 * The followings are the available columns in table '{{minimal_ketetapan}}':
 * @property string $id
 * @property string $tahun
 * @property string $minimal_ketetapan
 */
class PendataanObjekPajak extends CFormModel
{
	// constanta
	
	const S_PEREKAMAN_DATA_OP = '11';
	const S_PEMUTAKHIRAN_DATA_OP = '12';
	const S_PENGHAPUSAN_OP = '13';
	const S_PENGHAPUSAN_STATUS_OP_BERSAMA = '14';
	
	const L_PEREKAMAN_DATA_BANGUNAN = '21';
	const L_PEMUTAKHIRAN_DATA_BANGUNAN = '22';
	const L_PENGHAPUSAN_DATA_BANGUNAN = '23';
	const L_PENILAIAN_INDIVIDU = '24';
	
	const J_TANAH = 'S';
	const J_BANGUNAN = 'L';
	
	public $jenis_formulir;
	public $jenis_transaksi;
	public $no_formulir;
	public $nop;
	public $nop_bersama;
	public $nop_asal;
	public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('jenis_formulir,jenis_transaksi,no_formulir,nop,nop_asal', 'safe'),
        );
    }
	public function jns_formulir(){
		return [
			'0' => 'Pilih Jenis Formulir',
			self::J_BANGUNAN => 'LSPOP', // => Bangunan
			self::J_TANAH => 'SPOP' // => Tanah
		];
	}
	public function jns_transaksi(){
		return [
			self::J_BANGUNAN => [
				[self::L_PEREKAMAN_DATA_BANGUNAN => 'Perekaman Data Baru'],
				[self::L_PEMUTAKHIRAN_DATA_BANGUNAN => 'Pemutakhiran Data Bangunan'],
				[self::L_PENGHAPUSAN_DATA_BANGUNAN => 'Penghapusan Data Bangunan'],
				[self::L_PENILAIAN_INDIVIDU => 'Penilaian Individu']
			], // => Bangunan
			self::J_TANAH => [
					[self::S_PEREKAMAN_DATA_OP => 'Perekaman Data OP'],
					[self::S_PEMUTAKHIRAN_DATA_OP => 'Pemutakhiran Data OP'],
					[self::S_PENGHAPUSAN_OP => 'Penghapusan OP'],
					[self::S_PENGHAPUSAN_STATUS_OP_BERSAMA => 'Penghapusan OP Bersama']
				]
		];
	}
	public function attributeLabels()
	{
		return array(
			'jenis_formulir' => 'Jenis Formulir',
			'jenis_transaksi' => 'Jenis Transaksi',
			'no_formulir' => 'No Formulir',
			'nop' => 'NOP',
			'nop_asal' => 'NOP Asal'
		);
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function arrays_form(){
		
	}
}
