<?php
class init_model extends CI_Model {

	public $sql_filter = "";
    function get_sys_config($name)
    {
	   $sql="select * from sys_config where name = '$name'";
	   $query = $this->db->query($sql);
	   return $query->row()->value;
    }
}
?>
