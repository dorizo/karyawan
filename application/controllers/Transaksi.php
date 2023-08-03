<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('akunbankTransaksi_model');
			$this->load->model('akunbank_model');
			
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function setting($a)
	{
		$data["dataresult"] = $this->project_model->viewSinggle($a);
		$data["titlepage"] = "Tambah Transaksi Project = " .$data["dataresult"]->project_code;
		$data["datatable"] = $this->akunbankTransaksi_model->view($a);
		$this->load->view('template/header' , $data);
		$this->load->view('transaksi/view' , $data);
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
		$this->load->view('transaksi/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->edit();	
            redirect('/project', 'refresh');
		
		}
	}

    public function add($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
		$data["titlepage"] = "Transaksi Project ";
		$data["project_id"] = $id;
		$data["akunbank"] = $this->akunbank_model->view();
	//   print_r($data["akunbank"]);
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('transaksi/add' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->akunbankTransaksi_model->submitadd();	
            redirect('/transaksi/setting/'.$id, 'refresh');
		}
	}
    public function delete($d){
        $this->akunbankTransaksi_model->delete($d);
		redirect($_SERVER['HTTP_REFERER']);  
    }
}
