<?php
class Dashboard_model extends CI_Model {
	
	public $sql_filter = "";	
	
	
	/* DASHBOARD */
	
	function fetch_upcoming_delegasi_keluar(){		
			
		$sql = "SELECT * FROM delegasi_keluar dk
                 WHERE  tgl_sidang  > DATE_ADD( NOW(),INTERVAL -1 DAY) AND tgl_sidang < DATE_ADD( NOW(),INTERVAL 21 DAY) ORDER BY tgl_sidang ASC";
		#	echo "<pre>$sql</pre>";
		return $this->db->query($sql)->result_array();				
	}
	
	function fetch_upcoming_delegasi_masuk(){		
			
		$sql = "SELECT dm.*,dpm.jurusita_nama FROM delegasi_masuk dm LEFT OUTER JOIN delegasi_proses_masuk dpm
                ON  dpm.`delegasi_id`=dm.`id`
                 WHERE  tgl_sidang  > DATE_ADD( NOW(),INTERVAL -1 DAY) AND tgl_sidang < DATE_ADD( NOW(),INTERVAL 21 DAY) ORDER BY tgl_sidang ASC";
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

	function jadwal_sidang($ruang){
			$sql = "SELECT nomor_perkara,left(pihak1_text,40) pihak1_text,agenda FROM perkara p, perkara_jadwal_sidang pjs
			WHERE p.`perkara_id`=pjs.`perkara_id`
			AND DATE_FORMAT(tanggal_sidang,'%D %M %Y') = DATE_FORMAT(NOW(),'%D %M %Y')
			AND ruangan = $ruang";
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
			$query = $this->db->query("select * from ( SELECT  nama ketua,id,
					SUM(CASE WHEN YEAR(tanggal_pendaftaran)<YEAR(NOW()) AND (  YEAR(tanggal_putusan) = YEAR(NOW()) OR tanggal_putusan IS NULL ) THEN 1 ELSE 0 END) sisa,
					SUM(CASE WHEN YEAR(tanggal_pendaftaran)=YEAR(NOW()) THEN 1 ELSE 0 END) terima,
					SUM(CASE WHEN YEAR(tanggal_putusan) =YEAR(NOW()) THEN 1 ELSE 0 END) putus,
					SUM(CASE WHEN YEAR(tanggal_minutasi)=YEAR(NOW()) THEN 1 ELSE 0 END) minutasi,
					SUM(CASE WHEN YEAR(tanggal_putusan) IS NULL THEN 1 ELSE 0 END) sisask
					FROM 
					(
					SELECT a.perkara_id,b.id, b.nama,a.`nomor_perkara`,tanggal_pendaftaran, tanggal_putusan, tanggal_minutasi
					FROM v_perkara a LEFT JOIN hakim_pn b
					ON (SUBSTRING_INDEX(majelis_hakim_id, ',', 1) = b.`id`)
					) AS z
					GROUP BY nama) as a1
					WHERE ( terima + sisa ) > 0");			
		return $query->result_array();	
			
		}
		
		function get_progress_pp(){
			$query = $this->db->query("SELECT * FROM ( SELECT  nama pp,id,
					SUM(CASE WHEN YEAR(tanggal_pendaftaran)<YEAR(NOW()) AND (  YEAR(tanggal_putusan) = YEAR(NOW()) OR tanggal_putusan IS NULL ) THEN 1 ELSE 0 END) sisa,
					SUM(CASE WHEN YEAR(tanggal_pendaftaran)=YEAR(NOW()) THEN 1 ELSE 0 END) terima,
					SUM(CASE WHEN YEAR(tanggal_putusan) =YEAR(NOW()) THEN 1 ELSE 0 END) putus,
					SUM(CASE WHEN YEAR(tanggal_minutasi)=YEAR(NOW()) THEN 1 ELSE 0 END) minutasi,
					SUM(CASE WHEN YEAR(tanggal_putusan) IS NOT NULL AND YEAR(tanggal_putusan)=year(now()) and YEAR(tanggal_minutasi) is NULL THEN 1 ELSE 0 END) sisask
					FROM 
					(
					SELECT a.perkara_id,b.id, b.nama,a.`nomor_perkara`,tanggal_pendaftaran, tanggal_putusan, tanggal_minutasi
					FROM v_perkara a LEFT JOIN panitera_pn b
					ON (panitera_pengganti_id = b.`id`)
					) AS z
					 GROUP BY nama) AS a1
					  WHERE ( terima + sisa ) > 0");
		return $query->result_array();			 
		}
		


		function get_progress_hakim_detail($id,$filter){
		switch($filter) {
			case 'sisa' :
				$sql_filter = 'and YEAR(tanggal_pendaftaran)<YEAR(NOW()) AND (  YEAR(tanggal_minutasi) = YEAR(NOW()) OR tanggal_minutasi IS NULL )';
			break;case 'terima' :
				$sql_filter = 'and YEAR(tanggal_pendaftaran)=YEAR(NOW())';
			break;
			case 'putus' :
				$sql_filter = 'and YEAR(tanggal_putusan)=YEAR(NOW())';
			break;
            case 'minutasi' :
				$sql_filter = 'and YEAR(tanggal_minutasi)=YEAR(NOW())';
			break;
			case 'sisask':
				$sql_filter = 'and YEAR(tanggal_putusan) is NULL';
			break;
			default:
				$sql_filter = '';
			
		}
		#echo $sql_filter;
        // klo hakim_id 0, berarti belum ditentukan
        if ( $id == 0 ) :
            $sql_filter .= " and b.id is null";
        else :
            $sql_filter .= " and b.id = ".$id;
        endif;
		
		$sql = "SELECT a.perkara_id,a.`nomor_perkara`,pihak1_text, DATE_FORMAT(tanggal_pendaftaran,'%d-%m-%Y') tanggal_pendaftaran, DATE_FORMAT(sidang_pertama,'%d-%m-%Y') sidang_pertama,panitera_pengganti_text, DATE_FORMAT(tanggal_putusan,'%d-%m-%Y') tanggal_putusan, DATE_FORMAT(tanggal_minutasi,'%d-%m-%Y') tanggal_minutasi,proses_terakhir_text
									FROM v_perkara a LEFT JOIN hakim_pn b
									ON (SUBSTRING_INDEX(majelis_hakim_id, ',', 1) = b.`id`)
									WHERE 1=1
									".$sql_filter;
		
		#echo "<pre>$sql</pre>";
        $query = $this->db->query($sql);
		return $query->result_array();	
			
		}
		
		
		function get_progress_pp_detail($id,$filter){
		switch($filter) {
			case 'sisa' :
				$sql_filter = 'and YEAR(tanggal_pendaftaran)<YEAR(NOW()) AND (  YEAR(tanggal_minutasi) = YEAR(NOW()) OR tanggal_minutasi IS NULL )';
			break;case 'terima' :
				$sql_filter = 'and YEAR(tanggal_pendaftaran)=YEAR(NOW())';
			break;
			case 'putus' :
				$sql_filter = 'and YEAR(tanggal_putusan)=YEAR(NOW())';
			break;
            case 'minutasi' :
				$sql_filter = 'and YEAR(tanggal_minutasi)=YEAR(NOW())';
			break;
			case 'sisask':
				$sql_filter = 'and YEAR(tanggal_putusan) is NOT NULL and year(tanggal_putusan)=year(now()) AND YEAR(tanggal_minutasi) is NULL';
			break;
			default:
				$sql_filter = '';
			
		}
		#echo $sql_filter;
       // klo PP_ID 0, berarti belum ditentukan
        if ( $id == 0 ) :
            $sql_filter .= " and b.id is null";
        else :
            $sql_filter .= " and b.id = ".$id;
        endif;

		
		$sql = "SELECT a.perkara_id,a.`nomor_perkara`,pihak1_text, DATE_FORMAT(tanggal_pendaftaran,'%d-%m-%Y') tanggal_pendaftaran, DATE_FORMAT(sidang_pertama,'%d-%m-%Y') sidang_pertama,panitera_pengganti_text, DATE_FORMAT(tanggal_putusan,'%d-%m-%Y') tanggal_putusan, DATE_FORMAT(tanggal_minutasi,'%d-%m-%Y') tanggal_minutasi,proses_terakhir_text
				FROM v_perkara a LEFT outer JOIN panitera_pn b
				ON (panitera_pengganti_id = b.`id`)
				WHERE 1=1
				".$sql_filter;
		
		$query = $this->db->query($sql);			
		return $query->result_array();	
			
		}
	
    function get_nama_hakim($id){
        if ( $id == 0 )
            return "Belum ditentukan" ;
        $sql = $this->db->where("id",$id);
        $data = $this->db->get("hakim_pn")->row();
       return $data->nama_gelar;
    }

    function get_nama_pp($id){
        if ( $id == 0 )
            return "Belum ditentukan" ;
        $sql = $this->db->where("id",$id);
        $data = $this->db->get("panitera_pn")->row();
		return $data->nama_gelar;
    }
	
        function get_data_ikrar()
    	{
    		$sql = "SELECT DISTINCT * FROM perkara AS a LEFT JOIN perkara_ikrar_talak AS b ON a.`perkara_id`=b.`perkara_id`
    LEFT JOIN perkara_putusan AS c ON a.`perkara_id`=c.`perkara_id` join perkara_hakim_pn as d on a.`perkara_id`=d.`perkara_id`
    WHERE a.jenis_perkara_id='346' AND YEAR(a.tanggal_pendaftaran)=YEAR(NOW()) and c.status_putusan_id=62
    and b.`penetapan_majelis_hakim` is NULL  AND c.tanggal_bht IS NOT NULL and jabatan_hakim_id=1 and d.`aktif`='Y'";

    		$query = $this->db->query($sql);
    		return $query->result_array();
    	}

    	function get_sys_config($name)
    	{
    		$sql="select * from sys_config where name = '$name'";
    		$query = $this->db->query($sql);
    		return $query->row()->value;
    	}

		
	
}
?>
