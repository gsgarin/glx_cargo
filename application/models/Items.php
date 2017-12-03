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

    function count_qty_by_rule($city, $qty, $startYear, $endYear)
    {
        $this->db->select('*');
        $this->db->where('qty', $qty);
        $this->db->where('tanggal BETWEEN "'.date('Y-m-d', strtotime($startYear.'-01-01')).'" AND "'. date('Y-m-d', strtotime($endYear.'-01-01')).'"');
        $this->db->from('raw_data');
        return $this->db->count_all_results();
    }

    function count_city_and_qty_by_rule($city, $qty, $startYear, $endYear)
    {
        $this->db->select('*');
        $this->db->where('kota', $city);
        $this->db->where('qty', $qty);
        $this->db->where('tanggal BETWEEN "'.date('Y-m-d', strtotime($startYear.'-01-01')).'" AND "'. date('Y-m-d', strtotime($endYear.'-01-01')).'"');
        $this->db->from('raw_data');
        return $this->db->count_all_results();
    }

    function count_qty_and_month_by_rule($month, $qty, $startYear, $endYear)
    {
        $this->db->select('*');
        $this->db->where('qty', $qty);
        $this->db->where('MONTH(tanggal)', $month);
        $this->db->where('tanggal BETWEEN "'.date('Y-m-d', strtotime($startYear.'-01-01')).'" AND "'. date('Y-m-d', strtotime($endYear.'-01-01')).'"');
        $this->db->from('raw_data');
        return $this->db->count_all_results();
    }

    function get_detail_data($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('raw_data');

        $query = $this->db->get();
        return $query->row_array();
    }

    function get_detail_rule($startYear, $endYear)
    {
        $this->db->select('*');
        $this->db->where('year_start', $startYear);
        $this->db->where('year_end', $endYear);
        $this->db->from('rule_analyst');

        $query = $this->db->get();
        return $query->row_array();
    }

    function is_there_result($data)
    {
        $query = $this->db->get_where('result_analyst', array('bulan' => $data['bulan'], 'hasil_probabilitas' => $data['hasil_probabilitas'], 'qty' => $data['qty']), 1);
        if($query->num_rows() == 1){
            return 1;
        }else{
            return 0;
        }
    }

    function save_result($data)
    {
        $this->db->insert('result_analyst', $data);
    }

    function get_result_by_rule($id)
    {
        $this->db->select('*');
        $this->db->where('rule_id', $id);
        $this->db->from('result_analyst');

        $query = $this->db->get();

        return $query->result_array();
    }
} 