<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
			$data['module_name'] = "raw-data";
			$data['additional_css'] = "blank";
			$data['additional_js'] = "blank";
			$data['page'] = "index";

			$this->crud->set_table('users');
			$this->crud->where('id_user', $this->session->userdata('id_user'));
			$this->crud->unset_add();
			$this->crud->unset_delete();
			$this->crud->unset_print();
			$this->crud->edit_fields('username', 'nama_lengkap');
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



			$output = $this->crud->render();  
			$data['output'] = $output;  

			$this->load->view('backend/admin_master', $data);
		}else{
			redirect('backoffice/index');
		}
	}
}
 