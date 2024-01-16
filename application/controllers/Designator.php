<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designator extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('akunbank_pengajuan_model');
			$this->load->model('akunbank_model');
			
			if(!$this->session->userdata("karyawanNip")){
				redirect('/login', 'refresh');
			}
	}
    public function add($id , $pengajuan="project"){
        $data["designatorlist"] = $this->db->query("select * from datateknis_projectkhs_detail where project_id=".$id)->result_array();
		$data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["paket"] = $this->db->query("select * from witel JOIN package ON witel.package_id=package.package_id where witel.witel_id=".$data["dataresult"]->witel_id)->row();
        $data["designator"] = $this->db->query("select * from designator")->result_array();
        $this->form_validation->set_rules('designator_id', 'designator_id', 'required');
		$data["titlepage"] = "TAMBAH DESIGNATOR ";
		$data["project_id"] = $id;
		$data["pengajuanproses"] = $pengajuan;
		$data["akunbank"] = $this->akunbank_model->view();
		$data["pengajuanstatus"] = $this->akunbank_pengajuan_model->pengajuanstatus($pengajuan);
	//   print_r($data["akunbank"]);
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('package/add' , $data);
		$this->load->view('template/footer');
		
		}else{
			$p = $this->input->post();
			$m = $this->db->query("select * from designator where designator_id=".$this->input->post("designator_id"))->row();

            $p["designator_desc"] =$m->designator_desc ;
            $p["designator_code"] =$m->designator_code ;
            $p["total_designator"] =  str_replace(",", "",$this->input->post("total_designator"));
			$this->db->insert("datateknis_projectkhs_detail",$p);
			
			redirect('/designator/add/'.$this->input->post("project_id"), 'refresh');
        }
    }

	public function getnilaipaket(){
		// print_r($this->input->post());
		$this->db->where($this->input->post());
		$s =  $this->db->get("designator_package")->row();
		echo json_encode($s);

	}


}