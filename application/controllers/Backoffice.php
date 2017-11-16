<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {
	
	public function index()
	{
		$this->load->view('backend/admin_master');
	}
}
