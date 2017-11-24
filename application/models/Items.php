<?php 

/**
* @author: gsgarin
*/
class Items extends CI_Model{
	/**
	 * Save rule for data analyst
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
    function save_pre($data){
        $this->db->insert('analyst', $data);
    }
    /**
     * show data annyally group by nama kota and calculate all qty from same nama kota
     */
    function getAnnuallyFrom($startYear, $endYear)
    {
    	$this->db->select('*');
    	$this->db->select_sum('qty');
    	$this->db->where('tanggal BETWEEN "'.date('Y-m-d', strtotime($startYear.'-01-01')).'" AND "'. date('Y-m-d', strtotime($endYear.'-01-01')).'"');
    	$this->db->group_by('kota');
    	$this->db->from('raw_data');

    	$query = $this->db->get();

    	return $query->result_array();

    }

    function getDetailData($id)
    {
    	$this->db->select('*');
    	$this->db->from('raw_data');
    	$this->db->where('id', $id);
    	$query = $this->db->get();

    	return $query->result_array();
    }

    function getAnnuallyCityFrom($startYear, $endYear, $city)
    {
        $this->db->select('*');
        $this->db->where('kota', urldecode($city));
        $this->db->where('tanggal BETWEEN "'.date('Y-m-d', strtotime($startYear.'-01-01')).'" AND "'. date('Y-m-d', strtotime($endYear.'-01-01')).'"');
        $this->db->from('raw_data');

        $query = $this->db->get();

        return $query->result_array();
    }
} 