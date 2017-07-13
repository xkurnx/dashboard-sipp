<?php
class Dashboard_model extends CI_Model {
	
	public $sql_filter = "";	
	
	
	/* DASHBOARD */
	
	function fetch_upcoming_delegasi_keluar(){		
			
		$sql = "SELECT * FROM delegasi_keluar WHERE  tgl_sidang > NOW() ORDER BY tgl_sidang asc ";
		#	echo "<pre>$sql</pre>";
		return $this->db->query($sql)->result_array();				
	}
	
	function fetch_upcoming_delegasi_masuk(){		
			
		$sql = "SELECT * FROM delegasi_masuk WHERE  tgl_sidang > NOW() ORDER BY tgl_sidang asc ";
		#	echo "<pre>$sql</pre>";
		return $this->db->query($sql)->result_array();				
	}
	
	function fetch_rekap_sidang(){
		$sql = "SELECT SUM(1) s_hari_ini,
				SUM( CASE WHEN sidang_keliling='T' THEN 1 ELSE 0 END ) s_pa,
				SUM( CASE WHEN sidang_keliling='Y' THEN 1 ELSE 0 END ) sidkel
				FROM perkara_jadwal_sidang
				WHERE DATE_FORMAT(tanggal_sidang,'%D %M %Y') = DATE_FORMAT(NOW(),'%D %M %Y')";
		return $this->db->query($sql)->result_array();
	}
	
	function fetch_rekap_stat_perkara(){
		$sql = "SELECT * FROM
(
SELECT '1.stat_global' ket, -- SUBSTRING_INDEX(SUBSTRING_INDEX( REPLACE(`majelis_hakim_nama`,'</br>','<br/>') , '<br/>', 2 ),'<br/>',1) ketua,
SUM(CASE WHEN YEAR(tanggal_pendaftaran)<YEAR(NOW())  AND (tanggal_minutasi IS NULL OR YEAR(tanggal_minutasi)=YEAR(NOW())) THEN 1 ELSE 0 END) sisa,
SUM(CASE WHEN YEAR(tanggal_pendaftaran)=YEAR(NOW()) THEN 1 ELSE 0 END) terima,
SUM(CASE WHEN YEAR(tanggal_putusan) = YEAR(NOW()) THEN 1 ELSE 0 END) putus,
SUM(CASE WHEN YEAR(tanggal_minutasi) =YEAR(NOW()) THEN 1 ELSE 0 END) minutasi
FROM v_perkara
UNION
SELECT '2.stat_today' ket, -- SUBSTRING_INDEX(SUBSTRING_INDEX( REPLACE(`majelis_hakim_nama`,'</br>','<br/>') , '<br/>', 2 ),'<br/>',1) ketua,
SUM(CASE WHEN YEAR(tanggal_pendaftaran)<YEAR(NOW())  AND (tanggal_minutasi IS NULL OR YEAR(tanggal_minutasi)=YEAR(NOW())) THEN 1 ELSE 0 END) sisa,
SUM(CASE WHEN DATE_FORMAT(tanggal_pendaftaran,'%D %M %Y') = DATE_FORMAT(NOW(),'%D %M %Y') THEN 1 ELSE 0 END) terima,
SUM(CASE WHEN DATE_FORMAT(tanggal_putusan,'%D %M %Y') = DATE_FORMAT(NOW(),'%D %M %Y') THEN 1 ELSE 0 END) putus,
SUM(CASE WHEN DATE_FORMAT(tanggal_minutasi,'%D %M %Y') = DATE_FORMAT(NOW(),'%D %M %Y') THEN 1 ELSE 0 END) minutasi
FROM v_perkara
UNION
SELECT '3.stat_this_month' ket, -- SUBSTRING_INDEX(SUBSTRING_INDEX( REPLACE(`majelis_hakim_nama`,'</br>','<br/>') , '<br/>', 2 ),'<br/>',1) ketua,
SUM(CASE WHEN YEAR(tanggal_pendaftaran)<YEAR(NOW())  AND (tanggal_minutasi IS NULL OR YEAR(tanggal_minutasi)=YEAR(NOW())) THEN 1 ELSE 0 END) sisa,
SUM(CASE WHEN DATE_FORMAT(tanggal_pendaftaran,'%M %Y') = DATE_FORMAT(NOW(),'%M %Y') THEN 1 ELSE 0 END) terima,
SUM(CASE WHEN DATE_FORMAT(tanggal_putusan,'%M %Y') = DATE_FORMAT(NOW(),'%M %Y') THEN 1 ELSE 0 END) putus,
SUM(CASE WHEN DATE_FORMAT(tanggal_minutasi,'%M %Y') = DATE_FORMAT(NOW(),'%M %Y') THEN 1 ELSE 0 END) minutasi
FROM v_perkara
) AS z
ORDER BY ket ASC";
		return $this->db->query($sql)->result_array();
	}
		
	
	function get_progress_hakim(){
		$query = $this->db->query("select * from ( SELECT  nama ketua,
SUM(CASE WHEN YEAR(tanggal_pendaftaran)<YEAR(NOW()) AND (  YEAR(tanggal_minutasi) = YEAR(NOW()) OR tanggal_minutasi IS NULL ) THEN 1 ELSE 0 END) sisa,
SUM(CASE WHEN YEAR(tanggal_pendaftaran)=YEAR(NOW()) THEN 1 ELSE 0 END) terima,
SUM(CASE WHEN YEAR(tanggal_putusan) =YEAR(NOW()) THEN 1 ELSE 0 END) putus,
SUM(CASE WHEN YEAR(tanggal_minutasi)=YEAR(NOW()) THEN 1 ELSE 0 END) minutasi,
SUM(CASE WHEN YEAR(tanggal_putusan) IS NULL THEN 1 ELSE 0 END) sisask
FROM 
(
SELECT a.perkara_id,b.nama,a.`nomor_perkara`,tanggal_pendaftaran, tanggal_putusan, tanggal_minutasi
FROM v_perkara a LEFT JOIN hakim_pn b
ON (SUBSTRING_INDEX(majelis_hakim_id, ',', 1) = b.`id`)
) AS z
 GROUP BY nama) as a1
  WHERE ( terima + sisa ) > 0");			
		return $query->result_array();	
			
		}
		
		
	
	
		
	
}
?>
