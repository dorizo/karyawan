<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statusproject extends CI_Controller {

	
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

	public function detail($id)
	{
		$data["titlepage"] = "Detail Project";
		$data["dataresult"] = $this->project_model->viewSinggle($id);
		$data["datastatus"] = $this->db->query("select * from job where job_name='".$data["dataresult"]->project_status."' order by job_day asc")->row();
		$data["datastatusnext"] = $this->db->query("select * from job where job_day='".($data["datastatus"]->job_day +1)."' order by job_day asc")->row();
 		$this->load->view('template/header' , $data);
		$this->load->view('detail', $data);
		$this->load->view('template/footer');
	}
	public function adddetail(){
		print_r($this->input->post());
	}
	
}
