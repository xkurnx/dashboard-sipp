<?php
class SMS_model extends CI_Model {

	
	function send($data){
		// $sql = "insert into outbox(DestinationNumber,TextDecoded) values('$to','$msg')";
		$this->db->insert("dbsms.outbox",$data);				
		
	}
	
	function del($idp){
		
			$this->db->where('idp',$idp);
			$this->db->delete("t_program",$data);
			
	}
	
	function close($idp){
			$this->db->set(array('tgl_selesai'=>date('Y-m-d h:i:s')));
			$this->db->where('idp',$idp);
			$this->db->update("t_program",$data);
		
	}
	
	/****** Program Comment **************/
	function add_comment($data){
		if ( $data['idp'] != '' )
		{
		//	echo "Insert";
			$this->db->insert("t_komentar",$data);	
		}	
	}		
		
	
	
	
}
?>
