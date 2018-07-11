<?php
class CRealcount{
	public function c_day (){
		return date("m/d/Y");
	}
	
	public function init()
    {
        date_default_timezone_set("UTC");
    }
	public function get_data_dayKetetapan($d_date){
		//$d_date = self::c_day();
		$sql = "select 
			count(*) AS JUM_OBJEK_PAJAK,
			A.KD_KECAMATAN,
			SUM( A.PBB_TERHUTANG_SPPT) AS KETETAPAN
		from SPPT A
		where 1 = 1
		AND A.TGL_TERBIT_SPPT BETWEEN TO_DATE('$d_date 00:00:00', 'MM/DD/YYYY HH24:MI:SS')
					AND TO_DATE('$d_date 11:59:00', 'MM/DD/YYYY HH24:MI:SS')
		GROUP BY A.KD_KECAMATAN";
		
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
			
		$data = new CSqlDataProvider($sql, array(
			'db' => Yii::app()->dbOracle,
            'keyField' => 'KD_KECAMATAN',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'KD_KECAMATAN', 'count'
                ),
				'defaultOrder'=>'KD_KECAMATAN ASC',
            ),
            'pagination'=>FALSE,
                )
        );
		return $data->getData();
	}
	public function get_data_dayRealisasi($d_date){
		//$d_date = self::c_day();
		$sql = "SELECT 
					COUNT(*) as TOTAL_OBJEK_PAJAK,
					A.KD_KECAMATAN,
					SUM(A.DENDA_SPPT) AS PEMBAYARAN_DENDA, 
					SUM(A.JML_SPPT_YG_DIBAYAR) AS PEMBAYARAN_POKOK,
					A.THN_PAJAK_SPPT
				FROM 
					PEMBAYARAN_SPPT A, SPPT B 
				WHERE A. KD_PROPINSI=B.KD_PROPINSI(+)
					AND A. KD_DATI2=B.KD_DATI2(+)
					AND A. KD_KECAMATAN=B.KD_KECAMATAN(+)
					AND A. KD_KELURAHAN=B.KD_KELURAHAN(+)
					AND A. KD_BLOK=B.KD_BLOK(+)
					AND A. NO_URUT=B.NO_URUT(+)
					AND A. KD_JNS_OP=B.KD_JNS_OP(+)
					AND A.THN_PAJAK_SPPT = B.THN_PAJAK_SPPT(+)
					AND A.TGL_PEMBAYARAN_SPPT BETWEEN TO_DATE('$d_date 00:00:00', 'MM/DD/YYYY HH24:MI:SS')
					AND TO_DATE('$d_date 11:59:00', 'MM/DD/YYYY HH24:MI:SS')
				GROUP BY A.KD_KECAMATAN, A.THN_PAJAK_SPPT
				";
		
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
			
		$data = new CSqlDataProvider($sql, array(
			'db' => Yii::app()->dbOracle,
            'keyField' => 'KD_KELURAHAN',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'KD_KECAMATAN', 'count'
                ),
				'defaultOrder'=>'KD_KECAMATAN ASC',
            ),
            'pagination'=>FALSE,
                )
        );
		return $data->getData();
	}
	
}

?>