<?php
class Ac_model extends CI_Model {

	public $sql_filter = "";


	/* Penanganan Perkara */
	function get_info_perkara($nomor_perkara){
		
		$sql = "SELECT tanggal_pendaftaran, pihak1_text, pihak2_text,tanggal_putusan, tanggal_minutasi, amar_putusan
				FROM v_perkara WHERE TRIM(LEADING '0' FROM nomor_perkara) = TRIM(LEADING '0' FROM '".$nomor_perkara."')";
		#echo $sql;		
				
		return $this->db->query($sql)->row();
	}	

	function fetch_rekap_sidang(){
		$sql = "SELECT SUM(1) s_hari_ini,
				SUM( CASE WHEN sidang_keliling='T' THEN 1 ELSE 0 END ) s_pa,
				SUM( CASE WHEN sidang_keliling='Y' THEN 1 ELSE 0 END ) sidkel
				FROM perkara_jadwal_sidang
				WHERE DATE_FORMAT(tanggal_sidang,'%D %M %Y') = DATE_FORMAT(NOW(),'%D %M %Y')";
		return $this->db->query($sql)->result_array();
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
