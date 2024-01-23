<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('vendor_model');
			$this->load->model('akunbankTransaksi_model');
			$this->load->library('zip');
			$this->load->model('log_project_model');
			$this->load->model('job_model');
			$this->load->helper(array('form', 'url','directory'));
			if(!$this->session->userdata("userCodex")){
				redirect('/login', 'refresh');
			}
	}
	public function approve($kode){
		$this->db->where("project_id" , $kode);
		$this->db->join("project_cat", "project_cat.cat_id=project.cat_id");
		$this->db->join("parent_cat", "parent_cat.parentcatCode=project_cat.parentcatCode");
		$a = $this->db->get("project")->row();
		$ax = explode(",",$a->parentcatStruktur);
		$jobdey = $this->db->query("select * from job where job_day=".$ax[0])->row();
		print_r($jobdey);
		if($a->project_status != "pending"){
			$this->db->where("project_id" , $kode);
			$this->db->limit(1);
			$this->db->update("project" , array("project_status" => $jobdey->job_name));	
		}
		
		redirect('/statusproject/detail/'.$kode, 'refresh');
		



	}

	public function index()
	{
		$data["dataresult"] = $this->project_model->view();
		$data["titlepage"] = "PROYEK";
		$this->load->view('template/header' , $data);
		$this->load->view('project' , $data);
		$this->load->view('template/footer');
	}
	public function setting($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["vendorresult"] = $this->vendor_model->view();
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('projectpart/Settingnilaiproject' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->edit();
			
            redirect('/', 'refresh');
		
		}
	}
	public function download($id){
		$x = explode("/",$_SERVER['DOCUMENT_ROOT']);
		unset($x[4]);
		unset($x[5]);
		unset($x[6]);
		$path =  implode("/",$x)."/api/assets/".$id."/";
	
		// $path = $_SERVER["DOCUMENT_ROOT"]."/../../api/assets/".$id."/";
		// $path =  $_SERVER["DOCUMENT_ROOT"]."/backend_andalanpratama/assets/".$id."/";

		$this->zip->read_dir($path);

		// Download the file to your desktop. Name it "my_backup.zip"
		$this->zip->download('my_backup.zip');

	}
	public function detail($id){
        $data["dataresult"] = $this->project_model->viewSinggle($id);
		$data["logproject"] = $this->log_project_model->getlogproject($id);
		$data["sumproject"] = $this->akunbankTransaksi_model->sumproject($id);
		$data["transaksiproject"] = $this->akunbankTransaksi_model->view($id);
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
		// echo $_SERVER["DOCUMENT_ROOT"]."/../../api/assets/".$id."/";
		
			$x = explode("/",$_SERVER['DOCUMENT_ROOT']);
			unset($x[4]);
			unset($x[5]);
			unset($x[6]);
			// print_r($x);
		 $file =  implode("/",$x)."/api/assets/".$id."/";
		//local dir
		// $file =  $_SERVER["DOCUMENT_ROOT"]."/backend_andalanpratama/assets/".$id."/";
        $map = directory_map($file, false , true);
		$data["map"] =  $map;
		$this->load->view('template/header' , $data);
		$this->load->view('projectpart/detail' , $data);
		$this->load->view('template/footer');
	}
}
