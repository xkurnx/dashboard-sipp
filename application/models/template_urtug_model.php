<?php
class Template_urtug_model extends CI_Model {
	
		
	function fetch_urtug($kode_jabatan){		
		
		$sql = "select * from ref_template_urtug where kode_jabatan =".$kode_jabatan;
		#echo "<pre>$sql</pre>";	
		$q = $this->db->query($sql);	
		$ret ['result'] =	$q->result();
		$ret ['num_rows'] =	$q->num_rows();
		return $q;
	}
	
	function fetch_jabatan(){		
		
		$sql = "select * from ref_jabatan";
		#echo "<pre>$sql</pre>";	
		$q = $this->db->query($sql);	
		$ret ['result'] =	$q->result();
		$ret ['num_rows'] =	$q->num_rows();
		return $q;
	}
	
	
	
	
	function save_urtug($data){
		if ( empty($data['id']) )
		{
		//	echo "Insert";
			$this->db->insert("ref_template_urtug",$data);		
			return "Uraian Tugas Telah ditambah";	
		//	exit;
		}		
		else
		{
		//	echo "Update";
			$this->db->set($data);
			$this->db->where('id',$data['id']);
			$this->db->update("ref_template_urtug",$data);
			return "Uraian Tugas Telah diubah";	
		}	
	}
	
	function del_urtug($data){
		
			$this->db->where('id',$data['id']);
			$this->db->delete("ref_template_urtug");
			return "Data Telah dihapus";	
			
	}
	

	
	
	
}
?>
