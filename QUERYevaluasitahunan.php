SELECT 
						
						TAHUN,
						SUM(JUM_OBJEK_KETETAPAN) AS JUM_OBJEK_KETETAPAN,
						SUM(KETETAPAN) AS KETETAPAN,
						SUM(DENDA_SPPT) AS DENDA_SPPT,
						SUM(JUMLAH_BAYAR) AS JUMLAH_BAYAR,
						SUM( CASE WHEN STATUS = '0' THEN 1 ELSE 0  END) AS JUM_OBJEK_PIUTANG,
						SUM( CASE WHEN STATUS = '0' THEN KETETAPAN ELSE 0  END) AS PIUTANG,
						SUM( CASE WHEN STATUS = '1' THEN 1 ELSE 0  END) AS JUM_OBJEK_REALISASI,
						SUM( CASE WHEN STATUS = '1' THEN JUMLAH_BAYAR ELSE 0  END) AS REALISASI,
						( SUM(KETETAPAN) - SUM( CASE WHEN STATUS = '1' THEN JUMLAH_BAYAR ELSE 0  END) - SUM( CASE WHEN STATUS = '0' THEN KETETAPAN ELSE 0  END) ) AS SELISIH
					 FROM (
						 SELECT 
							BKetetapan.KD_PROPINSI,
							BKetetapan.KD_DATI2,
							BKetetapan.KD_KECAMATAN,
							BKetetapan.KD_KELURAHAN,
							BKetetapan.KD_BLOK,
							BKetetapan.NO_URUT,
							BKetetapan.KD_JNS_OP,
							BKetetapan.TAHUN,
							BKetetapan.KETETAPAN,
							BKetetapan.JUM_OBJEK_KETETAPAN,
							DECODE(BKetetapan.STATUS_PEMBAYARAN_SPPT,'0','BELUM BAYAR','1','BAYAR') STATUS_BAYAR,
							BPembayaran.DENDA_SPPT,
							BPembayaran.JUMLAH_BAYAR,
							BPembayaran.BERAPAKALIBAYAR,
							( CASE WHEN BKetetapan.STATUS_PEMBAYARAN_SPPT = '0' THEN '0' WHEN BPembayaran.STATUS_PEMBAYARAN = '0' THEN '0' ELSE '1' END ) AS STATUS
						 FROM (
							SELECT 
								A.KD_PROPINSI,
								A.KD_DATI2,
								A.KD_KECAMATAN,
								A.KD_KELURAHAN,
								A.KD_BLOK,
								A.KD_JNS_OP,
								A.NO_URUT,
								A.THN_PAJAK_SPPT AS TAHUN,
								1 AS JUM_OBJEK_KETETAPAN,
								( CASE WHEN A.PBB_TERHUTANG_SPPT < C.NILAI_PBB_MINIMAL THEN C.NILAI_PBB_MINIMAL ELSE A.PBB_TERHUTANG_SPPT END ) AS KETETAPAN,
								A.STATUS_PEMBAYARAN_SPPT
							FROM 
								SPPT A, PBB_MINIMAL C where A.THN_PAJAK_SPPT = C.THN_PBB_MINIMAL
							) BKetetapan left join (
								SELECT 
									XC.KD_PROPINSI_P,
									XC.KD_DATI2_P,
									XC.KD_KECAMATAN_P,
									XC.KD_KELURAHAN_P,
									XC.KD_BLOK_P,
									XC.NO_URUT_P,
									XC.KD_JNS_OP_P,
									XC.TAHUN,
									COUNT(*) AS BERAPAKALIBAYAR,
									SUM(DENDA_SPPT) AS DENDA_SPPT,
									SUM(JUMLAH_BAYAR) AS JUMLAH_BAYAR,
									STATUS_PEMBAYARAN
									FROM (
										SELECT 
											A.KD_PROPINSI_P,
											A.KD_DATI2_P,
											A.KD_KECAMATAN_P,
											A.KD_KELURAHAN_P,
											A.KD_BLOK_P,
											A.NO_URUT_P,
											A.KD_JNS_OP_P,
											A.THN_PAJAK_SPPT AS TAHUN,
											A.DENDA_SPPT AS DENDA_SPPT,
											(A.JML_SPPT_YG_DIBAYAR - A.DENDA_SPPT) AS JUMLAH_BAYAR,
											( CASE WHEN to_char(A.TGl_PEMBAYARAN_SPPT,'YYYY') != A.THN_PAJAK_SPPT THEN '0' ELSE '1' END ) AS STATUS_PEMBAYARAN
										FROM PEMBAYARAN_SPPT  A where  A.THN_PAJAK_SPPT = '2018'
									) XC
									group by 
									XC.KD_PROPINSI_P,
									XC.KD_DATI2_P,
									XC.KD_KECAMATAN_P,
									XC.KD_KELURAHAN_P,
									XC.KD_BLOK_P,
									XC.NO_URUT_P,
									XC.KD_JNS_OP_P,
									XC.TAHUN,
									XC.STATUS_PEMBAYARAN
							) BPembayaran ON 
								BKetetapan.KD_PROPINSI = BPembayaran.KD_PROPINSI_P AND 
								BKetetapan.KD_DATI2 = BPembayaran.KD_DATI2_P AND 
								BKetetapan.KD_KECAMATAN = BPembayaran.KD_KECAMATAN_P AND 
								BKetetapan.KD_KELURAHAN = BPembayaran.KD_KELURAHAN_P AND 
								BKetetapan.KD_BLOK = BPembayaran.KD_BLOK_P AND 
								BKetetapan.NO_URUT = BPembayaran.NO_URUT_P AND
								BKetetapan.KD_JNS_OP = BPembayaran.KD_JNS_OP_P AND
								BKetetapan.TAHUN = BPembayaran.TAHUN
					) YX
					WHERE 1 = 1
					 GROUP BY 
							TAHUN
							ORDER BY TAHUN DESC