<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akunbank extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('akunbank_model');
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["dataresult"] = $this->akunbank_model->view();
		$data["titlepage"] = "PROYEK";
		$this->load->view('template/header' , $data);
		$this->load->view('akunbank/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('projectpart/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->edit();	
            redirect('/project', 'refresh');
		
		}
	}

    public function add(){

		$this->form_validation->set_rules('total_akunbank', 'total_akunbank', 'required');
      $data["titlepage"] = "PROYEK ";
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('akunbank/add' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->akunbank_model->submitadd();	
            redirect('/akunbank', 'refresh');
		}
	}
    public function delete($d){
        $this->akunbank_model->delete($d);
        redirect('/akunbank', 'refresh');    
    }
}
