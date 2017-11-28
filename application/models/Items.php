<?php 

/**
* @author: gsgarin
*/
class Items extends CI_Model{
	/**
	 * Save rule for data rule_analyst
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
    function save_pre($data){
        $this->db->insert('rule_analyst', $data);
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

    function getTotalQty($startYear, $endYear)
    {
        $this->db->select_sum('qty');
        $this->db->where('tanggal BETWEEN "'.date('Y-m-d', strtotime($startYear.'-01-01')).'" AND "'. date('Y-m-d', strtotime($endYear.'-01-01')).'"');
        $this->db->from('raw_data');

        $query = $this->db->get();

        return $query->row_array();

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

    function is_there_rule($startYear, $endYear){
        $query = $this->db->get_where('rule_analyst', array('year_start' => $startYear,'year_end' => $endYear), 1);
        if($query->num_rows() == 1){
            return 1;
        }else{
            return 0;
        }
    }

    function get_city_by_qty($city, $qty, $startYear, $endYear)
    {
        $this->db->select('*');
        $this->db->where('kota', $city);
        $this->db->where('qty', $qty);
        $this->db->where('tanggal BETWEEN "'.date('Y-m-d', strtotime($startYear.'-01-01')).'" AND "'. date('Y-m-d', strtotime($endYear.'-01-01')).'"');
        $this->db->from('raw_data');

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_detail_data($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('raw_data');

        $query = $this->db->get();
        return $query->row_array();
    }
} 