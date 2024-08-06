<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suratpesanan extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('suratpesanan_model');
			$this->load->model('akunbank_model');
			$this->load->model('project_model');
			$this->load->model('witel_model');
			$this->load->model('akunakutansi_model');
			$this->load->model("job_model");
			
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["dataresult"] = $this->suratpesanan_model->view();
		$data["titlepage"] = "BIAYA LAINYA";
		$data["pluginjs"] = "vendor.js";
		$this->load->view('template/header' , $data);
		$this->load->view('suratpesanan/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){

		$this->form_validation->set_rules('username', 'username', 'required');
        
        $data["dataresult"] = $this->suratpesanan_model->viewSinggle($id);
        // $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "Vendor : " . $data["dataresult"]->vendorName;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('suratpesanan/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->suratpesanan_model->submitedit();	
            redirect('/biayalain', 'refresh');
		
		}
	}
	public function editkategori($id){
        
		$data["titlepage"] = "edit surat pesanan : " . $id;
        $data["datajob"] = $this->job_model->view_after(11);
        $data["dataresult"] = $this->suratpesanan_model->allproject($id);
		$data["suratpesananCode"] = $id;
		
		$this->form_validation->set_rules('suratpesananCode', 'suratpesananCode', 'required');
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('suratpesanan/editkategori' , $data);
		$this->load->view('template/footer');
		
		}else{
			// print_r($this->input->post());
			$awwww = $this->suratpesanan_model->allproject($this->input->post("suratpesananCode"));
			foreach ($awwww as $key => $value) {
				# code...
				print_r($value["project_id"]);
				header("Location: " . $_SERVER["HTTP_REFERER"]);
				$this->db->query("UPDATE `project` SET `project_status` = '".$this->input->post("project_status")."' WHERE `project_id` =". $value["project_id"]);
			}
			// $this->suratpesanan_model->submitedit();	
            // redirect('/biayalain', 'refresh');
		
		}
	}
    public function add(){

		$this->form_validation->set_rules('NoSuratpesanan', 'NoSuratpesanan', 'required');
      $data["titlepage"] = "PROYEK ";
	  
		$data["akunbank"] = $this->akunbank_model->view();
		$data["witel"] = $this->witel_model->view();
		$data["akunakutansi"] = $this->akunakutansi_model->view();
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('suratpesanan/add' , $data);
		$this->load->view('template/footer');
		
		}else{
			$kd = $this->suratpesanan_model->submitadd();
		
            redirect('/suratpesanan/bagi/'.$kd, 'refresh');
		}
	}

	public function submitnilaiproject(){
		$title = str_replace( array( '\'', '.', ',' , ';', '<', '>' ), '', $this->input->post("nilai_project_paid"));
		$material = str_replace( array( '\'', '.', ',' , ';', '<', '>' ), '', $this->input->post("material"));
		
		 $this->input->post("material");
		 $this->db->where("project_id" , $this->input->post("project_id"));
		 $hitungperformansi = $this->db->get("project")->row();
		$performansi =  ($hitungperformansi->nilai_boq*$this->input->post("performansi"))/100;
		$this->db->where("project_id" , $this->input->post("project_id"));
		$this->db->limit(1);
		$this->db->set("nilai_project_paid" ,$title);
		$this->db->set("material" ,$material);
		$this->db->set("performansi" ,$performansi);
		$this->db->update('project');
		redirect($_SERVER['HTTP_REFERER']);
	}

    public function detail($kd){
		$this->form_validation->set_rules('bagi[]', 'bagi', 'required');
		$datax = $this->suratpesanan_model->viewSinggle($kd);
		$data["outstanding"] = $this->project_model->projectoutstendingkode($kd);
		$data["id"]  = $kd; 
		$data["titlepage"] = "pembagian biaya dari witel =".$datax->witel_id;
		$data["project"] = $this->suratpesanan_model->witelfilterpilih($kd);
	   if ($this->form_validation->run() === FALSE)
        {
		$this->load->view('template/header' , $data);
		$this->load->view('suratpesanan/detail' , $data);
		$this->load->view('template/footer');
		}
    }
	public function addoutstanding($kd){
		$this->form_validation->set_rules('bagi[]', 'bagi', 'required');
		$datax = $this->suratpesanan_model->viewSinggle($kd);
		$data["titlepage"] = "pembagian biaya dari witel =".$datax->witel_id;
		$data["project"] = $this->project_model->projectoutstending();
	   if ($this->form_validation->run() === FALSE)
        {
		$this->load->view('template/header' , $data);
		$this->load->view('suratpesanan/bagioutstanding' , $data);
		$this->load->view('template/footer');
		}else{
			// $this->db->where_in("project_id" , $this->input->post("bagi"));
			// $data["result"] = $this->db->get("project")->result_array();
            // foreach($ );
            $datamarga = array();
            foreach ($this->input->post("bagi") as $key => $value) {
                // print_r($value);
                $datamarga[$key]["suratpesananCode"] = $kd;
                $datamarga[$key]["project_id"] =  $value;
				$x = $this->project_model->viewSinggle($value);
				$datamarga[$key]["nilai_outstanding"] = ($x->nilai_project-$x->nilai_project_paid);
				// $this->db->query("UPDATE `project` SET `project_status` = 'pemberkasan' WHERE `project_id` = $value");
            }
			// print_r($datamarga);
			
			$sss = $this->db->insert_batch("suratpesananoutstanding" , $datamarga);
		if($sss){
			echo "<script>alert('data berhasil Di input');</script>";
			redirect('/suratpesanan/detail/'.$kd, 'refresh'); 
		}
			
		}
	}
	public function bagi($kd){
		$this->form_validation->set_rules('bagi[]', 'bagi', 'required');
		$datax = $this->suratpesanan_model->viewSinggle($kd);
		$data["titlepage"] = "pembagian biaya dari witel =".$datax->witel_id;
		$data["project"] = $this->suratpesanan_model->witelfilter($datax->witel_id);
	   if ($this->form_validation->run() === FALSE)
        {
		$this->load->view('template/header' , $data);
		$this->load->view('suratpesanan/bagi' , $data);
		$this->load->view('template/footer');
		}else{
			// $this->db->where_in("project_id" , $this->input->post("bagi"));
			// $data["result"] = $this->db->get("project")->result_array();
            // foreach($ );
            $datamarga = array();
            foreach ($this->input->post("bagi") as $key => $value) {
                // print_r($value);
                $datamarga[$key]["suratpesananCode"] = $kd;
                $datamarga[$key]["project_id"] =  $value;
				$this->db->query("UPDATE `project` SET `project_status` = 'pemberkasan' WHERE `project_id` = $value");
            }
			$sss = $this->db->insert_batch("suratpesanandetail" , $datamarga);
		if($sss){
			echo "<script>alert('data berhasil Di input');</script>";
			redirect('/suratpesanan', 'refresh'); 
		}
			
		}
	}
	public function finalpost(){
		// print_r($this->input->post("project_id"));
		$arr = array();
		foreach ($this->input->post("project_id") as $key => $value) {
			// print_r($value);
			$arr[$key]["persentase"] =$this->input->post("persentase")[$key]; 
			$arr[$key]["nilaibiaya"] = $this->input->post("nilaibiaya")[$key];
			$arr[$key]["project_id"] =$this->input->post("project_id")[$key]; 
			$arr[$key]["tanggal_transaksi"] = $this->input->post("tanggal_transaksi");
			$arr[$key]["biayalainCode"] = $this->input->post("biayalainCode");
		}
		// print_r($arr);
		$sss = $this->db->insert_batch("suratpesanandetail" , $arr);
		if($sss){
			echo "<script>alert('data berhasil Di input');</script>";
			redirect('/suratpesanan', 'refresh'); 
		}
  	}

    public function delete($d){
        $this->db->where("suratpesananCode" , $d);
        $SS = $this->db->delete("suratpesanandetail");
        if($SS){
            $this->suratpesanan_model->delete($d);
            redirect('/suratpesanan', 'refresh'); 
        }
    }

	public function editprojectdate(){
			$this->db->where("suratpesananCode" , $this->input->post("suratpesananCode"));
			$P = $this->db->get("suratpesanandetail")->result_array();
			$p = [];
			foreach ($P as $key => $value) {
				print_r($value);
				$SA = $this->input->post();
				unset($SA["suratpesananCode"]);
				$this->db->where("project_id" , $value["project_id"]);
				$this->db->limit(1);
				$this->db->update("project" , $SA);
				
			}
			
            redirect('/suratpesanan/editkategori/'.$this->input->post("suratpesananCode"), 'refresh'); 

	}
}
