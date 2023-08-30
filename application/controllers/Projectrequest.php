<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projectrequest extends CI_Controller {

	
	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('vendor_model');
			$this->load->model('witel_model');
			if(!$this->session->userdata("karyawanNip")){
				redirect('/login', 'refresh');
			}
			
	}

	public function request()
	{
        print_r($this->input->get());

    }

}
?>