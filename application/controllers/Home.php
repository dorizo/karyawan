<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('vendor_model');
			$this->load->model('witel_model');
			if(!$this->session->userdata("karyawanNip")){
				redirect('/login', 'refresh');
			}
			// print_r($user_logged_in);
			
	}

	public function index()
	{
		$data["titlepage"] = "HOME";
		$data["dataresult"] = $this->project_model->view();
		$this->load->view('template/header' , $data);
		$this->load->view('home', $data);
		$this->load->view('template/footer');
	}
	public function add(){
		
		$data["titlepage"] = "Tambah Project";
		
        $data["vendorresult"] = $this->vendor_model->view();
		
        $data["witelresult"] = $this->witel_model->view();
		$data["kategori"] = $this->db->query("select * from project_cat")->result_array();
			$this->form_validation->set_rules('project_name', 'project_name', 'required');
		 if ($this->form_validation->run() === FALSE)
		  {
		   $this->load->view('template/header' , $data);
		  $this->load->view('vendor/addproject' , $data);
		  $this->load->view('template/footer');
		  
		  }else{
			  $this->project_model->submitadd();	
			  redirect('/', 'refresh');
		  }
	}
	public function profile(){
		
		$data["titlepage"] = "Profile";
		$data["dataresult"] = $this->project_model->view();
		$this->load->view('template/header' , $data);
		$this->load->view('home', $data);
		$this->load->view('template/footer');
	}
}
