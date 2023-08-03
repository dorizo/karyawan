<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('vendor_model');
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["dataresult"] = $this->vendor_model->view();
		$data["titlepage"] = "VENDOR";
		$this->load->view('template/header' , $data);
		// $this->load->view('vendor/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){

		$this->form_validation->set_rules('username', 'username', 'required');
        
        $data["dataresult"] = $this->vendor_model->viewSinggle($id);
        // $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "Vendor : " . $data["dataresult"]->vendorName;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('vendor/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->vendor_model->submitedit();	
            redirect('/vendor', 'refresh');
		
		}
	}

    public function add(){

		$this->form_validation->set_rules('username', 'username', 'required');
      $data["titlepage"] = "PROYEK ";
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('vendor/addproject' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->vendor_model->submitadd();	
            redirect('/vendor', 'refresh');
		}
	}
    public function delete($d){
        $this->vendor_model->delete($d);
        redirect('/vendor', 'refresh');    
    }
	public function profile(){
		$data["titlepage"] = "PROYEK ";
		$this->load->view('template/header' , $data);
		$this->load->view('template/footer');
	}
}
