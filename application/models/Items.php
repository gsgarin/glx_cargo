<?php 

/**
* @author: gsgarin
*/
class Items extends CI_Model{
    function save_pre($data){
        $this->db->insert('analyst', $data);
    }
} 