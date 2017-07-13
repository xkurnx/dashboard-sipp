<?php
class Perkara_model extends CI_Model {

	public $sql_filter = "";


	/* Penanganan Perkara */


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


	function get_process_hakim(){
			$query = $this->db->query("SELECT * FROM ( SELECT  nama ketua,id,
					SUM(CASE WHEN tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 120 THEN 1 ELSE 0 END) baik,
					SUM(CASE WHEN tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 120 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 180 THEN 1 ELSE 0 END) kurang,
					SUM(CASE WHEN tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 180 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)<= 360 THEN 1 ELSE 0 END) sangat,
					SUM(CASE WHEN tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)> 360 THEN 1 ELSE 0 END) bahaya
					FROM
					(
					SELECT a.perkara_id,b.id, b.nama,a.`nomor_perkara`,tanggal_pendaftaran, tanggal_putusan, tanggal_minutasi
					FROM v_perkara a LEFT JOIN hakim_pn b
					ON (SUBSTRING_INDEX(majelis_hakim_id, ',', 1) = b.`id`)
					) AS z
					GROUP BY nama) AS a1
					WHERE ( baik + kurang + sangat + bahaya ) > 0");
		return $query->result_array();

		}

    function get_process_hakim_total(){
			$query = $this->db->query("SELECT COUNT(*) as total_hakim FROM v_perkara a LEFT JOIN hakim_pn b
			ON (SUBSTRING_INDEX(majelis_hakim_id, ',', 1) = b.`id`) WHERE tanggal_putusan IS NULL");
		return $query->result_array();

		}




	function get_selesai_hakim(){
			$query = $this->db->query("SELECT * FROM ( SELECT  nama ketua,id,
					SUM(CASE WHEN YEAR(tanggal_putusan)=YEAR(NOW()) AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 120 THEN 1 ELSE 0 END) baik,
					SUM(CASE WHEN tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 120 THEN 1 ELSE 0 END) sisa_baik,
					SUM(CASE WHEN YEAR(tanggal_putusan)=YEAR(NOW()) AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 120 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 180 THEN 1 ELSE 0 END) kurang,
					SUM(CASE WHEN tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 120 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 180 THEN 1 ELSE 0 END) sisa_kurang,
					SUM(CASE WHEN YEAR(tanggal_putusan)=YEAR(NOW()) AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 180 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)<= 360 THEN 1 ELSE 0 END) sangat,
					SUM(CASE WHEN tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 180 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)<= 360 THEN 1 ELSE 0 END) sisa_sangat,
					SUM(CASE WHEN YEAR(tanggal_putusan)=YEAR(NOW()) AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)> 360 THEN 1 ELSE 0 END) bahaya,
					SUM(CASE WHEN tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)> 360 THEN 1 ELSE 0 END) sisa_bahaya
					FROM
					(
					SELECT a.perkara_id,b.id, b.nama,a.`nomor_perkara`,tanggal_pendaftaran, tanggal_putusan, tanggal_minutasi
					FROM v_perkara a LEFT JOIN hakim_pn b
					ON (SUBSTRING_INDEX(majelis_hakim_id, ',', 1) = b.`id`)
					) AS z
					GROUP BY nama) AS a1
					WHERE ( baik + kurang + sangat + bahaya ) > 0");
		return $query->result_array();

		}

	function get_selesai_hakim_total(){
			$query = $this->db->query("SELECT COUNT(*) AS total_hakim_selesai FROM v_perkara a LEFT JOIN hakim_pn b
			ON (SUBSTRING_INDEX(majelis_hakim_id, ',', 1) = b.`id`) WHERE YEAR(tanggal_putusan)=YEAR(NOW())");
		return $query->result_array();

		}




	function get_process_perkara_masuk(){
			$query = $this->db->query("SELECT (SELECT COUNT(*) FROM v_perkara WHERE YEAR(tanggal_putusan)=2017) +
			(SELECT COUNT(*) FROM v_perkara WHERE tanggal_putusan IS NULL) AS masuk");
		return $query->result_array();

		}

		function get_progress_pp(){
			$query = $this->db->query("SELECT * FROM ( SELECT  nama pp,id,
					SUM(CASE WHEN YEAR(tanggal_pendaftaran)<YEAR(NOW()) AND (  YEAR(tanggal_minutasi) = YEAR(NOW()) OR tanggal_minutasi IS NULL ) THEN 1 ELSE 0 END) sisa,
					SUM(CASE WHEN YEAR(tanggal_pendaftaran)=YEAR(NOW()) THEN 1 ELSE 0 END) terima,
					SUM(CASE WHEN YEAR(tanggal_putusan) =YEAR(NOW()) THEN 1 ELSE 0 END) putus,
					SUM(CASE WHEN YEAR(tanggal_minutasi)=YEAR(NOW()) THEN 1 ELSE 0 END) minutasi
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

		function get_process_hakim_detail($id,$filter){
		switch($filter) {
			case 'baik' :
		if ( $id == 0 ) {
            $sql_filter = "and tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 120 and b.id is null";
        }else {
            $sql_filter = "and tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 120 and b.id = ".$id;
        }

				#$sql_filter = 'and tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 120';
			break;
			case 'kurang' :
		if ( $id == 0 ) {
            $sql_filter = "and tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 120 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 180 and b.id is null";
        }else {
            $sql_filter = "and tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 120 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 180 and b.id = ".$id;
		}

				#$sql_filter = 'and tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 120 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 180';
			break;
			case 'sangat' :
		if ( $id == 0 ) {
            $sql_filter = "and tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 180 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)<= 360 and b.id is null";
        }else {
            $sql_filter = "and tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 180 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)<= 360 and b.id = ".$id;
        }

				#$sql_filter = 'and tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 180 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 360';
			break;
			case 'bahaya' :
		if ( $id == 0 ) {
            $sql_filter = "and tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)> 360 and b.id is null";
        }else {
            $sql_filter = "and tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)> 360 and b.id = ".$id;
        }

				#$sql_filter = 'and tanggal_putusan IS NULL AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)> 360';
			break;
			default:
				$sql_filter = '';

		}
		#echo $sql_filter;



		$sql = "SELECT a.perkara_id,a.`nomor_perkara`,pihak1_text, DATE_FORMAT(tanggal_pendaftaran,'%d-%m-%Y') tanggal_pendaftaran, DATE_FORMAT(sidang_pertama,'%d-%m-%Y') sidang_pertama,panitera_pengganti_text, DATE_FORMAT(tanggal_putusan,'%d-%m-%Y') tanggal_putusan, DATE_FORMAT(tanggal_minutasi,'%d-%m-%Y') tanggal_minutasi,proses_terakhir_text, a.proses_terakhir_id, a.diperbaharui_oleh, a.diperbaharui_tanggal
									FROM v_perkara a LEFT JOIN hakim_pn b
									ON (SUBSTRING_INDEX(majelis_hakim_id, ',', 1) = b.`id`)
									WHERE 1=1 ".$sql_filter;

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
			default:
				$sql_filter = '';

		}
		#echo $sql_filter;

		$sql = "SELECT a.perkara_id,a.`nomor_perkara`,pihak1_text, DATE_FORMAT(tanggal_pendaftaran,'%d-%m-%Y') tanggal_pendaftaran, DATE_FORMAT(sidang_pertama,'%d-%m-%Y') sidang_pertama,panitera_pengganti_text, DATE_FORMAT(tanggal_putusan,'%d-%m-%Y') tanggal_putusan, DATE_FORMAT(tanggal_minutasi,'%d-%m-%Y') tanggal_minutasi,proses_terakhir_text
				FROM v_perkara a LEFT JOIN panitera_pn b
				ON (panitera_pengganti_id = b.`id`)
				WHERE 1=1
				".$sql_filter."
				and b.id=".$id;

		$query = $this->db->query($sql);
		return $query->result_array();

		}


	function get_selesai_hakim_detail($id,$filter){
		switch($filter) {
			case 'baik' :
				$sql_filter = 'and YEAR(tanggal_putusan)=YEAR(NOW()) AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 120';
			break;
			case 'kurang' :
				$sql_filter = 'and YEAR(tanggal_putusan)=YEAR(NOW()) AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 120 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)< 180';
			break;
			case 'sangat' :
				$sql_filter = 'and YEAR(tanggal_putusan)=YEAR(NOW()) AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)>= 180 AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)<= 360';
			break;
			case 'bahaya' :
				$sql_filter = 'and YEAR(tanggal_putusan)=YEAR(NOW()) AND DATEDIFF(CURRENT_DATE,tanggal_pendaftaran)> 360';
			break;
			default:
				$sql_filter = '';

		}
		#echo $sql_filter;

		$sql = "SELECT a.perkara_id,a.`nomor_perkara`,pihak1_text, DATE_FORMAT(tanggal_pendaftaran,'%d-%m-%Y') tanggal_pendaftaran, DATE_FORMAT(sidang_pertama,'%d-%m-%Y') sidang_pertama,panitera_pengganti_text, DATE_FORMAT(tanggal_putusan,'%d-%m-%Y') tanggal_putusan, DATE_FORMAT(tanggal_minutasi,'%d-%m-%Y') tanggal_minutasi,proses_terakhir_text, a.proses_terakhir_id, a.diperbaharui_oleh, a.diperbaharui_tanggal
									FROM v_perkara a LEFT JOIN hakim_pn b
									ON (SUBSTRING_INDEX(majelis_hakim_id, ',', 1) = b.`id`)
									WHERE 1=1
									".$sql_filter."
									and b.id=".$id;


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

    function get_sys_config($name)
    {
    		$sql="select * from sys_config where name = '$name'";
    		$query = $this->db->query($sql);
    		return $query->row()->value;
    }

}
?>
