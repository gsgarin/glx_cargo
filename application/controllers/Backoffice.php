<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* @author: gsgarin;  
*/
class Backoffice extends CI_Controller {
	protected $crud;
	function __construct()
	{
		parent::__construct();
		$this->crud = new grocery_CRUD();
		$this->crud->unset_bootstrap();
		$this->crud->unset_jquery();
		$this->crud->unset_export();
	}
	public function index()
	{
		if (empty($this->session->userdata('user_level'))) {
			$data['var_title'] = "Login";
			$data['css_files'] = "login";
			$data['js_files'] = "login";
			$data['module_name'] = "auth";
			$data['page'] = "login_form";
			$this->load->view('backend/modules/auth/home', $data);
		}elseif ($this->session->userdata('user_level')=="admin") {
			$data['menu_active'][0] = 'active';
			$data['var_title'] = APP_NAME;
			$data['module_name'] = "dashboard";
			$data['additional_css'] = "blank";
			$data['additional_js'] = "blank";
			$data['page'] = "index";
			$detail_user = array('uname' => $this->session->userdata('user_username'));
			$getUserInfo = $this->users->getAdminInfo($detail_user);
			$data['nama_user'] = $getUserInfo['nama_lengkap'];

			$this->load->view('backend/admin_master', $data);
		}else{
			redirect('backoffice/logout');
		}
	}
	function login(){
		
		if ($this->input->post('username')) {
			$data = array(
				'uname' => $this->input->post('username'),
				'passwd' => $this->input->post('password')
				);
			//print_r($data);
			$cekLoginAdmin=$this->users->cekLoginAdmin($data);
			if ($cekLoginAdmin==1) {
				$cekData=$this->users->getAdminInfo($data);
				//echo $cekData['id_user'];

				$newdata = array(
					'id_user'=>$cekData['id_user'],
					'user_username'=>$cekData['username'],
					'user_level'=>$cekData['level'],
					'skin'=>$cekData['skin']
					);
				$session_user = $this->session->set_userdata($newdata);

				redirect('', 'refresh');
			}else{
				redirect('', 'refresh');
			}
		}else{
			redirect('', 'refresh');
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('', 'refresh');
	}

	public function is_logged_in()
    {
        $user = $this->session->userdata('user_username');
        if (isset($user)) {
        	return true;
        }
        return false;
    }

    function user(){
		if ($this->is_logged_in() == true){
			$data = array('uname' => $this->session->userdata('user_username'));
			$getUserInfo = $this->users->getAdminInfo($data);
			$data['nama_user'] = $getUserInfo['nama_lengkap'];

			$data['var_title'] = APP_NAME;
			$data['module_name'] = "user";
			$data['additional_css'] = "blank";
			$data['additional_js'] = "blank";
			$data['page'] = "index";

			$this->crud->set_table('users');
			$this->crud->where('id_user', $this->session->userdata('id_user'));
			$this->crud->unset_add();
			$this->crud->unset_delete();
			$this->crud->unset_print();
			$this->crud->edit_fields('username', 'nama_lengkap', 'skin');
			$this->crud->columns('username', 'nama_lengkap', 'level');

			$output = $this->crud->render();  
			$data['output'] = $output;  

			$this->load->view('backend/admin_master', $data);
		}else{
			redirect('backoffice/index');
		}
	}


	function raw_data()
	{
		if ($this->is_logged_in() == true) 
		{
			$data['var_title'] = APP_NAME;
			$data['module_name'] = "raw-data";
			$data['additional_css'] = "blank";
			$data['additional_js'] = "blank";
			$data['page'] = "index";
			$detail_user = array('uname' => $this->session->userdata('user_username'));
			$getUserInfo = $this->users->getAdminInfo($detail_user);
			$data['nama_user'] = $getUserInfo['nama_lengkap'];



			$this->crud->set_table('raw_data');

			$this->crud->columns('customer', 'kota', 'qty', 'tanggal');

			$output = $this->crud->render();  
			$data['output'] = $output;  

			$this->load->view('backend/admin_master', $data);
		}else{
			redirect('backoffice/index');
		}
	} 

	function analyst($process = null, $param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null)
	{
		if ($this->is_logged_in() == true) {
			$data['var_title'] = APP_NAME;
			$data['module_name'] = "analyst";
			
			$detail_user = array('uname' => $this->session->userdata('user_username'));
			$getUserInfo = $this->users->getAdminInfo($detail_user);
			$data['nama_user'] = $getUserInfo['nama_lengkap'];

			if ($process == "pre" || is_null($process)) {
				$data['additional_css'] = "blank";
				$data['additional_js'] = "blank";
				$data['page'] = "pre";	
				$data['page_name'] = "Preanalyst";	
				$data_masuk_range = explode(' - ', $this->input->post('daterange'));

				if (!empty($this->input->post('daterange'))) {
					//count total data form filter
					$CountQty = $this->items->getTotalQty($data_masuk_range[0], $data_masuk_range[1]);

					$data_masuk = array(
									'user_id' => $this->session->userdata('id_user'),
									'year_start' => $data_masuk_range[0],
									'year_end' => $data_masuk_range[1],
									'total_qty' => $CountQty['qty'],
								);
					//check is there, dont save
					$is_there_rule = $this->items->is_there_rule($data_masuk_range[0], $data_masuk_range[1]);
					if ($is_there_rule != 1) {
						$save = $this->items->save_pre($data_masuk);
					}
					
					redirect('backoffice/analyst/show_by_year/'.$data_masuk_range[0].'/'.$data_masuk_range[1], 'refresh');
				}
			}elseif ($process == "show_by_year") {
				$data['additional_css'] = "blank";
				$data['additional_js'] = "blank";
				$data['page'] = "show_by_year";	
				$data['page_name'] = "Menampilkan data tahunan dari tahun ". $param1 ." hingga ". $param2;	
				$data['startYear'] = $param1;
				$data['endYear'] = $param2;
				
				//show data annually group by nama kota and calculate all qty has same nama kota
				$data['annually'] = $this->items->getAnnuallyFrom($param1, $param2);
			}elseif ($process == "show_by_month") {
				$data['month'] = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
				$data['additional_css'] = "blank";
				$data['additional_js'] = "blank";
				
				$data['startYear'] = $param1;
				$data['endYear'] = $param2;
				$detail_data = $this->items->get_detail_data($param3);
				$detail_rule = $this->items->get_detail_rule($param1, $param2);
				
				
				$result_by_month = [];
				if ($param4 > 0 && $param4 < 13) {
					for ($i=1; $i <= 100; $i++) { 
						$cityByQty = $this->items->count_qty_by_rule($detail_data['kota'], $i, $param1, $param2);	
						$count_city_and_qty_by_rule = $this->items->count_city_and_qty_by_rule($detail_data['kota'], $i, $param1, $param2);	
						$count_qty_and_month_by_rule = $this->items->count_qty_and_month_by_rule($param4, $i, $param1, $param2);	
						$bagi_kota_qty = 0;
						$bagi_bulan_qty = 0;
						if ($cityByQty != 0) {
							$bagi_kota_qty = $count_city_and_qty_by_rule/$cityByQty;
							$bagi_bulan_qty = $count_qty_and_month_by_rule/$cityByQty;
						}
						$result_by_month[$i] = [
												'prob_qty' => $i,
												'nilai_qty' => $cityByQty,
												'percentage' => $cityByQty/$detail_rule['total_qty'],
												'cond_kota_qty' => $count_city_and_qty_by_rule,
												'bagi_kota_qty' => $bagi_kota_qty,
												'cond_bulan_qty' => $count_qty_and_month_by_rule,
												'bagi_bulan_qty' => $bagi_bulan_qty,
												'bayes' => ($cityByQty/$detail_rule['total_qty'])*$bagi_kota_qty*$bagi_bulan_qty,
											];
					}
					$data['page'] = "show_by_month";	
					$data['page_name'] = "Menampilkan data bulan ". $data['month'][$param4]. " pada kota ".$detail_data['kota'];	
					$data['total_qty'] = $detail_rule['total_qty'];
					$data['max_value'] = $max_value = max(array_column($result_by_month, 'bayes'));
					$data['result_by_month'] = $result_by_month;
					$data['next_step'] = $param4 + 1;
					if ($data['next_step'] == 13) {
						$data['next_step'] = 'finish';
					}
					$data['previous'] = false;
					$data['prev_step'] = $param4 - 1;
					if ($param4 != 1) {
						$data['previous'] = true;
					}
					$max_value = max(array_column($result_by_month, 'bayes'));
					$high = array_filter($result_by_month, function($var) use ($max_value){
						return ($var['bayes'] == $max_value);
					});
					$hasil_probabilitas = 0;
					foreach ($result_by_month as $item) {
						$hasil_probabilitas += $item['bayes'];
					}
					$qty_by_high = array_column($high, 'prob_qty');
					$qty_by_high = implode("", $qty_by_high);
					//need to save result
					$data_result = array(
										'rule_id' => $detail_rule['id'],
										'kota'	=> $detail_data['kota'],
										'bulan' => $data['month'][$param4],
										'hasil_probabilitas' => $hasil_probabilitas,
										'probabilitas_tertinggi' => $max_value,
										'qty' => $qty_by_high,
									);
					$is_there_result = $this->items->is_there_result($data_result);
					if ($is_there_result  != 1) {
						$this->items->save_result($data_result);
					}
					
				}elseif ($param4 == 'finish') {
					$data['page'] = "result_analyst";
					$data['page_name'] = "Rekap data dari ".$param1." hingga ".$param2." pada kota ".$detail_data['kota'];	
					$data['get_result_by_rule'] = $this->items->get_result_by_rule($detail_rule['id'], $detail_data['kota']);
					$data['prev_step'] = 12;


				}

				



			}
			$this->load->view('backend/admin_master', $data);
		}else{
			redirect('backoffice/index');
		}
	}

	public function laporan($year_start = null, $year_end = null)
	{
		if ($this->is_logged_in() == true) 
		{
			$data['var_title'] = APP_NAME;
			$data['module_name'] = "laporan";
			$data['additional_css'] = "blank";
			$data['additional_js'] = "blank";
			$data['page'] = "laporan_option";
			$data['page_name'] = "Pilih Hasil Analis";	
			$detail_user = array('uname' => $this->session->userdata('user_username'));
			$getUserInfo = $this->users->getAdminInfo($detail_user);
			$data['nama_user'] = $getUserInfo['nama_lengkap'];

			$data['rule_list'] = $this->items->get_rule_list();





			/*$this->crud->set_table('raw_data');
			$output = $this->crud->render();  
			$data['output'] = $output;  */

			$this->load->view('backend/admin_master', $data);
		}else{
			redirect('backoffice/index');
		}
	}

	//callback
	public function dataByCity($start, $end, $city)
	{
		if ($this->is_logged_in() == true) {
			$kota = $this->items->getAnnuallyCityFrom($start, $end, $city);
			echo(json_encode(array('data'=>$kota)));
		}
	}
}
 