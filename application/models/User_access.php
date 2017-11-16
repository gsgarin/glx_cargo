<?php 

/**
* @author: gsgarin
*/
class User_access extends CI_Model{
	function cekLoginAdmin($data){
		$query = $this->db->get_where('users', array('username' => $data['uname'],'password' => md5($data['passwd'])), 1);
        if($query->num_rows() == 1){
            return 1;
        }else{
            return 0;
        }
	}
	function getAdminInfo($data){
        $query = $this->db->query("SELECT * FROM users WHERE username = '".$data['uname']."'");
        return $query->row_array();
    }
    function daftarUser($data){
        $this->db->insert('user', $data);
    }
} 